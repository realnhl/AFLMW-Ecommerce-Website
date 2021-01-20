<?php

require('inc/config.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: mylogin.php");
    die;
}

$user_id = $_SESSION['id'];
$order_id = $_GET['order_id'];
$product_id = $_GET['product_id'];

$sql = "SELECT * FROM purchase WHERE order_id = '$order_id' AND product_id = '$product_id'";
$result = mysqli_query($conn, $sql);
$purchase = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/container.css">
    <title>Change Shipping Status</title>
</head>

<body id="changeShippingStatus">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <div class="container">
        <h1 id="changeShippingStatusH1">Change Shipping Status</h1>

        <h3 id="changeShippingStatusH3">Current Status : <?php echo $purchase[0]['status']; ?></h3>
        <form id="changeShippingStatusForm" action="changeStatus-submit.php" method="post">
            <input type="hidden" name="purchase_id" value="<?php echo $purchase[0]['id']; ?>">
            <select name="status" id="status">
                <option value="PROCESSING" <?php if ($purchase[0]['status'] == 'PROCESSING') echo 'selected'; ?>>Processing</option>
                <option value="PACKING" <?php if ($purchase[0]['status'] == 'PACKING') echo 'selected'; ?>>Packing</option>
                <option value="SHIPPING" <?php if ($purchase[0]['status'] == 'SHIPPING') echo 'selected'; ?>>Shipping</option>
                <option value="DELIVERED" <?php if ($purchase[0]['status'] == 'DELIVERED') echo 'selected'; ?>>Delivered</option>
            </select>
            <button type="submit" class="btn-success">Change Status</button>
        </form>

    </div>

    <?php require('inc/navBar.php'); ?>
</body>

</html>