<?php
require dirname(__DIR__, 2) . '/config/init.php';
require dirname(__DIR__, 2) . '/inc/functions.php';

$max_limit = 4;
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
            $userRepo->clearCounterAttempts($email, $clean_ip);
            $userRepo->updateCounterAttempts($email, $clean_ip, '1');

            unset($_SESSION['errors']);
            redirect('/dashboard');
        } else {
            $stmt = Database::getConnection()->prepare('SELECT COUNT(*) AS total_attempts FROM auth_attempts
                WHERE email = :email AND ip = :ip AND is_success = FALSE
                    AND attempt_time > NOW() - INTERVAL 15 MINUTE;');
            $stmt->execute(['email' => $email, 'ip' => $clean_ip]);
            $attempts_count = $stmt->fetch();

            $userRepo->updateCounterAttempts($email, $clean_ip, '0');

            $errors['auth'] = 'Неверный email или пароль.';

            if ($attempts_count['total_attempts'] == $max_limit) {
                $errors['auth_limit'] = 'Вам ограничен доступ, попробуйте позже!';
            }
        }
    }
    
    $_SESSION['errors'] = $errors;
    $_SESSION['active_tab'] = 'login';
    redirect('/auth');
}