<?php

require('inc/config.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: mylogin.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Add New Product</title>
</head>

<body class="add-product">

    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <div class="container">
        <h1 id="add-product-h1">Add a Product</h1>
        <form id="add-product-form" action="addProduct-submit.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="model_name"><b>Model Name : </b></label>
                <input type="text" name="model_name" id="model_name">
            </div>
            <br>
            <div>
                <label for="manufacturer"><b>Manufacturer : </b></label>
                <select name="manufacturer" id="manufacturer">
                    <option value="Sony">Sony</option>
                    <option value="Canon">Canon</option>
                    <option value="Nikon">Nikon</option>
                    <option value="Fujifilm">Fujifilm</option>
                    <option value="Olympus">Olympus</option>
                    <option value="Panasonic">Panasonic</option>
                    <option value="Leica">Leica</option>
                </select>
            </div>
            <br>
            <div>
                <label for="price"><b>Price (RM) : </b></label>
                <input type="number" step="0.01" name="price" id="price">
            </div>
            <br>
            <div>
                <label for="stock"><B>Quantity in stock : </B></label>
                <input type="number" name="stock" id="stock">
            </div>
            <br>
            <div>
                <label for="description"><b>Description : </b></label>
                <textarea name="description" id="" cols="30" rows="5"></textarea>
            </div>
            <br>
            <div>
                <label for="picture"><b>Picture : </b></label>
                <input type="file" name="picture" id="picture">
            </div>
            <br>

            <button class="btn-success" type="submit">Save</button>
        </form>
    </div>

    <?php require('inc/navBar.php'); ?>

</body>

</html>