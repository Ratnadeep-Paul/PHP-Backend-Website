<?php
include 'partials/dbconnect.php';

session_start();
$uri = $_SERVER['REQUEST_URI'];
$_SESSION['old_url'] = $uri;
$accout_name = 'Login/Signup';
if (isset($_SESSION['buyer-login'])) {
    $accout_name = $_SESSION['account-name'];
}

if (isset($_SESSION['seller-login'])) {
    header("location: logout.php");
}

$name = $_GET['name'];
$id = $_GET['id'];

$sql = "SELECT * FROM `products` WHERE `name` = '$name' AND `id`='$id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $photo = $row['photo'];
    $type = $row['paint-type'];
    $description = $row['description'];
    $size = $row['size'];
    $price = $row['price'];
    $artist = $row['artist'];
    $artist_id = $row['artist-id'];
}

$type_class = str_replace(" ", "-", $type);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <title><?php echo $name ?></title>
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
            <li> <a class="Oil-Painting hvr-underline-from-left" href="products.php?type=Oil Painting">Oil Painting</a></li>
            <li> <a class="Acrylic-Painting hvr-underline-from-left" href="products.php?type=Acrylic Painting">Acrylic Painting</a></li>
            <li> <a class="hvr-underline-from-left Pencil-Sketch" href="products.php?type=Pencil Sketch">Pencil Sketch</a></li>
            <li> <a class="Collage-Painting hvr-underline-from-left" href="products.php?type=Collage Painting">Collage Painting</a></li>
            <li> <a class="Water-Colour hvr-underline-from-left" href="products.php?type=Water Colour">Water Colour</a></li>
            <li> <a class="Pen-Works hvr-underline-from-left" href="products.php?type=Pen Works">Pen Works</a></li>
            <li> <a class="Glass-Painting hvr-underline-from-left" href="products.php?type=Glass Painting">Glass Painting</a></li>
        </ul>
    </nav>

    <section id="product-details">
        <div class="product-details">
            <div class="product-img">
                <img src="<?php echo $photo ?>" alt="...">
            </div>

            <div class="product-info">
                <h2><?php echo $name ?></h2>
                <p><?php echo $description ?></p>
                <p>Drawn By <a href="seller.php?seller_name=<?php echo $artist ?>&&seller_id=<?php echo $artist_id ?>"> <?php echo $artist ?></a></p>
                <div class="product-more-details">
                    <p>Size:</p>
                    <div class="btn btn-info"><?php echo $size ?></div>
                </div>
                <div class="product-more-details">
                    <p>Painting Type:</p>
                    <div class="btn btn-info"><?php echo $type ?></div>
                </div>

                <h3>Price:- &#8377;<?php echo $price ?></h3>
                <small style="display: block; width:100%;">Shipping Charges Included*</small>

                <a href="Order/order-checkout.php?product-name=<?php echo $name ?>&&product-id=<?php echo $id ?>" class="btn btn-danger">Buy</a>
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


        $('.<?php echo $type_class ?>').addClass('active')
    </script>
</body>

</html>