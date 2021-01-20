<?php

require('inc/config.php');
session_start();


$type = $_GET['type'];
$sql = "";

$titleName = "";

if ($type == "1") { // Current year
    $titleName = "Current Year";
    $sql = "SELECT * FROM purchase INNER JOIN product ON purchase.product_id = product.id WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 YEAR)";
} else if ($type == "2") { // Current Month
    $titleName = "Current Month";
    $sql = "SELECT * FROM purchase INNER JOIN product ON purchase.product_id = product.id WHERE YEAR(date_created) = YEAR(NOW()) AND MONTH(date_created)=MONTH(NOW())";
} else if ($type == "3") { // Current week
    $titleName = "Current Week";
    $sql = "SELECT * FROM purchase INNER JOIN product ON purchase.product_id = product.id WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
} else { // Today
    $titleName = "Today";
    $sql = "SELECT * FROM purchase INNER JOIN product ON purchase.product_id = product.id WHERE DATE_FORMAT(date_created, '%Y-%m-%d') = CURDATE()";
}

$result = mysqli_query($conn, $sql);
$purchases = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/css/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
    <title>Generate Report</title>
</head>

<body>
<div class="banner">
    <img src="assets/images/logo.png" alt="logo">
</div>

<div class="container">

    <h1>Generate Purchases Report (<?php echo $titleName; ?>)</h1>

    <table>
        <tr>
            <th>No.</th>
            <th>Date Purchase</th>
            <th>Product Name</th>
            <th>Manufacturer</th>
            <th>Price (RM)</th>
            <th>Quantity</th>
            <th>Sub-Total (RM)</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($purchases as $key => $purchase) : ?>
            <?php $total += $purchase['quantity'] * $purchase['price']; ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $purchase['date_created']; ?></td>
                <td><?php echo $purchase['model_name']; ?></td>
                <td><?php echo $purchase['manufacturer']; ?></td>
                <td><?php echo $purchase['price']; ?></td>
                <td><?php echo $purchase['quantity']; ?></td>
                <td><?php echo ($purchase['quantity'] * $purchase['price']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h1>Total = RM<?php echo $total; ?></h1> <br><br>

    <button onclick="window.print()" class="no-print">Print this report</button>
    <a href="dashboard.php" class="no-print"><button>Back</button></a>

</div>
<div class="no-print">
    <?php require('inc/navBar.php'); ?>
</div>
</body>

</html>