<?php

require('inc/config.php');
session_start();

$sql = "SELECT * FROM product"; // Summary recent purchases
$result1 = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/css.css">
    <title>Shop Products</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/container.css">
</head>

<body class="index">

    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <div class="container">
        <h1>List of Products</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
            <?php foreach ($products as $key => $product) : ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td>
                        Product Name : <b><?php echo $product['model_name']; ?></b><br>
                        Manufacturer : <b><?php echo $product['manufacturer']; ?></b><br>
                        Product Price : <b><?php echo $product['price']; ?></b><br>
                    </td>
                    <td>
                        <a href="viewProduct.php?id=<?php echo $product['id']; ?>"><button class="btn-view">View Product</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>


    <?php require('inc/navBar.php'); ?>
</body>


</html>