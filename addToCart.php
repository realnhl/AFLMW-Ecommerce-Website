<?php
include('inc/config.php');
session_start();

$user_id = $_SESSION['id'];
$product_id = $_POST['id'];
$quantity = $_POST['quantity'];
$stock = $_POST['stock'];

$sqlFindDuplicate = "SELECT * FROM cart WHERE product_id = '$product_id'";
$resultFindDuplicate = mysqli_query($conn, $sqlFindDuplicate);
$product = mysqli_fetch_all($resultFindDuplicate, MYSQLI_ASSOC);
$count = mysqli_num_rows($resultFindDuplicate);
if ($count == 1) {
    if ($quantity > $stock) {
        $message = urlencode("NotEnoughStock");
        header("Location: viewProduct.php?id=" . $product_id .  "&message=" . $message);
    } else {
        $currentQuantity = (int) $product[0]['quantity'];
        $newQuantity = $currentQuantity + $quantity;
        $sql = "UPDATE cart 
    SET quantity = '$newQuantity'
    WHERE product_id = '$product_id'";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $message = urlencode("errorAddCart");
            header("Location: myCart.php?message=" . $message);
        } else {
            $message = urlencode("successAddCart");
            header("Location: myCart.php?message=" . $message);
        }
    }
} else {
    if ($quantity > $stock) {
        $message = urlencode("NotEnoughStock");
        header("Location: viewProduct.php?id=" . $product_id .  "&message=" . $message);
    } else {
        $sql = "INSERT INTO cart(
            product_id,
            user_id,
            quantity)
            VALUES(
            '$product_id',
            '$user_id',
            '$quantity'
            )";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $message = urlencode("errorAddCart");
            header("Location: myCart.php?message=" . $message);
        } else {
            $message = urlencode("successAddCart");
            header("Location: myCart.php?message=" . $message);
        }
    }
}
