<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['userName'];
    $tun = $_POST['tun'];
    $ssccLabels = $_POST['ssccLabels'];

    // Prepare email content
    $subject = 'Product Scanning Data';
    $body = "User Name: $userName\nTUN: $tun\nSSCC Labels Scanned: " . implode(", ", $ssccLabels);

    // Setup PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server (use your provider)
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // SMTP username
        $mail->Password = 'your-email-password'; // SMTP password (or app password if 2FA enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Product Scanner');
        $mail->addAddress('DLCDCManagers@brownesdairy.com.au');

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Send email
        $mail->send();
        echo 'Email sent successfully';
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
    }
}
?>
