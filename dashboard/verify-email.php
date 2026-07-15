<?php
// create session and set default timezone
session_start();

// include helpers and db
include dirname(__DIR__) . '/inc/functions.php';
include dirname(__DIR__) . '/config/mail.php';
include dirname(__DIR__) . '/config/database.php';

$pdo = new Database;
$email = $pdo->prepare('SELECT email, email_verified FROM users WHERE id = :id', ['id' => $_SESSION['user_id']])->fetch();
if ($email['email_verified'] == 0 && empty($_GET['token'])) {
    $token = bin2hex(random_bytes(32));
    $token_expired = date('Y-m-d H:i:s', strtotime('+15 minutes')) ?? '';

    $pdo->prepare('UPDATE users 
        SET token = :token, token_expired = :token_expired 
        WHERE email = :email', 
        [
            ':token' => $token, 
            ':token_expired' => $token_expired, 
            ':email' => $email['email']
        ]
    );

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
    $pdo->prepare('UPDATE users 
                    SET token = NULL, token_expired = NULL, email_verified = 1 
                    WHERE token = :token AND token_expired > NOW()', 
        [
            'token' => $_GET['token']
        ]
    );
    $_SESSION['success'] = 'Почта успешно подтверждена.';
    redirect('/dashboard');
}
