<?php

include('inc/config.php');
session_start();

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Forgot Password</title>
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
                        No account found. Please enter correct email.
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <form class="login-form" action="forgotPassword-submit.php" method="post">

                <h2>Forgot my password</h2>
                <input type="text" name="email" placeholder="Email">
                <button type="submit" class="login-button">Recover my account</button>

            </form>
        </div>

    </main>
    <?php require('inc/navBar.php'); ?>


</body>

</html>