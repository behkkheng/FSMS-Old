<?php

$con = new mysqli("localhost","root","","fsms");

//if delete data
if(isset($_POST['deletedata'])){
    $customer_id = mysqli_real_escape_string($con, $_POST['delete_id']);

    $query = "DELETE FROM customer WHERE customerID='$customer_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        header("Location: Customer-Index.php");
        exit(0);
    }
    else
    {
        header("Location: Customer-Index.php");
        exit(0);
    }
}

//edit customer detail
if(isset($_POST['update']))
{
    $customer_id = mysqli_real_escape_string($con, $_POST['customer_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $hpNo = mysqli_real_escape_string($con, $_POST['hpNo']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $query = "UPDATE customer SET name='$name', hpNo='$hpNo', address='$address', email='$email' WHERE customerID='$customer_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        header("Location: Customer-Index.php");
        exit(0);
    }
    else
    {
        header("Location: Customer-Index.php");
        exit(0);
    }

}

?>