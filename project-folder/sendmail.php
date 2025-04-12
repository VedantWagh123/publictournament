<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer ko include karo
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Mailer setup
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                      
    $mail->Host       = 'smtp.gmail.com';                
    $mail->SMTPAuth   = true;                               
    $mail->Username   = 'gullytournament@gmail.com';     // ✅ Gmail ID
    $mail->Password   = 'egdn dodc xrwd nfcq';         // ✅ App Password (16 digit)
    $mail->SMTPSecure = 'tls';                         
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('', 'Vedant Tournament');
    $mail->addAddress('someone@example.com', 'Player');    // ✅ Jisko bhejna hai

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Tournament Registration Successful';
    $mail->Body    = '<h3>Congrats! Your registration is confirmed.</h3><p>We will contact you soon.</p>';
    $mail->AltBody = 'Congrats! Your registration is confirmed. We will contact you soon.';

    $mail->send();
    echo 'Message has been sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
