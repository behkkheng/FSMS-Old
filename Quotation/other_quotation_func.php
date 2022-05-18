<?php
$conn = new mysqli("localhost", "root", "", "fsms");

//delete quotation
if(isset($_POST['canceldata'])){
    $id = $_POST['cancel_id'];

    $cancel_quotation_query = "UPDATE `quotation` SET `cancel_status` = 'Cancel' WHERE `quotationID` = $id";
    $run_query = mysqli_query($conn, $cancel_quotation_query);

    if($run_query){
        echo("<script>location.href = 'Quotation-Index.php';</script>");
    } else{
        echo "Error when cancel quotation";
    }
}


?>