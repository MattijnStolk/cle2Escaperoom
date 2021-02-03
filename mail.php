<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {

    $mail->SMTPDebug    = 2;

    $mail->isSMTP();
    $mail->Host         = 'smtp.gmail.com';
    $mail->SMTPAuth     = true;
    $mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port         = 587;

    $mail->Username     = 'mailescapepool@gmail.com';
    $mail->Password     = 'St3kk3rd00s';


    $mail->setFrom('mailescapepool@gmail.com');
    $mail->addAddress('0986087@hr.nl', 'Mattijn stolk');
    $mail->addReplyTo('0986087@hr.nl');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

    $mail->isHTML(true);
    $mail->Subject      = 'Dit is een testmail vanuit PHPMailer';
    $mail->Body         = $body;
    $mail->AltBody      = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';

} catch (Exception $exception){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}