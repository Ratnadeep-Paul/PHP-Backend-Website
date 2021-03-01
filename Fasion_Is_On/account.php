<!DOCTYPE html>
<html lang="en">

<?php
include 'partials/dbconnect.php';
$method = $_SERVER['REQUEST_METHOD'];
$username = $_POST["name"];
$password = $_POST["password"];

if ($method == "POST") {

    $sql = "SELECT * FROM `Accounts` WHERE Name = '$username'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $db_pass = $row['Password'];
        if ($db_pass == $password) {
            header("location: zxcv1234abcd9876.php?login=True");
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Confirm Your Password</strong> Please Enter You Correct Password!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasion Is On-- Login </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: linear-gradient(45deg, #130021, #00314e);
        }

        .container {
            padding: 3rem;
            /* background: linear-gradient(45deg, #08efb9, #00ff95); */
            margin: 2rem auto;
            border-radius: 50px;
            width: 80%;
        }

        .container h1 {
            text-align: center;
        }

        .log {
            color: white;
            font-weight: 800;
            text-shadow: 0 0 20px #04ff00;
            transition: 0.8s;
            animation-name: log-jump;
            animation-iteration-count: infinite;
            animation-duration: 2s;
            cursor: pointer;
            font-size: 50px;
            display: inline-block;
            text-transform: uppercase;
            animation: anim 2s linear infinite;
            animation-play-state: paused;
            transition: 1s;
        }

        @keyframes anim {
            25% {
                text-shadow: 0 0 20px #04ff00;
            }

            50% {
                text-shadow: 0 0 20px red;
            }

            75% {
                text-shadow: 0 0 20px blue;
            }
        }

        .log:hover {
            animation-play-state: running;
            transform: scale(1.2);
        }


        .add {
            margin: auto;
            width: 75%;
            margin-top: 3rem;
            display: flex;
        }

        .form {
            border: 2px solid #99d5ff;
            padding: 4rem;
            margin: auto;
            border-radius: 11px;
            box-shadow: inset 0px 0px 61px 0px #002ca9;
        }

        .form-label {
            margin-bottom: .5rem;
            text-align: center;
            display: block;
            color: white;
            font-weight: 800;
        }

        .form-control {
            border: 1px solid #00fff3;
        }

        .btn-add {
            background: linear-gradient(229deg, #10ff5a, #00e7ff);
            color: white !important;
            font-size: larger;
            width: 97%;
            margin: auto;
            border: 2px solid white;
            border-radius: 20px;
            transition: 1.8s;
            box-shadow: inset 3px 4px 20px 0px #ffffff;
        }

        .btn-add:hover {
            box-shadow: 0px 0px 20px 7px #00e7ff;
            transform: scale(1.2);
            transition: 1.8s;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><span class="log">
                Login
            </span>
        </h1>

        <div class="add">
            <form action="/Fasion_Is_On/account.php" class="row form" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Enter The Username:-</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Enter The Password:-</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <button type="submit" style="margin-top: 1rem;" class="btn btn-add">Login</button>
            </form>
        </div>
    </div>
</body>

</html>