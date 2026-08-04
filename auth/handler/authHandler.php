<?php
require dirname(__DIR__, 2) . '/config/init.php';
require dirname(__DIR__, 2) . '/inc/functions.php';

$maxLimit = 6;
$clean_ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ?? 'unknown';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    CsrfTokenCheck();

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email)) { $errors['email'] = 'Введите email.'; }
    if (empty($password)) { $errors['password'] = 'Введите пароль.'; }

    if (empty($errors)) {

        $user = $userRepo->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['is_logged_in'] = true;

            unset($_SESSION['errors']);
            redirect('/dashboard');
        } else {
            $errors['auth'] = 'Неверный email или пароль.';
        }
    }
    
    $_SESSION['errors'] = $errors;
    $_SESSION['active_tab'] = 'login';
    redirect('/auth');
}