<?php
    $name = $_POST['name'];
    $hpNo = $_POST['hpNo'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $role = $_POST['role'];

    //Database connection
    $conn = new mysqli('localhost','root','','fsms');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    } else{
        $create_user_query = "INSERT INTO employee (name,hpNo,username,password,address,city,state,postcode,role) VALUES('$name','$hpNo','$username','$password','$address','$city','$state','$postcode','$role')";
        mysqli_query($conn, $create_user_query);
        echo '<script>alert("User created successfully!")</script>';
        header("Location: User-Index.php");
    }
?>