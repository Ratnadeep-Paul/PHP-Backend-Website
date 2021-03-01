<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fasion Is On</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&family=Yusei+Magic&display+Potta+One&display=swap" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php include 'partials/_header.php'; ?>
  <?php include 'partials/dbconnect.php'; ?>



  <div class="Featured-Product">
    <h1 class="item-heading Men-Watches">Men's Watches</h1>
  </div>

  <div class="container">
    <?php
    $sqli = "SELECT * FROM `Watches` ORDER BY `Sno` DESC";
    $result = mysqli_query($conn, $sqli);
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      $gender = $row['Gender'];
      $name = $row['Name'];
      $price = $row['Price'];
      $img = $row['Photo'];
      $buy = $row['Buy'];
      $i++;
      if ($gender == "Men" and $i < 9) {
        echo '<div class="card" style=" margin:0 25px 25px 0">
            <img style="border-radius:20px;" src="' . $img . '" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">' . substr($name, 0, 50) . '....</h5>
              <span> Price:-- ' . $price . ' INR</span>
              <a href="' . $buy . '" target="_blank" class="btn btn-primary">Check It.</a>
            </div>
          </div>';
      }
    } ?>
    <div class="card more" href="items.php?id=Watches&gen=Men" style=" margin:0 25px 25px 0">
      <a href="items.php?id=Watches&gen=Men">See More..
        <i class="far fa-arrow-alt-circle-right"></i></a>
    </div>
  </div>

  <div class="Featured-Product">
    <h1 class="item-heading Women-Watches">Women's Watches</h1>
  </div>

  <div class="container">
    <?php
    $sql = "SELECT * FROM `Watches` ORDER BY `Sno` DESC";
    $result = mysqli_query($conn, $sql);
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      $gender = $row['Gender'];
      $name = $row['Name'];
      $price = $row['Price'];
      $img = $row['Photo'];
      $buy = $row['Buy'];
      $i++;
      if ($gender == "Women" and $i < 9) {
        echo '<div class="card" style=" margin:0 25px 25px 0">
            <img style="border-radius:20px;" src="' . $img . '" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">' . substr($name, 0, 50) . '....</h5>
              <span> Price:-- ' . $price . ' INR</span>
              <a href="' . $buy . '" target="_blank" class="btn btn-primary">Check It.</a>
            </div>
          </div>';
      }
    } ?>
    <div class="card more" href="items.php?id=Watches&gen=Women" style=" margin:0 25px 25px 0">
      <a href="items.php?id=Watches&gen=Women">See More..
        <i class="far fa-arrow-alt-circle-right"></i>
      </a>
    </div>
  </div>

  <script>
    let underheader = document.getElementById('under-header');
    // addEventListener('onclick', function run(){
    //   if (underheader.style.display != 'none') {
    //     underheader.style.display = 'none'
    //   } else {
    //     underheader.style.display = 'flex'
    //   }
    // })

    function toggleHide() {
      if (underheader.style.display != 'none') {
        underheader.style.display = 'none'
      } else if (underheader.style.display = 'none') {
        underheader.style.display = 'flex'
      } else {
        underheader.style.display = 'none'
      }
    }
  </script>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/3bd0840b7e.js" crossorigin="anonymous"></script>

</body>

</html>