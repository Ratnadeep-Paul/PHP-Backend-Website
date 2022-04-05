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
$seller_id = $_GET['id'];
$seller_name = $_GET['name'];

$sql = "SELECT * FROM `seller` WHERE `id`='$seller_id' AND `name`='$seller_name'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $income = $row['income'];
    $income_change = $row['income-change'];
    $order = $row['orders'];
    $order_change = $row['order-change'];
    $products = $row['products'];
    $products_change = $row['products-change'];

    $phone = mysqli_real_escape_string($conn, $row['phone']);
    $phone_show = mysqli_real_escape_string($conn, $row['show-phone']);
    $email = mysqli_real_escape_string($conn, $row['email']);
    $upi = mysqli_real_escape_string($conn, $row['upi']);
    $city = mysqli_real_escape_string($conn, $row['city']);
    $pin = mysqli_real_escape_string($conn, $row['pin']);
    $state = mysqli_real_escape_string($conn, $row['state']);
    $country = mysqli_real_escape_string($conn, $row['country']);
    $identity = $row['identity'];
}

$order_sql = "SELECT * FROM `orders` WHERE `seller_name`='$seller_name' AND `seller_id`='$seller_id' AND `order_status`=''";
$order_result = mysqli_query($conn, $order_sql);
$active_order = mysqli_num_rows($order_result);

$_SESSION['seller-phone'] = $phone;
$_SESSION['seller-id'] = $seller_id;
$uri = $_SERVER['REQUEST_URI'];
$_SESSION['old_url'] = $uri;
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/seller-style.css">
    <title>Profile Of <?php echo $seller_name ?></title>
</head>

<body class="account-page">
    <!-- Modal -->

    <div class="modal fade" id="resetIncome" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Are You Sure??
                    </h5>
                </div>
                <div class="modal-body">
                    <a href="reset-seller.php?tag=income" class="btn btn-danger">Reset Income Of This Month</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="resetOrder" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Are You Sure??
                    </h5>
                </div>
                <div class="modal-body">
                    <a href="reset-seller.php?tag=order" class="btn btn-danger">Reset Order Of This Month</a>
                </div>
            </div>
        </div>
    </div>


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
            <h2>Account - <?php echo $seller_name ?></h2>
            <div id="dashboard" class="dashboard-content admin-dashboard">
                <div class="top-dashboard">
                    <div class="dashboard-card">
                        <h3> <?php echo $income ?> &#8377;</h3>
                        <p>Total Sale</p>
                    </div>
                    <div class="dashboard-card">
                        <h3> <?php echo $income_change ?> &#8377;</h3>
                        <p>Sell This Month</p>
                        <button type="button" data-toggle="modal" data-target="#resetIncome" class="btn btn-danger">Reset</button>
                    </div>
                    <div class="dashboard-card">
                        <h3> <?php echo $order ?></h3>
                        <p>Total Product Ordered</p>
                    </div>
                    <div class="dashboard-card">
                        <h3> <?php echo $order_change ?></h3>
                        <p>Product Ordered This Month</p>
                        <button type="button" data-toggle="modal" data-target="#resetOrder" class="btn btn-danger">Reset</button>
                    </div>
                    <div class="dashboard-card">
                        <h3> <?php echo $products ?></h3>
                        <p>Products Are Listed</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><?php echo $active_order ?></h3>
                        <p>Not Approved Order</p>
                    </div>
                </div>
            </div>

            <div id="personal-details">
                <h2>Personal Details</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $seller_name ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><?php echo $phone ?></td>
                        </tr>
                        <tr>
                            <td>Shown Phone Number</td>
                            <td><?php echo $phone_show ?></td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                            <td>UPI ID</td>
                            <td><?php echo $upi ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><?php echo $city ?></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td><?php echo $state ?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><?php echo $country ?></td>
                        </tr>
                        <tr>
                            <td>Pin Code</td>
                            <td><?php echo $pin ?></td>
                        </tr>
                        <tr>
                            <td>ID Proff</td>
                            <td><a href="<?php echo $identity ?>" target="_blank" class="btn btn-primary">Show Photo</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <h2>Products</h2>
            <div class="products">

                <?php
                $sql = "SELECT * FROM `products` WHERE `artist` = '$seller_name' AND `artist-id`='$seller_id' AND `status`='available'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);

                if ($num != 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_name = $row['name'];
                        $product_id = $row['id'];
                        $product_photo = '../' . $row['photo'];
                        $product_price = $row['price'];
                        $product_type = $row['paint-type'];
                        $product_size = $row['size'];

                        echo '<div class="product-card">
                                <img class="product-card-img" src="' . $product_photo . '" alt="..."></img>
                                <div class="product-card-info">
                                    <span><strong>' . $product_name . '</strong></span>
                                    <span><strong>Size:-</strong> ' . $product_size . '</span>
                                    <span><strong>Type:-</strong> ' . $product_type . '</span>
                                    <h5 class="card-price">&#8377;' . $product_price . '</h5>
                                </div>
                                <button type="button" data-toggle="modal" data-target="#deleteSure' . $product_id . '" class="btn btn-danger">Delete</button>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteSure' . $product_id . '" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Are You Sure??
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                <a href="delete-product.php?product_id=' . $product_id . '" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo '<div class="alert alert-warning mt-2" style="width: 100%" role="alert">
                                       <strong> No Products Are Added Yet!! </strong>
                                    </div>';
                }
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