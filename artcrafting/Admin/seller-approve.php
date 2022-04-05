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

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/seller-style.css">
    <title>Seller Approving Menu</title>
</head>

<body class="account-page">
    <nav>
        <div class="logo">
            <a href="../index.php"><strong>Art</strong> Craftings</a>
        </div>
    </nav>

    <div class="account admin-account">

        <img src="../Img/icons/Menu Icon.svg" alt="..." onclick="toggleMenu()" class="menu">

        <div class="left" id="menu-left">
            <div class="account-option-selector account-left-options">
                <a href="dashboard.php" class="btn dash-option" href="dashboard.php">Dashboard</a>
                <a href="seller.php" class=" btn">Sellers</a>
                <a href="seller-approve.php" class="option-active btn">Approve Seller</a>
            </div>

            <a href="../logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">
            <h2>Sellers</h2>
            <div class="sellers">

                <?php

                include '../partials/dbconnect.php';
                $sql = "SELECT * FROM `seller` WHERE `trust`!='Approved' AND `trust`!='Rejected'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $seller_id = $row['id'];
                    $seller_name = $row['name'];
                    $phone = mysqli_real_escape_string($conn, $row['phone']);
                    $phone_show = mysqli_real_escape_string($conn, $row['show-phone']);
                    $email = mysqli_real_escape_string($conn, $row['email']);
                    $upi = mysqli_real_escape_string($conn, $row['upi']);
                    $city = mysqli_real_escape_string($conn, $row['city']);
                    $pin = mysqli_real_escape_string($conn, $row['pin']);
                    $state = mysqli_real_escape_string($conn, $row['state']);
                    $country = mysqli_real_escape_string($conn, $row['country']);
                    $identity = $row['identity'];

                    echo '<div type="button" class="seller" data-toggle="modal" data-target="#Sellers' . $seller_id . '">
                                <div class="left">
                                    <h5>
                                        <img style="filter: invert(0.2)" width="20px" src="../Img/icons/user.svg" alt="...">
                                        <span>' . $seller_name . '</span>
                                    </h5>
                                    <p><strong>Phone:-</strong> ' . $phone . '</p>
                                </div>
                                <div class="right right-approve">
                                    <a href="seller-trust-update.php?id=' . $seller_id . '&&name=' . $seller_name . '&&trust=Approved" class=" btn btn-success">
                                        <h4>Accept</h4>
                                    </a>
                                    <a href="seller-trust-update.php?id=' . $seller_id . '&&name=' . $seller_name . '&&trust=Rejected" class="btn btn-danger">
                                        <h4>Reject</h4>
                                    </a>
                                </div>
                            </div>
                            <!-- Modals -->
                            <div class="modal fade" id="Sellers' . $seller_id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ArtistsLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ArtistsLabel">About Ratnadeep Paul</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body select-artist">
                                            <div id="personal-details">
                                                <h2>Personal Details</h2>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>' . $seller_name . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone Number</td>
                                                            <td>' . $phone . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shown Phone Number</td>
                                                            <td>' . $phone_show . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email Address</td>
                                                            <td>' . $email . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>UPI ID</td>
                                                            <td>' . $upi . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>City</td>
                                                            <td>' . $city . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>State</td>
                                                            <td>' . $state . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Country</td>
                                                            <td>' . $country . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pin Code</td>
                                                            <td>' . $pin . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Identity Proff</td>
                                                            <td><a target="_blank" href="' . $identity . '" class="btn btn-primary">Show Photo</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }

                ?>

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