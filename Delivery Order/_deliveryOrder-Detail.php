<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

$deliveryOrderID = $_GET['id'];
$get_deliveryOrder_query = "SELECT * FROM `deliveryOrder` WHERE deliveryOrderID='$deliveryOrderID'";
$run_query = mysqli_query($connection, $get_deliveryOrder_query);
$deliveryOrder = mysqli_fetch_assoc($run_query);
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
            <div class="row deliveryOrder-info">
                <div class="col-sm-4 deliveryOrder-col border-right">
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
                <div class="col-sm-4 deliveryOrder-col border-right">
                    To:
                    <br>
                    <?php
                    $customerID = $deliveryOrder['customerID'];
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

                <div class="col-sm-4 deliveryOrder-col">
                    <!--deliveryOrder id-->
                    <b class="col-sm-6">Delivery Order #<?php echo $deliveryOrder['deliveryOrderID']; ?></b><br>
                    <br>


                    <!--date-->
                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <b>Date: </b>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            $date = $deliveryOrder['date'];
                            echo $date;
                            ?>
                        </div>
                    </div>

                    <br>

                    <!--PO No-->
                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <b>Purchase Order No.: </b>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            $poNo = $deliveryOrder['poNo'];
                            echo $poNo;
                            ?>
                        </div>
                    </div>

                    <br>

                    <!--Cancel status-->
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <b>DeliveryOrder Status: </b>
                        </div>
                        <div class="col-md-6">
                            <?php
                            if ($deliveryOrder['cancel_status'] == "Cancel") {
                                echo '<p style="color:red;">Cancel</p>';
                            } else {
                                echo '<p>Not Cancel</p>';
                            }
                            ?>
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
                                <th>Qty.</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php
                            $all_deliveryOrder_detail_query = "SELECT * FROM deliveryOrderDetail WHERE deliveryOrderID = '$deliveryOrderID'";
                            $run_query = mysqli_query($connection, $all_deliveryOrder_detail_query);
                            if ($run_query) {
                                $index_number = 1;
                                foreach ($run_query as $row) {

                            ?>

                                    <tbody>
                                        <tr>
                                            <!--index number-->
                                            <td> <?php echo $index_number; ?> </td>

                                            <!--product id-->
                                            <td> <?php echo $row['productID']; ?> </td>

                                            <!--name of product-->
                                            <?php
                                            $productID = $row["productID"];

                                            $get_product_name = "SELECT name FROM product WHERE productID = '$productID'";
                                            $run_query = mysqli_query($connection, $get_product_name);
                                            $product_name = mysqli_fetch_array($run_query);
                                            ?>
                                            <td>
                                                <?php
                                                if ($product_name != null) {
                                                    echo $product_name["name"];
                                                } else {
                                                    echo "<b>Product is either deleted or not exist.</b>";
                                                }  ?>
                                            </td>

                                            <!--quantity-->
                                            <td> <?php echo $row['quantity']; ?> </td>

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
                                <th class="lead" style="border: 0;">Amount of Product</th>
                            </tr>
                            <tr>

                                <!--total product-->
                                <th>Total Number of Product:</th>
                                <?php
                                $product_quantity = 0;
                                $deliveryOrderDetail = "SELECT quantity FROM deliveryOrderDetail WHERE deliveryOrderID='$deliveryOrderID'";
                                $queryResult = mysqli_query($connection, $deliveryOrderDetail);
                                if ($queryResult) {
                                    foreach ($queryResult as $row) {

                                        $product_quantity = $product_quantity + $row['quantity'];
                                    }
                                }
                                ?>
                                <td><b><?php echo "$product_quantity"; ?></b></td>

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
                    $deliveryOrderID = $deliveryOrder['deliveryOrderID'];

                    if ($deliveryOrder['cancel_status'] == "Not Cancel") {
                    ?>
                        <form action="\FSMS\Delivery Order\DeliveryOrder-Edit.php" method="GET">
                            <input type="hidden" value="<?php echo $deliveryOrderID; ?>" name="id">

                            <button type="submit" class="btn btn-info btn m-1 editbtn" name="edit"><i class="fas fa-pencil-alt"></i> Edit </button>
                        </form>
                    <?php
                    } else {
                    ?>
                        <form action="\FSMS\Delivery Order\DeliveryOrder-Edit.php" method="GET">
                            <input type="hidden" value="<?php echo $deliveryOrderID; ?>" name="id">

                            <button type="submit" class="btn btn-info btn m-1 editbtn" name="edit" disabled><i class="fas fa-pencil-alt"></i> Edit </button>
                        </form>'<?php
                            }

                                ?>



                        <?php
                        $deliveryOrderID = $deliveryOrder['deliveryOrderID'];

                        if ($deliveryOrder['cancel_status'] == "Not Cancel") {
                        ?>
                            <form>
                                <input type="hidden" value="<?php $deliveryOrderID; ?>" name="id">
                                <button type="button" class="btn btn-danger deletebtn btn mt-1" data-toggle="modal" data-target="#deletemodal"><i class="bi bi-file-earmark-excel-fill"></i> Cancel </button>
                            </form>
                        <?php
                        } else {
                        ?>
                            <form>
                                <input type="hidden" value="<?php $deliveryOrderID ?>" name="id">
                                <button type="button" class="btn btn-danger deletebtn btn mt-1" disabled><i class="bi bi-file-earmark-excel-fill"></i> Cancel </button>
                            </form>
                        <?php
                        }

                        ?>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- /.deliveryOrder -->

<!-- Cancel Modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: bold;" class="modal-title" id="exampleModalLabel"> Cancel Delivery Order </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="other_deliveryOrder_func.php" method="post">

                <div class="modal-body">

                    <input type="hidden" name="cancel_id" id="delete_id" value="<?php echo $deliveryOrderID ?>">

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>