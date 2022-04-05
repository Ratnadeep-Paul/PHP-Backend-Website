<?php

include '../../partials/dbconnect.php';
session_start();
if (isset($_SESSION['seller-login'])) {
    $seller_name = $_SESSION['seller-name'];
} else {
    header("location: ../logout.php");
    exit();
}


if (!isset($_GET['order_id'])) {
    $order_id = $_SESSION['order-id'];
} else {
    $order_id = $_GET['order_id'];
    $_SESSION['order-id'] = $order_id;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courier_name = $_POST['courier'];
    $tracking_id = $_POST['tracking-id'];

    $update_sql = "UPDATE `orders` SET `order_status`='Shipped', `last-date`='$courier_name', `tracking-id`='$tracking_id' WHERE `id`='$order_id'";
    mysqli_query($conn, $update_sql);

    $sql_order = "SELECT * FROM `orders` WHERE `id`='$order_id'";
    $result_order = mysqli_query($conn, $sql_order);
    while ($row_order = mysqli_fetch_assoc($result_order)) {
        $product_name = $row_order['product_name'];
        $product_id = $row_order['product_id'];
        $order_type = $row_order['order_type'];
        $order_placing_id = $row_order['order_id'];
    }

    if ($order_type == 'Customized') {
        $product_sql = "SELECT * FROM `custom` WHERE `id`='$order_placing_id'";
        $product_result = mysqli_query($conn, $product_sql);
        while ($row_product = mysqli_fetch_assoc($result_product)) {
            $price = $row_product['product-price'];
            $seller_id = $row_product['seller-id'];
        }
    } else {
        $product_sql = "SELECT * FROM `products` WHERE  `id`='$product_id' AND `name`='$product_name'";
        $product_result = mysqli_query($conn, $product_sql);
        while ($row_product = mysqli_fetch_assoc($result_product)) {
            $price = $row_product['price'];
            $seller_id = $row_product['artist-id'];
        }
    }

    $seller_update = "UPDATE `seller` SET `income`='$price',`income-change`='$price' WHERE `id`='$seller_id' AND `name`='$seller_name'";
    mysqli_query($conn, $seller_update);
    header("location: ../order-details.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .payment-form {
            background: #e0e0e0;
            width: 50%;
            height: 20rem;
            display: flex;
            margin-top: 10%;
            box-shadow: 0 0 40px #54545491;
            border-radius: 5px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .payment-form form label {
            display: inline-block;
            margin-bottom: .5rem;
            padding: 0;
            text-align: initial;
            margin: auto;
            width: 50%;
        }

        .payment-form form {
            width: 80%;
        }

        .form-detail {
            width: 95%;
            display: flex;
            text-align: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .payment-form h1 {
            border-bottom: 2px solid;
            padding: 1rem;
            margin-bottom: 1.5rem;
            width: 80%;
            text-align: center;
        }

        .form-control {
            width: 50%;
        }

        .btn {
            width: 95%;
        }

        @media screen and (max-width:600px) {
            .payment-form {
                width: 90%;
                display: flex;
                margin-top: 40%;
                box-shadow: 0 0 40px #54545491;
                border-radius: 5px;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .payment-form h1 {
                font-size: 2rem;
            }

        }
    </style>

</head>

<body>
    <div class="payment-form">
        <h1>Payment Details</h1>
        <form action="#" method="POST">
            <div class="form-detail">
                <label for="tracking-id">Tracking From Courier Service</label>
                <input type="text" class="form-control" name="tracking-id" id="tracking-id" required>
            </div>
            <div class="form-detail">
                <label for="courier">Courier Name</label>
                <input type="number" class="form-control" name="courier" id="courier" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>