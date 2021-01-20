<?php

require('inc/config.php');
session_start();

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM purchase 
        INNER JOIN product on purchase.product_id = product.id
        WHERE user_id = '$user_id'
        ORDER BY date_created DESC"; // Summary recent purchases
$result1 = mysqli_query($conn, $sql);
$purchases = mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>My Purchases</title>
</head>

<body class="myPurchases">

    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] == "errorAddPayment") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Unable to proceed to payment. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successAddPayment") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Payment submitted successfully. Wait for your item to be shipped out.
            </div>
        <?php elseif ($_GET['message'] == "errorAddReview") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Review failed to be submitted. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successAddReview") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                The review has successfully been submitted!
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="container">

        <h1>History of My Purchases</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Details</th>
                <th>Date Purchase</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($purchases as $key => $purchase) : ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td>
                        Product Name : <b><?php echo $purchase['model_name']; ?></b><br>
                        Product Price : <b><?php echo $purchase['price']; ?></b><br>
                        Quantity : <b><?php echo $purchase['quantity']; ?></b><br>
                    </td>
                    <td><?php echo $purchase['date_created']; ?></td>
                    <td><?php echo $purchase['status']; ?></td>
                    <td>
                        <a href="viewPurchase.php?order_id=<?php echo $purchase['order_id']; ?>&product_id=<?php echo $purchase['product_id']; ?>"><button class="btn-view">View Purchase Details</button></a> </td>
                </tr> <?php endforeach; ?>
        </table>
    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>