<?php

require('inc/config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // $active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $email and $password, table row must be 1 row

    if ($count == 1) {
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['login'] = true;
        $_SESSION['type'] = $row['type'];
        header("location: dashboard.php");
    } else {
        $message = urlencode("error");
        header("Location: mylogin.php?message=" . $message);
    }
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>AFLMW Login Page</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/loginSignUp.css">
</head>

<body>
    <main>
        <div class="log-main">
            <div class="banner">
                <img src="assets/images/logo.png" alt="logo">
            </div>

            <?php if (isset($_GET['message'])) : ?>
                <?php if ($_GET['message'] == "error") : ?>
                    <div class="alert-error">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        Login Failed! You entered wrong email or password. Please try again.
                    </div>
                <?php endif; ?>
                <?php if ($_GET['message'] == "successRegister") : ?>
                    <div class="alert-success">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        Your account has successfully been created! Please login to start shopping.
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <form class="login-form" action="mylogin.php" method="POST" style="margin-top: 60px">

                <h2>Hello there!</h2>
                <input required type="text" name="email" placeholder="Email">
                <input required type="password" name="password" placeholder="Password">
                <button type="submit" class="login-button">Sign In</button>
                <h4><a href="myregister.php">Not a member? Click here to sign up!</a></h4>
                <a href="forgotPassword.php">Forgot password?</a>

            </form>
        </div>

    </main>
    <?php require('inc/navBar.php'); ?>


</body>

</html>