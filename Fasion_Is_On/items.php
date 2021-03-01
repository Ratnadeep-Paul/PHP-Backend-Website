<!DOCTYPE html>
<html lang="en">
<?php
$gen = $_GET['gen'];
$product = $_GET['id']
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$gen $product" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&family=Yusei+Magic&display+Potta+One&display=swap" rel="stylesheet">
</head>

<body>

    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/dbconnect.php'; ?>

    <div class="Featured-Product">
        <h1 class="item-heading <?php echo "$gen-$product" ?>"><?php echo "$gen's $product" ?> </h1>
    </div>
    <div class="container">
        <?php
        $sql = "SELECT * FROM `$product` ORDER BY `Sno` DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $gender = $row['Gender'];
            $name = $row['Name'];
            $price = $row['Price'];
            $img = $row['Photo'];
            $buy = $row['Buy'];
            if ($gender == "$gen") {
                echo '<div class="card" style=" margin:0 25px 25px 0">
                <img style="border-radius:20px;" src="' . $img . '" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">' . substr($name, 0, 50) . '....</h5>
                  <span> Price:-- ' . $price . ' INR</span>
                  <a href="' . $buy . '" target="_blank" class="btn btn-primary">Check It.</a>
                </div>
              </div>';
            }
        }
        ?>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>