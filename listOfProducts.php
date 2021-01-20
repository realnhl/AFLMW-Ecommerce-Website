<?php

require('inc/config.php');
session_start();

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM product"; // Summary recent purchases
$result1 = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>List of Products</title>
</head>

<body class="listOfProduct">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] == "errorAddNew") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Unable to add new camera. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successAddNew") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                New camera has been successfully added!
            </div>
        <?php elseif ($_GET['message'] == "errorDelete") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Cannot delete the camera. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successDelete") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                The camera has successfully been deleted from the store!
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="container">
        <h1>List of Products</h1>
        <a href="addProduct.php"><button class="btn-success" style="margin-bottom:30px;">Add new product</button></a>

        <table class="productTable">
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
                        Product Price : RM <b><?php echo $product['price']; ?></b><br>
                        Stocks : <b><?php echo $product['stock']; ?></b><br>
                    </td>
                    <td>
                        <a href="viewProduct.php?id=<?php echo $product['id']; ?>"><button class="btn-view">View Product</button></a>
                        <a href="editProduct.php?id=<?php echo $product['id']; ?>"><button class="btn-edit">Edit details</button></a>
                        <form action="deleteProduct.php" method="post" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <input type="hidden" name="picture" value="<?php echo $product['picture']; ?>">
                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete product?')">Delete product</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>