<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // SMTP server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com';    // e.g. smtp.sendgrid.net, smtp.gmail.com, or your mail host
    $mail->SMTPAuth   = true;
    $mail->Username   = 'smtp_username';
    $mail->Password   = 'smtp_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or PHPMailer::ENCRYPTION_SMTPS
    $mail->Port       = 587; // 465 for SMTPS, 587 for STARTTLS

    // Message settings
    $mail->setFrom('info@saimunenterprise.com', 'Saimun Enterprise');
    $mail->addAddress('recipient@example.com', 'Recipient Name'); // change recipient
    // $mail->addReplyTo('replyto@example.com', 'Reply Name'); // optional

    $mail->isHTML(true);
    $mail->Subject = 'Test email from PHP (PHPMailer)';
    $mail->Body    = '<p>Hello — this is a <strong>test</strong> email.</p>';
    $mail->AltBody = "Hello — this is a test email.";

    // Optional: attach
    // $mail->addAttachment('/path/to/file.pdf', 'file.pdf');

    $mail->send();
    echo "Message sent\n";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
}
