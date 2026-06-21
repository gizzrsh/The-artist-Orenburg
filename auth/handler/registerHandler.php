<!-- 
1. Принять данные из формы регистрации
2. Валидация и обработка данных
3. Загрузка данные в БЗ после проверки
4. Обработать существующие ошибки
5. Редирект на страницу авторизации
-->

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require $_SERVER['DOCUMENT_ROOT'] . '/inc/functions.php';

function register()
{
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    echo (validateField($name)) ? "true" : "Длина строки должна быть от 3 до 21 символа";
    echo (validateField($name)) ? "true" : "Длина строки должна быть от 3 до 21 символа";
}

register();