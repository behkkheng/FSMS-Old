<?php
    session_start();

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "fsms";

    if (!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
    {
        die("Failed to connect the database.");
    }
    
    function check_login($con)
    {

        if(isset($_SESSION['user_id']))
        {
            $id = $_SESSION['user_id'];
            $query = "select * from employee where employeeID = '$id' limit 1";

            $result = mysqli_query($con,$query);
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);

                return $user_data;
            }
        }

        //redirect to login
        header("Location: login.php");
        die;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Something was posted
        $username_enter = $_POST['username'];
        $password_enter = $_POST['password'];

        if(empty($username_enter)  && empty($password_enter)){
            echo '<script>alert("Please enter a username and password.")</script>';
        }
        elseif(empty($username_enter)){
            echo '<script>alert("Please enter username.")</script>';
        }
        elseif(empty($password_enter)){
            echo '<script>alert("Please enter password.")</script>';
        }
        elseif(!empty($username_enter)  && !empty($password_enter)){
            //read from database
            $query = "SELECT * FROM employee where username = '$username_enter' limit 1";
            $result = mysqli_query($con,$query);

            if($result){
                if($result && mysqli_num_rows($result) > 0){
                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['password'] === $password_enter){
                        $_SESSION['employeeID'] = $user_data['employeeID'];
                        $_SESSION['name'] = $user_data['name'];
                        $_SESSION['role'] = $user_data['role'];

                        //check remember me is tick or not
                        if(!empty($_POST['remember_me'])) {
                            setcookie ("username",$_POST['username'],time()+ 3600);
                            setcookie ("password",$_POST['password'],time()+ 3600);
                        } else {
                            setcookie("username","");
                            setcookie("password","");
                        }
                        header("Location: Dashboard/Dashboard.php");
                        die;
                    }else{
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

                <form method="post" >
                    <div asp-validation-summary="All" class="alert-danger" role="alert"></div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input asp-for="Email" class="form-control" placeholder="Email" name="username" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <span asp-validation-for="Email" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="Password" class="form-control" placeholder="Password" name="password" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <span asp-validation-for="Password" class="text-danger"></span>
                    </div>
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
                        <div class="col-4">
                            <input style="float: right;" class="btn btn-primary" type="submit" value="Sign In" />
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
    <script src="~/js/site.js" asp-append-version="true"></script>
    <script type="text/javascript">
        //$('#login').submit(function (e) {
        //    let email = document.getElementById('Email').value;
        //    let password = document.getElementById('Password').value;
        //    if (email !== 'manager' || password !== "12345") {
        //        $('#login').submit();
        //    } else {
        //        e.preventDefault();
        //        setCookie();
        //    }
        //})
    </script>


</body>
</html>

