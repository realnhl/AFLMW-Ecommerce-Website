<?php


require('inc/config.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    die;
}

$today = date("Ymd");
$randomOrderID = $today . strtoupper(substr(uniqid(sha1(time())), 0, 4));

$user_id = $_SESSION['id'];

$sql = "SELECT c.*,p.model_name,p.price
        FROM cart c
        INNER JOIN product p on c.product_id = p.id
        WHERE c.user_id = '$user_id' 
        ORDER BY date_created"; // Summary my cart

$result = mysqli_query($conn, $sql);
$cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sqlUser = "SELECT * from user WHERE id = '$user_id'";
$result2 = mysqli_query($conn, $sqlUser);
$user = mysqli_fetch_all($result2, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Check Out</title>
</head>

<body class="checkOut">
    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <div class="container">

        <h1>Check Out</h1>
        <a><b><i>Product Information</i></b></a>
        <table class="checkOutProductInformation">
            <tr>
                <th>No</th>
                <th>Details</th>
                <th>Date Added</th>
                <th>Total</th>
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
                    <td>RM<?php echo $cart_item['price'] * $cart_item['quantity'];; ?></td>
                    <?php $total +=  $cart_item['price'] * $cart_item['quantity']; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a><b><i>Receiver Information</i></b></a>
        <p>Name : <?php echo $user[0]['name']; ?></p>
        <p>Email : <?php echo $user[0]['email']; ?></p>
        <p>Phone Number : <?php echo $user[0]['mobile_no']; ?></p>
        <p>Shipping Address : <?php echo $user[0]['user_address']; ?></p>
        <form class="checkOutReceiverInformation" action="payment-submit.php" method="post" name="checkout" onsubmit="chkcc()">
            <label>Order ID : <b><?php echo $randomOrderID; ?></b></label>
            <div>
                <label for="bankName">Bank Name : </label>
                <input type="text" name="bank_name" required id="bankName">
            </div>
            <br>
            <div>
                <label for="bankNo">Card Number : </label>
                <input type="text" name="card_number" required id="bankNo"><br>
                <small>Enter only 16 digit number of your bank card.</small>
            </div>
            <br>
            <div>
                <label for="bankCRC">Card CRC : </label>
                <input type="password" name="card_crc"required id="bankCRC"><br>
                <small>Enter 4 digit number back of your card.</small>
            </div>

            <h2>Total : RM<?php echo $total; ?></h2>
            <input type="hidden" name="order_id" value="<?php echo $randomOrderID; ?>">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <hr>
            <button type="submit" class="btn-success">Pay Now</button>
        </form>
    </div>

    <?php require('inc/navBar.php'); ?>
</body>

<script>
    function chkcc() {
        var bname = document.checkout.bank_name;
        var cnumber = document.checkout.card_number;
        var ccrc = document.checkout.card_crc;
        var cardnum = /^(\d{16})$/;
        var alphabet = /^[A-Za-z]+|\s+$/;
        var crc = /^\d{3,4}$/;

        if (bname.value.match(alphabet)) {
            if (cnumber.value.match(cardnum)) {
                if (ccrc.value.match(alphabet)&&ccrc.value.match(crc)) {
                    alert("Credit card crc cannot contain alphabet and only 3 or 4 numbers!");
                    event.preventDefault();
                }
                else {
                    return true;
                }
            } else {
                alert("Not a valid card number! Please enter a valid (16 digits) credit card number!");
                event.preventDefault();
            }
        } else {
            alert("Bank name can only contain alphabet!");
            event.preventDefault();
            return false;
        }

    }
</script>

</html>