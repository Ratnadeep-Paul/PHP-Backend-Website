<?php
$exist = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../partials/dbconnect.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $phone_show = mysqli_real_escape_string($conn, $_POST['phone-show']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $upi = mysqli_real_escape_string($conn, $_POST['upi']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $pass = 'usernameusername##123456#@$%^^@@54';

    $rand = random_int(0011, 99999);
    $ID_post = 'Identity -- ' . $name . ' -- ' . $rand;

    $uploading_dir = "../Img/Seller-ID/";
    $uploading_file = $uploading_dir . basename($_FILES["identity"]["name"]);
    $imageFileType = strtolower(pathinfo($uploading_file, PATHINFO_EXTENSION));

    if ($imageFileType != "") {
        $target_file = $uploading_dir . basename($ID_post . "." . $imageFileType);
    } else {
        echo '';
    }

    $upload = move_uploaded_file($_FILES["identity"]["tmp_name"], $target_file);

    $existSql = "SELECT * FROM `seller` WHERE `phone` = '$phone'";
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
        $_SESSION['seller_phone'] = $phone;
        $_SESSION['seller_name'] = $name;

        $sql = "INSERT INTO `seller`(`name`, `phone`, `password`, `show-phone`, `email`, `upi`, `identity`, `city`, `country`, `pin`, `state`) VALUES ('$name','$phone','$pass','$phone_show','$email','$upi', '$target_file', '$city','$country','$pin','$state')";

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
                <form action="signup.php" method="POST" enctype="multipart/form-data">
                    <?php
                    if ($exist == true) {
                        echo ' <div class="alert mb-2 alert-danger" role="alert">
                                        This Phone Number Already In Use!!
                                    </div>';
                    }
                    ?>
                    <div class="form-elements">
                        <label for="name">Enter Your Full Name</label>
                        <input placeholder="eg. Elon Musk" type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-elements">
                        <label for="phone">Enter Your Phone Number Without '+91' Or '0' In The Start</label>
                        <input type="number" placeholder="eg. 9876543210" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-elements">
                        <label for="phone-show">Enter Your Phone Number Which Will Show On Order Details. (Buyer Can
                            Show This
                            Number.)</label>
                        <input type="number" placeholder="eg. 9876543210" class="form-control" id="phone-show" name="phone-show" required>
                    </div>
                    <div class="form-elements">
                        <label for="email">Enter Your Email Address</label>
                        <input type="email" placeholder="eg. abc@xyz.com" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-elements">
                        <label for="upi">Enter Your UPI ID. (For Payment)</label>
                        <input type="text" class="form-control" id="upi" name="upi" placeholder="eg. 9876543210@abc" required>
                    </div>
                    <div class="form-elements">
                        <label for="city">Enter The Name Of Your City</label>
                        <input type="text" class="form-control" id="city" placeholder="eg. Mumbai" name="city" required>
                    </div>
                    <div class="form-elements">
                        <label for="pin">Enter The Name Of Your PIN Code</label>
                        <input type="number" class="form-control" id="pin" placeholder="eg. 110002" name="pin" required>
                    </div>
                    <div class="form-elements">
                        <label for="state">Enter The Name Of Your State</label>
                        <input type="text" class="form-control" id="state" placeholder="eg. Delhi" name="state" required>
                    </div>
                    <div class="form-elements">
                        <label for="">Enter The Name Of Your Country</label>
                        <input type="text" class="form-control" id="country" value="India" name="country" readonly>
                    </div>
                    <div class="form-elements">
                        <label for="">Upload A Scanned Photo Of Your Aadhar/PAN Card.</label>
                        <input type="file" class="form-file" id="identity" required name="identity">
                    </div>
                    <button type="submit" class="btn sign-btn btn-primary">Create</button>
                </form>
                <a href="login.php">Already Have An Account? Click Here To Login</a>
            </div>
        </div>
    </div>


</body>

</html>