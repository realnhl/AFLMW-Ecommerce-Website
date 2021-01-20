<?php
require('inc/config.php');
session_start();
$sql = "SELECT * FROM product";

$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/css/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Generate Item Report</title>
    
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
<div class="banner">
    <img src="assets/images/logo.png" alt="logo">
</div>

<div class="container">

    <h1>Generate Item Report</h1>

    <table>
        <tr>
            <th>No.</th>
            <th>Product ID</th>
            <th>Manufacturer</th>
            <th>Model Name</th>
            <th>Price (RM)</th>
            <th>Stock</th>
        </tr>
        <?php foreach ($products as $key => $product) : ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['manufacturer']; ?></td>
                <td><?php echo $product['model_name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['stock']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table> <br><br>

    <button onclick="window.print()" class="no-print">Print this report</button>
    <a href="dashboard.php" class="no-print"><button>Back</button></a>

</div>
    <div class="no-print">
        <?php require('inc/navBar.php'); ?>
    </div>
</body>

</html>