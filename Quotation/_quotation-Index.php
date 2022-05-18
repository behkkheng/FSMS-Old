<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <a class="btn btn-primary float-right" href="Quotation-Create.php" role="button"><i class="bi bi-plus-circle-fill"></i> Create New Quotation</a>
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

            $query = "SELECT * FROM quotation";
            $query_run = mysqli_query($connection, $query);
            ?>
            <table id="datatableid" class="table text-center">
                <thead>
                    <tr>
                        <th scope="col"> Quotation ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
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
                                <td> <?php echo $row['quotationID']; ?> </td>
                                <td> <?php
                                        $customerID = $row['customerID'];
                                        $get_customer_name_query = "SELECT name FROM customer WHERE customerID='$customerID'";
                                        $query_run = mysqli_query($connection, $get_customer_name_query);
                                        $customer_name = mysqli_fetch_array($query_run);

                                        echo $customer_name['name']; ?> </td>

                                <td> <?php echo $row['date']; ?> </td>

                                <td> <?php if ($row['cancel_status'] == "Not Cancel") {
                                            echo "Not Cancel";
                                        } else {
                                            echo "<p style='color:red'>Cancel</p>";
                                        } ?> </td>
                                <td>
                                    RM <?php echo $row['total_amount']; ?>
                                </td>


                                <td class="mr-1">
                                    <div class="row float-right mr-3">
                                        <form action="\FSMS\Quotation\Quotation-Detail.php" method="get">
                                            <input type="hidden" value="<?php echo $row['quotationID']; ?>" name="id">
                                            <button type="submit" class="btn btn-primary btn-sm m-1 viewbtn"><i class="fas fa-folder"></i> View </button>
                                        </form>

                                        <?php
                                        $quotationID = $row['quotationID'];

                                        if ($row['cancel_status'] == "Not Cancel") {
                                        ?>
                                            <form action="\FSMS\Quotation\Quotation-Edit.php" method="get">
                                            <input type="hidden" value="<?php echo $quotationID; ?>" name="id">
                                            <button type="submit" class="btn btn-info btn-sm m-1 editbtn"><i class="fas fa-pencil-alt"></i> Edit </button>
                                        </form><?php
                                        } else {
                                            ?>
                                            <form action="\FSMS\Quotation\Quotation-Edit.php" method="get">
                                            <input type="hidden" value="<?php echo $quotationID; ?>" name="id">
                                            <button type="submit" class="btn btn-info btn-sm m-1 editbtn" disabled><i class="fas fa-pencil-alt"></i> Edit </button>
                                        </form><?php
                                        }

                                        ?>



                                        <?php
                                        $quotationID = $row['quotationID'];

                                        if ($row['cancel_status'] == "Not Cancel") {
                                            echo
                                            '<form>
                                                <input type="hidden" value="$quotationID" name="id">
                                                <button type="button" class="btn btn-danger deletebtn btn-sm m-1"><i class="bi bi-file-earmark-excel-fill"></i> Cancel </button>
                                                </form>';
                                        } else {
                                            echo
                                            '<form>
                                                <input type="hidden" value="$quotationID" name="id">
                                                <button type="button" class="btn btn-danger deletebtn btn-sm m-1" disabled><i class="bi bi-file-earmark-excel-fill"></i> Cancel </button>
                                                </form>';
                                        }

                                        ?>
                                        </i>
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

                <!-- CANCEL POP UP FORM (Bootstrap MODAL) -->
                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-weight: bold;" class="modal-title" id="exampleModalLabel"> Delete Quotation Data </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="other_quotation_func.php" method="POST">

                                <div class="modal-body">

                                    <input type="hidden" name="cancel_id" id="delete_id">

                                    <h5 class="text-center"> Are you sure want to cancel this quotation?</h5>
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
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {

        $('.deletebtn').on('click', function() {

            $('#deletemodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id').val(data[0]);
        });
    });
</script>