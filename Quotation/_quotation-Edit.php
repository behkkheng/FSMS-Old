<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Save connection
$connection = new mysqli($servername, $username, $password, $dbname);

$quotationID = $_GET['id'];
$get_quotation_query = "SELECT * FROM `quotation` WHERE quotationID='$quotationID'";
$run_query = mysqli_query($connection, $get_quotation_query);
$quotation = mysqli_fetch_assoc($run_query);

if ($_SESSION['run_one_time'] == 1) {
    $_SESSION['quotation_customerID'] = $quotation['customerID'];
    $_SESSION['run_one_time'] = 2;
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
                <div class="row invoice-info">
                    <div class="col-sm-4 quotation-col border-right">
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
                        <a href="#" data-toggle="modal" data-target="#addCustomer" class="float-right">Add Customer</a>
                        <br>
                        <?php
                        $get_customer_id = $_SESSION['quotation_customerID'];

                        if (!$get_customer_id == "") {

                            $get_customer_detail_query = "SELECT * FROM `customer` WHERE customerID = '$get_customer_id'";
                            $run_query = mysqli_query($connection, $get_customer_detail_query);

                            $customer_detail = mysqli_fetch_array($run_query);

                            if ($customer_detail != null) { ?>

                                <address>
                                    <strong><?php echo $customer_detail['name']; ?></strong><br>
                                    <?php echo $customer_detail['address']; ?>,<br />
                                    Email: <?php echo $customer_detail['email']; ?><br>
                                    Phone: <?php echo $customer_detail['hpNo']; ?><br>
                                </address>
                            <?php
                            } else {
                                echo "<br><b>Customer is either deleted or not exist.</b>";
                            }

                            ?>


                        <?php

                        } else {
                            echo "No customer added.";
                        }

                        ?>
                    </div>
                    <!-- /.col -->


                    <div class="col-sm-4 quotation-col">
                        <!--quotation id-->
                        <b class="col-sm-6">Quotation #<?php echo $quotationID; ?></b><br>
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
                                    <?php
                                    $today_date = date("Y-m-d");
                                    $date = $quotation['date'];

                                    if (isset($date)) {
                                        $date = $today_date;
                                    }

                                    ?>

                                    <input type="text" class="form-control form-control-sm" id="datepicker" value="<?php echo $date; ?>" name="date" required>
                                    <div class="invalid-feedback">Date is required.</div>
                                </div>

                            </div>

                        </div>

                        <!--Cancel status-->
                        <div class="row col-sm-12">
                            <div class="col-sm-6">
                                <b>Quotation Status: </b>
                            </div>
                            <div class="col-sm-6">
                                Not Cancel
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
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tr>
                                <?php
                                $all_quotation_detail_query = "SELECT * FROM quotationDetail WHERE quotationID = '$quotationID'";
                                $all_quotation_detail = mysqli_query($connection, $all_quotation_detail_query);
                                if ($all_quotation_detail) {
                                    $index_number = 1;
                                    $total_amount = 0.00;
                                    foreach ($all_quotation_detail as $row) {

                                ?>

                                        <tbody>
                                            <tr class="align-middle">
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
                                                <td> <?php
                                                    if ($product_name != null) {
                                                        echo $product_name["name"];
                                                    } else {
                                                        echo "<b>Product is either deleted or not exist.</b>";
                                                    }  ?> </td>

                                                <!--quantity-->
                                                <td> <?php $rowquantity = $row['quantity'];
                                                        echo $rowquantity; ?> </td>

                                                <!--product unit price-->
                                                <?php
                                                $get_product_price = "SELECT price FROM product WHERE productID = '$productID'";
                                                $run_query = mysqli_query($connection, $get_product_price);
                                                $product_price = mysqli_fetch_assoc($run_query);
                                                ?>
                                                <td>RM <?php
                                                        $furniture_price = $product_price['price'];
                                                        $rowprice = number_format((float)$furniture_price, 2, '.', '');
                                                        echo $rowprice; ?> </td>

                                                <!--Subtotal-->
                                                <td><b>RM <?php
                                                            $subtotal = $rowquantity * $product_price['price'];
                                                            $subtotal = number_format((float)$subtotal, 2, '.', '');
                                                            echo $subtotal;
                                                            $total_amount += $subtotal;
                                                            ?></b></td>

                                                <!--delete button-->
                                                <td class="text-right">
                                                    <form action="" method="post">
                                                        <input type="hidden" value="<?php echo $row['quotationDetailID']; ?>" name="id">
                                                        <button type="submit" class="btn btn-danger btn-sm m-1 editbtn mt-0" name="deleteQuotationDetail"><i class="fas fa-trash"></i> Delete </button>
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
                                    $total_amount = number_format((float)$total_amount, 2, '.', '');
                                    ?>
                                    <td><b>RM <?php echo $total_amount; ?></b></td>

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
                        <?php

                        $already_have_quotation_detail_query = "SELECT * FROM quotationDetail WHERE quotationID = '$quotationID'";
                        $run_query = mysqli_query($connection, $already_have_quotation_detail_query);
                        $already_have_quotation_detail_query = mysqli_fetch_array($run_query);

                        if ($_SESSION['quotation_customerID'] == "") {
                            echo '<button type="button" class="btn btn-success float-right mr-2" data-toggle="modal" data-target="#customer_not_set"><i class="fas fa-save"></i>
                                Save Quotation
                              </button>';
                        } else if (!isset($already_have_quotation_detail_query)) {
                            echo '<button type="button" class="btn btn-success float-right mr-2" data-toggle="modal" data-target="#quotation_detail_not_set"><i class="fas fa-save"></i>
                                Save Quotation
                              </button>';
                        } else if (isset($already_have_quotation_detail_query) && isset($_SESSION['quotation_customerID'])) {
                            echo '<button type="submit" name="editQuotation" class="btn btn-success float-right mr-2">
                            <i class="fas fa-save"></i> Save
                            </button>';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.quotation -->

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

<!-- Quotation Detail not set warning Modal -->
<div class="modal fade" id="quotation_detail_not_set" tabindex="-1" aria-labelledby="quotation_detail_not_set" aria-hidden="true">
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
                            <select class="form-control" id="product_name" name="product" required>
                                <?php
                                $show_product_name_query = "SELECT name, quantity, productID FROM product";
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
                                for ($i = 1; $i < $product_names['quantity']; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="addQuotationDetail"><i class="fas fa-save"></i> Save</button>

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
                        <a class="btn btn-primary" data-toggle="modal" data-target="#createNewCustomer" style="color: white;" role="button"><i class="bi bi-plus-circle"></i> Save New</a>
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

<!--Save New Customer Modal-->
<div class="modal fade" id="createNewCustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Save New Customer</h4>
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
                            <div class="form-group col-md-6">
                                <label for="hpNo">H/P No</label>
                                <input type="text" class="form-control" id="hpNo" name="hpNo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <textarea class="form-control" id="inputAddress" rows="3" name="address"></textarea>
                        </div>

                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="createCustomer">Save</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--script for form validation-->
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

<!--script for form validation-->
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
if (isset($_POST['addQuotationDetail'])) {
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];

    $get_product_price_query = "SELECT price FROM product WHERE productID='$product'";
    $run_query = mysqli_query($connection, $get_product_price_query);
    $price = mysqli_fetch_assoc($run_query);

    $insert_quotation_detail_query = "INSERT INTO `quotationdetail` (`quotationID`, `quantity`, `productID`) VALUES ('$quotationID', '$quantity', '$product')";;

    $run_query = mysqli_query($connection, $insert_quotation_detail_query);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['deleteQuotationDetail'])) {
    $quotation_detail_id = $_POST["id"];

    $delete_quotation_details_query = "DELETE FROM quotationDetail WHERE quotationDetailID='$quotation_detail_id'";
    $run_query = mysqli_query($connection, $delete_quotation_details_query);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['createCustomer'])) {
    $name = $_POST['name'];
    $hpNo = $_POST['hpNo'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $create_customer_query = "INSERT INTO `customer` (`name`, `hpNo`, `address`, `city`, `state`, `postcode`) VALUES ('$name', '$hpNo', '$address', '$city', '$state', '$postcode')";
    $run_query = mysqli_query($connection, $create_customer_query);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['addCustomer'])) {
    $_SESSION["quotation_customerID"] = $_POST['customer'];

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['editQuotation'])) {
    $date = $_POST['date'];
    $customerID = $_SESSION['quotation_customerID'];
    $total_amount = $_POST['total_amount'];
    $cancel_status = "Not Cancel";

    $edit_quotation_query = "UPDATE `quotation` SET `date` = '$date', `customerID` = '$customerID', `total_amount` = '$total_amount' WHERE `quotationID` = '$quotationID'";;
    $run_query = mysqli_query($connection, $edit_quotation_query);

    if ($run_query) {
        $_SESSION['quotation_customerID'] = "";
        echo ("<script>location.href = 'Quotation-Index.php';</script>");
        exit();
    } else {
        $_SESSION['quotation_customerID'] = "";
    }
}
?>