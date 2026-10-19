@extends('theme')

@section('title')
    Авторизация
@endsection

@section('content')
    <section class="register-login d-flex justify-content-center">
        <form action="/auth" method="post" class="form m-5 p-4">
            @csrf
            <h1 class="text-bold text-center p-3" style="font-size: 28px">Войти</h1>

            <div class="mb-3">
                <label class="text form-label label-form">Логин</label>
                <input type="text" name="login" class="form-input form-group" placeholder="Логин" required>
                <div class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
                <label class="text form-label label-form">Пароль</label>
                <input type="password" name="password" class="form-input form-group" placeholder="Пароль" required>
                <div class="invalid-feedback"></div>
            </div>

            <button type="submit" class="text text-center form-button" style="font-size: 24px;">
                Войти</button>
            <hr>
            <p class=" text-center p-3 m-0 pb-0">У вас нет аккаунта? <a href="/register">
                    <b>Зарегистрироваться</b></a></p>
        </form>
    </section>
@endsection
