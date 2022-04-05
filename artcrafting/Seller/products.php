<?php
include '../partials/dbconnect.php';
session_start();
if (isset($_SESSION['seller-login'])) {
    $seller_name = $_SESSION['seller-name'];
} else {
    header("location: logout.php");
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
                <a href="dashboard.php" class="btn dash-option" href="dashboard.php">Dashboard</a>
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
                <a href="order-details.php" class="option-active btn order-option">My Products</a>
                <a href="add-product.php" class="btn order-option">Add New Products</a>
                <a href="customized.php" class="btn order-option">Customized Painting</a>
            </div>

            <a href="../logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">
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
                                <a href="edit-product.php?product_id=' . $product_id . '" class="btn btn-primary">Edit</a>
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
                                                <a href="handler/delete-product.php?product_id=' . $product_id . '" class="btn btn-danger">Delete</a>
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