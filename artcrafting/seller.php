<?php
include 'partials/dbconnect.php';

session_start();
$uri = $_SERVER['REQUEST_URI'];
$_SESSION['old_url'] = $uri;
$accout_name = 'Login/Signup';
if (isset($_SESSION['buyer-login'])) {
    $accout_name = $_SESSION['account-name'];
}

$seller_name = $_GET['seller_name'];
$seller_id = $_GET['seller_id'];

$pre_sql = "SELECT * FROM `seller` WHERE `name`='$seller_name' AND `id`='$seller_id'";
$pre_result = mysqli_query($conn, $pre_sql);

while ($pre_row = mysqli_fetch_assoc($pre_result)) {
    $products = $pre_row['products'];
    $orders = $pre_row['order-success'];
    $phone = $pre_row['show-phone'];
}

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
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title><?php echo $seller_name ?></title>
</head>

<body>

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
                <a href="Account/login.php" id="login-register"><?php echo $accout_name ?></a>
            </div>
        </ul>

        <ul class="nav-phone">
            <div class="logo">
                <strong>Art</strong> Craftings
            </div>
            <div class="account-login">
                <img src="Img/icons/user.svg" alt="...">
                <a href="Account/login.php" id="login-register"><?php echo $accout_name ?></a>
            </div>
            <div class="search-bar">
                <input class="form-control" type="text" placeholder="Search Items Here">
                <div id="search-result" class="search-result"></div>
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

    <section id="show-products" class="show-products">
        <div class="top-seller">
            <div class="left">
                <h3><?php echo $seller_name ?></h3>
                <p><strong>Phone:</strong> <?php echo $phone ?></p>
            </div>
            <div class="right">
                <div class="seller-card">
                    <h4><?php echo $products ?></h4>
                    <p>Products Available</p>
                </div>
                <div class="seller-card">
                    <h4><?php echo $orders ?></h4>
                    <p>Products Sold</p>
                </div>
                <div class="seller-card">
                    <span class="fas fa-star" style="font-size: 2rem; color: #ff9900;"></span>
                    <p><?php echo $orders . '(' . $num_rating . ')' ?></p>
                </div>
            </div>
        </div>
        <div class="product-list seller-product">
            <h2>Produts Of <?php echo $seller_name ?></h2>
            <div class="products">

                <div class="product-card">
                    <span class="product-card-img"><img src="Img/Product-Img/Paint Brush.svg" alt="..."></span>
                    <h4>Create A Custom Painting<em>Choose One From Lots Of Artist</em></h4>
                    <h5>Starting From</h5>
                    <h4 class="card-price">&#8377;6000.00</h4>
                    <a href="#" class="btn btn-primary">Create</a>
                </div>

                <?php
                $sql = "SELECT * FROM `products` WHERE `artist`='$seller_name' AND `artist-id`='$seller_id' AND `status`='available'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $artist = $row['artist'];
                    $name = $row['name'];
                    $id = $row['id'];
                    $price = $row['price'];
                    $photo = "'" . $row['photo'] . "'";
                    $size = $row['size'];
                    echo '<div class="product-card">
                    <span class="product-card-img" style="background: url(' . $photo . ');"></span>
                    <div class="product-card-info">
                        <h4>' . $name . '<em>By ' . $artist . '</em></h4>
                        <h5>Size:- ' . $size . '</h5>
                        <h4 class="card-price">&#8377;' . $price . '</h4>
                        <a href="product-details.php?name=' . $name . '&&id=' . $id . '" class="btn btn-primary">Buy</a>
                    </div>
                </div>';
                }

                ?>

            </div>
        </div>
    </section>

    <?php
    include 'partials/footer.php';
    ?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
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