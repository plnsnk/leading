@extends('theme')

@section('title')
    Три у микрофона || Ведущие с душой
@endsection

@section('content')
    <section id="banner">
        <div class="banner-content">
            <p class="banner-sub">Ведущие с душой</p>
            <h1 class="banner-text">
                Берём на себя микрофон, настроение и атмосферу -
                вам остаётся только наслаждаться праздником
            </h1>
            <a href="/booking" class="banner-btn">Забронировать дату</a>
        </div>
    </section>

    <section class="working" id="history">
        <div class="container">
            <h1 class="text-1 text-center p-4">У каждого праздника своя история</h1>

            <div class="row align-items-stretch">
                <div class="col-md-5 no-work p-4">
                    <p class="block-sub">Мы не про это</p>
                    <p class="block-text">«Конкурс → тост → танец → конкурс → торт»</p>
                </div>

                <div class="col-md-2 work-arrow d-none d-lg-flex">→</div>

                <div class="col-md-5 work p-4">
                    <p class="block-sub">Мы про это</p>
                    <p class="block-text">
                        Сначала мы узнаём вас: кто будет на празднике, какие у вас
                        отношения с гостями, что вы любите, что точно не любите и каким
                        хотите запомнить этот день. А потом создаём концепцию именно
                        для вашего события.
                    </p>
                    <p class="block-chain">Ваши люди → ваша история → наша идея → ваш праздник</p>
                </div>
            </div>
        </div>
    </section>
    <section class="why-section pb-2" id="why" >
        <div class="container">
            <h1 class="text-1 text-center p-4 pb-2">Почему нас трое</h1>
            <p class="why-intro">
                Один ведущий - это хорошо.<br>
                А три - это когда всё под контролем и при этом никто не скучает.
            </p>

            <div class="row g-4">
                <div class="col-md-6 why-card">
                    <p class="why-card-sub">Три характера</p>
                    <p class="why-card-text">Каждая из нас - со своей энергетикой, юмором и стилем общения.</p>
                </div>
                <div class="col-md-6 why-card">
                    <p class="why-card-sub">Три взгляда на праздник</p>
                    <p class="why-card-text">Мы замечаем больше: кто засмеялся,
                        кто готов выйти в конкурс, кому пора дать микрофон, а кому — бокал.</p>
                </div>
                <div class="col-md-6 why-card">
                    <p class="why-card-sub">Всё под контролем</p>
                    <p class="why-card-text">Пока одна ведёт конкурс, вторая встречает гостей,
                        а третья уже решает вопрос с музыкой и тортом. Праздник идёт спокойно и по плану.</p>
                </div>
                <div class="col-md-6 why-card">
                    <p class="why-card-sub">Одна команда</p>
                    <p class="why-card-text">Мы работаем как единый механизм, поэтому праздник
                        получается динамичным, живым и непредсказуемо хорошим.</p>
                </div>
            </div>

            <p class="why-final">Три ведущие - втрое больше харизмы, юмора и эмоций.</p>
            <h1 class="text-1 text-center p-4"></h1>
        </div>
    </section>

    <section class="register-login" id="question" style="background: rgb(78, 1, 25)!important;">

        <form action="/questions" method="post" class="form">
            @csrf
            <h1 class="text-1 text-center">Задать вопрос</h1>

            <div class="mb-3">
                <label class="form-label label-form">Как к вам обращаться</label>
                <input type="text" name="name" class="form-input" placeholder="Например: Анна" required>
            </div>

            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label label-form">Номер телефона</label>
                    <input type="tel" name="phone" class="form-input" placeholder="+7 (___) ___-__-__" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label label-form">Куда вам написать ответ</label>
                    <input type="text" name="social" class="form-input" placeholder="ВК / Telegram / @ник / Почта / Позвонить">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label label-form">Вопрос</label>
                <textarea name="question" rows="4" class="form-input"
                          placeholder="Задайте вопрос, мы с радостью ответим на него!"></textarea>
            </div>

            <button type="submit" class="form-button">Отправить вопрос</button>
        </form>
    </section>
@endsection
