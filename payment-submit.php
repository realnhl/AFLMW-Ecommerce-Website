<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('inc/config.php');
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';

$user_id = $_SESSION['id'];
$bank_name = $_POST['bank_name'];
$order_id = $_POST['order_id'];
$total = $_POST['total'];

$sql = "INSERT INTO purchase(product_id,quantity,user_id,order_id) SELECT product_id,quantity,concat('" . $user_id . "'),concat('" . $order_id . "') FROM cart WHERE user_id = '$user_id'";

$sql2 = "INSERT INTO payment(order_id,bank_name,total) VALUES ('$order_id','$bank_name','$total')";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'webdevproj2020@gmail.com'; // email
$mail->Password = 'webDevProj2020'; // password
$mail->setFrom('admin@aflmwstore.com', 'Administrator AFLMW'); // From email and name
$mail->addAddress($_SESSION['email'], 'Shopper'); // to email and name
$mail->Subject = 'AFLMW : Purchase Details';


if (!$result && !$result2) {
    $message = urlencode("errorAddPayment");
    header("Location: myPurchases.php?message=" . $message);
} else {
    $emailSQL =
        "SELECT c.*,p.model_name,p.price
        FROM cart c
        INNER JOIN product p on c.product_id = p.id
        WHERE c.user_id = '$user_id' 
        ORDER BY date_created";

    $resultEmail = mysqli_query($conn, $emailSQL);
    $purchases = mysqli_fetch_all($resultEmail, MYSQLI_ASSOC);

    foreach ($purchases as $key => $purchase) {
        $quantity = $purchase['quantity'];
        $product_id = $purchase['product_id'];
        $sqlRemoveStock = "UPDATE product SET stock = stock - '$quantity' WHERE id = '$product_id'";
        $resultRemoveStock = mysqli_query($conn, $sqlRemoveStock);
    }
    $counter = 0;
    $message = "";
    $message .= "<h2>Your purchase details</h2> <br><br>";
    foreach ($purchases as $key => $purchase) {
        $message .= "No : " . ++$counter . "<br>";
        $message .= "Product Name : " . $purchase['model_name'] . "<br>";
        $message .= "Product Price : " . $purchase['price'] . "<br>";
        $message .= "Quantity : " . $purchase['quantity'] . "<br>";
        $message .= "Date Added : " . $purchase['date_created'] . "<br>";
    }

    $message .= "<b>Total : RM" . $total . "</b><br>";
    $message .= "To view more details, please visit our website.";

    $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        $sql3 = "DELETE FROM cart WHERE user_id = '$user_id'";
        $result3 = mysqli_query($conn, $sql3);
        echo "<script> location.href='https://aflmwstore.000webhostapp.com/myPurchases.php?message=successAddPayment'; </script>";
        exit;
    }

    
}
