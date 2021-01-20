<?php

require('inc/config.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: mylogin.php");
    die;
}

$model_name = $_POST['model_name'];
$manufacturer = $_POST['manufacturer'];
$price = $_POST['price'];
$description = $_POST['description'];
$stock = $_POST['stock'];

$target_dir = "uploads/";
$fileName = basename($_FILES["picture"]["name"]);
$target_file = $target_dir . $fileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["picture"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO product(
            model_name,
            manufacturer,
            price,
            stock,
            description,
            picture)
            VALUES (
            '$model_name',
            '$manufacturer',
            '$price',
            '$stock',
            '$description',
            '$fileName')
            ";
        $result = mysqli_query($conn, $sql);
        $message = urlencode("successAddNew");
        header("Location: listOfProducts.php?message=" . $message);
    } else {
        $message = urlencode("errorAddNew");
        header("Location: listOfProducts.php?message=" . $message);
    }
}
