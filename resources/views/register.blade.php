@extends('theme')

@section('title')
    Регистрация
@endsection

@section('content')
    <section class="register-login d-flex justify-content-center">
        <form action="/register" method="post" class="form m-5 p-4">
            @csrf
            <h1 class="text-1 text-center p-3 " >Зарегистрироваться</h1>

            <div class="mb-3">
                <label class="form-label label-form">Логин</label>
                <input type="text" name="login" class="form-input" placeholder="Логин"
                       value="{{ old('login') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label label-form">ФИО</label>
                <input type="text" name="username" class="form-input" placeholder="ФИО"
                       value="{{ old('username') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label label-form">Номер телефона</label>
                <input type="tel" name="phone" class="form-input" placeholder="Номер телефона"
                       value="{{ old('phone') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label label-form">Почта</label>
                <input type="email" name="email" class="form-input" placeholder="Почта"
                       value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label label-form">Пароль</label>
                <input type="password" name="password" class="form-input" placeholder="Пароль" required>
            </div>

            <div class="mb-3">
                <label class="form-label label-form">Повторите пароль</label>
                <input type="password" name="password_confirmation" class="form-input"
                       placeholder="Повторите пароль" required>
            </div>

            <button type="submit" class="form-button">Зарегистрироваться</button>
            <hr>
            <p class="text-center p-3 m-0 pb-0">У вас есть аккаунт? <a href="/auth"><b>Войти</b></a></p>
        </form>
    </section>
@endsection
