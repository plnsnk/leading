@extends('theme')

@section('title')
    Анкета
@endsection

@section('content')
    <section class="register-login">
        <div class="form form-anketa">
            <h1 class="text-1 text-center">Анкета от {{ $anketa->created_at->format('d.m.Y') }}</h1>

            @if($application)
                <div class="anketa-block">
                    <h2 class="anketa-block-title">Данные заявки</h2>
                    <p class="show-q">Имя</p>
                    <p class="show-a">{{ $application->name }}</p>
                    <p class="show-q">Телефон</p>
                    <p class="show-a">{{ $application->phone }}</p>
                    <p class="show-q">Праздник</p>
                    <p class="show-a">{{ $application->event_type }}</p>
                    <p class="show-q">Дата</p>
                    <p class="show-a">{{ \Carbon\Carbon::parse($application->event_date)->format('d.m.Y') }}</p>
                    @if($application->place)
                        <p class="show-q">Место</p>
                        <p class="show-a">{{ $application->place }}</p>
                    @endif
                </div>
            @endif

            @foreach(config('anketa.blocks') as $block)
                <div class="anketa-block">
                    <h2 class="anketa-block-title">{{ $block['title'] }}</h2>

                    @foreach($block['questions'] as $q)
                        @php $value = $anketa->answers[$q['key']] ?? null; @endphp
                        @if(filled($value))
                            <p class="show-q">{{ $q['text'] }}</p>
                            <p class="show-a">{{ $value }}</p>
                        @endif
                    @endforeach
                </div>
            @endforeach

            <a href="/cabinet" class="form-button" style="display:block; text-align:center; text-decoration:none;color: #C9AFAF!important;">
                Назад в кабинет
            </a>
        </div>
    </section>
@endsection
