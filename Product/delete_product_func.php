<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM employee WHERE employeeID='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:User-Index.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}

?>