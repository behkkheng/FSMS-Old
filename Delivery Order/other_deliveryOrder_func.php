<?php
$conn = new mysqli("localhost", "root", "", "fsms");

//delete delivery Order
if(isset($_POST['canceldata'])){
    $id = $_POST['cancel_id'];

    $cancel_deliveryOrder_query = "UPDATE `deliveryOrder` SET `cancel_status` = 'Cancel' WHERE `deliveryOrderID` = $id";
    $run_query = mysqli_query($conn, $cancel_deliveryOrder_query);

    if($run_query){
        echo("<script>location.href = 'DeliveryOrder-Index.php';</script>");
    } else{
        echo "Error when cancel Delivery Order";
    }
}


?>