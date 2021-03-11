<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);


$mail->SMTPDebug = 0;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = 'mailescapepool@gmail.com';
$mail->Password = 'St3kk3rd00s';

$mail->setFrom('mailescapepool@gmail.com');
$mail->addReplyTo('mailescapepool@gmail.com');
$mail->isHTML(true);