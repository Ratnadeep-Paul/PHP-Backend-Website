<?php
include '../partials/dbconnect.php';

session_start();
$uri = $_SESSION['old_url'];
$accout_name = 'Login/Signup';

if (isset($_SESSION['buyer-login'])) {
    $accout_name = $_SESSION['account-name'];
} else {
    header("location: login.php");
    exit();
}

if (isset($_GET['checkout'])) {
    $_SESSION['checkout'] = 'truest';
}

$accout_phone = $_SESSION['account-phone'];
$accout_id = $_SESSION['account-id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_city = $_POST['city'];
    $post_pin = $_POST['pin'];
    $post_state = $_POST['state'];
    $post_country = $_POST['country'];
    $post_address = $_POST['address'];

    $update_sql = "UPDATE `buyer` SET `city`='$post_city',`pin`='$post_pin',`state`='$post_state',`country`='$post_country',`address`='$post_address' WHERE `id`='$accout_id' AND `name`='$accout_name' AND `phone`='$accout_phone'";

    if ($result_update = mysqli_query($conn, $update_sql)) {
        if ($_SESSION['checkout'] == 'truest') {
            header("location: $uri");
        } else {
            header("location: ../account.php");
        }
    }
}


$sql = "SELECT * FROM `buyer` WHERE `phone`='$accout_phone' AND `name`='$accout_name' AND `id`='$accout_id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $phone = $row['phone'];
    $city = $row['city'];
    $pin = $row['pin'];
    $state = $row['state'];
    $country = $row['country'];
    $address = $row['address'];
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
    <title>My Account</title>
</head>

<body class="account-page">

    <div class="account">
        <div class="left edit-left">
            <div class="hello account-left-options">
                <img src="../Img/icons/user.svg" alt="...">
                <div>
                    <span>Hi,</span>
                    <h6><?php echo $accout_name ?></h6>
                </div>
            </div>

            <div class="account-option-selector account-left-options">
                <a href="../account.php" class="btn account-option ">My Account</a>
                <a class="btn option-active">Change Address</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a href="../account.php" class="btn order-option">My Orders</a>
                <a class="btn" href="tel: +91 6002250149">Call For Report Problem</a>
            </div>

            <a href="../logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">

            <div id="personal-details">
                <h2>Edit Details</h2>
                <table class="table">
                    <tbody>
                        <form action="update-address.php" method="post">
                            <tr>
                                <td>City</td>
                                <td><input type="text" class="form-control" id="city" value="<?php echo $city ?>" name="city" required></td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td><input type="text" class="form-control" id="state" value="<?php echo $state ?>" name="state" required></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td><input type="text" class="form-control" id="country" value="<?php echo $country ?>" name="country" readonly></td>
                            </tr>
                            <tr>
                                <td>Pin Code</td>
                                <td><input type="number" class="form-control" id="pin" value="<?php echo $pin ?>" name="pin" required></td>
                            </tr>
                            <tr>
                                <td>Delivery Address</td>
                                <td><textarea name="address" class="form-control" id="address" rows="4" required><?php echo $address ?></textarea>
                                </td>
                            </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</body>

</html>