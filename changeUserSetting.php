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
    <title>Change User Setting</title>
</head>

<body class="changeUserSetting">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] == "errorEditEmail") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Unable to update email. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successEditEmail") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Email has been successfully updated!
            </div>
        <?php elseif ($_GET['message'] == "wrongpass") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Wrong password. Please enter your correct password.
            </div>
        <?php elseif ($_GET['message'] == "errorEditPass") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Unable to update password. Please try again!
            </div>
        <?php elseif ($_GET['message'] == "successEditPass") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Password has been successfully updated!
            </div>
        <?php elseif ($_GET['message'] == "confirmpasserror") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Your new password and confirmation password do not match.
            </div>
        <?php elseif ($_GET['message'] == "errorEdit") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Your details failed to be updated. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successEdit") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Your information has been successfully updated.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="container">

        <h1><i>Change User Setting</i></h1>
        <form class="changeUserSettingForm" action="updateUserSetting.php" method="POST">
            <div>
                <label for="name">Name : </label>
                <input type="text" name="name" id="name" value="<?php echo $user[0]['name']; ?>">
            </div>
            <br>
            <div>
                <label for="email">Email : </label>
                <input type="email" disabled name="email" id="email" value="<?php echo $user[0]['email']; ?>">
                <br>
                <a href="changeEmail.php" style="display: inline-block;"><button type="button" class="btn-view">Change my email</button></a>
            </div>
            <br>
            <div>
                <label for="password">Password : </label>
                <input type="password" disabled name="password" id="password" value="<?php echo $user[0]['password']; ?>">
                <br>
                <a href="changePassword.php"><button type="button" class="btn-view">Change my password</button></a>
            </div>

            <br>
            <div>
                <label for="mobile_no">Mobile Phone No. : </label>
                <input type="text" name="mobile_no" id="mobile_no" value="<?php echo $user[0]['mobile_no']; ?>">
            </div>
            <br>
            <div>
                <label for="address">Home Address : </label>
                <textarea name="address" id="address" cols="30" rows="5"><?php echo $user[0]['user_address']; ?></textarea>
            </div>
            <br>
            <div>
                <label for="c_password">Confirm Password to change your information : </label>
                <br>
                <input type="password" name="c_password" id="c_password">
            </div>
            <button type="submit" class="btn-success">Update my info</button>
        </form>
    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>