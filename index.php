<?php

use App\Controllers\FormController;

include "Vendor/autoload.php";
include "App/Services/helpers.php";

// создание экземпляра класса-контроллера
$controller = new FormController();

// образение к методу handle, который выполняет обработку
if($_POST) $controller->handle();

include "Resources/Views/header.php";
?>

<section class="form-section">
    <div class="container">
        <form action="" method="POST" class="feedback-form">
            <!--если запрос выполнен успешно-->
            <?php if(isset($_GET['success'])): ?>
            <div class="alert success-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="success-block__image" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                </svg>
                <!--вывод полученных данных-->
                Клиент №<?= $_GET['contractor'] ?> и сделка №<?= $_GET['deal'] ?> успешно созданы.
            </div>
            <!--если запрос выполнен с ошибкой-->
            <?php elseif(isset($_GET['error'])): ?>
            <div class="alert danger-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="success-block__image" viewBox="0 0 16 16">
                    <path d="M4.355.522a.5.5 0 0 1 .623.333l.291.956A4.979 4.979 0 0 1 8 1c1.007 0 1.946.298 2.731.811l.29-.956a.5.5 0 1 1 .957.29l-.41 1.352A4.985 4.985 0 0 1 13 6h.5a.5.5 0 0 0 .5-.5V5a.5.5 0 0 1 1 0v.5A1.5 1.5 0 0 1 13.5 7H13v1h1.5a.5.5 0 0 1 0 1H13v1h.5a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 1 1-1 0v-.5a.5.5 0 0 0-.5-.5H13a5 5 0 0 1-10 0h-.5a.5.5 0 0 0-.5.5v.5a.5.5 0 1 1-1 0v-.5A1.5 1.5 0 0 1 2.5 10H3V9H1.5a.5.5 0 0 1 0-1H3V7h-.5A1.5 1.5 0 0 1 1 5.5V5a.5.5 0 0 1 1 0v.5a.5.5 0 0 0 .5.5H3c0-1.364.547-2.601 1.432-3.503l-.41-1.352a.5.5 0 0 1 .333-.623zM4 7v4a4 4 0 0 0 3.5 3.97V7H4zm4.5 0v7.97A4 4 0 0 0 12 11V7H8.5zM12 6a3.989 3.989 0 0 0-1.334-2.982A3.983 3.983 0 0 0 8 2a3.983 3.983 0 0 0-2.667 1.018A3.989 3.989 0 0 0 4 6h8z"/>
                </svg>
                При отправке данных произошла ошибка.
            </div>
            <?php endif ?>
            <h2 class="feedback-form__title">Обратная связь</h2>
            <div class="feedback-form__group">
                <input type="text" class="feedback-form__input" name="firstName" placeholder="Имя" required>
                <input type="text" class="feedback-form__input" name="lastName" placeholder="Фамилия" required>
            </div>
            <div class="feedback-form__group">
                <input type="text" class="feedback-form__input" name="middleName" placeholder="Отчество" required>
                <input type="text" class="feedback-form__input" name="contractorPhone" placeholder="Номер телефона" required>
            </div>
            <input type="email" class="feedback-form__input" name="contractorEmail" placeholder="Email-адрес" required>
            <textarea name="description" class="feedback-form__input feedback-form__text" placeholder="Комментарий" required></textarea>
            <button type="submit" class="feedback-form__button">Отправить</button>
        </form>
    </div>
</section>

<?php
include "resources/views/footer.php"
?>
