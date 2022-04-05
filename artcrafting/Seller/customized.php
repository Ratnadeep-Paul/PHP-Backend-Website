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

$added = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $price_1 = $_POST['6X8-Inches'];
    $price_2 = $_POST['8X12-Inches'];
    $price_3 = $_POST['12X16-Inches'];
    $price_4 = $_POST['16X24-Inches'];
    $price_5 = $_POST['24X33-Inches'];

    $sql = "UPDATE `seller` SET `$type`= 'Yes',`$type 6X8 Inches`='$price_1',`$type 8X12 Inches`='$price_2',`$type 12X16 Inches`='$price_3',`$type 16X24 Inches`='$price_4',`$type 24X33 Inches`='$price_5' WHERE `id`='$seller_id' AND `phone`='$seller_phone'";
    $result = mysqli_query($conn, $sql);
    $added = true;
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
    <title>Customized Product</title>
</head>

<body class="account-page">
    <nav>
        <div class="logo">
            <a href="../index.php"><strong>Art</strong> Craftings</a>
        </div>

        <div class="account-login">
            <img src="../Img/icons/user.svg" alt="...">
            <a href="dashboard.php" id="login-register">Ratnadeep Paul</a>
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
                <a href="products.php" class="btn order-option">My Products</a>
                <a href="add-product.php" class="btn order-option">Add New Products</a>
                <a href="customized.php" class="option-active btn order-option">Customized Painting</a>
            </div>

            <a href="logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">
            <h2>Add Price For Your Customized Paintings</h2>
            <?php
            if ($added == true) {
                echo ' <div class="alert mb-2 mt-2 alert-success" role="alert">
                                        Product Addedd Successfully!!
                                    </div>';
            }
            ?>
            <div class="customized">
                <form action="customized.php" method="POST">
                    <div class="form-group row">
                        <label for="paint-type" class="col-sm-5 col-form-label">Select Paint Type</label>
                        <div class="col-sm-7">
                            <select onchange="getCustom()" class="form-control" name="paint-type" id="paint-type">
                                <option value="Acrylic Painting">Acrylic Painting</option>
                                <option value="Oil Painting">Oil Painting</option>
                                <option value="Pencil Sketch">Pencil Sketch</option>
                                <option value="Water Colour">Water Colour</option>
                                <option value="Pen Works">Pen Works</option>
                                <option value="Glass Painting">Glass Painting</option>
                            </select>
                        </div>
                    </div>
                    <div id="fetch-customized">

                        <input style="display: none;" type="text" name="type" class="form-control" id="type" readonly value="">

                        <div class="form-group row">
                            <label for="12x16" class="col-sm-5 col-form-label">Price For 6X8 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" name="6X8-Inches" class="form-control" id="6x8">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="24x32" class="col-sm-5 col-form-label">Price For 8X12 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" name="8X12-Inches" class="form-control" id="8x12">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="36x48" class="col-sm-5 col-form-label">Price For 12X16 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" name="12X16-Inches" class="form-control" id="12x16">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="48x64" class="col-sm-5 col-form-label">Price For 16X24 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" name="16X24-Inches" class="form-control" id="16x24">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="60x80" class="col-sm-5 col-form-label">Price For 24X33 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" name="24X33-Inches" class="form-control" id="24x33">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">Save Price</button>
                    </div>
                </form>
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

            function getCustom() {
                let type = document.getElementById('paint-type')
                $.post("handler/customize-price.php", {
                    type: type.value,
                }, function(data, status) {
                    if (data != "") {
                        $('#fetch-customized').html(data)
                    }
                })
            }
        </script>


</body>

</html>