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
$trust = $_GET['trust'];
$seller_id = $_GET['id'];
$seller_name = $_GET['name'];

if ($trust == "Approved") {
    $sql_seller = "SELECT * FROM `seller` WHERE `id`='$seller_id'";
    $result_seller = mysqli_query($conn, $sql_seller);
    while ($row_seller = mysqli_fetch_assoc($result_seller)) {
        $phone = mysqli_real_escape_string($conn, $row_seller['phone']);
    }

    $sql_update = "UPDATE `seller` SET `trust`='Approved' WHERE `id`='$seller_id' AND `name`='$seller_name'";
    mysqli_query($conn, $sql_update);

    $msg = 'Dear ' . $seller_name . '%0a' . 'Your Seller Account Has Been Activated';

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=pzTo5faxrhdVlLeRb3gKPuvyc81Fts02HIqDA6wS4kJWmXZE7UC8trYvedgFmq2laHTZ14WEV9SILos6&sender_id=HCSSIL&message=" . urlencode($msg) . "&route=v3&numbers=" . urlencode($phone),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
} else {
    $sql_seller = "SELECT * FROM `seller` WHERE `id`='$seller_id'";
    $result_seller = mysqli_query($conn, $sql_seller);
    while ($row_seller = mysqli_fetch_assoc($result_seller)) {
        $phone = mysqli_real_escape_string($conn, $row_seller['phone']);
    }

    $sql_update = "UPDATE `seller` SET `trust`='Rejected' WHERE `id`='$seller_id' AND `name`='$seller_name'";
    mysqli_query($conn, $sql_update);

    $msg = 'Dear ' . $seller_name . '%0a' . 'Your Seller Account Has Been Rejected';

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=pzTo5faxrhdVlLeRb3gKPuvyc81Fts02HIqDA6wS4kJWmXZE7UC8trYvedgFmq2laHTZ14WEV9SILos6&sender_id=HCSSIL&message=" . urlencode($msg) . "&route=v3&numbers=" . urlencode($phone),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
}

header('location: seller-approve.php');
