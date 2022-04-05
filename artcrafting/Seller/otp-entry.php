<?php
$wrong = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../partials/dbconnect.php';
    $otp = $_POST['otp'];

    session_start();
    $phone = $_SESSION['seller_phone'];
    $name = $_SESSION['seller_name'];

    $sql = "SELECT * FROM `otp` WHERE `user_id`='$phone' AND `user`='$name'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $otp_get = $row['otp'];
        $otp_id = $row['id'];
        if ($otp_get == $otp) {
            $deleteSql = "DELETE FROM `otp` WHERE `id`='$otp_id'";
            $delete_result = mysqli_query($conn, $deleteSql);
            $_SESSION['otp-verified'] = true;
            header("location: password.php ");
        } else {
            $wrong = true;
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
    <title>Verify Account</title>
</head>

<body class="signup-page">
    <div>
        <div class="container cont-signup otp-entry">
            <h1>Verify Your Account</h1>
            <div class="signup">
                <div class="alert alert-success" role="alert">
                    <strong>An OTP Has Sent To Your Phone Number.</strong>
                </div>
                <form action="otp-entry.php" method="POST">
                    <div class="form-elements">
                        <input type="text" class="form-control" id="otp" placeholder="Enter The OTP" name="otp" required>
                    </div>
                    <?php
                    if ($wrong == true) {
                        echo ' <div class="alert mt-2 alert-danger" role="alert">
                                        OTP Doesn`t Matched!!
                                    </div>';
                    }
                    ?>
                    <button type="submit" class="btn sign-btn btn-primary">Verify</button>
                </form>
            </div>
        </div>
    </div>


</body>

</html>