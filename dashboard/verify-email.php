<?php
// create session and set default timezone
session_start();

// include helpers and db
include dirname(__DIR__) . '/config/init.php';
include dirname(__DIR__) . '/config/mail.php';
include dirname(__DIR__) . '/inc/functions.php';

$email = $userRepo->findById($_SESSION['user_id']);
if ($email['email_verified'] == 0 && empty($_GET['token'])) {
    $token = bin2hex(random_bytes(32));
    $token_expired = date('Y-m-d H:i:s', strtotime('+15 minutes')) ?? '';

    $userRepo->updateTokenByEmail($email['email'], $token, $token_expired);

    $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], 'Mailer');
    $mail->addAddress($email['email'], 'Recipient');
    $mail->isHTML(true);
    $mail->Subject  = 'Ссылка для подтверждения почты';
    $mail->Body     = "Здравствуйте! Перейдите по этой ссылке и подтвердите почту: http://{$_SERVER['HTTP_HOST']}/dashboard/verify-email.php?token=$token";
    $mail->send();

    $_SESSION['success'] = 'На вашу почту отправлена ссылка для подтверждения почты';
    redirect('/dashboard');
}
if (!empty($_GET['token'])) {
    $token = $_GET['token'];

    $userRepo->emailConfirmedByToken($token);

    $_SESSION['success'] = 'Почта успешно подтверждена.';
    redirect('/dashboard');
}
