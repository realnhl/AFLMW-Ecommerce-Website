<?php

include('inc/config.php');
session_start();
$user_id = $_SESSION['id'];
$name = $_POST['name'];
$mobile_no = $_POST['mobile_no'];
$address = $_POST['address'];
$c_password = $_POST['c_password'];


$sql = "SELECT * FROM user 
        WHERE id = '$user_id' AND 
        password = '$c_password'";
$result = mysqli_query($conn, $sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
    $sql2 = "UPDATE user 
    SET name = '$name',
    user_address = '$address',
    mobile_no = '$mobile_no'
    WHERE id = '$user_id'";

    $result2 = mysqli_query($conn, $sql2);


    if (!$result2) {
        $message = urlencode("errorEdit");
        header("Location: changeUserSetting.php?message=" . $message);
    } else {
        $message = urlencode("successEdit");
        header("Location: changeUserSetting.php?message=" . $message);
    }
} else {
    $message = urlencode("wrongpass");
    header("Location: changeUserSetting.php?message=" . $message);
}
