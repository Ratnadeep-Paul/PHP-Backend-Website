<?php

include '../partials/dbconnect.php';
session_start();

if (isset($_SESSION['buyer-login'])) {
    $accout_name = $_SESSION['account-name'];
} else {
    if (isset($_SESSION['seller-login'])) {
        header("location: ../logout.php");
    }

    header("location: ../login.php");
    exit();
}

$order_id = $_POST['prefix-order'];
$note = mysqli_real_escape_string($conn, $_POST['note']);

$sql = "SELECT * FROM `orders` WHERE `order_id`='$order_id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $payment_id = $row['payment-id'];
    $product_id = $row['product_id'];
    $product_name = $row['product_name'];
    $buyer = $row['buyer_name'];
}

$sql_product = "SELECT * FROM `products` WHERE `id`='$product_id' AND `name`='$product_name'";
$result_product = mysqli_query($conn, $sql_product);
while ($product_row = mysqli_fetch_assoc($result_product)) {
    $price = $product_row['price'];
}

$url = "https://sandbox.paykun.com/v1/merchant/transaction/" . $payment_id . "/refund";
$data = array('refund_amount' => $price, 'remarks' => '$note', 'signature' => $buyer);

$headers = array(
    "MerchantId: 942983059951129",
    "AccessToken: AF7C99EF58E0D341CF4237D38039D8A8"
);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => $headers,
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */
    echo 'Failed';
}

var_dump($result);
