<?php
require_once __DIR__ . '/init.php';
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail ->CharSet     = "UTF-8";
$mail->Host         = $_ENV['MAIL_HOST'];
$mail->Port         = $_ENV['MAIL_PORT'];
$mail->SMTPAuth     = false;
$mail->SMTPSecure   = false;