<?php
// create session and set default timezone
session_start();

// include helpers and db
include dirname(__DIR__) . '/inc/functions.php';
include dirname(__DIR__) . '/config/database.php';
include dirname(__DIR__) . '/config/mail.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    CsrfTokenCheck();
    
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
         'email' => $email]
    );

    // send link with token for reser password
    $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], 'Mailer');
    $mail->addAddress($email, 'Recipient');
    $mail->isHTML(true);
    $mail->Subject  = 'Ссылка для восстановения пароля';
    $mail->Body     = "Здравствуйте! Перейдите по этой ссылке и заполните новый пароль: http://{$_SERVER['HTTP_HOST']}/reset-password/password-change.php?token=$token";
    $mail->send();

    // save success message and redirect
    $_SESSION['success'] = 'Ссылка отправлена на почту.';
    redirect('/reset-password');
}