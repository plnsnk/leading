@extends('theme')

@section('title')
    Забронировать дату
@endsection

@section('content')
    <section class="register-login">
        <form action="/booking" method="post" class="form">
            @csrf
            <h1 class="text-1 text-center">Забронировать дату</h1>

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
                    <label class="form-label label-form">Ссылка на соцсеть</label>
                    <input type="text" name="social" class="form-input" placeholder="ВК / Telegram / @ник">
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label label-form">Какой праздник</label>
                    <select name="event_type" class="form-input" required>
                        <option value="" disabled selected>Выберите…</option>
                        <option>Свадьба</option>
                        <option>День рождения</option>
                        <option>Юбилей</option>
                        <option>Корпоратив</option>
                        <option>Выпускной</option>
                        <option>Другое</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label label-form">Дата праздника</label>
                    <input type="date" name="event_date" class="form-input" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label label-form">Где будет проходить</label>
                <input type="text" name="place" class="form-input"
                       placeholder="Город, площадка: ресторан, загородный дом…">
            </div>

            <div class="mb-3">
                <label class="form-label label-form">Какой формат хотите</label>
                <div class="format-checks">
                    <label class="check-item"><input type="checkbox" name="format[]" value="Весело"> Весело</label>
                    <label class="check-item"><input type="checkbox" name="format[]" value="Душевно"> Душевно</label>
                    <label class="check-item"><input type="checkbox" name="format[]" value="Стильно"> Стильно</label>
                    <label class="check-item"><input type="checkbox" name="format[]" value="Доверюсь вам"> Доверюсь вам</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label label-form">Комментарий - что ещё важно</label>
                <textarea name="comment" rows="4" class="form-input"
                          placeholder="Количество гостей, особенности, пожелания…"></textarea>
            </div>

            <button type="submit" class="form-button">Отправить заявку</button>
        </form>
    </section>
@endsection
