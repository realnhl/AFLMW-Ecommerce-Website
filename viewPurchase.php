<?php

require('inc/config.php');
session_start();

$user_id = $_SESSION['id'];
$order_id = $_GET['order_id'];
$product_id = $_GET['product_id'];

$sql = "SELECT * FROM purchase WHERE order_id = '$order_id' AND product_id = '$product_id'";
$sql2 = "SELECT * FROM payment WHERE order_id = '$order_id'";
$sql3 = "SELECT * FROM product WHERE id = '$product_id'";
$sql4 = "SELECT * FROM user INNER JOIN purchase ON user.id = purchase.user_id WHERE order_id = '$order_id'";
//$sql4 = "SELECT * FROM user WHERE id = '$user_id'";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);

$purchase = mysqli_fetch_all($result, MYSQLI_ASSOC);
$payment = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$product = mysqli_fetch_all($result3, MYSQLI_ASSOC);
$user = mysqli_fetch_all($result4, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>View Purchase Details</title>
</head>

<body class="viewPurchase">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <div class="container">

        <h1>Product Details</h1>
        Product Name : <b><?php echo $product[0]['model_name']; ?></b><br>
        Product Price : <b><?php echo $product[0]['price']; ?></b><br>
        Quantity : <b><?php echo $purchase[0]['quantity']; ?></b><br><br>
        Status : <b><?php echo $purchase[0]['status']; ?></b><br><br>
        <?php if ($purchase[0]['status'] == "DELIVERED" && $purchase[0]['is_reviewed'] == "0" && $user_id == $purchase[0]['user_id']) : ?>
            <form action="createReview-submit.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product[0]['id']; ?>">
                <h3> Write a review</h3>
                <textarea name="review" id="" cols="30" rows="10"></textarea><br><br>
                <button type="submit" class="btn-success">Submit</button><br>
            </form>
        <?php endif; ?>

        <a href="viewProduct.php?id=<?php echo $product[0]['id']; ?>"><button class="btn-view">View Product</button></a>

        <h1>Payment Details</h1>
        Order ID : <b><?php echo $purchase[0]['order_id']; ?></b><br>
        Receiver's Name : <b><?php echo $user[0]['name']; ?></b><br>
        Receiver's Phone Number : <b><?php echo $user[0]['mobile_no']; ?></b><br>
        Shipping Address : <b><?php echo $user[0]['user_address']; ?></b><br>
        Bank Name : <b><?php echo $payment[0]['bank_name']; ?></b><br>
        Date Paid : <b><?php echo $payment[0]['date_created']; ?></b><br>
        Total Paid : <b>RM<?php echo $payment[0]['total']; ?></b><br>

    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>