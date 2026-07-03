<?php
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
$mail ->CharSet = "UTF-8";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // Адрес почтового сервера (например, smtp.yandex.ru)
$mail->SMTPAuth = true;
$mail->Username = 'blood100012@gmail.com'; // Ваша почта
$mail->Password = 'cfdczgensyoqsfon'; // Ваш пароль или токен приложения
$mail->Port = 587; 