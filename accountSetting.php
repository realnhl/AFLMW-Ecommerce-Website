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
    <title>My Account</title>
</head>

<body class="acc-setting">

    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <div class="container">

        <h1 class="acc-setting-h1">My Account</h1>
        <table id="acc-set">
            <tr>
                <td>User ID: </td>
                <td><?php echo $user[0]['id']; ?></td>
            </tr>
            <tr>
                <td>Full Name: </td>
                <td><?php echo $user[0]['name']; ?></td>
            </tr>
            <tr>
                <td>Email Address: </td>
                <td><?php echo $user[0]['email']; ?></td>
            </tr>
            <tr>
                <td>Mobile Phone: </td>
                <td><?php echo $user[0]['mobile_no']; ?></td>
            </tr>
            <tr>
                <td>Home Address:</td>
                <td><?php echo $user[0]['user_address']; ?></td>
            </tr>
            <tr>
                <td>User Type</td>
                <td>
                    <?php if ($user[0]['type'] == 1) : ?>
                        Administrator
                    <?php else : ?>
                        Normal User
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <br>
        <hr>
        <a href="changeUserSetting.php"><button class="btn-view">Change User Information</button></a>
    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>