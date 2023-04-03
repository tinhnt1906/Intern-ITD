<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

function sendMail($email, $name, $resetURL, $subject)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username   = 'tinhnt1906@gmail.com';                     //SMTP username
        $mail->Password   = 'eamzxtyucphesvmw';                               //SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Thiết lập thông tin người gửi và người nhận
        $mail->setFrom($email, $name);
        $mail->addAddress($email, $name);

        // Thiết lập tiêu đề và nội dung email
        $mail->Subject = $subject;
        $mail->Body = 'Xin chào ' . $name . ',' . $resetURL . '';
        // Thiết lập định dạng email là HTML
        $mail->isHTML(true);
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}