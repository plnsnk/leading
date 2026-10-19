@extends('theme')

@section('title')
    Личный кабинет
@endsection

@section('content')
    <section class="register-login">
        <div class="container" style="max-width: 900px">
            <h1 class="text-1 text-center" style="color:#F4F1EC">Личный кабинет</h1>

            <h2 class="anketa-block-title" style="color:#F4F1EC">Мои заявки</h2>

            @forelse($applications as $app)
                <div class="cab-card">
                    <div class="cab-card-head">
                        <span class="cab-event">{{ $app->event_type }}</span>
                        <span>{{ \Carbon\Carbon::parse($app->event_date)->format('d.m.Y') }}</span>
                    </div>
                    <p class="cab-line"><b>Имя:</b> {{ $app->name }}</p>
                    <p class="cab-line"><b>Телефон:</b> {{ $app->phone }}</p>
                    @if($app->place)<p class="cab-line"><b>Место:</b> {{ $app->place }}</p>@endif
                    @if($app->format)<p class="cab-line"><b>Формат:</b> {{ $app->format }}</p>@endif

                    @php $anketa = $anketasByApp[$app->id] ?? null; @endphp

                    @if($anketa)
                        <a class="cab-link" href="/anketa/{{ $anketa->id }}">Посмотреть анкету →</a>
                    @else
                        <a class="cab-link" href="/anketa?application_id={{ $app->id }}">
                            Заполнить анкету для этого мероприятия →
                        </a>
                    @endif
                </div>
            @empty
                <p class="cab-empty">Заявок пока нет - <a href="/booking" class="a">забронировать дату</a>.</p>
            @endforelse
            <div class="container" style="max-width: 900px">
                <h1 class="text-1 text-center"></h1>
                <h2 class="anketa-block-title" style="color:#F4F1EC">Мои вопросы</h2>

                @forelse($questions as $question)
                    <div class="cab-card">
                        <p class="cab-line"><b>Имя:</b> {{ $question->name }}</p>
                        <p class="cab-line"><b>Телефон:</b> {{ $question->phone }}</p>
                        <p class="cab-line"><b>Телефон:</b> {{ $question->question }}</p>
                    </div>
                @empty
                    <p class="cab-empty">Вопросов пока нет - <a href="/question" class="a">задать вопрос</a>.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection
