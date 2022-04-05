<?php
include 'partials/dbconnect.php';

session_start();
$uri = $_SERVER['REQUEST_URI'];
$_SESSION['old_url'] = $uri;
$accout_name = 'Login/Signup';

if (isset($_SESSION['buyer-login'])) {
    $accout_name = $_SESSION['account-name'];
} else {
    if (isset($_SESSION['seller-login'])) {
        header("location: logout.php");
    }

    header("location: Account/login.php");
    exit();
}

if (isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = false;
}

$accout_phone = $_SESSION['account-phone'];
$accout_id = $_SESSION['account-id'];

$sql = "SELECT * FROM `buyer` WHERE `phone`='$accout_phone' AND `name`='$accout_name' AND `id`='$accout_id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
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
    <link rel="stylesheet" href="CSS/style.css">
    <title>My Account</title>
</head>

<body class="account-page">
    <nav class="navigation">
        <ul class="nav-computer">
            <div class="logo">
                <a href="index.php"><strong>Art</strong> Craftings</a>
            </div>
            <div class="search-bar">
                <input class="form-control" id="search-bar" type="text" onkeyup="showResult()" placeholder="Search Items Here">
                <div id="search-result" class="search-result">
                </div>
            </div>
            <div class="account-login">
                <img src="Img/icons/user.svg" alt="...">
                <a href="account.php" id="login-register"><?php echo $accout_name ?></a>
            </div>
        </ul>

        <ul class="nav-phone">
            <div class="logo">
                <strong>Art</strong> Craftings
            </div>
            <div class="account-login">
                <img src="Img/icons/user.svg" alt="...">
                <a href="account.php" id="login-register"><?php echo $accout_name ?></a>
            </div>
            <div class="search-bar">
                <input class="form-control" type="text" placeholder="Search Items Here">
                <div id="search-result" class="search-result">
                </div>
            </div>
        </ul>


        <ul class="nav-items">
            <li> <a class="hvr-underline-from-left" href="products.php?type=Oil Painting">Oil Painting</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Acrylic Painting">Acrylic Painting</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Pencil Sketch">Pencil Sketch</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Collage Painting">Collage Painting</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Water Colour">Water Colour</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Pen Works">Pen Works</a></li>
            <li> <a class="hvr-underline-from-left" href="products.php?type=Glass Painting">Glass Painting</a></li>
        </ul>
    </nav>

    <?php
    if ($order == true) {
        echo ' <div id="order-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                                       <strong> Order Placed Successfully!! </strong> 
                                       Go To <a class="btn btn-success" href="Account/orders.php">My Orders</a>
                                    </div>';
    }
    ?>

    <div class="account">

        <img src="Img/icons/Menu Icon.svg" alt="..." onclick="toggleMenu()" class="menu">

        <div class="left" id="menu-left">
            <div class="hello account-left-options">
                <img src="Img/icons/user.svg" alt="...">
                <div>
                    <span>Hi,</span>
                    <h5><?php echo $name ?></h5>
                </div>
            </div>

            <div class="account-option-selector account-left-options">
                <a onclick="activeAccount()" class="btn account-option option-active">My Account</a>
                <a class="btn" href="Account/update-address.php">Change Address</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a href="Account/orders.php" class="btn order-option">My Orders</a>
                <a class="btn" href="tel: +91 6002250149">Call For Report Problem</a>
            </div>

            <a href="logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">

            <div id="personal-details">
                <h2>Personal Details</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $name ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $phone ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><?php echo $city ?></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td><?php echo $state ?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><?php echo $country ?></td>
                        </tr>
                        <tr>
                            <td>Pin Code</td>
                            <td><?php echo $pin ?></td>
                        </tr>
                        <tr>
                            <td>Delivery Address</td>
                            <td><?php echo $address ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#order-details').hide()
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

        function showResult() {
            results = document.getElementById('search-result')
            search = document.getElementById('search-bar')
            searchText = search.value
            if (search.value == "") {
                $('#search-result').html("")
            } else {
                // results.style.display = 'flex';
                $.post("handler/search.php", {
                    name: searchText,
                }, function(data, status) {
                    if (data != "") {
                        $('#search-result').html(data)
                    }
                })
            }
        }
    </script>


</body>

</html>