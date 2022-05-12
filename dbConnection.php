<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "fsms";

    if (!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
    {
        die("Failed to connect the database.");
    }
    
?>