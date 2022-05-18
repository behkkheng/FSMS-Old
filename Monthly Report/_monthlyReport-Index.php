<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <a class="btn btn-primary float-right text-white" data-toggle="modal" data-target="#createReport"><i class="bi bi-plus-circle-fill"></i> Generate New Report</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fsms";
            $_SESSION["quotation_customerID"] = "";
            $_SESSION['run_one_time'] = 1;

            // Create connection
            $connection = new mysqli($servername, $username, $password, $dbname);

            $query = "SELECT * FROM monthlyReport ORDER BY year,month ASC;";
            $query_run = mysqli_query($connection, $query);
            ?>
            <table id="datatableid" class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Year</th>
                        <th scope="col">Month</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php
                if ($query_run) {
                    foreach ($query_run as $row) {
                ?>

                        <tbody>
                            <tr>
                                <td> <?php
                                        echo $row['year'];
                                        ?>
                                </td>

                                <td> <?php
                                        echo $row['month'];
                                        ?>
                                </td>
                                <td>
                                    RM <?php
                                        $year_this_column = $row['year'];
                                        $month_this_column = $row['month'];

                                        $total_query = "SELECT total_amount FROM invoice WHERE MONTH(date)=$month_this_column AND YEAR(date)=$year_this_column";
                                        $run_query = mysqli_query($connection, $total_query);
                                        $month_total_amount = 0.00;
                                        if ($run_query) {
                                            foreach ($run_query as $row) {
                                                $month_total_amount += $row['total_amount'];
                                            }
                                            $amount = number_format((float)$month_total_amount, 2, '.', '');
                                            echo $amount;
                                        }
                                        ?>
                                </td>


                                <td class="mr-1">
                                    <div class="row float-right mr-3">
                                        <form action="\FSMS\Monthly Report\MonthlyReport-Detail.php" method="get">
                                            <input type="hidden" value="<?php echo $year_this_column; ?>" name="year">
                                            <input type="hidden" value="<?php echo $month_this_column; ?>" name="month">
                                            <button type="submit" class="btn btn-primary btn-sm m-1 viewbtn"><i class="fas fa-folder"></i> View </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        </tbody>

                <?php
                    }
                } else {
                    echo "No Record Found";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<!--create new report-->
<div class="modal fade" id="createReport">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Monthly Sales Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">

                    <div class="form-row">
                        <!--Year-->
                        <div class="form-group col-md-6">
                            <label for="product_name">Year</label>
                            <select class="form-control" id="product_name" name="year">
                                <?php
                                $year_query = "SELECT YEAR(date) FROM invoice GROUP BY YEAR(date);";
                                $query_run = mysqli_query($connection, $year_query);

                                if ($query_run) {
                                    foreach ($query_run as $year_array) {
                                        $year = $year_array["YEAR(date)"];
                                        echo "<option value='$year'>$year</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!--Quantity-->
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">Month</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="month">
                                <?php
                                for ($i = 1; $i < 13; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="createReport"><i class="fas fa-save"></i> Create</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php

//create report
if (isset($_POST['createReport'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];

    $check_query = "SELECT * FROM `monthlyreport` WHERE year='$year'AND month='$month'";
    $query_run = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($query_run) == 0) {
        $create_query = "INSERT INTO `monthlyreport` (`month`, `year`) VALUES ('$month', '$year')";
        $query_run = mysqli_query($connection, $create_query);

        if ($query_run) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Exception occur when create sales report.";
        }
    }
}

?>