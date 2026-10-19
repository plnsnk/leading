@extends('theme')

@section('title')
    Анкета мероприятия
@endsection

@section('content')
    <section class="register-login">
        <form action="/anketa" method="post" class="form form-anketa">
            @csrf
            @if($application)
                <input type="hidden" name="application_id" value="{{ $application->id }}">
            @endif
            <h1 class="text-1 text-center">Анкета мероприятия</h1>
            <p class="anketa-intro">
                Спасибо!    Заполните, пожалуйста, анкету — она поможет ведущему заранее
                познакомиться с вами и сделать программу именно под вас и ваших гостей.
                Поля со звёздочкой — обязательные, остальное по желанию.
            </p>

            @foreach(config('anketa.blocks') as $block)
                <div class="anketa-block">
                    <h2 class="anketa-block-title">{{ $block['title'] }}</h2>

                    @foreach($block['questions'] as $q)
                        <div class="mb-3">
                            <label class="form-label label-form">
                                {{ $q['text'] }} @if(!empty($q['req']))<span class="req">*</span>@endif
                            </label>

                            @if(in_array($q['type'], ['text', 'date', 'time']))
                                <input type="{{ $q['type'] }}" name="answers[{{ $q['key'] }}]"
                                       class="form-input" @if(!empty($q['req'])) required @endif>

                            @elseif($q['type'] === 'textarea')
                                <textarea name="answers[{{ $q['key'] }}]" rows="3" class="form-input"></textarea>

                            @elseif($q['type'] === 'select')
                                <select name="answers[{{ $q['key'] }}]" class="form-input"
                                        @if(!empty($q['req'])) required @endif>
                                    <option value="" disabled selected>Выберите…</option>
                                    @foreach($q['options'] as $opt)<option>{{ $opt }}</option>@endforeach
                                </select>

                            @elseif($q['type'] === 'radio')
                                <div class="format-checks">
                                    @foreach($q['options'] as $opt)
                                        <label class="check-item">
                                            <input type="radio" name="answers[{{ $q['key'] }}]" value="{{ $opt }}"> {{ $opt }}
                                        </label>
                                    @endforeach
                                </div>

                            @elseif($q['type'] === 'checkbox')
                                <div class="format-checks">
                                    @foreach($q['options'] as $opt)
                                        <label class="check-item">
                                            <input type="checkbox" name="answers[{{ $q['key'] }}][]" value="{{ $opt }}"> {{ $opt }}
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach

            <button type="submit" class="form-button">Отправить анкету</button>
        </form>
    </section>
@endsection
