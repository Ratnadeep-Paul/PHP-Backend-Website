<?php
session_start();
if (!isset($_SESSION['account-name']) || $_SESSION['buyer-login'] != true) {
    header("location: ../Account/login.php");
    exit;
}

if (isset($_SESSION['seller-login'])) {
    header("location: ../logout.php");
}

$payment_id = $_GET['payment-id'];

$product_name = $_SESSION['product-name'];
$product_id = $_SESSION['product-id'];

$accout_id = $_SESSION['account-id'];
$accout_name = $_SESSION['account-name'];

$seller_name = $_SESSION['seller-name'];
$seller_id = $_SESSION['seller-id'];
include '../partials/dbconnect.php';

$seller_sql = "SELECT * FROM `seller` WHERE `id`='$seller_id' AND `name`='$seller_name'";
$seller_result = mysqli_query($conn, $seller_sql);

while ($seller_row = mysqli_fetch_assoc($seller_result)) {
    $new_orders = $seller_row['orders'] + 1;
    $new_order_change = $seller_row['order-change'] + 1;
    $new_products = $seller_row['products'] - 1;
    $new_product_change = $seller_row['products-change'] - 1;
}

$update_sql = "UPDATE `seller` SET `products`='$new_products', `products-change`='$new_product_change', `orders`='$new_orders',`order-change`='$new_order_change' WHERE `name`='$seller_name' AND `id`='$seller_id'";
mysqli_query($conn, $update_sql);

$product_sql = "UPDATE `products` SET `status`='Not Available' WHERE `id`='$product_id'";
mysqli_query($conn, $product_sql);


$today = date('d-M-Y');
$order_id = $_SESSION['order-id'];

$sql_order = "INSERT INTO `orders`(`order_id`, `payment-id`, `order_date`, `order_status`, `seller_name`, `seller_id`, `product_name`, `product_id`, `buyer_name`, `buyer_id`, `order_type`) VALUES ('$order_id', '$payment_id','$today','Ordered','$seller_name','$seller_id','$product_name','$product_id','$accout_name','$accout_id','Product')";
$result_order = mysqli_query($conn, $sql_order);

echo '<script>
                    window.location.href = "../account.php?order=true";
                </script>';
