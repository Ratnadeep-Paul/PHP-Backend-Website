<?php
include '../partials/dbconnect.php';
session_start();


if (isset($_SESSION['seller-login'])) {
    $seller_name = $_SESSION['seller-name'];
} else {
    header("location: login.php");
    exit();
}

$seller_phone = $_SESSION['seller-phone'];
$seller_id = $_SESSION['seller-id'];


$sql = "SELECT * FROM `seller` WHERE `phone`='$seller_phone' AND `name`='$seller_name' AND `id`='$seller_id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $income = $row['income'];
    $income_change = $row['income-change'];
    $order = $row['orders'];
    $order_change = $row['order-change'];
    $products = $row['products'];
    $trust = $row['trust'];
}


if ($trust != 'Approved') {
    header("location: personal-details.php");
}


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/seller-style.css">
    <title>Dashboard</title>
</head>

<body class="account-page">
    <nav>
        <div class="logo">
            <a href="../index.php"><strong>Art</strong> Craftings</a>
        </div>

        <div class="account-login">
            <img src="../Img/icons/user.svg" alt="...">
            <a href="dashboard.php" id="login-register"><?php echo $seller_name ?></a>
        </div>
    </nav>

    <div class="account">

        <img src="../Img/icons/Menu Icon.svg" alt="..." onclick="toggleMenu()" class="menu">

        <div class="left" id="menu-left">
            <div class="account-option-selector account-left-options">
                <a href="dashboard.php" class="option-active btn dash-option" href="dashboard.php">Dashboard</a>
            </div>

            <div class="account-option-selector account-left-options">
                <a href="personal-details.php" class="btn account-option">Personal Information</a>
                <a class="btn" href="update-details.php">Change Information</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a href="order-details.php" class="btn order-option">My Orders</a>
                <a class="btn" href="tel: +91 6002250149">Call For Report Problem</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a href="products.php" class="btn order-option">My Products</a>
                <a href="add-product.php" class="btn order-option">Add New Products</a>
                <a href="customized.php" class="btn order-option">Customized Painting</a>
            </div>

            <a href="logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">

            <div id="dashboard" class="dashboard-content  admin-dashboard">
                <span class="account-name">
                    <h2>Hi,</h2> <?php echo $seller_name ?>
                </span>
                <div class="top-dashboard">
                    <div class="dashboard-card">
                        <h3><?php echo $income ?> &#8377;</h3>
                        <p>Total Sale</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $income_change ?> &#8377;</h3>
                        <p>Sell This Month</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $order ?></h3>
                        <p>Total Product Ordered</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $order_change ?></h3>
                        <p>Product Ordered This Month</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $products ?></h3>
                        <p>Products Are Listed</p>
                    </div>
                    <a class="dashboard-card dashboard-card-link" target="_blank" href="../seller.php?seller_name=<?php echo $seller_name ?>&&seller_id=<?php echo $seller_id ?>">
                        <h4>Open Customer View</h4>
                        <p>To Share With Others</p>
                    </a>
                </div>
            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        menu = document.getElementById('menu-left');
        // menu.style.display = 'none';

        function toggleMenu() {
            if (menu.style.display == 'none' || menu.style.display == '') {
                $('#menu-left').show()
                $('.right').hide()
            } else {
                menu.style.display = 'none';
                $('.right').show()
            }

        }
    </script>


</body>

</html>