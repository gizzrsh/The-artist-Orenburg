<?php
require_once __DIR__ . '/init.php';
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
$mail->isSMTP();
$mail ->CharSet     = "UTF-8";
$mail->Host         = $_ENV['MAIL_HOST'];
$mail->SMTPAuth     = true;
$mail->Username     = $_ENV['MAIL_USERNAME'];
$mail->Password     = $_ENV['MAIL_PASSWORD'];
$mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port         = $_ENV['MAIL_PORT'];