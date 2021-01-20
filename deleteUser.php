<?php

include('inc/config.php');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: mylogin.php");
    exit;
}

$id = $_POST['id'];

$sql = "DELETE FROM user WHERE id = '$id' ";

$res = mysqli_query($conn, $sql);

if (!$res) {
    $message = urlencode("errorDeleteUser");
    header("Location: listOfUsers.php?message=" . $message);
} else {
    $message = urlencode("successDeleteUser");
    header("Location: listOfUsers.php?message=" . $message);
}
