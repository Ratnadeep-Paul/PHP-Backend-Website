<?php
include '../partials/dbconnect.php';
session_start();
$added = false;
if (isset($_SESSION['seller-login'])) {
    $seller_name = $_SESSION['seller-name'];
} else {
    header("location: logout.php");
    exit();
}

$seller_phone = $_SESSION['seller-phone'];
$seller_id = $_SESSION['seller-id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product-name'];
    $product_photo = '';
    $description = $_POST['description'];
    $paint_type = $_POST['paint-type'];
    $paint_size = $_POST['paint-size'];
    $price = $_POST['price'];
    $rand = random_int(0011, 99999);

    $photo_post = $product_name . '--' . $seller_name . '--' . $rand;


    $uploading_dir = "../Img/Product-Img/";
    $uploading_file = $uploading_dir . basename($_FILES["product-photo"]["name"]);
    $imageFileType = strtolower(pathinfo($uploading_file, PATHINFO_EXTENSION));

    if ($imageFileType != "") {
        $target_file = $uploading_dir . basename($photo_post . "." . $imageFileType);
    } else {
        echo '';
    }


    $upload = move_uploaded_file($_FILES["product-photo"]["tmp_name"], $target_file);
    $photo = str_replace("../", "", $target_file);

    $sql = "INSERT INTO `products`(`name`, `paint-type`, `artist`, `artist-id`, `price`, `size`, `description`, `photo`) VALUES ('$product_name','$paint_type','$seller_name','$seller_id','$price','$paint_size','$description','$photo')";
    $result = mysqli_query($conn, $sql);

    $seller_sql = "SELECT * FROM `seller` WHERE `id`='$seller_id' AND `name`='$seller_name'";
    $seller_result = mysqli_query($conn, $seller_sql);
    while ($seller_row = mysqli_fetch_assoc($seller_result)) {
        $new_products = $seller_row['products'] + 1;
        $new_products_change = $seller_row['products-change'] + 1;
    }
    $update_sql = "UPDATE `seller` SET `products`='$new_products',`products-change`='$new_products_change' WHERE `id`='$seller_id' AND `name`='$seller_name'";
    $update_result = mysqli_query($conn, $update_sql);
    $added = true;
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
    <title>Add Products</title>
</head>

<body class="account-page">
    <nav>
        <div class="logo">
            <a href="../index.php"><strong>Art</strong> Craftings</a>
        </div>

        <div class="account-login">
            <img src="../Img/icons/user.svg" alt="...">
            <a href="dashboard.php" id="login-register"><?php echo $seller_name ?></a>
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
                <a class="btn" href="update-details.php">Change Information</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a href="order-details.php" class="btn order-option">My Orders</a>
                <a class="btn" href="tel: +91 6002250149">Call For Report Problem</a>
            </div>

            <div class="order-option-selector account-left-options">
                <a href="products.php" class="btn order-option">My Products</a>
                <a href="add-product.php" class="option-active btn order-option">Add New Products</a>
                <a href="customized.php" class="btn order-option">Customized Painting</a>
            </div>

            <a href="logout.php" class="btn account-left-options logout ">Logout</a>
        </div>

        <div class="right">
            <h2>Add New Products</h2>

            <div class="add-product">
                <?php
                if ($added == true) {
                    echo ' <div class="alert mb-2 mt-2 alert-success" role="alert">
                                        Product Addedd Successfully!!
                                    </div>';
                }
                ?>
                <form action="add-product.php" method="POST" enctype="multipart/form-data">
                    <div class="left">
                        <label for="product-photo"><img for="product-photo" id="photo-pre" src="../Img/Product-Img/Upload-Art.svg" alt="..."></label>
                        <input type="file" onchange="loadFile(event)" class="form-control-file" name="product-photo" id="product-photo" required>
                    </div>
                    <div class="right">
                        <div class="form-group">
                            <label for="product-name">Enter The Product Name</label>
                            <h3><input type="text" name="product-name" id="product-name" class="form-control" placeholder="Product Name" required></h3>
                        </div>
                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <textarea class="form-control" required id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="paint-type">Select The Product Type</label>
                            <select class="form-control" name="paint-type" id="paint-type" required>
                                <option value="Acrylic Painting">Acrylic Painting</option>
                                <option value="Oil Painting">Oil Painting</option>
                                <option value="Pencil Sketch">Pencil Sketch</option>
                                <option value="Collage Painting">Collage Painting</option>
                                <option value="Water Colour">Water Colour</option>
                                <option value="Pen Works">Pen Works</option>
                                <option value="Glass Painting">Glass Painting</option>
                                <option value="3D Painting">3D Painting</option>
                                <option value="Digital Painting">Digital Painting</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paint-size">Select The Product Size</label>
                            <select class="form-control" name="paint-size" id="paint-type" required>
                                <option value='6X8 Inches'>6X8 Inches</option>
                                <option value='8X12 Inches'>8X12 Inches</option>
                                <option value='12X16 Inches'>12X16 Inches</option>
                                <option value='16X24 Inches'>16X24 Inches</option>
                                <option value='24X33 Inches'>24X33 Inches</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product-price">Price Of The Product</label>
                            <input onkeyup="priceCalc()" type="number" name="product-price" class="form-control" id="product-price" required>
                        </div>
                        <div class="form-group">
                            <label for="product-shipping">Shipping Charge</label>
                            <input onkeyup="priceCalc()" type="number" name="product-shipping" class="form-control" required id="product-shipping">
                        </div>
                        <div class="form-group">
                            <h3><input class="form-control" type="text" name="price" id="price" required readonly></h3>
                            <small>Product Price + Shipping Charge + Website Charges</small>
                        </div>
                        <button type="submit" class="btn btn-warning">Add Product</button>
                    </div>
                </form>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            document.addEventListener('contextmenu', event => event.preventDefault());
        </script>

        <script>
            var loadFile = function(event) {
                var output = document.getElementById('photo-pre');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };

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


            function priceCalc() {
                let proPrice = document.getElementById('product-price').value
                let proShip = document.getElementById('product-shipping').value

                a1 = Number(proPrice) + Number(proShip)
                a2 = (Number(proPrice) / 100) * 10
                a3 = a2 + a1
                document.getElementById('price').value = a3.toFixed(2)
            }
        </script>


</body>

</html>