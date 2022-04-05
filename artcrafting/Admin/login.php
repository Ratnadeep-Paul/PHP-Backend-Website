<?php
session_start();
$wrong = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../partials/dbconnect.php';
    $login = false;
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM `admin` WHERE `username`='$username' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($password == $row['password']) {
                $phone = $row['phone'];
                $login = True;
                $_SESSION['admin-power-login'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['user_phone'] = $phone;

                $otp = random_int(11111111, 99999999);
                $msg = 'Your Admin OTP Is:-' . '%0a' . $otp;

                $sql_otp = "INSERT INTO `otp`(`otp`, `user`, `user_id`) VALUES ('$otp','$username','$phone')";
                $result_otp = mysqli_query($conn, $sql_otp);

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
                header("location: otp-entry.php ");

                curl_close($curl);
            } else {
                $wrong = true;
            }
        }
    } else {
        $wrong = true;
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

<body class="login-page">
    <div>
        <div class="container cont-signup otp-entry">
            <h1>Login To Your Account</h1>
            <div class="signup">
                <form action="login.php" method="POST">
                    <div class="form-elements">
                        <input type="text" class="form-control" autocomplete='off' id="username" placeholder="Username" name="username">
                    </div>
                    <div class="form-elements">
                        <input type="password" class="form-control" id="password" placeholder="Enter Your Password" name="password">
                    </div>
                    <button type="submit" class="btn sign-btn btn-primary">Login</button>
                </form>
                <?php
                if ($wrong == true) {
                    echo ' <div class="alert mt-2 alert-danger" role="alert">
                                        You Entered Wrong Account Details!
                                    </div>';
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>