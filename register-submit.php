<?php

include('inc/config.php');
session_start();

$name = $_POST['name'];
$phoneNumber = $_POST['phoneNumber'];
$address = $_POST['address'];
$password = $_POST['password'];
$email = $_POST['email'];

$sql = "INSERT INTO user(name,email,password,user_address,mobile_no) VALUES('$name','$email','$password','$address','$phoneNumber')";

$result = mysqli_query($conn, $sql);

if (!$result) {
    $message = urlencode("errorRegister");
    header("Location: mylogin.php?message=" . $message);
} else {
    $message = urlencode("successRegister");
    header("Location: mylogin.php?message=" . $message);
}
