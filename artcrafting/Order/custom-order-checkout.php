<?php
session_start();
$uri = $_SERVER['REQUEST_URI'];
$_SESSION['old_url'] = $uri;
if (!isset($_SESSION['account-name']) || $_SESSION['buyer-login'] != true) {
    header("location: ../Account/login.php");
    exit;
}
if (isset($_SESSION['seller-login'])) {
    header("location: ../logout.php");
}

$accout_name = $_SESSION['account-name'];
$accout_phone = $_SESSION['account-phone'];
$accout_id = $_SESSION['account-id'];
$paint_type = $_SESSION['paint-type'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../partials/dbconnect.php';

    $seller_name = $_POST['artist-name'];
    $_SESSION['seller-name'] = $seller_name;
    $seller_id = $_POST['artist-id'];
    $_SESSION['seller-id'] = $seller_id;
    $product_size = $_POST['size'];
    $_SESSION['product-size'] = $product_size;
    $_SESSION['product-name'] = "Customized " . $product_size . $paint_type . " For " . $accout_name . ' By ' . $seller_name;

    $rand = random_int(0011, 99999);
    $photo_post = $accout_name . '--' . $seller_name . '-- Customized --' . $paint_type . $rand;

    $uploading_dir = "Img/Product-Img/";
    $uploading_file = $uploading_dir . basename($_FILES["product-photo"]["name"]);
    $imageFileType = strtolower(pathinfo($uploading_file, PATHINFO_EXTENSION));

    if ($imageFileType != "") {
        $photo_upload = $uploading_dir . basename($photo_post . "." . $imageFileType);
        $photo_view = '../' . $photo_upload;
    } else {
        echo '';
    }



    $upload = move_uploaded_file($_FILES["product-photo"]["tmp_name"], $photo_upload);
    $_SESSION['product-photo'] = $photo_upload;

    $sql_seller = "SELECT * FROM `seller` WHERE `name`='$seller_name' AND `id`='$seller_id'";
    $seller_result = mysqli_query($conn, $sql_seller);

    while ($row_seller = mysqli_fetch_assoc($seller_result)) {
        $price = $row_seller[$paint_type . ' ' . $product_size];
        $_SESSION['product-price'] = $price;
    };

    $sql_account = "SELECT * FROM `buyer` WHERE `phone`='$accout_phone' AND `name`='$accout_name' AND `id`='$accout_id'";
    $result_account = mysqli_query($conn, $sql_account);

    while ($row_account = mysqli_fetch_assoc($result_account)) {
        $city = $row_account['city'];
        $pin = $row_account['pin'];
        $state = $row_account['state'];
        $country = $row_account['country'];
        $address = $row_account['address'];
    }
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
    <title>Order Checkout</title>
</head>

<body>

    <nav class="navigation">
        <ul class="nav-computer">
            <div class="logo">
                <a href="index.php"><strong>Art</strong> Craftings</a>
            </div>
        </ul>

        <ul class="nav-phone">
            <div class="logo">
                <strong>Art</strong> Craftings
            </div>
        </ul>
    </nav>


    <section class="order-checkout">
        <div class="left">
            <div class="order-summary order-left-box">
                <h2>Order Summary</h2>
                <div>
                    <img src="<?php echo $photo_view ?>" alt="...">
                    <div>
                        <span>Customized <?php echo $product_size ?> <?php echo $paint_type ?></span>
                        <small>By, <?php echo $seller_name ?></small>
                        <p><?php echo $paint_type ?></p>
                        <p><?php echo $product_size ?></p>
                        <h4>&#8377;<?php echo $price ?></h4>
                    </div>
                </div>
            </div>

            <div class="delivery-address  order-left-box">
                <h2>Delivery Address</h2>
                <div>
                    <p><strong><?php echo $accout_name ?></strong></p>
                    <p><strong>Phone No.</strong> <?php echo $accout_phone ?></p>
                    <p><?php echo $address ?>, <?php echo $pin ?></p>
                    <p><?php echo $city ?>, <?php echo $state ?>, <?php echo $country ?></p>
                </div>
            </div>
        </div>
        <div class="right">
            <h2>Price Details</h2>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Price</td>
                        <td id="price-main"><?php echo $price ?></td>
                    </tr>
                    <tr>
                        <td>Other Taxes</td>
                        <td id="other-tax"></td>
                    </tr>
                    <tr class="total-price">
                        <td><strong>Total</strong></td>
                        <td><strong id="total-price"></strong></td>
                    </tr>
                </tbody>
            </table>
            <a href="payment-here-custom.php" class="btn btn-warning">Place Order</a>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        price = document.getElementById('price-main').innerHTML
        document.getElementById('other-tax').innerHTML = ((price / 100) * 3).toFixed(0) + '.00'
        document.getElementById('total-price').innerHTML = (((price / 100) * 3) + Number(price)).toFixed(0) + '.00';
    </script>

    <?php
    $tax_price = $price + (($price / 100) * 3);
    $_SESSION['total-price'] = round($tax_price, 0);
    ?>


</body>

</html>