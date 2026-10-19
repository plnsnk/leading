<?php

namespace App\Http\Controllers;

use App\Models\Anketa;
use App\Models\Application;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function forms()
    {
        return view('forms');
    }
    // в MainController (или отдельный BookingController)
    public function bookingForm()
    {
        return view('booking');
    }

    public function booking(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|max:100',
            'phone'      => 'required|max:20',
            'event_type' => 'required|max:50',
            'event_date' => 'required|date',
        ], [
            'required'        => 'Поле :attribute обязательно.',
            'event_date.date' => 'Укажите дату праздника.',
        ]);

        $data['format']  = $request->has('format') ? implode(', ', $request->format) : null;
        $data['user_id'] = Auth::id();

        Application::create($data);

        return redirect('/cabinet')->with('success', 'Заявка отправлена!
        Мы скоро свяжемся с вами и сообщим свободна ли дата!');
    }
    public function anketaForm(Request $request)
    {
        $applicationId = $request->query('application_id');
        $application   = null;

        if ($applicationId) {
            $application = Application::where('id', $applicationId)
                ->where('user_id', Auth::id())
                ->first();

            // если анкета для этой заявки уже есть — редирект на просмотр
            if ($application && Anketa::where('application_id', $application->id)->exists()) {
                $anketa = Anketa::where('application_id', $application->id)->first();
                return redirect('/anketa/' . $anketa->id);
            }
        }

        return view('anketa', ['application' => $application]);
    }

    public function anketaStore(Request $request)
    {
        $answers = $request->input('answers', []);

        foreach ($answers as $key => $value) {
            if (is_array($value)) {
                $answers[$key] = implode(', ', $value);
            }
        }

        foreach (['name', 'event_type', 'date'] as $field) {
            if (empty($answers[$field])) {
                return back()->withErrors('Заполните обязательные поля: имя, тип праздника и дата.')->withInput();
            }
        }

        // привязываем к конкретной заявке
        $applicationId = $request->input('application_id');
        $application   = null;

        if ($applicationId) {
            $application = Application::where('id', $applicationId)
                ->where('user_id', Auth::id())
                ->first();

            // защита: нельзя заполнить две анкеты на одну заявку
            if ($application && Anketa::where('application_id', $application->id)->exists()) {
                return back()->withErrors('Анкета для этой заявки уже заполнена.');
            }
        }

        Anketa::create([
            'user_id'        => Auth::id(),
            'application_id' => $application?->id,
            'answers'        => $answers,
        ]);

        return redirect('/cabinet')->with('success', 'Анкета отправлена! Мы изучим её до созвона.');
    }
    public function anketaShow($id)
    {
        $anketa = Anketa::findOrFail($id);

        // ищем заявку по application_id из анкеты, а не по id анкеты
        $application = $anketa->application_id
            ? Application::find($anketa->application_id)
            : null;

        // проверка доступа
        if (!Auth::user()->admin && $anketa->user_id !== Auth::id()) {
            abort(403);
        }

        return view('anketa-show', [
            'anketa'      => $anketa,
            'application' => $application,  // может быть null
        ]);
    }
    public function questions(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|max:100',
            'phone'      => 'required|max:20',
            'question' => 'required|min:5',

        ], [
            'min'                => ':attribute минимум :min символов.',
            'max'                => ':attribute максимум :max символов.',
            'required'        => 'Поле :attribute обязательно.',
        ]);

        $question  = Question::create([
            'phone' => $request->phone,
            'name' => $request->name,
            'social' => $request->social,
            'question' => $request->question,
        ]);
        if(Auth::check()){
            $question['user_id'] = Auth::id();
            $question->save();
        }

        return redirect('/')->with('success', 'Вопрос отправлен! Мы скоро свяжемся с вами для ответа на ваш вопрос!');
    }
}
