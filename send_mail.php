<?php
// Đường dẫn đến tập tin PHPMailer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Tạo đối tượng PHPMailer
$mail = new PHPMailer(true);

try {
    // Cấu hình thông tin máy chủ SMTP
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '6095753ecbbc14';
    $mail->Password = '8fded65453be18';
    $mail->Port = 2525;

    // Thiết lập thông tin người gửi và người nhận
    $mail->setFrom('phamtuyetanh2@gmail.com', 'TA');
    $mail->addAddress($email);

    // Thiết lập nội dung email
    $mail->isHTML(true);
    $mail->Subject = 'SignUp successfully';
    $mail->Body = 'Congratulations on your successful registration';

    // Gửi email
    $mail->send();

} catch (Exception $e) {
    echo 'Failed to send email. Error: ' . $mail->ErrorInfo;
}