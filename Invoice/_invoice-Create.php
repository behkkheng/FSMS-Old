<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

$get_current_invoiceID = "SELECT invoiceID FROM `invoice` ORDER BY invoiceID DESC LIMIT 1";
$run_query = mysqli_query($connection, $get_current_invoiceID);
$invoice = mysqli_fetch_assoc($run_query);
if (isset($invoice)) {
    $invoiceID = $invoice["invoiceID"]+1;
} else {
    $invoiceID = "0";
}

?>

<div class="row">
    <div class="col-12">
        <form action="" method="POST">
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
                    <div class="col-sm-4 invoice-col border-right">
                        To:
                        <a href="#" data-toggle="modal" data-target="#addCustomer" class="float-right">Add Customer</a>
                        <br>
                        <?php
                        $get_customer_id = $_SESSION['invoice_customerID'];

                        if (!$get_customer_id == "") {

                            $get_customer_detail_query = "SELECT * FROM `customer` WHERE customerID = '$get_customer_id'";
                            $run_query = mysqli_query($connection, $get_customer_detail_query);

                            $customer_detail = mysqli_fetch_array($run_query);



                        ?>
                            <address>
                                <strong><?php echo $customer_detail['name']; ?></strong><br>
                                <?php echo $customer_detail['address']; ?>,<br />
                                <?php echo $customer_detail['postcode']; ?>, <?php echo $customer_detail['city']; ?>,<br> <?php echo $customer_detail['state']; ?><br />
                                Phone: <?php echo $customer_detail['hpNo']; ?><br>
                            </address>


                        <?php

                        } else {
                            echo "No customer added.";
                        }

                        ?>
                    </div>
                    <!-- /.col -->


                    <div class="col-sm-4 invoice-col">
                        <!--invoice id-->
                        <b>Invoice #<?php echo $invoiceID; ?></b><br>
                        <br>

                        <!--date-->
                        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
                        <link rel="stylesheet" href="/resources/demos/style.css">
                        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
                        <script>
                            $(function() {
                                
                                $("#datepicker").datepicker({
                                    dateFormat: "yy-mm-dd"
                                });
                            });
                        </script>
                        <div class="form-group row needs-validation" novalidate>

                            <div class="form-group row">
                                <label for="datepicker" class="col-sm-2 col-form-label col-form-label ml-2">Date: </label>

                                <div class="col-sm-8">
                                    <?php $today_date = date("Y-m-d"); ?>
                                    <input type="text" class="form-control form-control-sm" id="datepicker" value="<?php echo $today_date; ?>" name="date">
                                </div>

                                <div class="invalid-feedback">Name field is required.</div>
                            </div>

                        </div>

                        <!--Cancel status-->
                        <div>
                            <b>Invoice Status: </b>
                            <p>Not Cancel</p>
                        </div>


                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <br />
                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Product</th>
                                    <th>Qty.</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tr>
                                <?php
                                $all_invoice_detail_query = "SELECT * FROM invoiceDetail WHERE invoiceID = '$invoiceID'";
                                $all_invoice_detail = mysqli_query($connection, $all_invoice_detail_query);
                                if ($all_invoice_detail) {
                                    $index_number = 1;
                                    foreach ($all_invoice_detail as $row) {

                                ?>

                                        <tbody>
                                            <tr>
                                                <!--index number-->
                                                <td> <?php echo $index_number; ?> </td>

                                                <!--name of product-->
                                                <?php
                                                $productID = $row["productID"];
                                                $get_product_name = "SELECT name FROM product WHERE productID = '$productID'";
                                                $run_query = mysqli_query($connection, $get_product_name);
                                                $product_name = mysqli_fetch_assoc($run_query);
                                                ?>
                                                <td> <?php echo $product_name["name"]; ?> </td>

                                                <!--quantity-->
                                                <td> <?php echo $row['quantity']; ?> </td>

                                                <!--product unit price-->
                                                <?php
                                                $get_product_price = "SELECT price FROM product WHERE productID = '$productID'";
                                                $run_query = mysqli_query($connection, $get_product_price);
                                                $product_price = mysqli_fetch_assoc($run_query);
                                                ?>
                                                <td> <?php echo $product_price['price']; ?> </td>

                                                <!--Subtotal-->
                                                <td>RM <?php echo $row['subtotal']; ?> </td>

                                                <!--delete button-->
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" value="<?php echo $row['invoiceDetailID']; ?>" name="id">
                                                        <button type="submit" class="btn btn-danger btn-sm m-1 editbtn" name="deleteInvoiceDetail"><i class="fas fa-trash"></i></i> Delete </button>
                                                    </form>
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
                <p>
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#addProduct"><i class="fas fa fa-plus-circle"></i> Add Product</button>
                </p>
                <div class="row">

                    <!-- accepted payments column -->
                    <div class="col-6">
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
                    <div class="col-5">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="lead" style="border: 0;">Amount</th>
                                </tr>
                                <tr>

                                    <!--total amount-->
                                    <th>Total:</th>
                                    <?php
                                    $total_amount = "0.00";
                                    $invoiceDetail = "SELECT subtotal FROM invoiceDetail";
                                    $queryResult = mysqli_query($connection, $invoiceDetail);
                                    $amount = '0.00';
                                    if ($queryResult) {
                                        foreach ($queryResult as $row) {

                                            $amount = $amount + $row['subtotal'];
                                            $total_amount = number_format((float)$amount, 2, '.', '');
                                        }
                                    }
                                    ?>
                                    <td>RM <?php echo "$total_amount"; ?></td>
                                    
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <input type="hidden" value="<?php echo "$total_amount"; ?>" name="total_amount">
                <!-- /.row -->
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <button type="submit" name="createInvoice" class="btn btn-success float-right">
                            <i class="fas fa-save"></i> Save Invoice
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.invoice -->

<!--add product details-->
<div class="modal fade" id="addProduct">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Products</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">

                    <!--Product-->
                    <div class="form-group">
                        <label for="product_name">Product</label>
                        <select class="form-control" id="product_name" name="product">
                            <?php
                            $show_product_name_query = "SELECT name, productID FROM product";
                            $query_run = mysqli_query($connection, $show_product_name_query);

                            if ($query_run) {
                                foreach ($query_run as $product_names) {
                                    $name = $product_names["name"];
                                    $product_id = $product_names["productID"];
                                    echo "<option value='$product_id'>$name</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!--Quantity-->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Quantity</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="quantity">
                            <?php
                            for ($i = 1; $i < 100; $i++) {
                                echo "<option>$i</option>";
                            }
                            ?>
                        </select>
                    </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addInvoiceDetail">Submit</button>

            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--Add Customer Modal-->
<div class="modal fade" id="addCustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">

                    <!--Customer-->
                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <select class="form-control" id="customer" name="customer">
                            <?php
                            $show_customer_name_query = "SELECT name, customerID FROM customer";
                            $query_run = mysqli_query($connection, $show_customer_name_query);

                            if ($query_run) {
                                foreach ($query_run as $customer_names) {
                                    $name = $customer_names["name"];
                                    $customer_id = $customer_names["customerID"];
                                    echo "<option value='$customer_id'>$name</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!--Create New Customer-->
                    <div>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#createNewCustomer" style="color: white;" role="button">Create New</a>
                    </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addCustomer">Submit</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--Create New Customer Modal-->
<div class="modal fade" id="createNewCustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="">
                <div class="modal-body">

                    <!--Customer-->
                    <div class="col-12">

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">Name field is required.</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="hpNo">H/P No</label>
                                <input type="text" class="form-control" id="hpNo" name="hpNo">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <textarea class="form-control" id="inputAddress" rows="3" name="address"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity" name="city">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="custom-select" name="state">
                                    <option selected value="">Choose...</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Melaka">Melaka</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Putrajaya">Putrajaya</option>
                                    <option value="Labuan">Labuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPostcode">Postcode</label>
                                <input type="text" class="form-control" id="inputPostcode" name="postcode">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="createCustomer">Create</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
if (isset($_POST['addInvoiceDetail'])) {
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];

    $get_product_price_query = "SELECT price FROM product WHERE productID='$product'";
    $run_query = mysqli_query($connection, $get_product_price_query);
    $price = mysqli_fetch_assoc($run_query);

    $subtotal = $quantity * $price['price'];

    $insert_invoice_detail_query = "INSERT INTO `invoicedetail` (`invoiceID`, `quantity`, `subtotal`, `productID`) VALUES ('$invoiceID', '$quantity', '$subtotal', '$product')";;

    $run_query = mysqli_query($connection, $insert_invoice_detail_query);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['deleteInvoiceDetail'])) {
    $invoice_detail_id = $_POST["id"];

    $delete_invoice_details_query = "DELETE FROM invoiceDetail WHERE invoiceDetailID='$invoice_detail_id'";
    $run_query = mysqli_query($connection, $delete_invoice_details_query);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['createCustomer'])) {
    $name = $_POST['name'];
    $hpNo = $_POST['hpNo'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];

    $create_customer_query = "INSERT INTO `customer` (`name`, `hpNo`, `address`, `city`, `state`, `postcode`) VALUES ('$name', '$hpNo', '$address', '$city', '$state', '$postcode')";
    $run_query = mysqli_query($connection, $create_customer_query);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['addCustomer'])) {
    $_SESSION["invoice_customerID"] = $_POST['customer'];

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['createInvoice'])) {
    $date = $_POST['date'];
    $customerID = $_SESSION['invoice_customerID'];
    $total_amount = $_POST['total_amount'];
    $cancel_status = "Not Cancel";

    $create_invoice_query = "INSERT INTO `invoice` (`date`, `customerID`, `total_amount`, `cancel_status`) VALUES ('$date', '$customerID', '$total_amount', '$cancel_status')";
    $run_query = mysqli_query($connection, $create_invoice_query);

    if($run_query){
        echo("<script>location.href = 'Invoice-Index.php';</script>");
        exit();
    }
    else{
        echo "Cannot save data.";
    }
}
?>