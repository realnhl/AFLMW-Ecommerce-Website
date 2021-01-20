<?php

include('inc/config.php');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: mylogin.php");
    exit;
}

$id = $_POST['id'];
$picture = $_POST['picture'];

$sql = "DELETE FROM product WHERE id = '$id' ";

$res = mysqli_query($conn, $sql);
unlink('uploads/' . $picture);

if (!$res) {
    $message = urlencode("errorDelete");
    header("Location: listOfProducts.php?message=" . $message);
} else {
    $message = urlencode("successDelete");
    header("Location: listOfProducts.php?message=" . $message);
}
