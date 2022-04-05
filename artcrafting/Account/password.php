<?php
session_start();
if ($_SESSION['otp-verified'] != true) {
    header("location: otp-entry.php ");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../partials/dbconnect.php';
    $password = $_POST['password'];
    $phone = $_SESSION['user_phone'];
    $name = $_SESSION['user_name'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE `buyer` SET `password`='$hash' WHERE `name`='$name' AND `phone`='$phone'";
    $result = mysqli_query($conn, $sql);

    header("location: login.php ");
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
    <title>Create Account</title>
</head>

<body class="signup-page">
    <div>
        <div class="container cont-signup otp-entry">
            <h1>Create Password</h1>
            <div class="signup">
                <form action="password.php" method="POST">
                    <div class="form-elements">
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-elements">
                        <input type="password" onkeyup="checkPassword()" class="form-control" id="confirm-password" placeholder="Confirm Password" name="confirm-password" required>
                    </div>
                    <span id="check"></span>
                    <button type="submit" class="btn sign-btn btn-primary">Create Account</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script>
        function checkPassword() {
            if ($('#password').val() == $('#confirm-password').val()) {
                $('#check').html('Password Matching').css('color', 'green');
            } else
                $('#check').html('Password Not Matching').css('color', 'red');
        }
    </script>
</body>

</html>