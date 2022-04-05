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
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/seller-style.css">
    <title>Orders</title>
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
                <a href="dashboard.php" class="btn dash-option" href="dashboard.php">Dashboard</a>
            </div>

            <div class="account-option-selector account-left-options">
                <a href="personal-details.php" class="btn account-option">Personal Information</a>
                <a class="btn" href="update-details.php">Change Information</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a href="order-details.php" class="option-active btn order-option">My Orders</a>
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

            <div id="order-details">
                <h2>Order Details</h2>
                <div class="order-list">

                    <?php
                    $sql_order = "SELECT * FROM `orders` WHERE `seller_name`='$seller_name' AND `seller_id`='$seller_id'";
                    $result_order = mysqli_query($conn, $sql_order);
                    $num_orders = mysqli_num_rows($result_order);
                    if ($num_orders > 0) {
                        while ($row_order = mysqli_fetch_assoc($result_order)) {
                            $order_id = $row_order['id'];
                            $order_placing_id = $row_order['order_id'];
                            $buyer_name = $row_order['buyer_name'];
                            $buyer_id = $row_order['buyer_id'];
                            $product_name = $row_order['product_name'];
                            $product_id = $row_order['product_id'];
                            $order_status = $row_order['order_status'];
                            $order_type = $row_order['order_type'];
                            $order_tracking_number = $row_order['tracking-id'];
                            $order_last_date = $row_order['last-date'];

                            if ($order_status == "Shipped") {
                                $order_last_date_text = 'Courier Service Name';
                            } else {
                                $order_last_date_text = 'Last Date To Complete Order';
                            }

                            if ($order_type == 'customized') {
                                $sql_product = "SELECT * FROM `custom` WHERE `id`='$product_id' AND `name`='$product_name'";
                                $result_product = mysqli_query($conn, $sql_product);
                                while ($row_product = mysqli_fetch_assoc($result_product)) {
                                    $product_photo = "../" . $row_product['photo'];
                                    $product_size = $row_product['size'];
                                    $product_type = $row_product['paint-type'];
                                }

                                $sql_buyer = "SELECT * FROM `buyer` WHERE `id`='$buyer_id' AND `name`='$buyer_name'";
                                $result_buyer = mysqli_query($conn, $sql_buyer);
                                while ($row_buyer = mysqli_fetch_assoc($result_buyer)) {
                                    $buyer_city = $row_buyer['city'];
                                    $buyer_state = $row_buyer['state'];
                                    $buyer_pin = $row_buyer['pin'];
                                    $buyer_country = $row_buyer['country'];
                                    $buyer_phone = $row_buyer['phone'];
                                    $buyer_address = $row_buyer['address'];
                                }

                                echo '<div type="button" data-toggle="modal" data-target="#delivery' . $order_id . '" class="orders">
                                        <img src="' . $product_photo . '" alt="...">
                                        <div class="order-short-details">
                                            <h5>' . $product_name . '</h5>
                                            <span><strong>Size:-</strong> ' . $product_size . '</span>
                                            <span><strong>Type:-</strong> ' . $product_type . '</span>
                                             <button class="btn btn-primary orderinfo-btn" type="button" data-toggle="collapse" data-target="#inforder' . $order_id . '" aria-expanded="false" aria-controls="inforder' . $order_id . '">
                                                More Info>>>
                                            </button>
                                            <div class="collapse" id="inforder' . $order_id . '">
                                            <h6>Delivery Details</h6>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Phone</td>
                                                        <td>' . $buyer_phone . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>' . $buyer_city . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>State</td>
                                                        <td>' . $buyer_state . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>' . $buyer_country . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pin Code</td>
                                                        <td>' . $buyer_pin . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Delivery Address</td>
                                                        <td>' . $buyer_address . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order Status</td>
                                                        <td>' . $order_status . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order ID</td>
                                                        <td>' . $order_placing_id . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>' . $order_last_date_text . '</td>
                                                        <td>' . $order_last_date . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tracking Number</td>
                                                        <td>' . $order_tracking_number . '</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        <a href="handler/order-shipped.php?order_id=' . $order_id . '" class="btn btn-info">Shipped</a>
                                                    <a href="handler/order-status.php?status=Approved&&order_id=' . $order_id . '" class="btn btn-success">Approve</a>
                                        </div>
                                    </div> </div>';
                            } else {
                                $sql_product = "SELECT * FROM `products` WHERE `id`='$product_id' AND `name`='$product_name'";
                                $result_product = mysqli_query($conn, $sql_product);
                                while ($row_product = mysqli_fetch_assoc($result_product)) {
                                    $product_photo = '../' . $row_product['photo'];
                                    $product_size = $row_product['size'];
                                    $product_type = $row_product['paint-type'];
                                }

                                $sql_buyer = "SELECT * FROM `buyer` WHERE `id`='$buyer_id' AND `name`='$buyer_name'";
                                $result_buyer = mysqli_query($conn, $sql_buyer);
                                while ($row_buyer = mysqli_fetch_assoc($result_buyer)) {
                                    $buyer_city = $row_buyer['city'];
                                    $buyer_state = $row_buyer['state'];
                                    $buyer_pin = $row_buyer['pin'];
                                    $buyer_country = $row_buyer['country'];
                                    $buyer_phone = $row_buyer['phone'];
                                    $buyer_address = $row_buyer['address'];
                                }

                                if ($order_status == "Shipped") {
                                    $order_last_date_text = 'Courier Service Name';
                                } else {
                                    $order_last_date_text = '';
                                    $order_last_date = '';
                                }

                                echo '<div class="orders">
                                        <img src="' . $product_photo . '" alt="...">
                                        <div class="order-short-details">
                                            <h5>' . $product_name . '</h5>
                                            <span><strong>Size:-</strong> ' . $product_size . '</span>
                                            <span><strong>Type:-</strong> ' . $product_type . '</span>
                                              <button class="btn btn-primary orderinfo-btn" type="button" data-toggle="collapse" data-target="#inforder' . $order_id . '" aria-expanded="false" aria-controls="inforder' . $order_id . '">
                                                More Info>>>
                                            </button>
                                            <div class="collapse" id="inforder' . $order_id . '">
                                            <h6>Delivery Details</h6>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Phone</td>
                                                        <td>' . $buyer_phone . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>' . $buyer_city . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>State</td>
                                                        <td>' . $buyer_state . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>' . $buyer_country . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pin Code</td>
                                                        <td>' . $buyer_pin . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Delivery Address</td>
                                                        <td>' . $buyer_address . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order Status</td>
                                                        <td>' . $order_status . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order ID</td>
                                                        <td>' . $order_placing_id . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>' . $order_last_date_text . '</td>
                                                        <td>' . $order_last_date . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tracking Number</td>
                                                        <td>' . $order_tracking_number . '</td>
                                                    </tr>
                                                    </tbody>
                                                    </table>
                                                    <a href="handler/order-shipped.php?order_id=' . $order_id . '" class="btn btn-info">Shipped</a>
                                                    <a href="handler/order-status.php?status=Approved&&order_id=' . $order_id . '" class="btn btn-success">Approve</a>
                                        </div>
                                    </div> </div>';
                            }
                        }
                    } else {
                        echo '<div class="alert alert-warning" role="alert">
                                        No Orders Are Placed Yet!!
                                    </div>';
                    }
                    ?>

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