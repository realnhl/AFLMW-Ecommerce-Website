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
    <title>Change My Email Address</title>
</head>

<body class="changeEmail">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <div class="container">
        <h1 class="changeEmailH1">Change Email Address</h1>
        <form class="changeEmailForm" action="changeEmail-submit.php" method="post">
            <div>
                <label for="old_email">Old Email : </label>
                <input type="email" disabled name="old_email" id="old_email" value="<?php echo $user[0]['email']; ?>">
            </div>
            <br>
            <div>
                <label for="new_email">New Email : </label>
                <input type="email" name="new_email" id="new_email">
            </div>
            <br>
            <div>
                <label for="c_password">Confirm Password to change your email : </label>
                <input type="password" name="c_password" id="c_password">
            </div>
            <br>
            <hr>
            <a href="changeUserSetting.php"><button type="button" class="btn-view">Back</button></a>
            <button type="submit" class="btn-success">Update my email</button>
        </form>

    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>