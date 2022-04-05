<?php
include '../partials/dbconnect.php';

$seller_name = $_POST['name'];
$seller_id = $_POST['id'];
$type = $_POST['type'];

$sql = "SELECT * FROM `seller` WHERE `id`='$seller_id' AND `name`='$seller_name' AND `$type`='Yes'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $price_1 = $row[$type . ' ' . '6X8 Inches'];
    $price_2 = $row[$type . ' ' . '8X12 Inches'];
    $price_3 = $row[$type . ' ' . '12X16 Inches'];
    $price_4 = $row[$type . ' ' . '16X24 Inches'];
    $price_5 = $row[$type . ' ' . '24X33 Inches'];

    $rating_sql = "SELECT * FROM `ratings` WHERE `seller_id`='$seller_id'";
    $result_rating = mysqli_query($conn, $rating_sql);
    $num_rating = mysqli_num_rows($result_rating);
    $rating = 0;
    while ($row_rating = mysqli_fetch_assoc($result_rating)) {
        $rating = $rating + $row_rating['rating'];
    }

    if ($rating != 0) {
        $rating = $rating / $num_rating;
    } else {
        $rating = 'No Rating Yet';
    }

    echo '
            <p>Drawn By <a href="seller.php?seller_name=' . $seller_name . '&&seller_id=' . $seller_id . '" target="_blank"> ' . $seller_name . '</a></p>
            <span><strong>Rating:- </strong> <span class="fas fa-star" style="font-size: 1rem; color: #ff9900;"></span>' . $rating . ' ('.$num_rating.')</span>
            <div style="display: none;">
                <input type="text" name="artist-name" value="' . $seller_name . '" id="artist-name">
                <input type="text" name="artist-id" value="' . $seller_id . '" id="artist-id">
            </div>

            <div class="product-more-details">

                <div class="form-group">
                    <label for="size">Select Size</label>
                    <select onchange="priceChange()" class="form-control" name="size" id="size">
                        <option value="6X8 Inches">6X8 Inches</option>
                        <option value="8X12 Inches">8X12 Inches</option>
                        <option value="12X16 Inches">12X16 Inches</option>
                        <option value="16X24 Inches">16X24 Inches</option>
                        <option value="24X33 Inches">24X33 Inches</option>
                    </select>
                </div>

            </div>

            <h3 id="price-tag">Price:- &#8377;' . $price_1 . '</h3>
            <small style="display: block; width:100%;">Shipping Charges Included*</small>

            <button type="submit" class="btn btn-danger">Create</button>

            <!-- script  -->
            <script>
                let price = document.getElementById("price-tag")
                let size = document.getElementById("size")

                function priceChange() {
                    if (size.value == "6X8 Inches") {
                        price.innerText = "Price:- ₹' . $price_1 . '"
                    } else if (size.value == "8X12 Inches") {
                        price.innerText = "Price:- ₹' . $price_2 . '"
                    } else if (size.value == "12X16 Inches") {
                        price.innerText = "Price:- ₹' . $price_3 . '"
                    } else if (size.value == "16X24 Inches") {
                        price.innerText = "Price:- ₹' . $price_4 . '"
                    } else if (size.value == "24X33 Inches") {
                        price.innerText = "Price:- ₹' . $price_5 . '"
                    }
                }
            </script>
';
}


?>