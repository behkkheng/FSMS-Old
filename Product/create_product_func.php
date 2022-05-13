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
        $stmt = $conn->prepare("INSERT INTO employee (name,hpNo,username,password,address,city,state,postcode,role) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss",$name,$hpNo,$username,$password,$address,$city,$state,$postcode,$role);
        $stmt->execute();
        echo '<script>alert("User created successfully!")</script>';
        $stmt->close;
        $conn->close;
    }
?>