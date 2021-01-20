<?php

require('inc/config.php');
session_start();

$user_id = $_POST['id'];

$sql = "UPDATE user SET type = '2' WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    $message = urlencode("errorUpdateUser");
    header("Location: listOfUsers.php?message=" . $message);
} else {
    $message = urlencode("successUpdateUser");
    header("Location: listOfUsers.php?message=" . $message);
}
