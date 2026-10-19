<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="/images/logo.webp" type="image/x-icon">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-minion shadow-sm">
        <div class="container">

            <a class="navbar-brand" href="/"><img src="/images/logo.webp" alt="logo" class="logo-header"></a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarMain"
                    aria-controls="navbarMain" aria-expanded="false" aria-label="Открыть меню">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Главная</a></li>
                    <li class="nav-item"><a class="nav-link"  href="/booking">Забронировать</a></li>
                    <li class="nav-item"><a class="nav-link"  href="/#history">Уникальность праздников</a></li>
                    <li class="nav-item" ><a class="nav-link" href="/#why">Почему трио</a></li>
                    <li class="nav-item" ><a class="nav-link" href="/#question">Задать вопрос</a></li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth

                        <li class="nav-item">
                            <a class="nav-link text-bold" href="/logout">Выйти</a>
                        </li>

                        <li class="nav-item">
                            <span class="text-sans nav-link"><a href="/cabinet" style="color: black"
                            style="font-size: 20px;text-decoration: none!important;color: #4E0119">{{ Auth::user()->login }}</a></span>
                        </li>

                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/auth">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link button" href="/register">Регистрация</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    @if (session()->has('success'))
        <div class="alert alert-success alert-danger text-center m-0" style="color: #4E0119;background-color: #C9AFAF;
        border:none;border-radius: 0">
            <b>{{ session()->get('success') }}</b>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-danger text-center m-0" style="color: #C9AFAF;background-color: #4E0119;
        border:none;border-radius: 0">
            @foreach ($errors->all() as $error)
                <b>{{ $error }}</b>
            @endforeach
        </div>
    @endif
    @yield('content')
</main>
<footer class="footer">
    <div class="container">
        <div class="row gy-4 py-4 mt-0">

            {{-- Лого и о сайте --}}
            <div class="col-md-4">
                <a class="navbar-brand p-0" href="/">
                    <img src="/images/logo.webp" alt="logo" class="logo-header">
                </a>
                <p class="footer-text" >
                    Нас зовут снова. И это лучший комплимент.
                </p>
            </div>

            {{-- Навигация --}}
            <div class="col-md-4">
                <h5 class="text-hemico">Навигация</h5>
                <ul class="footer-list">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/booking">Забронировать</a></li>
                    <li><a href="/#history">Уникальность праздников</a></li>
                    <li><a href="/#why">Почему трио</a></li>
                    <li><a href="/#question">Задать вопрос</a></li>
                    @auth
                        <li><a href="/cabinet">Кабинет</a></li>
                        <li><a href="/logout">Выйти</a></li>
                    @else
                        <li><a href="/auth">Войти</a></li>
                        <li><a href="/register">Регистрация</a></li>
                    @endauth
                </ul>
            </div>

            {{-- Контакты --}}
            <div class="col-md-4">
                <h5 class="text-hemico">Контакты</h5>
                <ul class="footer-list">
                    <li><a href="mailto:fisenkopolina06@gmail.com">fisenkopolina06@gmail.com</a></li>
                    <li><a href="/https://t.me/plnsnks">Telegram</a></li>
                    <li><a href="/https://vk.ru/fisenkopolina">ВКонтакте</a></li>
                </ul>
            </div>

        </div>
    </div>

    {{-- Нижняя полоска --}}
    <div class="footer-bottom text-center">
        <p class="mb-0">© 2026 Трио у микрофона.</p>
    </div>
</footer>
<script src="{{asset('/js/script.js')}}"></script>
<script src="{{asset('/bootstrap/js/bootstrap.js')}}"></script>
</body>
</html>
