<?php

require('inc/config.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: mylogin.php");
    die;
}

$purchase_id = $_POST['purchase_id'];
$status = $_POST['status'];

$sql = "UPDATE purchase SET status = '$status' WHERE id = '$purchase_id'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    $message = urlencode("errorEdit");
    header("Location: purchasesHistory.php?message=" . $message);
} else {
    $message = urlencode("successEdit");
    header("Location: purchasesHistory.php?message=" . $message);
}
