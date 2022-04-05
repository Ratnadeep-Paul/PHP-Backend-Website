<?php
include '../partials/dbconnect.php';
session_start();
if (isset($_SESSION['seller-login'])) {
    $seller_name = $_SESSION['seller-name'];
} else {
    header("location: login.php");
    exit();
}

$updated = false;
$seller_phone = $_SESSION['seller-phone'];
$seller_id = $_SESSION['seller-id'];

$sql = "SELECT * FROM `seller` WHERE `phone`='$seller_phone' AND `name`='$seller_name' AND `id`='$seller_id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $name = mysqli_real_escape_string($conn, $row['name']);
    $phone_show = mysqli_real_escape_string($conn, $row['show-phone']);
    $email = mysqli_real_escape_string($conn, $row['email']);
    $upi = mysqli_real_escape_string($conn, $row['upi']);
    $city = mysqli_real_escape_string($conn, $row['city']);
    $pin = mysqli_real_escape_string($conn, $row['pin']);
    $state = mysqli_real_escape_string($conn, $row['state']);
    $country = mysqli_real_escape_string($conn, $row['country']);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone_show = mysqli_real_escape_string($conn, $_POST['phone-show']);
    $upi = mysqli_real_escape_string($conn, $_POST['upi']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);

    $update_sql = "UPDATE `seller` SET `show-phone`='$phone_show',`upi`='$upi',`city`='$city',`country`='$country',`pin`='$pin',`state`='$state' WHERE `phone`='$seller_phone' AND `name`='$seller_name' AND `id`='$seller_id'";

    mysqli_query($conn, $update_sql);
    $updated = true;
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/seller-style.css">
    <title>My Account</title>
</head>

<body class="account-page">
    <nav>
        <div class="logo">
            <a href="../index.php"><strong>Art</strong> Craftings</a>
        </div>

        <div class="account-login">
            <img src="../Img/icons/user.svg" alt="...">
            <a href="dashboard.php" id="login-register"><?php echo $name ?></a>
        </div>
    </nav>

    <div class="account">

        <img src="../Img/icons/Menu Icon.svg" alt="..." onclick="toggleMenu()" class="menu">

        <div class="left" id="menu-left">
            <div class="account-option-selector account-left-options">
                <a href="dashboard.php" class="btn dash-option" href="dashboard.php">Dashboard</a>
            </div>

            <div class="account-option-selector account-left-options">
                <a href="personal-details.php" class="btn account-option">Personal Information</a>
                <a class="option-active btn" href="update-details.php">Change Information</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a href="order-details.php" class="btn order-option">My Orders</a>
                <a class="btn" href="tel: +91 6002250149">Call For Report Problem</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a href="products.php" class="btn order-option">My Products</a>
                <a href="add-product.php" class="btn order-option">Add New Products</a>
                <a href="customized.php" class="btn order-option">Customized Painting</a>
            </div>

            <a href="logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">

            <div id="personal-details">
                <h2>Edit Details</h2>
                <?php
                if ($updated == true) {
                    echo ' <div class="alert mb-2 mt-2 alert-success" role="alert">
                                        Account Updated Successfully!!
                                    </div>';
                }
                ?>
                <table class="table">
                    <tbody>
                        <form action="update-details.php" method="post">
                            <tr>
                                <td>Phone Number Shown</td>
                                <td><input type="number" class="form-control" id="phone-show" value="<?php echo $phone_show ?>" name="phone-show" required></td>
                            </tr>
                            <tr>
                                <td>UPI ID</td>
                                <td>
                                    <input type="text" class="form-control" id="upi" name="upi" value="<?php echo $upi ?>" required>
                                </td>
                            </tr>
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

    <script>
        menu = document.getElementById('menu-left');
        // menu.style.display = 'none';

        function toggleMenu() {
            if (menu.style.display == 'none' || menu.style.display == '') {
                $('#menu-left').show()
                $('.right').hide()
            } else {
                menu.style.display = 'none';
                $('.right').show()
            }

        }
    </script>


</body>

</html>