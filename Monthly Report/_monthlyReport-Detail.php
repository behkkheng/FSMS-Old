<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

$year = $_GET['year'];
$month = $_GET['month'];
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
                <div class="col-sm-6 invoice-col border-right">
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



                <div class="col-sm-6 quotation-col">
                    <!--title-->
                    <!--date-->
                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <b>Title: </b>
                        </div>
                        <div class="col-sm-6">
                            <b><?php echo $year;
                                echo " ";
                                echo date('F', mktime(0, 0, 0, $month, 10)); ?> Sales Report</b><br>
                        </div>
                    </div>

                    <br>

                    <!--date-->
                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <b>Today Date: </b>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            $today = date("Y/m/d");
                            echo $today;
                            ?>
                        </div>
                    </div>

                    <br>

                    <!--show report date range-->
                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <b>Date From: </b>
                        </div>
                        <div class="col-sm-6">
                            01/<?php echo $month ?>/<?php echo $year ?>
                        </div>
                    </div><br>

                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <b>To: </b>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo cal_days_in_month(CAL_GREGORIAN, $month, $year);
                            ?>/<?php echo $month ?>/<?php echo $year ?>
                        </div>
                    </div>

                    <br>




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
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Invoice ID</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php
                            $invoice_query = "SELECT date, customerID, total_amount, invoiceID FROM invoice WHERE MONTH(date)=$month AND YEAR(date)=$year ORDER BY date ASC";
                            $run_query = mysqli_query($connection, $invoice_query);
                            $month_total_amount = 0.00;
                            if ($run_query && mysqli_num_rows($run_query)!=0) {
                                $index_number = 1;
                                foreach ($run_query as $row) {

                            ?>
                                    <tbody>
                                        <tr>
                                            <!--index number-->
                                            <td> <?php echo $index_number; ?> </td>

                                            <!--date-->
                                            <td> <?php echo $row['date']; ?> </td>

                                            <!--customer name-->
                                            <?php
                                            $customerID = $row["customerID"];

                                            $get_customer_name = "SELECT name FROM customer WHERE customerID = '$customerID'";
                                            $run_query = mysqli_query($connection, $get_customer_name);
                                            $customer_name = mysqli_fetch_array($run_query);
                                            ?>
                                            <td> <?php echo $customer_name["name"]; ?> </td>

                                            <!--invoiceID-->
                                            <td> <?php echo $row['invoiceID']; ?> </td>

                                            <!--total amount-->
                                            <td>RM <?php echo $row['total_amount'];
                                                    $month_total_amount += $row['total_amount']; ?> </td>

                                        </tr>
                                    </tbody>

                                <?php
                                    $index_number++;
                                }
                            } else {
                                ?>
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="5">No sales for this month.</td>
                                    </tr>
                                </tbody>


                            <?php
                            }
                            ?>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <table class="table table-borderless">
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>

                <tr>
                    <th class="text-right" style="width: 80%">Total Amount:</th>
                    <th class="text-center"><u style="font-weight: bold;">RM <?php echo number_format((float)$month_total_amount, 2, '.', '') ?></u></th>
                </tr>

            </table>

            <div class="no-print text-right">
                <button type="button" class="btn btn-secondary m-1" onClick="window.print()"><i class="bi bi-printer-fill"></i> Print</button>
            </div>
            <!--print button-->


        </div>
    </div>
</div>