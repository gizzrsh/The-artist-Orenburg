<?php
require dirname(__DIR__, 2) . '/config/database.php';
require dirname(__DIR__, 2) . '/inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    CsrfTokenCheck();

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $errors = [];
    if (empty($email) || empty($password)) {
        $errors['auth'] = 'Неверный email или пароль.';
    }

    if (empty($errors)) {
        $pdo = new Database();

        $sql = "SELECT id, email, role_id, password FROM users WHERE email = :email";
        $user = $pdo->prepare($sql, ['email' => $email])->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['is_logged_in'] = true;

            unset($_SESSION['errors']);
            redirect('/dashboard');
        }
    } else {
            $errors['auth'] = 'Неверный email или пароль.';
    }

    $_SESSION['errors'] = $errors;
    redirect('/auth');
}