<?php
$exist = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../partials/dbconnect.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pass = 'usernameusername!@#!~!#$#%^$^%$%$#$#%&**&^%$$#@!!';

    $existSql = "SELECT * FROM `buyer` WHERE `phone` = '$phone'";
    $resultSql = mysqli_query($conn, $existSql);

    $numRows = mysqli_num_rows($resultSql);
    if ($numRows > 0) {
        $exist = true;
    } else {
        echo '<script>
                   let sbtn = document.getElementById("submit-btn");
                    sbtn.style.display = "none";
                </script>';

        session_start();
        $_SESSION['user_phone'] = $phone;
        $_SESSION['user_name'] = $name;

        $sql = "INSERT INTO `buyer`(`password`, `name`, `phone`, `email`, `city`, `pin`, `state`, `country`, `address`) VALUES ('$pass','$name','$phone', '$email', '$city','$pin','$state','$country','$address')";

        if ($result = mysqli_query($conn, $sql)) {

            $otp = random_int(111111, 999999);
            $msg = 'Your OTP Is:-' . '%0a' . $otp;

            $sql_otp = "INSERT INTO `otp`(`otp`, `user`, `user_id`) VALUES ('$otp','$name','$phone')";
            $result_otp = mysqli_query($conn, $sql_otp);

            if ($exist == false) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=pzTo5faxrhdVlLeRb3gKPuvyc81Fts02HIqDA6wS4kJWmXZE7UC8trYvedgFmq2laHTZ14WEV9SILos6&sender_id=HCSSIL&message=" . urlencode($msg) . "&route=v3&numbers=" . urlencode($phone),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
            }

            header("location: otp-entry.php ");
        }
    }
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
            <h1>Create Your Account</h1>
            <div class="signup">
                <form action="signup.php" method="POST">
                    <?php
                    if ($exist == true) {
                        echo ' <div class="alert mb-2 alert-danger" role="alert">
                                        This Phone Number Already In Use!!
                                    </div>';
                    }
                    ?>
                    <div class="form-elements">
                        <input type="text" class="form-control" id="name" placeholder="Enter Your Full Name" name="name" required>
                    </div>
                    <div class="form-elements">
                        <input type="number" class="form-control" id="phone" placeholder="Enter Your Phone Number Without '+91' Or '0' In The Start" name="phone" required>
                    </div>
                    <div class="form-elements">
                        <input type="email" class="form-control" id="email" placeholder="Enter Your Email Address" name="email" required>
                    </div>
                    <div class="form-elements">
                        <input type="text" class="form-control" id="city" placeholder="Name Of Your City" name="city" required>
                    </div>
                    <div class="form-elements">
                        <input type="number" class="form-control" id="pin" placeholder="Enter The PIN Code" name="pin" required>
                    </div>
                    <div class="form-elements">
                        <input type="text" class="form-control" id="state" placeholder="Name Of Your State" name="state" required>
                    </div>
                    <div class="form-elements">
                        <input type="text" class="form-control" id="country" value="India" name="country" readonly>
                    </div>
                    <div class="form-elements">
                        <textarea name="address" class="form-control" id="address" rows="4" placeholder="Enter Your Delivery Address" required></textarea>
                    </div>
                    <button type="submit" id="submit-btn" class="btn sign-btn btn-primary">Create</button>
                </form>

                <a href="login.php">Already Have An Account? Click Here To Login</a>
            </div>
        </div>
    </div>

</body>

</html>