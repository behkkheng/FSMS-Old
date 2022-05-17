<?php
$conn = new mysqli("localhost", "root", "", "fsms");

//delete invoice
if(isset($_POST['canceldata'])){
    $id = $_POST['cancel_id'];

    $cancel_invoice_query = "UPDATE `invoice` SET `cancel_status` = 'Cancel' WHERE `invoiceID` = $id";
    $run_query = mysqli_query($conn, $cancel_invoice_query);

    if($run_query){
        echo("<script>location.href = 'Invoice-Index.php';</script>");
    } else{
        echo "Error when cancel invoice";
    }
}


?>