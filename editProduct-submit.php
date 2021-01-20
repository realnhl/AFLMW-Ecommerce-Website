<?php

include('inc/config.php');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: mylogin.php");
    exit;
}

$id = $_POST['id'];
$model_name = $_POST['model_name'];
$manufacturer = $_POST['manufacturer'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$description = $_POST['description'];


$sql = "";
$message = "";

if (!is_uploaded_file($_FILES["picture"]["name"])) {
    $sql = "UPDATE product 
        SET model_name = '$model_name', 
        manufacturer = '$manufacturer', 
        price = '$price', 
        stock = '$stock',
        description = '$description' 
        WHERE id = '$id'";
} else {
    $picture = $_POST['picture'];
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
    if ($_FILES["picture"]["size"] > 500000) {
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
            echo "The file " . $fileName . " has been uploaded.";

            $tempSQL = "SELECT picture FROM product WHERE id = '$id'";
            $res1 = mysqli_query($conn, $tempSQL);
            $product = mysqli_fetch_all($res1, MYSQLI_ASSOC);
            unlink('uploads/' . $product[0]['picture']);

            $sql = "UPDATE product 
                    SET model_name = '$model_name', 
                    manufacturer = '$manufacturer', 
                    price = '$price', 
                    stock = '$stock',
                    description = '$description',
                    picture = '$fileName'
                    WHERE id = '$id'";

            $message = urlencode("successAddNew");
        } else {
            echo "Sorry, there was an error uploading your file.";
            $message = urlencode("errorAddNew");
        }
    }
}

$res = mysqli_query($conn, $sql);

if (!$res) {
    $message = urlencode("errorEdit");
    header("Location: editProduct.php?id=" . $id . "&message=" . $message);
} else {
    $message = urlencode("successEdit");
    header("Location: editProduct.php?id=" . $id . "&message=" . $message);
}
