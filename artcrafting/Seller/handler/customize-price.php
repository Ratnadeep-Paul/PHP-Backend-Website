<?php

include '../../partials/dbconnect.php';
session_start();
if (isset($_SESSION['seller-login'])) {
    $seller_name = $_SESSION['seller-name'];
} else {
    header("location: logout.php");
    exit();
}

$type = $_POST['type'];
$seller_phone = $_SESSION['seller-phone'];
$seller_id = $_SESSION['seller-id'];

$sql = "SELECT * FROM `seller` WHERE `phone`='$seller_phone' AND `name`='$seller_name' AND `id`='$seller_id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $price_1 = $row[$type . ' ' . '6X8 Inches'];
    $price_2 = $row[$type . ' ' . '8X12 Inches'];
    $price_3 = $row[$type . ' ' . '12X16 Inches'];
    $price_4 = $row[$type . ' ' . '16X24 Inches'];
    $price_5 = $row[$type . ' ' . '24X33 Inches'];
}

echo '           <input style="display: none;" type="text" name="type" class="form-control" id="type" readonly value="' . $type . '">

                    <div class="form-group row">
                            <label for="12x16" class="col-sm-5 col-form-label">Price For 6X8 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" name="6X8-Inches" value="' . $price_1 . '" class="form-control" id="6x8">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="24x32" class="col-sm-5 col-form-label">Price For 8X12 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" value="' . $price_2 . '" name="8X12-Inches" class="form-control" id="8x12">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="36x48" class="col-sm-5 col-form-label">Price For 12X16 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" value="' . $price_3 . '" name="12X16-Inches" class="form-control" id="12x16">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="48x64" class="col-sm-5 col-form-label">Price For 16X24 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" value="' . $price_4 . '" name="16X24-Inches" class="form-control" id="16x24">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="60x80" class="col-sm-5 col-form-label">Price For 24X33 Inches</label>
                            <div class="col-sm-7">
                                <input type="text" value="' . $price_5 . '" name="24X33-Inches" class="form-control" id="24x33">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">Save Price</button>';
