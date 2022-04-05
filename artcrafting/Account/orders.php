<?php
include '../partials/dbconnect.php';

session_start();
$uri = $_SERVER['REQUEST_URI'];
$_SESSION['old_url'] = $uri;
$accout_name = 'Login/Signup';

if (isset($_SESSION['buyer-login'])) {
    $accout_name = $_SESSION['account-name'];
} else {
    if (isset($_SESSION['seller-login'])) {
        header("location: ../logout.php");
    }

    header("location: ../login.php");
    exit();
}

if (isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = false;
}

$accout_phone = $_SESSION['account-phone'];
$accout_id = $_SESSION['account-id'];

$sql = "SELECT * FROM `buyer` WHERE `phone`='$accout_phone' AND `name`='$accout_name' AND `id`='$accout_id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>My Account</title>
</head>

<body class="account-page">
    <nav class="navigation">
        <ul class="nav-computer">
            <div class="logo">
                <a href="index.php"><strong>Art</strong> Craftings</a>
            </div>
            <div class="search-bar">
                <input class="form-control" id="search-bar" type="text" onkeyup="showResult()" placeholder="Search Items Here">
                <div id="search-result" class="search-result">
                </div>
            </div>
            <div class="account-login">
                <img src="../Img/icons/user.svg" alt="...">
                <a href="account.php" id="login-register"><?php echo $accout_name ?></a>
            </div>
        </ul>

        <ul class="nav-phone">
            <div class="logo">
                <strong>Art</strong> Craftings
            </div>
            <div class="account-login">
                <img src="../Img/icons/user.svg" alt="...">
                <a href="account.php" id="login-register"><?php echo $accout_name ?></a>
            </div>
            <div class="search-bar">
                <input class="form-control" type="text" placeholder="Search Items Here">
                <div id="search-result" class="search-result">
                </div>
            </div>
        </ul>


        <ul class="nav-items">
            <li> <a class="hvr-underline-from-left" href="products.php?type=Oil Painting">Oil Painting</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Acrylic Painting">Acrylic Painting</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Pencil Sketch">Pencil Sketch</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Collage Painting">Collage Painting</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Water Colour">Water Colour</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Pen Works">Pen Works</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Glass Painting">Glass Painting</a></li>
        </ul>
    </nav>

    <div class="account">

        <img src="../Img/icons/Menu Icon.svg" alt="..." onclick="toggleMenu()" class="menu">

        <div class="left" id="menu-left">
            <div class="hello account-left-options">
                <img src="../Img/icons/user.svg" alt="...">
                <div>
                    <span>Hi,</span>
                    <h5><?php echo $name ?></h5>
                </div>
            </div>

            <div class="account-option-selector account-left-options">
                <a href="../account.php" class="btn account-option ">My Account</a>
                <a class="btn" href="update-address.php">Change Address</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a class="btn order-option option-active">My Orders</a>
                <a class="btn" href="tel: +91 6002250149">Call For Report Problem</a>
            </div>

            <a href="../logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">
            <div id="order-details">
                <h2>Order Details</h2>
                <div class="order-list">

                    <?php
                    $sql_order = "SELECT * FROM `orders` WHERE `buyer_name`='$name' AND `buyer_id`='$accout_id'";
                    $result_order = mysqli_query($conn, $sql_order);
                    $num_orders = mysqli_num_rows($result_order);
                    if ($num_orders > 0) {

                        while ($row_order = mysqli_fetch_assoc($result_order)) {
                            $order_id = $row_order['id'];
                            $seller_name = $row_order['seller_name'];
                            $seller_id = $row_order['seller_id'];
                            $product_name = $row_order['product_name'];
                            $order_placing_id = $row_order['order_id'];
                            $product_id = $row_order['product_id'];
                            $order_status = $row_order['order_status'];
                            $order_type = $row_order['order_type'];
                            $order_tracking_number = $row_order['tracking-id'];
                            $order_last_date = $row_order['last-date'];

                            $random_pass = rand(0, $order_placing_id);

                            if ($order_status == "Shipped") {
                                $order_last_date_text = 'Courier Service Name:- ';
                                $refund_text = "";
                                $refund_link = "";
                            } else {
                                $order_last_date_text = 'Last Date To Complete Order';
                                $refund_text = "Cancel Order";
                                $refund_link = "../Order/refund.php?prefix-token=" . $order_id . "&&order-pass=" . $random_pass;
                            }

                            if ($order_type == 'customized') {
                                $sql_product = "SELECT * FROM `custom` WHERE `id`='$product_id' AND `name`='$product_name'";
                                $result_product = mysqli_query($conn, $sql_product);
                                while ($row_product = mysqli_fetch_assoc($result_product)) {
                                    $product_photo = "../" . $row_product['photo'];
                                    $product_size = $row_product['size'];
                                    $product_type = $row_product['paint-type'];
                                }

                                echo '<div class="orders">
                                    <img src="' . $product_photo . '" alt="...">
                                    <div class="order-short-details">
                                        <span><strong>' . $product_name . '</strong></span>
                                        <small>By ' . $seller_name . '</small>
                                        <span>Order Number:- ' . $order_placing_id . '</span>
                                        <span>Order Status:- ' . $order_status . '</span>
                                        <span>' . $order_last_date_text  . $order_last_date . '</span>
                                        <span class="mb-1">Tracking Number:- ' . $order_tracking_number . '</span>
                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#delivery' . $order_id . '">  Order Delivered</button>
                                        <a class="btn btn-danger mt-1" type="button" data-toggle="modal" data-target="#cancelorder' . $order_id . '">' . $refund_text . '</a>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delivery' . $order_id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Do You Get The Item You Order??
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                    <a href="Account/delivery.php?status=Delivered&&prefix-token=' . $order_placing_id . '&&order-pass=' . $random_pass . '" class="btn btn-success">Yes</a>
                                                    <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="cancelorder' . $order_id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Are Your Sure?? You Are Cancelling The Order!!
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                <p> After Cancelling The Order, Your Payment Will Be Refunded To Your Account (Original Scource Of Payment). But The Taxes Are Not Redundable.
                                                    </p>
                                                    <form action="../Order/refund.php" method="POST">
                                                    <div style="display:none;">
                                                    <input type="text" value="' . $order_placing_id . '" name="prefix-order"/>
                                                    </div>
                                                    <div class="form-group">
                                                         <div class="form-group">
                                                            <label for="note">Why You Are Cancelling The Order??</label>
                                                            <textarea required class="form-control" id="note" name="note" rows="3"></textarea>
                                                        </div>
                                                    </form>
                                                    <button type="submit" class="btn btn-danger" >Cancel Order</button>
                                                    <button class="btn btn-success" type="button" data-dismiss="modal" aria-label="Close">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>';
                            } else {

                                $sql_product = "SELECT * FROM `products` WHERE `id`='$product_id' AND `name`='$product_name'";
                                $result_product = mysqli_query($conn, $sql_product);
                                while ($row_product = mysqli_fetch_assoc($result_product)) {
                                    $product_photo = '../' . $row_product['photo'];
                                }

                                if ($order_status == "Shipped") {
                                    $order_last_date_text = 'Courier Service Name:- ';
                                    $refund_text = "";
                                    $refund_link = "";
                                } else {
                                    $order_last_date_text = '';
                                    $order_last_date = '';
                                    $refund_text = "Cancel Order";
                                }

                                echo '<div class="orders">
                                    <img src="' . $product_photo . '" alt="...">
                                    <div class="order-short-details">
                                        <span><strong>' . $product_name . '</strong></span>
                                        <small>By ' . $seller_name . '</small>
                                        <span>Order Number:- ' . $order_placing_id . '</span>
                                        <span>Order Status:- ' . $order_status . '</span>
                                        <span>' . $order_last_date_text . $order_last_date . '</span>
                                        <span class="mb-1">Tracking Number:- ' . $order_tracking_number . '</span>
                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#delivery' . $order_id . '">  Order Delivered</button>
                                        <a class="btn btn-danger mt-1"type="button" data-toggle="modal" data-target="#cancelorder' . $order_id . '">' . $refund_text . '</a>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delivery' . $order_id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Do You Get The Item You Order??
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                    <a href="Account/delivery.php?status=Delivered&&prefix-token=' . $order_placing_id . '&&order-pass=' . $random_pass . '" class="btn btn-success">Yes</a>
                                                    <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="cancelorder' . $order_id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Are Your Sure?? You Are Cancelling The Order!!
                                                    </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p>
                                                    After Cancelling The Order, Your Payment Will Be Refunded To Your Account (Original Scource Of Payment). But The Taxes Are Not Redundable.
                                                    </p>
                                                    <form action="../Order/refund.php" method="POST"> 
                                                    <div style="display:none;">
                                                    <input type="text" value="' . $order_placing_id . '" name="prefix-order"/>
                                                    </div>
                                                    <div class="form-group">
                                                         <div class="form-group">
                                                            <label for="note">Why You Are Cancelling The Order??</label>
                                                            <textarea required class="form-control" id="note" name="note" rows="3"></textarea>
                                                        </div>
                                                    </form>
                                                    <button type="submit" class="btn btn-danger" >Cancel Order</button>
                                                    <button class="btn btn-success" type="button" data-dismiss="modal" aria-label="Close">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>';
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

        function showResult() {
            results = document.getElementById('search-result')
            search = document.getElementById('search-bar')
            searchText = search.value
            if (search.value == "") {
                $('#search-result').html("")
            } else {
                // results.style.display = 'flex';
                $.post("handler/search.php", {
                    name: searchText,
                }, function(data, status) {
                    if (data != "") {
                        $('#search-result').html(data)
                    }
                })
            }
        }
    </script>


</body>

</html>