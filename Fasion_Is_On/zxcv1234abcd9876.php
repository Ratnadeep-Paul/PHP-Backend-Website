<?php
$loggin = $_GET['login']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasion Is On-- Adding Items</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .container h1 {
            margin-top: 2rem;
            text-align: center;
            color: blue;
            font-weight: 800;
            text-decoration: underline;
        }

        .add {
            margin: auto;
            width: 80%;
            margin-top: 2rem;
        }

        .btn-add {
            background: linear-gradient(229deg, #00ffad, #0043ff);
            color: white !important;
            font-size: larger;
            width: 96%;
            margin: auto;
            border: none;
            border-radius: 20px;
            transition: 0.4s;
        }

        .btn-add:hover {
            background: linear-gradient(460deg, #00ffad, #0043ff);
            transition: 0.4s;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/dbconnect.php';
    $method = $_SERVER['REQUEST_METHOD'];
    $show = false;

    if ($method == 'POST') {

        $product = $_POST["product"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $gender = $_POST["gender"];
        $buy = $_POST["buy"];
        $photo = $_POST["photo"];

        $sql = "INSERT INTO `$product` (`Sno`,`Name`, `Price`, `Gender`, `Buy`, `Photo`) VALUES (NULL,'$name', '$price', '$gender', '$buy', '$photo')";
        $result = mysqli_query($conn, $sql);
        $show = true;
    };



    if ($show == true) {
        echo '<div class="countainer my-4" style="margin: 0 0% 0 0%;" ><div class="alert alert-success alert-dismissible fade show" style="margin-top:-1.5rem;" role="alert">
        <strong>Successfully Added </strong> Your Item Has Been Added!! (' . $gender . ' ' . $product . ') 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div></div>';
    };
    ?>


    <?php
    if ($loggin == "True") {

        echo  '<div class="container">
        <h1>Add Your Amazon Product</h1>
        <div class="add">
            <form action="/Fasion_Is_On/zxcv1234abcd9876.php?login=True" class="row" method="POST">
                <div class="mb-3">
                    <label for="product" style="font-size:2rem;" class="form-label">Which Product You Want To Add</label>
                    <select name="product" class="form-select">
                        <option selected>Choose Product...</option>
                        <option value="Watches">Watches</option>
                        <option>Shoes</option>
                        <option>T-Shirts</option>
                        <option>Shirts</option>
                        <option>Pants</option>
                        <option>Dresses</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Enter Details Of The Item:-</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter The Name Of The Item">
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="price" placeholder="Enter The Price Of The Product (eg: 100.00)" id="price" aria-label="Price Of The Product">
                    </div>
                    <div class="col">
                        <input type="text" name="gender" id="gender" class="form-control" placeholder="Gender (eg: Men, Women)" aria-label="Gender">
                    </div>
                </div>
                <div class="row" style="margin-top: 1rem;">
                    <div class="col">
                        <input type="text" name="buy" class="form-control" placeholder="Enter The Buying Link Of The Product" id="buy" aria-label="Buying Link Of The Product">
                    </div>
                    <div class="col">
                        <input type="text" name="photo" id="photo" class="form-control" placeholder="Enter The Photo Link Of The Product" aria-label="Photo Link">
                    </div>
                </div>
                <button type="submit" style="margin-top: 1rem;" class="btn btn-add">Add Item</button>
            </form>
        </div>
    </div>';
    }
    ?>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>