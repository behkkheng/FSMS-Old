<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST['delete_id']))
{
    $employee_id = mysqli_real_escape_string($con, $_POST['delete_id']);

    $query = "DELETE FROM employee WHERE employeeID='$employee_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        header("Location: User-Index.php");
        exit(0);
    }
    else
    {
        header("Location: User-Index.php");
        exit(0);
    }
}




if(isset($_POST['update']))
{
    $employee_id = mysqli_real_escape_string($con, $_POST['employee_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $hpNo = mysqli_real_escape_string($con, $_POST['hpNo']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $postcode = mysqli_real_escape_string($con, $_POST['postcode']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $query = "UPDATE employee SET name='$name', hpNo='$hpNo', username='$username', password='$password', address='$address', city='$city', state='$state', postcode='$postcode', role='$role' WHERE employeeID='$employee_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        header("Location: User-Index.php");
        exit(0);
    }
    else
    {
        header("Location: User-Index.php");
        exit(0);
    }

}

?>