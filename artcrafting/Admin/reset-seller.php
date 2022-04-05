<?php
session_start();
if (!isset($_SESSION['otp-verified'])) {
    if (!isset($_SESSION['admin-power-login'])) {
        if ($_SESSION['otp-verified'] != 'Done Dude' && $_SESSION['admin-power-login'] != true) {
            header("location: ../logout.php");
        }
        header("location: ../logout.php");
    }
    header("location: ../logout.php");
}

include '../partials/dbconnect.php';

$seller_id = $_SESSION['seller-id'];
$url = $_SESSION['old_url'];
$tag = $_GET['tag'];

if ($tag == 'income') {
    $sql = "UPDATE `seller` SET `income-change` = '0' WHERE `id`='$seller_id'";
    $result = mysqli_query($conn, $sql);
} else {
    $sql2 = "UPDATE `seller` SET `order-change` = '0' WHERE `id`='$seller_id'";
    $result2 = mysqli_query($conn, $sql2);
}

header("location: $url");
