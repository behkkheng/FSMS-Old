<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "fsms";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname)) {
    die("Failed to connect the database.");
}

function check_login($con)
{

    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM employee WHERE employeeID = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            return $user_data;
        }
    }

    //redirect to login
    header("Location: login.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Something was posted
    $username_enter = $_POST['username'];
    $password_enter = $_POST['password'];

    if (!empty($username_enter)  && !empty($password_enter)) {
        //read from database
        $query = "SELECT * FROM employee where username = '$username_enter' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password_enter) {
                    $_SESSION['employeeID'] = $user_data['employeeID'];
                    $_SESSION['name'] = $user_data['name'];
                    $_SESSION['role'] = $user_data['role'];

                    //check remember me is tick or not
                    if (!empty($_POST['remember_me'])) {
                        setcookie("username", $_POST['username'], time() + 3600);
                        setcookie("password", $_POST['password'], time() + 3600);
                    } else {
                        setcookie("username", "");
                        setcookie("password", "");
                    }
                    header("Location: Dashboard/Dashboard.php");
                    die;
                } else {
                    echo '<script>alert("Invalid password or username.")</script>';
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FSMS | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="lib/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="lib/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <h1><b>FSMS</b></h1>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="post" action="" class="needs-validation" novalidate>

                    <!--username-->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input asp-for="Email" class="form-control" placeholder="Email" name="username" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please filled in your username.
                            </div>
                        </div>
                        <span class="text-danger"></span>
                    </div>

                    <!--password-->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="Password" class="form-control" placeholder="Password" name="password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please filled in your password.
                            </div>
                        </div>
                        <span asp-validation-for="Password" class="text-danger"></span>
                    </div>


                    <!--remember me-->
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember_me" value="yes">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->

                        <!--Sign in button-->
                        <div class="col-4">
                            <input style="float: right;" class="btn btn-primary" type="submit" value="Sign In" name="Sign In">
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src="lib/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/adminlte.min.js"></script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

</body>

</html>