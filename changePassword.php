<?php

require('inc/config.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: mylogin.php");
    die;
}

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM user WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Change My Password</title>
</head>

<body class="changePassword">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <div class="container">
        <h1 class="changePasswordH1">Change Password</h1>
        <form class="changePasswordForm" action="changePassword-submit.php" method="post">
            <div>
                <label for="old_password">Old Password : </label>
                <input type="password" name="old_password" id="old_password">
            </div>
            <br>
            <div>
                <label for="new_password">New Password : </label>
                <input type="password" name="new_password" id="new_password">
            </div>
            <br>
            <div>
                <label for="c_password">Confirm New Password : </label>
                <input type="password" name="c_password" id="c_password">
            </div>
            <br>
            <hr>
            <a href="changeUserSetting.php"><button type="button" class="btn-view">Back</button></a>
            <button type="submit" class="btn-success">Update my password</button>
        </form>


    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>