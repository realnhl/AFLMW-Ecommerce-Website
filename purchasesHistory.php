<?php

require('inc/config.php');
session_start();

$sql = "SELECT * FROM purchase 
        INNER JOIN product on purchase.product_id = product.id
        ORDER BY date_created DESC"; // Summary recent purchases
$result1 = mysqli_query($conn, $sql);
$purchases = mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/container.css">
    <title>List of Purchases</title>
</head>

<body class="purchaseHistory">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] == "errorEdit") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Update failed! Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successEdit") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Update success!
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="container">

        <h1>List of Purchases</h1>
        <table class="paleBlueRows">
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
                        <a href="viewProduct.php?id=<?php echo $purchase['product_id']; ?>"><button class="btn-view">View Product</button></a>
                        <a href="viewPurchase.php?order_id=<?php echo $purchase['order_id']; ?>&product_id=<?php echo $purchase['product_id']; ?>"><button class="btn-success">View Purchase Details</button></a>
                        <?php if ($purchase['status'] != "DELIVERED") : ?>
                            <a href="changeStatus.php?order_id=<?php echo $purchase['order_id']; ?>&product_id=<?php echo $purchase['product_id']; ?>"><button class="btn-edit">Edit Status</button></a>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
    </div>


    <?php require('inc/navBar.php'); ?>
</body>

</html>