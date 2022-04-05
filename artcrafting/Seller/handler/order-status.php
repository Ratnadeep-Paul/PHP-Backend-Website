<?php
$order_id = $_GET['id'];
$status = $_GET['status'];

include '../../partials/dbconnect.php';
$update_sql = "UPDATE `orders` SET `order_status`='$status' WHERE `id`='$order_id'";
mysqli_query($conn, $update_sql);
header("location: ../order-details.php");
