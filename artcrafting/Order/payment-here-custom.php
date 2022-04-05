<?php

session_start();
if (!isset($_SESSION['account-name']) || $_SESSION['buyer-login'] != true) {
  header("location: ../Account/login.php");
  exit;
}

if (isset($_SESSION['seller-login'])) {
  header("location: ../logout.php");
}

include '../partials/dbconnect.php';
$accout_phone = $_SESSION['account-phone'];
$accout_id = $_SESSION['account-id'];
$accout_name = $_SESSION['account-name'];
$total_price = $_SESSION['total-price'];
$seller_name = $_SESSION['seller-name'];
$seller_id = $_SESSION['seller-id'];
$product_name = $_SESSION['product-name'];


$sql_account = "SELECT * FROM `buyer` WHERE `phone`='$accout_phone' AND `name`='$accout_name' AND `id`='$accout_id'";
$result_account = mysqli_query($conn, $sql_account);
while ($row_account = mysqli_fetch_assoc($result_account)) {
  $city = $row_account['city'];
  $pin = $row_account['pin'];
  $phone = $row_account['phone'];
  $email = $row_account['email'];
  $state = $row_account['state'];
  $country = $row_account['country'];
  $address = $row_account['address'];
}

$order_id = rand(1111111111, 999999999999999);
$_SESSION['order-id'] = $order_id;


require '../Payment/Payment.php';
require '../Payment/Validator.php';
require '../Payment/Crypto.php';

/**
 * Parameters requires to initialize an object of Payment are as follow.
 * mid => Merchant Id provided by Paykun
 * accessToken => Access Token provided by Paykun
 * encKey => Encryption provided by Paykun
 * isLive => Set true for production environment and false for sandbox or testing mode
 * isCustomTemplate => Set true for non composer projects, will disable twig template
 */


$mid = '320157477124405';
$access = '0364DE2B91634D1EB644999AD9CB20A1';
$api = '09417979F5CEC41B8A4C14FAE50F5C77';

$obj = new \Paykun\Checkout\Payment("$mid", "$access", "$api", true, true);

// Initializing Order
// default currency is 'INR'
$obj->initOrder("$order_id", "$product_name", "$total_price", "http://127.0.0.1/artcrafting/Order/order-success-customized.php", 'http://127.0.0.1/artcrafting/Order/order-failed-customized.php', 'INR');

// Add Customer
$obj->addCustomer("$accout_name", "$email", "$phone");

// Add Shipping address
$obj->addShippingAddress("$country", "$state", "$city", "$pin", "$address");

// Add Billing Address
$obj->addBillingAddress("$country", "$state", "$city", "$pin", "$address");

//Render template and submit the form
echo $obj->submit();

  /* Check for transaction status
* Once your success or failed url called then create an instance of Payment same as above and then call getTransactionInfo like below
* $obj = new Payment('merchantUId', 'accessToken', 'encryptionKey', true, true); //Second last false if sandbox mode
 * $transactionData = $obj->getTransactionInfo(Get payment-id from the success or failed url);
 * Process $transactionData as per your requirement
* 
* */
