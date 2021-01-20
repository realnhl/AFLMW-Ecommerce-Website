<?php

require('inc/config.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: mylogin.php");
    die;
}

$user_id = $_SESSION['id'];
$product_id = $_POST['product_id'];
$purchase_id = $_POST['purchase_id'];
$review = $_POST['review'];

$sql = "INSERT INTO review(product_id,user_id,review_details) VALUES ('$product_id','$user_id','$review')";
$sql2 = "UPDATE purchase SET is_reviewed = '1' WHERE product_id = '$product_id'";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

if (!$result && !$result2) {
    $message = urlencode("errorAddReview");
    header("Location: myPurchases.php?message=" . $message);
} else {
    $message = urlencode("successAddReview");
    header("Location: myPurchases.php?message=" . $message);
}
