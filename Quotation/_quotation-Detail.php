<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

$quotationID = $_GET['id'];
$get_quotation_query = "SELECT * FROM `quotation` WHERE quotationID='$quotationID'";
$run_query = mysqli_query($connection, $get_quotation_query);
$quotation = mysqli_fetch_assoc($run_query);
?>

<div class="row">
    <div class="col-12">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Lean Aik Furniture
                    </h4>
                    <br>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col border-right">
                    From:
                    <address>
                        <strong>Lean Aik Furniture</strong><br>
                        4995, Jalan New Ferry<br />
                        12100 Butterworth<br />
                        Penang<br />
                        Phone: (60) 12-454 3360<br>
                        Email: info@leanaikfurniture.com
                    </address>
                </div>
                <!-- /.col -->

                <!--add client-->
                <div class="col-sm-4 quotation-col border-right">
                    To:
                    <br>
                    <?php
                    $customerID = $quotation['customerID'];
                    $get_customer_detail_query = "SELECT * FROM `customer` WHERE customerID = '$customerID'";
                    $run_query = mysqli_query($connection, $get_customer_detail_query);

                    $customer_detail = mysqli_fetch_array($run_query);

                    if ($customer_detail != null) { ?>

                        <address>
                            <strong><?php echo $customer_detail['name']; ?></strong><br>
                            <?php echo $customer_detail['address']; ?>,<br />
                            <?php echo $customer_detail['postcode']; ?>, <?php echo $customer_detail['city']; ?>,<br> <?php echo $customer_detail['state']; ?><br />
                            Phone: <?php echo $customer_detail['hpNo']; ?><br>
                        </address>
                    <?php
                    } else {
                        echo "<br><b>Customer is either deleted or not exist.</b>";
                    }

                    ?>

                </div>

                <div class="col-sm-4 quotation-col">
                    <!--quotation id-->
                    <b class="col-sm-6">Quotation #<?php echo $quotation['quotationID']; ?></b><br>
                    <br>


                    <!--date-->
                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <b>Date: </b>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            $date = $quotation['date'];
                            echo $date;
                            ?>
                        </div>
                    </div>

                    <br>

                    <!--Cancel status-->
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <b>Quotation Status: </b>
                        </div>
                        <div class="col-md-6">
                            <?php
                            if ($quotation['cancel_status'] == "Cancel") {
                                echo '<p style="color:red;">Cancel</p>';
                            } else {
                                echo '<p>Not Cancel</p>';
                            }
                            ?>
                        </div>
                    </div>

                    <br>

                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <b>Date Validity: </b>
                        </div>
                        <div class="col-sm-6">
                            1 Month
                        </div>
                    </div>

                    <!-- /.col -->
                </div>
            </div>
            <!-- /.row -->
            <br />
            <!-- Table row -->
            <div class="row text-center">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product ID</th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Qty.</th>
                                <th>Unit Price</th>
                                <th class="text-right">Subtotal&nbsp&nbsp&nbsp&nbsp</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php
                            $all_quotation_detail_query = "SELECT * FROM quotationDetail WHERE quotationID = '$quotationID'";
                            $run_query = mysqli_query($connection, $all_quotation_detail_query);
                            if ($run_query) {
                                $index_number = 1;
                                foreach ($run_query as $row) {

                            ?>

                                    <tbody>
                                        <tr>
                                            <!--index number-->
                                            <td> <?php echo $index_number; ?> </td>

                                            <!--product id-->
                                            <td>
                                                <?php
                                                $id = $row['productID'];;
                                                if ($id != null) {
                                                ?>
                                                    <?php echo $row['productID']; ?>
                                                <?php
                                                } else {
                                                    echo "<b>Product is either deleted or not exist.</b>";
                                                }  ?>
                                            </td>

                                            <!--name of product-->
                                            <?php
                                            $productID = $row["productID"];

                                            $get_product_name = "SELECT name FROM product WHERE productID = '$productID'";
                                            $run_query = mysqli_query($connection, $get_product_name);
                                            $product_name = mysqli_fetch_array($run_query);
                                            ?>
                                            <td> <?php
                                                    if ($product_name != null) {
                                                        echo $product_name["name"];
                                                    } else {
                                                        echo "<b>Product is either deleted or not exist.</b>";
                                                    }  ?>
                                            </td>

                                            <!--image-->
                                            <?php

                                            $get_product_image = "SELECT productPath FROM product WHERE productID = '$productID'";
                                            $run_query = mysqli_query($connection, $get_product_image);
                                            $product_image = mysqli_fetch_array($run_query);
                                            ?>
                                            <td height="10%" width="10%">
                                                <?php
                                                if ($product_image != null) { ?>
                                                    
                                                <img class="img-fluid" style="" src="<?php echo $product_image["productPath"]; ?>">
                                                
                                                <?php
                                                } else {
                                                    echo "<b>Product is either deleted or not exist.</b>";
                                                }  ?>
                                            </td>

                                            <!--quantity-->
                                            <td> <?php echo $row['quantity']; ?> </td>

                                            <!--product unit price-->
                                            <?php
                                            $get_product_price = "SELECT price FROM product WHERE productID = '$productID'";
                                            $run_query = mysqli_query($connection, $get_product_price);
                                            $product_price = mysqli_fetch_array($run_query);
                                            ?>
                                            <td>
                                                <?php
                                                if ($product_price != null) {
                                                ?>
                                                    RM <?php echo $product_price['price']; ?>
                                                <?php
                                                } else {
                                                    echo "<b>Product is either deleted or not exist.</b>";
                                                }  ?>
                                            </td>

                                            <!--Subtotal-->
                                            <td class="text-right">
                                                <?php
                                                $subtotal = $row['subtotal'];
                                                if ($subtotal != null) {
                                                ?>
                                                    <b>
                                                        RM <?php echo $row['subtotal']; ?>&nbsp&nbsp
                                                    </b>
                                                <?php
                                                } else {
                                                    echo "<b>Product is either deleted or not exist.</b>";
                                                }  ?>

                                            </td>

                                        </tr>
                                    </tbody>

                            <?php
                                    $index_number++;
                                }
                            } else {
                                echo "Nothing was added.";
                            }
                            ?>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <div class="row">

                <!-- accepted payments column -->
                <div class="col-8">
                    <p class="lead">Payment Methods:</p>
                    <img src="/FSMS/images/credit/visa.png" alt="Visa">
                    <img src="/FSMS/images/credit/mastercard.png" alt="Mastercard">
                    <img src="/FSMS/images/credit/american-express.png" alt="American Express">
                    <img src="/FSMS/images/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        This document is computer generated. No signature required.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="" style="border: 0;">Amount</th>
                            </tr>
                            <tr>

                                <!--total amount-->
                                <th class="">Total:</th>
                                <?php
                                $get_quotation_total = "SELECT total_amount FROM quotation WHERE quotationID = '$quotationID'";
                                $run_query = mysqli_query($connection, $get_quotation_total);
                                $quotation_total = mysqli_fetch_array($run_query);
                                $total_amount = $quotation_total['total_amount'];
                                ?>
                                <td class="pl-0 ml-0 text-right">
                                    <b>
                                        RM <?php echo "$total_amount"; ?>&nbsp&nbsp
                                    </b>
                                </td>
                            </tr>
                            <tr>

                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <br>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print text-rightd-flex justify-content-between">

                <div>

                </div>
                <div class="row mr-2">

                    <!--print button-->
                    <button type="button" class="btn btn-secondary m-1" onClick="window.print()"><i class="bi bi-printer-fill"></i> Print</button>

                    <?php
                    $quotationID = $quotation['quotationID'];

                    if ($quotation['cancel_status'] == "Not Cancel") {
                    ?>
                        <form action="\FSMS\Quotation\Quotation-Edit.php" method="GET">
                            <input type="hidden" value="<?php echo $quotationID; ?>" name="id">

                            <button type="submit" class="btn btn-info btn m-1 editbtn" name="edit"><i class="fas fa-pencil-alt"></i> Edit </button>
                        </form>
                    <?php
                    } else {
                    ?>
                        <form action="\FSMS\Quotation\Quotation-Edit.php" method="GET">
                            <input type="hidden" value="<?php echo $quotationID; ?>" name="id">

                            <button type="submit" class="btn btn-info btn m-1 editbtn" name="edit" disabled><i class="fas fa-pencil-alt"></i> Edit </button>
                        </form>'<?php
                            }

                                ?>



                        <?php
                        $quotationID = $quotation['quotationID'];

                        if ($quotation['cancel_status'] == "Not Cancel") {
                        ?>
                            <form>
                                <input type="hidden" value="<?php $quotationID; ?>" name="id">
                                <button type="button" class="btn btn-danger deletebtn btn mt-1" data-toggle="modal" data-target="#deletemodal"><i class="bi bi-file-earmark-excel-fill"></i> Cancel </button>
                            </form>
                        <?php
                        } else {
                        ?>
                            <form>
                                <input type="hidden" value="<?php $quotationID ?>" name="id">
                                <button type="button" class="btn btn-danger deletebtn btn mt-1" disabled><i class="bi bi-file-earmark-excel-fill"></i> Cancel </button>
                            </form>
                        <?php
                        }

                        ?>

                        ?>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- /.quotation -->

<!-- Cancel Modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: bold;" class="modal-title" id="exampleModalLabel"> Cancel Quotation </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="other_deliveryOrder_func.php" method="post">

                <div class="modal-body">

                    <input type="hidden" name="cancel_id" id="delete_id" value="<?php echo $quotationID ?>">

                    <h5 class="text-center"> Are you sure want to cancel?</h5>
                    <h5 class="text-center"> *You can't revert back or edit later.</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" name="canceldata" class="btn btn-primary">Yes</button>
                </div>
            </form>

        </div>
    </div>
</div>