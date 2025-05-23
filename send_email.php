<?php
session_start();

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

$_SESSION['form_data'] = $_POST;

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Palagay na lang po ng Google account sa Username and sa addAddress.
    // Then Google App Password naman po sa password.
    $mail->Username = "@gmail.com";  // Google acount 
    $mail->Password = " ";           // Google app password

    $mail->setFrom($email, $name);
    $mail->addAddress("@gmail.com");    // Google acount 

    $mail->Subject = $subject;
    $mail->isHTML(true);
    $mail->Body = "
        <div style='font-family: Arial, sans-serif; font-size: 18px;'>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <br>
            <p><strong>Message:</strong></p>
            <p>{$message}</p>
        </div>
    ";

    $mail->send();
    $_SESSION['status'] = "
    <style>
        .status-message {
            color: rgb(0, 130, 80);
        }
        @media (max-width: 900px) {
            .status-message {
                text-align: center;
            }
        }
    </style>
    <p class='status-message'>Message sent.<br>Thank you for contacting us!</p>";
    unset($_SESSION['form_data']);
}
catch (Exception $e) {
    $_SESSION['status'] = "
    <style>
        .status-message {
            color:rgb(137, 11, 0);
        }
        @media (max-width: 900px) {
            .status-message {
                text-align: center;
            }
        }
    </style>
    <p class='status-message'>Something went wrong. Please try agian.</p>";
}

header("Location: contact_form.php");