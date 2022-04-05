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

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/seller-style.css">
    <title>Sellers</title>
</head>

<body class="account-page">
    <nav>
        <div class="logo">
            <a href="../index.php"><strong>Art</strong> Craftings</a>
        </div>
    </nav>

    <div class="account admin-account">

        <img src="../Img/icons/Menu Icon.svg" alt="..." onclick="toggleMenu()" class="menu">

        <div class="left" id="menu-left">
            <div class="account-option-selector account-left-options">
                <a href="dashboard.php" class="btn dash-option" href="dashboard.php">Dashboard</a>
                <a href="seller.php" class="option-active btn">Sellers</a>
                <a href="seller-approve.php" class="btn">Approve Seller</a>
            </div>

            <a href="../logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">
            <h2>Sellers</h2>
            <div class="sellers">

                <?php
                $sql_seller = "SELECT * FROM `seller` WHERE `trust`='Approved'";
                $result_seller = mysqli_query($conn, $sql_seller);
                while ($row_seller = mysqli_fetch_assoc($result_seller)) {
                    $seller_name = $row_seller['name'];
                    $seller_id = $row_seller['id'];
                    $seller_phone = $row_seller['phone'];
                    $seller_income = $row_seller['income'];
                    $seller_order_success = $row_seller['order-success'];
                }

                echo '<a href="seller-profile.php?id=' . $seller_id . '&&name=' . $seller_name . '" class="seller">
                            <div class="left">
                                <h5>' . $seller_name . '</h5>
                                <p><strong>Phone:-</strong> ' . $seller_phone . '</p>
                            </div>
                            <div class="right">
                                <span class="seller-info-card">
                                    <strong>' . $seller_income . ' &#8377;</strong>
                                    <p>Total Balance</p>
                                </span>
                                <span class="seller-info-card">
                                    <strong>' . $seller_order_success . '</strong>
                                    <p>Product Sell</p>
                                </span>
                            </div>
                        </a>'
                ?>

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