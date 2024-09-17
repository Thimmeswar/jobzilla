<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json'); // Ensure JSON response

    // Extract form data and sanitize it
    $name = htmlspecialchars($_POST['username1']);
    $email = htmlspecialchars($_POST['email1']);
    $phone = htmlspecialchars($_POST['phone1']);
    $subject = htmlspecialchars($_POST['subject1']);
    $message = htmlspecialchars($_POST['message1']);
    $adminEmail = 'navithap0720@gmail.com';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '18jadalaakhila@gmail.com'; // Your Gmail address
        $mail->Password   = 'lgnfjcnyywkbhrbt';     // Your Gmail App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('admin@gmail.com', 'Your Name');
        $mail->addAddress($adminEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Job Request';
        $mail->Body    = "<h2>Client Details</h2>
                          <p><strong>Subject:</strong> {$subject}</p>
                          <p><strong>Name:</strong> {$name}</p>
                          <p><strong>Phone:</strong> {$phone}</p>
                          <p><strong>Email:</strong> {$email}</p>
                          <p><strong>Message:</strong><br>{$message}</p>";

        // Send email and handle success or failure
        if ($mail->send()) {
            echo json_encode(['status' => 'success', 'message' => 'Your message has been sent successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send message. Mailer Error: ' . $mail->ErrorInfo]);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message. Mailer Error: ' . $e->getMessage()]);
    }
    exit(); // Stop further execution
}
?>
