<?php
session_start();
if (!isset($_SESSION['otp-verified'])) {
    if (!isset($_SESSION['admin-power-login'])) {
        if ($_SESSION['otp-verified'] != 'Done Dude' && $_SESSION['admin-power-login'] != true) {
            header("location: ../logout.php");
        }
        header("location: ../logout.php");
    }
    header("location: ../logout.php");
}

include '../partials/dbconnect.php';

$total_sale = 0;
$month_sale = 0;
$total_order = 0;
$month_order = 0;
$total_product = 0;

$sql_seller = "SELECT * FROM `seller` WHERE `trust`='Approved'";
$result_seller = mysqli_query($conn, $sql_seller);
$total_seller = mysqli_num_rows($result_seller);
while ($row_seller = mysqli_fetch_assoc($result_seller)) {
    $total_sale = $total_sale + $row_seller['income'];
    $month_sale = $month_sale + $row_seller['income-change'];
    $total_order = $total_order + $row_seller['orders'];
    $month_order = $month_order + $row_seller['order-change'];
    $total_product = $total_product + $row_seller['products'];
}

$total_income = ($total_sale / 100) * 10;
$month_income = ($month_sale / 100) * 10;

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
    </nav>

    <div class="account">

        <img src="../Img/icons/Menu Icon.svg" alt="..." onclick="toggleMenu()" class="menu">

        <div class="left" id="menu-left">
            <div class="account-option-selector account-left-options">
                <a href="dashboard.php" class="option-active btn dash-option" href="dashboard.php">Dashboard</a>
                <a href="seller.php" class="btn">Sellers</a>
                <a href="seller-approve.php" class="btn">Approve Seller</a>
            </div>

            <a href="../logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">
            <div id="dashboard" class="dashboard-content admin-dashboard">
                <span class="account-name">
                    <h2>Hi,</h2> Admin
                </span>
                <div class="top-dashboard">
                    <div class="dashboard-card">
                        <h3><?php echo $total_sale ?> &#8377;</h3>
                        <p>Total Sale</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $month_sale ?> &#8377;</h3>
                        <p>Sell This Month</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $total_income ?> &#8377;</h3>
                        <p>Total Income</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $month_income ?> &#8377;</h3>
                        <p>Income This Month</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $total_order ?> </h3>
                        <p>Total Product Ordered</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $month_order ?> </h3>
                        <p>Product Ordered This Month</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $total_product ?> </h3>
                        <p>Products Are Listed</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $total_seller ?> </h3>
                        <p>Seller In Listed</p>
                    </div>
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