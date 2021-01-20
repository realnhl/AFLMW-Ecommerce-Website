<?php

require('inc/config.php');
session_start();

$user_id = $_SESSION['id'];

$sql = "SELECT c.*,p.model_name,p.price
        FROM cart c
        INNER JOIN product p on c.product_id = p.id
        WHERE c.user_id = '$user_id' 
        ORDER BY date_created"; // Summary my cart

$result = mysqli_query($conn, $sql);
$cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>My Cart</title>
</head>

<body class="myCart">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] == "errorAddCart") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Unable to add product to cart. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successAddCart") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                The product has been successfully added to cart.
            </div>
        <?php elseif ($_GET['message'] == "errorDeleteCart") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Cannot delete the product. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successDeleteCart") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                The product has successfully been deleted from the cart!
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="container">

        <h1>List of My Cart</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Details</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
            <?php $total = 0; ?>
            <?php foreach ($cart_items as $key => $cart_item) : ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td>
                        Product Name : <b><?php echo $cart_item['model_name']; ?></b><br>
                        Product Price : <b><?php echo $cart_item['price']; ?></b><br>
                        Quantity : <b><?php echo $cart_item['quantity']; ?></b><br>
                    </td>
                    <td><?php echo $cart_item['date_created']; ?></td>
                    <td>
                        <a href="viewProduct.php?id=<?php echo $cart_item['product_id']; ?>"><button class="btn-view">View Product</button></a>
                        <form action="deleteItemFromCart.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $cart_item['id']; ?>">
                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product from cart?')">Delete item</button>
                        </form>
                    </td>
                </tr>

                <?php $total +=  $cart_item['price'] * $cart_item['quantity']; ?>

            <?php endforeach; ?>
        </table>
        <br>
        <h2>Total : RM<?php echo $total; ?></h2>
        <hr>
        <a href="checkOut.php"><button class="btn-success">Check out</button></a>
    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>