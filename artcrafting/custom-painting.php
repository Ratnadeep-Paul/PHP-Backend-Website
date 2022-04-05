<?php
include 'partials/dbconnect.php';


session_start();
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $type_class = str_replace(" ", "-", $type);
    $_SESSION['paint-type'] = $type;
}

if (isset($_SESSION['seller-login'])) {
    header("location: logout.php");
}

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Custom Painting Order</title>
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
        <form action="Order/custom-order-checkout.php" method="POST" enctype="multipart/form-data">
            <div class="product-details custom-painting">
                <div class="product-img">
                    <img id="product-photo" src="Img/Product-Img/Paint Brush.svg" alt="...">

                    <div class="form-group">
                        <label for="product-photo">Upload Photo (Under 2MB)</label>
                        <input type="file" onchange="loadFile(event)" class="form-control-file" name="product-photo" id="product-photo" required>
                    </div>
                </div>

                <div class="product-info">
                    <h2>Create Your Own Custom Painting.</h2>
                    <p> </p>

                    <div class="product-more-details">
                        <p>Painting Type:</p>
                        <a href="custom-painting.php?type=Acrylic Painting" class="btn Acrylic-Painting-btn btn-info">Acrylic Painting</a>
                        <a href="custom-painting.php?type=Oil Painting" class="btn Oil-Painting-btn btn-info ">Oil Colour</a>
                        <a href="custom-painting.php?type=Water Colour" class="Water-Colour-btn btn btn-info ">Water Colour</a>
                        <a href="custom-painting.php?type=Glass Painting" class="Glass-Painting-btn btn btn-info ">Glass Painting</a>
                        <a href="custom-painting.php?type=Pen Works" class="Pen-Works-btn btn btn-info ">Pen Works</a>
                        <a href="custom-painting.php?type=Pencil Sketch" class="btn btn-info Pencil-Sketch-btn">Pencil Sketch</a>
                    </div>

                    <div style="display: none;">
                        <input type="text" name="type" id="type" value="<?php echo $type ?>">
                    </div>

                    <button type="button" class="btn btn-primary btn-artist" data-toggle="modal" data-target="#Artists">
                        Select
                        Artist</button>

                    <div id="artist-custom-details" class="artist-custom-details">

                    </div>
                </div>
            </div>
        </form>
    </section>

    <?php
    include 'partials/footer.php';
    ?>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />




    <script>
        function showResult() {
            let results = document.getElementById('search-result')
            let search = document.getElementById('search-bar')
            let searchText = search.value
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

        var loadFile = function(event) {
            var output = document.getElementById('product-photo');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        $('.<?php echo $type_class ?>').addClass('active')
        $('.<?php echo $type_class ?>-btn').addClass('btn-active')
    </script>


    <!-- Modals -->
    <div class="modal fade" id="Artists" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ArtistsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ArtistsLabel">Select An Artist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body select-artist">
                    <div class="artist-list">

                        <?php

                        include 'partials/dbconnect.php';
                        $sql = "SELECT * FROM `seller` WHERE `$type`='Yes' AND `trust`='Approved'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $seller_name = $row['name'];
                            $seller_id = $row['id'];
                            $active_order = $row['actice-custom-order'];
                            $working_till = $row['working-till'];
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


                            if ($active_order > 0) {
                                echo '
                                    <div onclick="selectArtist' . $seller_id . '()" class="artist" data-dismiss="modal" aria-label="Close">
                            <span>' . $seller_name . '</span> <br> <span>Working On Another Project Till:-' . $working_till . '</span> <br>
                            <span><strong>Rating:- </strong> <span class="fas fa-star" style="font-size: 1rem; color: #ff9900;"></span>' . $rating . '</span>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">6X8 Inches</th>
                                        <th scope="col">8X12 Inches</th>
                                        <th scope="col">12X16 Inches</th>
                                        <th scope="col">16X24 Iches</th>
                                        <th scope="col">24X33 Inches</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>&#8377;' . $price_1 . '</td>
                                        <td>&#8377;' . $price_2 . '</td>
                                        <td>&#8377;' . $price_3 . '</td>
                                        <td>&#8377;' . $price_4 . '</td>
                                        <td>&#8377;' . $price_5 . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- script -->
                        <script>
                            function selectArtist' . $seller_id . '(){
                            let seller_name = "' . $seller_name . '"
                            let seller_id = "' . $seller_id . '"
                            let paint_type = "' . $type . '"
                             $.post("handler/artists-action.php", {
                                name: seller_name,
                                id: seller_id,
                                type: paint_type,
                            }, function(data, status) {
                                if (data != "") {
                                    $("#artist-custom-details").html(data)
                                }
                            })
                        }
                        </script>';
                            } else {
                                echo '
                                    <div onclick="selectArtist' . $seller_id . '()" class="artist" data-dismiss="modal" aria-label="Close">
                            <span>' . $seller_name . '</span> <br>
                            <span><strong>Rating:- </strong> <span class="fas fa-star" style="font-size: 1rem; color: #ff9900;"></span>' . $rating . '</span>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">6X8 Inches</th>
                                        <th scope="col">8X12 Inches</th>
                                        <th scope="col">12X16 Inches</th>
                                        <th scope="col">16X24 Iches</th>
                                        <th scope="col">24X33 Inches</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>&#8377;' . $price_1 . '</td>
                                        <td>&#8377;' . $price_2 . '</td>
                                        <td>&#8377;' . $price_3 . '</td>
                                        <td>&#8377;' . $price_4 . '</td>
                                        <td>&#8377;' . $price_5 . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- script -->
                        <script>
                            function selectArtist' . $seller_id . '(){
                            let seller_name = "' . $seller_name . '"
                            let seller_id = "' . $seller_id . '"
                            let paint_type = "' . $type . '"
                             $.post("handler/artists-action.php", {
                                name: seller_name,
                                id: seller_id,
                                type: paint_type,
                            }, function(data, status) {
                                if (data != "") {
                                    $("#artist-custom-details").html(data)
                                }
                            })
                        }
                        </script>';
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>