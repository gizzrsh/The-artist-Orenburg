<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require $_SERVER['DOCUMENT_ROOT'] . '/inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $errors = [];
    if (!validateField($name)) {
        $errors['name'] = 'Имя должно содержать от 3 до 21 символа';
    }
    if (!validateEmail($email)) {
        $errors['email'] = 'Укажите настоящий email, например name@example.com';
    }
    if (!validatePassword($password)) {
        $errors['password'] = 'Пароль должен быть от 8 символов, содержать строчные и заглавные буквы, цифру и спецсимвол (!@#$%...)';
    }

    if (empty($errors)) {
        $pdo = new Database();
        $checkSql = "SELECT id FROM users WHERE email = :email";
        $checkStmt = $pdo->prepare($checkSql, ['email' => $email]);
        
        if ($checkStmt->rowCount() > 0) {
            $errors['email'] = 'Пользователь с таким email уже зарегистрирован';
            $_SESSION['errors'] = $errors;
        } else {
            $sql = "INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)";
            $pdo->prepare($sql, ['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT), 'role_id' => 3]);
        }

        redirect('/auth');
    } else {
        $_SESSION['errors'] = $errors;
        redirect('/auth');
    }
}