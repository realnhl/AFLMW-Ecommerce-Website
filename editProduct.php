<?php

require('inc/config.php');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: mylogin.php");
    exit;
}

$product_id = $_GET['id'];

$sql = "SELECT * FROM product WHERE id = '$product_id'";
$result = mysqli_query($conn, $sql);

$product = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Edit Product Details</title>
</head>

<body class="editProduct">

    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] == "errorEdit") : ?>
            <div class="alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Unable to update camera details. Please try again.
            </div>
        <?php elseif ($_GET['message'] == "successEdit") : ?>
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Camera details has been successfully update!
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="container">
        <h1>Edit Product Details</h1>
        <form action="editProduct-submit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product[0]['id']; ?>">
            <img src="uploads/<?php echo $product[0]['picture']; ?>" height="300" width="auto" alt="">
            <div>
                <label for="model_name">Model Name : </label>
                <input type="text" name="model_name" id="model_name" value="<?php echo $product[0]['model_name']; ?>">
            </div>
            <br>
            <div>
                <label for="manufacturer">Manufacturer : </label>
                <select name="manufacturer" id="manufacturer">
                    <option value="Sony" <?php if ($product[0]['manufacturer'] == 'Sony') echo 'selected'; ?>>Sony</option>
                    <option value="Canon" <?php if ($product[0]['manufacturer'] == 'Canon') echo 'selected'; ?>>Canon</option>
                    <option value="Nikon" <?php if ($product[0]['manufacturer'] == 'Nikon') echo 'selected'; ?>>Nikon</option>
                    <option value="Fujifilm" <?php if ($product[0]['manufacturer'] == 'Fujifilm') echo 'selected'; ?>>Fujifilm</option>
                    <option value="Olympus" <?php if ($product[0]['manufacturer'] == 'Olympus') echo 'selected'; ?>>Olympus</option>
                    <option value="Panasonic" <?php if ($product[0]['manufacturer'] == 'Panasonic') echo 'selected'; ?>>Panasonic</option>
                    <option value="Leica" <?php if ($product[0]['manufacturer'] == 'Leica') echo 'selected'; ?>>Leica</option>
                </select>
            </div>
            <br>
            <div>
                <label for="price">Price (RM) : </label>
                <input type="number" step="0.01" name="price" id="price" value="<?php echo $product[0]['price']; ?>">
            </div>
            <br>
            <div>
                <label for="stock">Quantity in stock : </label>
                <input type="number" name="stock" id="stock" value="<?php echo $product[0]['stock']; ?>">
            </div>
            <br>
            <div>
                <label for="description">Description : </label>
                <textarea name="description" id="" cols="30" rows="5"><?php echo $product[0]['description']; ?></textarea>
            </div>
            <br>
            <div>
                <label for="picture">Picture : </label>
                <input type="file" name="picture" id="picture">
            </div>
            <br>

            <button type="submit" class="btn-success">Save</button>


        </form>
        <a href="listOfProducts.php"><button class="btn-view">Back</button></a>
    </div>
    <?php require('inc/navBar.php'); ?>
</body>

</html>