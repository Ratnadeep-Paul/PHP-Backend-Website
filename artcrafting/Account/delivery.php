<?php
session_start();
include '../partials/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['order-number'];
    $sql_order = "SELECT * FROM `orders` WHERE `order_id`='$id'";
    $result_order = mysqli_query($conn, $sql_order);
    while ($row = mysqli_fetch_assoc($result_order)) {
        $seller_id = $row['seller_id'];
        $seller_name = $row['seller_name'];
        $buyer_id = $row['buyer_id'];
        $buyer_name = $row['buyer_name'];
    }

    $rating = $_POST['rate'];
    $comment = $_POST['comment'];

    $rating_sql = "INSERT INTO `ratings`(`rating`, `comment`, `seller_id`, `seller_name`, `buyer_name`, `buyer_id`) VALUES ('$rating','$comment','$seller_id','$seller_name','$buyer_name','$buyer_id')";
    mysqli_query($conn, $rating_sql);
    header("location: ../account.php");
} else {
    $status = $_GET['status'];
    $id = $_GET['prefix-token'];
    $_SESSION['order-number'] = $id;

    if (isset($_SESSION['buyer-login'])) {
        $sql = "UPDATE `orders` SET `order_status`='$status' WHERE `order_id`='$id'";
        $result = mysqli_query($conn, $sql);
        if ($status == 'Delivered') {

            $sql_order = "SELECT * FROM `orders` WHERE `id`='$id'";
            $result_order = mysqli_query($conn, $sql_order);

            while ($row = mysqli_fetch_assoc($result_order)) {
                $seller_id = $row['seller_id'];
                $product_id = $row['product_id'];
            }

            $seller_sql = "SELECT * FROM `seller` WHERE `id`='$seller_id'";
            $seller_result = mysqli_query($conn, $seller_sql);

            while ($seller_row = mysqli_fetch_assoc($seller_result)) {
                $order_success = $seller_row['order-success'] + 1;
                $products = $seller_row['products'];
            }

            $product_sql = "UPDATE `products` SET `status`='Sold' WHERE `id`='$product_id'";
            $product_result = mysqli_query($conn, $product_sql);

            $update_sql = "UPDATE `seller` SET `products`='$products', `order-success`='$order_success' WHERE `id`='$seller_id'";
            mysqli_query($conn, $update_sql);

            $delete_sql = "DELETE FROM `orders` WHERE `id`='$id'";
            $delete_result = mysqli_query($conn, $delete_sql);

            // header("location: ../account.php");
        }
        // header("location: ../account.php");
    } else {
        header("location: login.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Rating</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #14161b;
        }

        .rating-card {
            margin-top: 15%;
            text-align: center;
            justify-content: center;
            align-items: center;
            width: 50%;
            padding: 1rem 1rem;
            background: #0000007d;
        }

        .container {
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .rating-card h2 {
            text-transform: uppercase;
            font-family: sans-serif;
            color: #ffbf00;
            border-bottom: 2px solid;
        }

        .stars {
            display: none;
        }

        .rate-stars label {
            font-size: 2rem;
            color: #c1c1c1;
            float: right;
            padding: 0.25rem;
            transition: 0.2s;
        }

        .rate-stars input:not(:checked)~label:hover,
        .rate-stars input:not(:checked)~label:hover~label {
            color: yellow;
        }

        .rate-stars input:checked~label {
            color: yellow;
        }

        .rating-card form {
            width: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
            align-items: center;
            justify-content: center;
        }

        .rating-card textarea {
            width: 100%;
            margin: 0.5rem 0;
            background: #efefef;
            border: 1px solid #d2d2d2;
            border-radius: 5px;
        }

        .rating-card .btn {
            width: 100%;
        }

        @media screen and (max-width: 650px) {
            .rating-card {
                width: 95%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="rating-card card">
            <h2>Rate The Seller</h2>
            <form action="delivery.php" method="POST">
                <small>Select Star According To Your Experience.</small>
                <smal>1 Star = Very Bad And 5 Star = Excellent</smal>
                <div class="rate-stars">
                    <input value="5" type="radio" class="stars" name="rate" id="rate-5">
                    <label for="rate-5" title="Excellent" class="fas fa-star"></label>

                    <input value="4" type="radio" class="stars" name="rate" id="rate-4">
                    <label for="rate-4" title="Very Good" class="fas fa-star"></label>

                    <input value="3" type="radio" class="stars" name="rate" id="rate-3">
                    <label for="rate-3" title="Good" class="fas fa-star"></label>

                    <input value="2" type="radio" class="stars" name="rate" id="rate-2">
                    <label for="rate-2" title="Bad" class="fas fa-star"></label>

                    <input value="1" type="radio" class="stars" name="rate" id="rate-1">
                    <label for="rate-1" title="Very Bad" class="fas fa-star"></label>
                </div>

                <textarea name="comment" id="comment" rows="4" placeholder="Write Your Feedback Or Experience. (Optional)"></textarea>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>
    </div>

    <script>

    </script>
</body>

</html>