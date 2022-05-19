<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

$get_current_deliveryOrderID = "SELECT MAX(deliveryOrderID) FROM `deliveryOrder`";
$run_query = mysqli_query($connection, $get_current_deliveryOrderID);
$deliveryOrder = mysqli_fetch_assoc($run_query);
if (isset($deliveryOrder)) {
    $deliveryOrderID = $deliveryOrder["MAX(deliveryOrderID)"] + 1;
} else {
    $deliveryOrderID = "0";
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="row">
    <div class="col-12">
        <form action="" method="POST" class="needs-validation" novalidate>
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
                        <a href="#" data-toggle="modal" data-target="#addCustomer" class="float-right">Add Customer</a>
                        <br>
                        <?php
                        $get_customer_id = $_SESSION['deliveryOrder_customerID'];

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


                    <div class="col-sm-4 deliveryOrder-col">
                        <!--deliveryOrder id-->
                        <b class="col-sm-6">Delivery Order #<?php echo $deliveryOrderID; ?></b><br>
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

                        <div class="form-group needs-validation" novalidate>

                            <div class="form-group row col-sm-12">
                                <label for="datepicker" class="col-md-6 col-form-label">Date: </label>

                                <div class="col-sm-6">
                                    <?php $today_date = date("Y-m-d"); ?>

                                    <input type="text" class="form-control form-control-sm mol-md-6" id="datepicker" value="<?php echo $today_date; ?>" name="date" required>
                                    <div class="invalid-feedback">Date is required.</div>
                                </div>

                            </div>

                        </div>

                        <!--PO No-->
                        <div class="form-group">

                            <div class="form-group row col-sm-12">
                                <label for="poNo" class="col-md-6 col-form-label">Purchased Order No.: </label>

                                <div class="col-sm-6">

                                    <input type="text" class="form-control form-control-sm mol-md-6" id="poNo" name="poNo">
                                    
                                </div>
                            </div>
                            
                        </div>

                        <!--Cancel status-->
                        <div class="row col-sm-12">
                            <div class="col-sm-6">
                                <b>Delivery Order Status: </b>
                            </div>
                            <div class="col-sm-6">
                                Not Cancel
                            </div>
                        </div>


                    </div>
                    <!-- /.col -->
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tr>
                                <?php
                                $all_deliveryOrder_detail_query = "SELECT * FROM deliveryOrderDetail WHERE deliveryOrderID = '$deliveryOrderID'";
                                $all_deliveryOrder_detail = mysqli_query($connection, $all_deliveryOrder_detail_query);
                                if ($all_deliveryOrder_detail) {
                                    $index_number = 1;
                                    foreach ($all_deliveryOrder_detail as $row) {

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
                                                $product_name = mysqli_fetch_assoc($run_query);
                                                ?>
                                                <td> <?php echo $product_name["name"]; ?> </td>

                                                <!--quantity-->
                                                <td> <?php echo $row['quantity']; ?> </td>

                                                <!--delete button-->
                                                <td class="text-right">
                                                    <form action="" method="post">
                                                        <input type="hidden" value="<?php echo $row['deliveryOrderDetailID']; ?>" name="id">
                                                        <button type="submit" class="btn btn-danger btn-sm m-1 editbtn" name="deleteDeliveryOrderDetail"><i class="fas fa-trash"></i> Delete </button>
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
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <?php

                        $already_have_deliveryOrder_detail_query = "SELECT * FROM deliveryOrderDetail WHERE deliveryOrderID = '$deliveryOrderID'";
                        $run_query = mysqli_query($connection, $already_have_deliveryOrder_detail_query);
                        $already_have_deliveryOrder_detail_query = mysqli_fetch_array($run_query);

                        if ($_SESSION['deliveryOrder_customerID'] == "") {
                            echo '<button type="button" class="btn btn-success float-right mr-2" data-toggle="modal" data-target="#customer_not_set"><i class="fas fa-save"></i>
                                Create Delivery Order
                              </button>';
                        } else if (!isset($already_have_deliveryOrder_detail_query)) {
                            echo '<button type="button" class="btn btn-success float-right mr-2" data-toggle="modal" data-target="#deliveryOrder_detail_not_set"><i class="fas fa-save"></i>
                                Create Delivery Order
                              </button>';
                        } else if (isset($already_have_deliveryOrder_detail_query) && isset($_SESSION['deliveryOrder_customerID'])) {
                            echo '<button type="submit" name="createDeliveryOrder" class="btn btn-success float-right mr-2">
                            <i class="fas fa-save"></i> Create Delivery Order
                            </button>';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.deliveryOrder -->

<!-- Customer not set warning Modal -->
<div class="modal fade" id="customer_not_set" tabindex="-1" aria-labelledby="customer_not_set" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title" id="exampleModalLabel">Warning!</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Customer field cannot be empty.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Delivery Order Detail not set warning Modal -->
<div class="modal fade" id="deliveryOrder_detail_not_set" tabindex="-1" aria-labelledby="deliveryOrder_detail_not_set" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title" id="exampleModalLabel">Warning!</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                No product added.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!--add product details-->
<div class="modal fade" id="addProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Products</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">

                    <div class="form-row">
                        <!--Product-->
                        <div class="form-group col-md-6">
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
                        <div class="form-group col-md-6">
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

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="addDeliveryOrderDetail"><i class="fas fa-save"></i> Save</button>

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
    <div class="modal-dialog">
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
                    <div class="form-group row">
                        <label for="customer" class="col-sm-3 col-form-label">Customer: </label>
                        <select class="form-control col-sm-8" id="customer" name="customer">
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

                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#createNewCustomer" style="color: white;" role="button"><i class="bi bi-plus-circle"></i> Create New</a>
                    </div>

                    <div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="addCustomer"><i class="fas fa-save"></i> Save</button>
                    </div>

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

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>


<?php
if (isset($_POST['addDeliveryOrderDetail'])) {
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];

    $insert_deliveryOrder_detail_query = "INSERT INTO `deliveryOrderdetail` (`deliveryOrderID`, `quantity`, `productID`) VALUES ('$deliveryOrderID', '$quantity', '$product')";;

    $run_query = mysqli_query($connection, $insert_deliveryOrder_detail_query);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['deleteDeliveryOrderDetail'])) {
    $deliveryOrder_detail_id = $_POST["id"];

    $delete_deliveryOrder_details_query = "DELETE FROM deliveryOrderDetail WHERE deliveryOrderDetailID='$deliveryOrder_detail_id'";
    $run_query = mysqli_query($connection, $delete_deliveryOrder_details_query);

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
    $_SESSION["deliveryOrder_customerID"] = $_POST['customer'];

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['createDeliveryOrder'])) {
    $date = $_POST['date'];
    $customerID = $_SESSION['deliveryOrder_customerID'];
    $cancel_status = "Not Cancel";
    $poNo = $_POST['poNo'];

    $create_deliveryOrder_query = "INSERT INTO `deliveryOrder` (`date`, `customerID`, `product_quantity`, `cancel_status`, `poNo`) VALUES ('$date', '$customerID', '$product_quantity', '$cancel_status', '$poNo')";
    $run_query = mysqli_query($connection, $create_deliveryOrder_query);

    if ($run_query) {
        $_SESSION['deliveryOrder_customerID'] = "";
        echo ("<script>location.href = 'DeliveryOrder-Index.php';</script>");
        exit();
    } else {
        $_SESSION['deliveryOrder_customerID'] = "";
        echo "Cannot save data.";
    }
}
?>