@extends('theme')

@section('title')
    Кабинет ведущего
@endsection

@section('content')
    <section class="register-login">
        <div class="container" style="max-width: 1100px">
            <h1 class="text-1 text-center" style="color:#F4F1EC">Кабинет ведущего</h1>

            <h2 class="anketa-block-title" style="color:#F4F1EC">Заявки и анкеты</h2>

            <div style="overflow-x: auto" class="mb-5">
                <table class="cab-table">
                    <tr>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Праздник</th>
                        <th>Дата</th>
                        <th>Место</th>
                        <th>Анкета</th>
                    </tr>
                    @foreach($applications as $app)
                        <tr>
                            <td>{{ $app->name }}</td>
                            <td>{{ $app->phone }}</td>
                            <td>{{ $app->event_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($app->event_date)->format('d.m.Y') }}</td>
                            <td>{{ $app->place ?? '—' }}</td>
                            <td>
                                @php $ank = $anketas->firstWhere('application_id', $app->id) ?? $anketas->firstWhere('user_id', $app->user_id); @endphp
                                @if($ank)
                                    <a href="/anketa/{{ $ank->id }}">открыть</a>
                                @else
                                    <span style="opacity:.5">нет</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <h2 class="anketa-block-title" style="color:#F4F1EC">Вопрос</h2>

            <div style="overflow-x: auto">
                <table class="cab-table">
                    <tr>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Соц сеть</th>
                        <th>Вопрос</th>
                    </tr>
                    @foreach($questions as $question)
                        <tr>
                            <td>{{ $question->name }}</td>
                            <td>{{ $question->phone }}</td>
                            <td>{{ $question->social }}</td>
                            <td>{{ $question->question }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection
