<?php
// create session and set default timezone
session_start();
date_default_timezone_set('Asia/Yekaterinburg');

// include helpers and db
include dirname(__DIR__) . '/inc/functions.php';
include dirname(__DIR__) . '/config/database.php';
include dirname(__DIR__) . '/config/mail.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get data
    $token = bin2hex(random_bytes(32));
    $token_expired = (date('Y-m-d H:i:s', strtotime('+15 minutes')));
    $email = $_POST['email'];

    // check exists user
    $pdo = new Database;
    $user = $pdo->prepare('SELECT * FROM users WHERE email = :email', ['email' => $email])->fetch();
    if (!$user || !validateEmail($email)) {
        $_SESSION['errors']['user'] = 'Пользователь не найден.';
        redirect('/reset-password');
    }

    // update columns token and token expired, if gotten email matches
    $pdo->prepare('UPDATE users
                SET token = :token, token_expired = :token_expired
                WHERE email = :email', 
                ['token' => $token, 
                    'token_expired' => $token_expired, 
                    'email' => $email]);

    // send link with token for reser password
    $mail->setFrom('blood100012@gmail.com');
    $mail->addAddress($email);
    $mail->Subject = 'link to reset your password';
    $mail->Body = "Привет! Это ссылка для сброса пароля: http://localhost:8080/reset-password/password-change.php?token=$token";
    $mail->send();

    // save success message and redirect
    $_SESSION['success'] = 'Ссылка отправлена на почту.';
    redirect('/reset-password');
}