<?php

require('inc/config.php');
session_start();

// if (isset($_SESSION['name'])) {
// 	header("Location: dashboard.php");
// 	die;
// }

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM user "; // Summary recent purchases
$result1 = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>List of Users</title>
</head>

<body class="listOfUser">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] == "errorDeleteUser") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Unable to delete user. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successDeleteUser") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                User has successfully been deleted from the system!
            </div>
        <?php elseif ($_GET['message'] == "errorUpdateAdmin") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Failed to make this user as admin. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successUpdateAdmin") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                The user has successfully been upgraded to admin!
            </div>
        <?php elseif ($_GET['message'] == "errorUpdateUser") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Failed to demote this user. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successUpdateUser") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                The user has successfully been demoted to user!
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="container">
        <h1>List of Users</h1>
        <br>
        <table>
            <tr>
                <th>No</th>
                <th>Details</th>
                <th>Date Registered</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $key => $user) : ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td>
                        ID : <b><?php echo $user['id']; ?></b><br>
                        Name : <b><?php echo $user['name']; ?></b><br>
                        Email : <b><?php echo $user['email']; ?></b><br>
                        Mobile Number : <b><?php echo $user['mobile_no']; ?></b><br>
                        Address : <b><?php echo $user['user_address']; ?></b><br>
                        Type : <?php if ($user['type'] == 1) : ?>
                            <b>Admin</b>
                        <?php else : ?>
                            <b>Normal User</b>
                        <?php endif; ?>
                        <br>
                    </td>
                    <td><?php echo $user['date_created']; ?><br></td>
                    <?php if ($user['id'] != $user_id) : ?>
                        <td>

                            <?php if ($user['type'] != 1) : ?>
                                <form action=" makeAdmin.php" method="post" style="display: inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="btn-success">Make as Admin</button>
                                </form>
                            <?php else : ?>
                                <form action="makeUser.php" method="post" style="display: inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="btn-edit">Demote to user</button>
                                </form>
                            <?php endif; ?>
                            <form action="deleteUser.php" method="post" style="display: inline-block;">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete user</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>

    <?php require('inc/navBar.php'); ?>
</body>

</html>