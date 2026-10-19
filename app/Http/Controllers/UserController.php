<?php

namespace App\Http\Controllers;

use App\Models\Anketa;
use App\Models\Application;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;


class UserController extends Controller
{
   public function registerForm()
   {
       return view('register');
   }

   public function register(Request $request)
   {
       $request->validate([
           'login' => 'min:8|max:15|unique:users,login|alpha_dash|required',
           'password' => 'min:8|max:30|confirmed|regex:/[a-zA-Z]/|regex:/[0-9]/|required',
           'email' => 'email|unique:users,email|max:100|required',
           'phone' => 'min:11|max:12|required',
           'username' => 'min:10|max:100|required'
       ],[
           'required'           => 'Поле :attribute обязательно для заполнения.',
           'login.min'          => 'Логин минимум 8 символов.',
           'login.max'          => 'Логин максимум 15 символов.',
           'login.unique'       => 'Такой логин уже занят.',
           'login.alpha_dash'   => 'Логин — только буквы, цифры, дефис и подчёркивание.',
           'password.min'       => 'Пароль минимум 8 символов.',
           'password.confirmed' => 'Пароли не совпадают.',
           'email.email'        => 'Введите корректный email.',
           'email.unique'       => 'Этот email уже зарегистрирован.',
           'phone.regex'        => 'Некорректный номер телефона.',
           'username.min'       => 'ФИО минимум 10 символов.',
           'min'                => ':attribute минимум :min символов.',
           'max'                => ':attribute максимум :max символов.',
       ]);
       $exists = User::where('login', $request->login)->exists();
       if($exists){
           return back()->withInput()->withErrors('Этот логин занят. Попробуйте еще раз!');
       }
       $user = User::create([
           'login'=>$request->login,
           'phone'=>$request->phone,
           'email'=>$request->email,
           'username'=>$request->username,
           'password'=>Hash::make($request->password),
       ]);
       Auth::login($user);
       return redirect('/cabinet')->with('success', 'Вы успешно вошли в аккаунт');
   }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ], [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ]);
        $exists = User::where('login', $request->login)->exists();
        if(!$exists){
            return back()->withErrors('Этого логина не существует. Попробуйте еще раз!');
        }
       $success= Auth::attempt([
            'login'=>$request->login,
            'password'=>$request->password,
        ]);
        if(!$success) {
            return back()->withErrors('Пароль или логин неверный');
        }
        return redirect('cabinet')->with('success','вы успешно вошли в аккаунт');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Вы успешно вышли из аккаунта');
    }

    public function cabinet()
    {
        $user = Auth::user();

        if ($user->admin) {
            return view('cabinet-admin', [
                'applications' => Application::latest()->get(),
                'anketas'      => Anketa::latest()->get(),
                'questions'      => Question::latest()->get(),
            ]);
        }

        $questions = Question::where('user_id', $user->id)->latest()->get();
        $applications = Application::where('user_id', $user->id)->latest()->get();
        $anketas      = Anketa::where('user_id', $user->id)->latest()->get();

        // мапа: application_id => anketa (для быстрой проверки в blade)
        $anketasByApp = $anketas->keyBy('application_id');

        return view('cabinet', [
            'questions'    => $questions,
            'applications'    => $applications,
            'anketas'         => $anketas,
            'anketasByApp'    => $anketasByApp,
        ]);
    }



}
