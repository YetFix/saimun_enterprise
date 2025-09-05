<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // adjust path if not using Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = "mail.saimunenterprise.com";   // Replace with your mail server
        $mail->SMTPAuth   = true;
        $mail->Username   = "business@saimunenterprise.com";   // SMTP username
        $mail->Password   = "business@saimunenterprise.com";         // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Or PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 587; // 465 for SSL

        // From and To
        $mail->setFrom("business@saimunenterprise.com", "Website Contact Form");
        $mail->addAddress("business@saimunenterprise.com", "Saimun Enterprise");

        // Optional: reply-to the person who filled the form
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Contact Form: " . $subject;
        $mail->Body    = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
        ";
        $mail->AltBody = "Name: {$name}\nEmail: {$email}\nSubject: {$subject}\nMessage:\n{$message}";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
