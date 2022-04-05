<?php
session_start();
$uri = $_SERVER['REQUEST_URI'];
$_SESSION['old_url'] = $uri;
$accout_name = 'Login/Signup';
if (isset($_SESSION['buyer-login'])) {
    $accout_name = $_SESSION['account-name'];
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
    <title>Art Craftings</title>
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

    <section id="home">
        <div class="banner">
            <a href="custom-painting.php?type=Acrylic Painting"><img src="Img/Banner/Custom Painting.jpg" alt="Custom Photo Make..."></a>
        </div>
    </section>

    <section id="product-overview">
        <div class="product-list">
            <h2>Newest Arrivals</h2>
            <div class="products">

                <div class="product-card">
                    <span class="product-card-img"><img src="Img/Product-Img/Paint Brush.svg" alt="..."></span>
                    <div class="product-card-info">
                        <h4>Create A Custom Painting<em>Choose One From Lots Of Artist</em></h4>
                        <h5>Starting From</h5>
                        <h4 class="card-price">&#8377;6000.00</h4>
                        <a href="custom-painting.php?type=Acrylic Painting" class="btn btn-primary">Create</a>
                    </div>
                </div>

                <?php

                include 'partials/dbconnect.php';
                $sql = "SELECT * FROM `products` WHERE `status`='available' ORDER BY `id` DESC";
                $result = mysqli_query($conn, $sql);
                $j = 0;

                while ($j < 19 && $row = mysqli_fetch_assoc($result)) {
                    $artist = $row['artist'];
                    $name = $row['name'];
                    $id = $row['id'];
                    $price = $row['price'];
                    $photo = "'" . $row['photo'] . "'";
                    $size = $row['size'];
                    $j++;
                    echo '<div class="product-card">
                    <span class="product-card-img" style="background: url(' . $photo . ');"></span>
                    <div class="product-card-info">
                        <h4>' . substr($name, 0, 34)  . '...<em>By ' . $artist . '</em></h4>
                        <h5>Size:- ' . $size . '</h5>
                        <h4 class="card-price">&#8377;' . $price . '</h4>
                        <a href="product-details.php?name=' . $name . '&&id=' . $id . '" class="btn btn-primary">Buy</a>
                    </div>
                </div>';
                }

                ?>

            </div>
        </div>

        <div class="product-list">
            <h2>Cheapest Products</h2>
            <div class="products">

                <div class="product-card">
                    <span class="product-card-img"><img src="Img/Product-Img/Paint Brush.svg" alt="..."></span>
                    <div class="product-card-info">
                        <h4>Create A Custom Painting<em>Choose One From Lots Of Artist</em></h4>
                        <h5>Starting From</h5>
                        <h4 class="card-price">&#8377;6000.00</h4>
                        <a href="custom-painting.php?type=Oil" class="btn btn-primary">Create</a>
                    </div>
                </div>

                <?php

                include 'partials/dbconnect.php';
                $sql = "SELECT * FROM `products` WHERE `status`='available' ORDER BY `price` ASC";
                $result = mysqli_query($conn, $sql);
                $i = 0;

                while ($i < 19 && $row = mysqli_fetch_assoc($result)) {

                    $artist = $row['artist'];
                    $name = $row['name'];
                    $id = $row['id'];
                    $price = $row['price'];
                    $photo = "'" . $row['photo'] . "'";
                    $size = $row['size'];
                    $i++;
                    echo '<div class="product-card">
                        <span class="product-card-img" style="background: url(' . $photo . ');"></span>
                        <div class="product-card-info">
                            <h4>' .substr($name, 0, 34).'...<em>By ' . $artist . '</em></h4>
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
    </script>
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