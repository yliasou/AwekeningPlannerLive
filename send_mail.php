<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files (Adjust path if needed)
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server (e.g., smtp.office365.com for Outlook)
        $mail->SMTPAuth = true;
        $mail->Username = 'yliasfranckgadie@gmail.com'; // Replace with your email
        $mail->Password = 'cxid uiel iydr pajc'; // Use an App Password if using Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or PHPMailer::ENCRYPTION_SMTPS for SSL
        $mail->Port = 587; // 465 for SSL, 587 for TLS

        // Email details
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('yliasfranckgadie@gmail.com'); // Change to the recipient's email
        $mail->Subject = 'Nouveau message de contact';
        
        // Email Body
        $body = "Nom: " . htmlspecialchars($_POST["name"]) . "\n";
        $body .= "Email: " . filter_var($_POST["email"], FILTER_SANITIZE_EMAIL) . "\n";
        $body .= "Téléphone: " . htmlspecialchars($_POST["phone"]) . "\n\n";
        $body .= "Message:\n" . htmlspecialchars($_POST["message"]);

        $mail->Body = $body;

        // Send Email
        $mail->send();
        echo "Votre message a été envoyé avec succès!";
        header("Location: success.html");
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du message: {$mail->ErrorInfo}";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
