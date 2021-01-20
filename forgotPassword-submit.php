<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('inc/config.php');
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';

$email = $_POST['email'];

$sql = "SELECT password FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = mysqli_num_rows($result);
$message = "";

$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'webdevproj2020@gmail.com'; // email
$mail->Password = 'webDevProj2020'; // password


if ($count == 1) {
    $mail->setFrom('admin@aflmwstore.com', 'Administrator AFLMW'); // From email and name
    $mail->addAddress($email, 'Shopper'); // to email and name
    $mail->Subject = 'Password Reset';
    $mail->msgHTML("Your password is " . $row['password'] . " Please login to the website to continue shopping with us! Thank you"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
    if(!$mail->send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
        echo "Message sent!";
        echo "<script> location.href='https://aflmwstore.000webhostapp.com/mylogin.php'; </script>";
        exit;

    }
    
} else {
    $message = urlencode("error");
    header("Location: forgotPassword.php?message=" . $message);
}
