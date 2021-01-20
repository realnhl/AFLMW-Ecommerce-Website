<?php

require('inc/config.php');
session_start();

// Normal User

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM purchase 
        INNER JOIN product on purchase.product_id = product.id
        WHERE user_id = '$user_id'
        ORDER BY date_created DESC
        LIMIT 5"; // Summary recent purchases
$result1 = mysqli_query($conn, $sql);
$purchases = mysqli_fetch_all($result1, MYSQLI_ASSOC);

$sql2 = "SELECT * FROM cart 
        INNER JOIN product on cart.product_id = product.id
        WHERE user_id = '$user_id' 
        ORDER BY date_created 
        DESC LIMIT 5"; // Summary my cart
$result2 = mysqli_query($conn, $sql2);
$cart_items = mysqli_fetch_all($result2, MYSQLI_ASSOC);

// ADMIN

// All Time Total Purchases 
$sqlTotalPurchases = "SELECT * FROM purchase";
$resultTotalPurchases = mysqli_query($conn, $sqlTotalPurchases);
$rowTotalPurchases = mysqli_fetch_array($resultTotalPurchases, MYSQLI_ASSOC);
$countTotalPurchases = mysqli_num_rows($resultTotalPurchases);

// Total Purchases Monthly
$sqlTotalPurchasesMonthly = "SELECT * FROM purchase WHERE YEAR(date_created) = YEAR(NOW()) AND MONTH(date_created)=MONTH(NOW())";
$resultTotalPurchasesMonthly = mysqli_query($conn, $sqlTotalPurchasesMonthly);
$rowTotalPurchasesMonthly = mysqli_fetch_array($resultTotalPurchasesMonthly, MYSQLI_ASSOC);
$countTotalPurchasesMonthly = mysqli_num_rows($resultTotalPurchasesMonthly);

// Total Purchases Weekly
$sqlTotalPurchasesWeekly = "SELECT * FROM purchase WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
$resultTotalPurchasesWeekly = mysqli_query($conn, $sqlTotalPurchasesWeekly);
$rowTotalPurchasesWeekly = mysqli_fetch_array($resultTotalPurchasesWeekly, MYSQLI_ASSOC);
$countTotalPurchasesWeekly = mysqli_num_rows($resultTotalPurchasesWeekly);

// Total Purchases Daily
$sqlTotalPurchasesDaily = "SELECT * FROM purchase WHERE DATE_FORMAT(date_created, '%Y-%m-%d') = CURDATE()";
$resultTotalPurchasesDaily = mysqli_query($conn, $sqlTotalPurchasesDaily);
$rowTotalPurchasesDaily = mysqli_fetch_array($resultTotalPurchasesDaily, MYSQLI_ASSOC);
$countTotalPurchasesDaily = mysqli_num_rows($resultTotalPurchasesDaily);

// Data for chart total product manufacturer
$sqlTotalSalesManufacturer = "SELECT product.manufacturer, count(*) as total FROM product INNER JOIN purchase ON product.id = purchase.product_id GROUP BY product.manufacturer ORDER BY product.manufacturer";
$resultTotalSalesManufacturer = mysqli_query($conn, $sqlTotalSalesManufacturer);

$data = array();
foreach ($resultTotalSalesManufacturer as $row) {
    $data[] = $row;
}

$dataForChart = json_encode($data);

// Data for chart total sales manufacturer
$sqlTotalProductManufacturer = "SELECT product.manufacturer, count(*) as total FROM product GROUP BY product.manufacturer ORDER BY product.manufacturer";
$resultTotalProductManufacturer = mysqli_query($conn, $sqlTotalProductManufacturer);
$data2 = array();
foreach ($resultTotalProductManufacturer as $row) {
    $data2[] = $row;
}

$dataForChart2 = json_encode($data2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/container.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0-alpha/Chart.min.js"></script>
    <title>Dashboard</title>

</head>

<body class="dashboard">

    <div class="banner">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <div class="container">
        <?php if ($_SESSION['type'] == 2) : ?>
            <!-- Shopper -->

            <h1>Summary of my recent purchases</h1>

            <table>
                <tr>
                    <th>No</th>
                    <th>Details</th>
                    <th>Date Purchase</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($purchases as $key => $purchase) : ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td>
                            Product Name : <b><?php echo $purchase['model_name']; ?></b><br>
                            Product Price : <b><?php echo $purchase['price']; ?></b><br>
                            Quantity : <b><?php echo $purchase['quantity']; ?></b><br>
                        </td>
                        <td><?php echo $purchase['date_created']; ?></td>
                        <td><?php echo $purchase['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <br>
            <hr>
            <a href="myPurchases.php"><button class="btn-view">See all my purchases</button></a>

            <h1>Summary of my cart</h1>

            <table>
                <tr>
                    <th>No</th>
                    <th>Details</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($cart_items as $key => $cart_item) : ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td>
                            Product Name : <b><?php echo $cart_item['model_name']; ?></b><br>
                            Product Price : <b><?php echo $cart_item['price']; ?></b><br>
                            Quantity : <b><?php echo $cart_item['quantity']; ?></b><br>
                        </td>
                        <td><?php echo $cart_item['date_created']; ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <br>
            <hr>
            <a href="myCart.php"><button class="btn-view">See all my carts</button></a>


        <?php else : ?>
            <!-- Admin / Staff -->
            <div class="summaryReport">
                <h2>Total Purchases : <?php echo $countTotalPurchases; ?></h2>
                <h2>Total Purchases This Month : <?php echo $countTotalPurchasesMonthly; ?></h2>
                <h2>Total Purchases This Week : <?php echo $countTotalPurchasesWeekly; ?></h2>
                <h2>Total Purchases Today : <?php echo $countTotalPurchasesDaily; ?></h2>
            </div>


            <div class="graphContainer">
                <div class="graph1">
                    <canvas id="totalSalesManufacturerChart" style="width: 300px;height:300px;background-color:white;"></canvas>
                </div>
                <div class="graph2">
                    <canvas id="totalProductManufacturerChart" style="width: 300px;height:300px;background-color:white;"></canvas>
                </div>

            </div>


            <br>
            <div>
                <form action="generatePurchasesReport.php" method="get">
                    <label for="type"></label>
                    <select name="type" id="type">
                        <option value="1">Year</option>
                        <option value="2">Month</option>
                        <option value="3">Week</option>
                        <option value="4">Today</option>
                    </select>
                    <button class="btn-view" type="submit">Generate Purchases Report</button>
                </form><br><br>

                <a href="generateItemReport.php" style="text-decoration: none;"><button class="btn-view">Generate Item Report</button></a>
            </div>
        <?php endif; ?>
    </div>

    <?php require('inc/navBar.php'); ?>

</body>

<script>
    var manufacturer = [];
    var numbers = [];
    var data = <?php echo $dataForChart; ?>;
    for (var i in data) {
        manufacturer.push(data[i].manufacturer);
        numbers.push(data[i].total);
    }

    var ctx = document.getElementById('totalSalesManufacturerChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: manufacturer,
            datasets: [{
                label: 'Number of Sales',
                data: numbers,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Total Sales by Manufacturer'
            }
        }
    });

    var manufacturer2 = [];
    var numbers2 = [];
    var data2 = <?php echo $dataForChart2; ?>;
    for (var i in data2) {
        manufacturer2.push(data2[i].manufacturer);
        numbers2.push(data2[i].total);
    }
    var ctx = document.getElementById('totalProductManufacturerChart');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: manufacturer2,
            datasets: [{
                label: 'Number of Product',
                data: numbers2,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Total Product by Manufacturer'
            }
        }
    });
</script>

</html>