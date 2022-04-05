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

if (isset($_GET['payment'])) {
    $payment = $_GET['payment'];
} else {
    $payment = true;
}

include '../partials/dbconnect.php';
$product_name = $_GET['product-name'];
$product_id = $_GET['product-id'];
$_SESSION['product-id'] = $product_id;
$_SESSION['product-name'] = $product_name;

$accout_phone = $_SESSION['account-phone'];
$accout_id = $_SESSION['account-id'];
$accout_name = $_SESSION['account-name'];

$sql = "SELECT * FROM `products` WHERE `name` = '$product_name' AND `id`='$product_id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $photo = '../'. $row['photo'];
    $type = $row['paint-type'];
    $description = $row['description'];
    $size = $row['size'];
    $price = $row['price'];
    $artist = $row['artist'];
    $artist_id = $row['artist-id'];

    $_SESSION['seller-name'] = $artist;
    $_SESSION['seller-id'] = $artist_id;
}

$sql_account = "SELECT * FROM `buyer` WHERE `phone`='$accout_phone' AND `name`='$accout_name' AND `id`='$accout_id'";
$result_account = mysqli_query($conn, $sql_account);

while ($row_account = mysqli_fetch_assoc($result_account)) {
    $city = $row_account['city'];
    $pin = $row_account['pin'];
    $state = $row_account['state'];
    $country = $row_account['country'];
    $address = $row_account['address'];
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

    <?php
    if ($payment != 'failed') {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                       <strong> Payment Failed!! </strong> 
                                       Please Try Again.
                                    </div>';
    }
    ?>


    <section class="order-checkout">
        <div class="left">
            <div class="order-summary order-left-box">
                <h2>Order Summary</h2>
                <div>
                    <img src="<?php echo $photo ?>" alt="...">
                    <div>
                        <span><?php echo $product_name ?></span>
                        <small>By, <?php echo $artist ?></small>
                        <p><?php echo $type ?></p>
                        <p><?php echo $size ?></p>
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
                    <a href="../Account/update-address.php?checkout=truest" class="btn btn-info">Change Address</a>
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
            <a href="payment-here-product.php" class="btn btn-warning">Place Order</a>
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