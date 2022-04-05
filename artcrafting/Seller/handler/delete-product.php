<?php
include '../../partials/dbconnect.php';
session_start();
if (isset($_SESSION['seller-login'])) {
    $seller_name = $_SESSION['seller-name'];
} else {
    header("location: logout.php");
    exit();
}

$seller_phone = $_SESSION['seller-phone'];
$seller_id = $_SESSION['seller-id'];
$product_id = $_GET['product_id'];


$delete_sql = "DELETE FROM `products` WHERE `id`='$product_id'";
$result = mysqli_query($conn, $delete_sql);

$seller_sql = "SELECT * FROM `seller` WHERE `id`='$seller_id' AND `name`='$seller_name'";
$seller_result = mysqli_query($conn, $seller_sql);
while ($seller_row = mysqli_fetch_assoc($seller_result)) {
    $new_products = $seller_row['products'] - 1;
    $new_products_change = $seller_row['products-change'] - 1;
}
$update_sql = "UPDATE `seller` SET `products`='$new_products',`products-change`='$new_products_change' WHERE `id`='$seller_id' AND `name`='$seller_name'";
$update_result = mysqli_query($conn, $update_sql);
echo '<script>
                    window.location.href = "../products.php";
                </script>';
