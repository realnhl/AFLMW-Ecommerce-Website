<?php

require('inc/config.php');
session_start();

$product_id = $_GET['id'];

$sql = "SELECT * FROM product WHERE id = '$product_id'";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM review INNER JOIN user on review.user_id = user.id WHERE product_id = '$product_id'";
$result2 = mysqli_query($conn, $sql2);

$product = mysqli_fetch_all($result, MYSQLI_ASSOC);
$reviews = mysqli_fetch_all($result2, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product Details</title>
    <link rel="stylesheet" href="assets/css/container.css" />
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body class="viewProduct">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] == "NotEnoughStock") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Not enough stock. We will restock soon. Thank you.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="container" style="padding:0 5em;">

        <h1>View Product Details</h1>

        <img src="uploads/<?php echo $product[0]['picture']; ?>" height="300" width="auto" alt="">

        <div>
            <p>Model Name : <?php echo $product[0]['model_name']; ?></p>
        </div>

        <div>
            <p>Manufacturer : <?php echo $product[0]['manufacturer']; ?></p>
        </div>

        <div>
            <p>Price : RM<?php echo $product[0]['price']; ?></p>
        </div>
        <div>
            <p>Stock : <?php echo $product[0]['stock']; ?> left</p>
        </div>
        <div>
            <p>Description : <?php echo $product[0]['description']; ?></p>
        </div>
        <?php if (isset($_SESSION['type'])) : ?>
            <?php if ($_SESSION['type'] != 1) : ?>
                <form action="addToCart.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $product[0]['id']; ?>">
                    <div>
                        <label for="quantity">Quantity : </label>
                        <input type="number" name="quantity" id="quantity" value="1">
                        <input type="hidden" name="stock" id="stock" value="<?php echo $product[0]['stock']; ?>">
                    </div>
                    <br>
                    <button type="submit" class="btn-success">Add To Cart</button>
                </form>

            <?php endif; ?>
        <?php endif; ?>
        <h1>Reviews</h1>
        <?php if (!empty($reviews)) : ?>
            <table style="margin-bottom: 30px;">
                <tr>
                    <th>No.</th>
                    <th>User</th>
                    <th>Comments</th>
                    <th>Date Posted</th>
                </tr>
                <?php foreach ($reviews as $key => $review) : ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td>
                            <?php echo $review['name']; ?>
                        </td>
                        <td><?php echo $review['review_details']; ?></td>
                        <td>
                            <?php echo $review['date_created']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <h3>There is no review yet for this product</h3>
        <?php endif; ?>
    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>