<?php

include('inc/config.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: mylogin.php");
    die;
}

$user_id = $_SESSION['id'];
$new_password = $_POST['new_password'];
$old_password = $_POST['old_password'];
$c_password = $_POST['c_password'];

if ($new_password == $c_password) {
    $sql = "SELECT * FROM user 
        WHERE id = '$user_id' AND 
        password = '$old_password'";
    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $sql2 = "UPDATE user 
    SET password = '$new_password'
    WHERE id = '$user_id'";
        $result2 = mysqli_query($conn, $sql2);

        if (!$result2) {
            $message = urlencode("errorEditPass");
            header("Location: changeUserSetting.php?message=" . $message);
        } else {
            $message = urlencode("successEditPass");
            header("Location: changeUserSetting.php?message=" . $message);
        }
    } else {
        $message = urlencode("wrongpass");
        header("Location: changeUserSetting.php?message=" . $message);
    }
} else {
    $message = urlencode("confirmpasserror");
    header("Location: changeUserSetting.php?message=" . $message);
}
