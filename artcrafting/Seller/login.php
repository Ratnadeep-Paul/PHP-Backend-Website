<?php
session_start();

$wrong = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../partials/dbconnect.php';
    $login = false;
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM `seller` WHERE phone='$phone' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $name = $row['name'];
                $phone = $row['phone'];
                $id = $row['id'];
                $login = True;
                $_SESSION['seller-login'] = true;
                $_SESSION['seller-name'] = $name;
                $_SESSION['seller-phone'] = $phone;
                $_SESSION['seller-id'] = $id;
                header("location: dashboard.php ");
            } else {
                $wrong = true;
            }
        }
    } else {
        $exists = true;
    };
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/account-style.css">
    <title>Login</title>
</head>

<body class="login-page seller-login-page">
    <div>
        <div class="container cont-signup otp-entry">
            <h1>Login To Your Account</h1>
            <div class="signup">
                <form action="login.php" method="POST">
                    <div class="form-elements">
                        <input type="text" class="form-control" id="phone" placeholder="Enter Your Phone Number" name="phone">
                    </div>
                    <div class="form-elements">
                        <input type="password" class="form-control" id="password" placeholder="Enter Your Password" name="password">
                    </div>
                    <button type="submit" class="btn sign-btn btn-primary">Login</button>
                    <a href="signup.php">Don't Have An Account? Click Here To Create An Account</a>
                </form>
                <?php
                if ($wrong == true) {
                    echo ' <div class="alert mt-2 alert-danger" role="alert">
                                        You Enter A Wrong Password!
                                    </div>';
                } elseif ($exists == true) {
                    echo ' <div class="alert mt-2 alert-danger" role="alert">
                                        This Phone Number Doesn`t Have Any Account!
                                    </div>';
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>