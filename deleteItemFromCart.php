<?php

include('inc/config.php');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: mylogin.php");
    die;
}

$id = $_POST['id'];

$sql = "DELETE FROM cart WHERE id = '$id' ";

$res = mysqli_query($conn, $sql);

if (!$res) {
    $message = urlencode("errorDeleteCart");
} else {
    $message = urlencode("successDeleteCart");
    header("Location: myCart.php?message=" . $message);
}
