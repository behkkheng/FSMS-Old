<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <a class="btn btn-primary float-right" href="Invoice-Create.php" role="button">New Invoice</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fsms";

            // Create connection
            $connection = new mysqli($servername, $username, $password, $dbname);

            $query = "SELECT * FROM invoice";
            $query_run = mysqli_query($connection, $query);
            ?>
            <table id="datatableid" class="table">
                <thead>
                    <tr>
                        <th scope="col"> Invoice ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col"> </th>
                    </tr>
                </thead>
                <?php
                if ($query_run) {
                    foreach ($query_run as $row) {
                ?>

                        <tbody>
                            <tr>
                                <td> <?php echo $row['invoiceID']; ?> </td>
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
                                        }?> </td>
                                <td></td>

                                <div class="row">
                                    <td class="text-right">
                                        <div class="row">
                                            <form action="\FSMS\Invoice\Invoice-Detail.php" method="get">
                                                <input type="hidden" value="<?php echo $row['invoiceID']; ?>" name="id">
                                                <button type="submit" class="btn btn-primary btn-sm m-1 viewbtn"><i class="fas fa-folder"></i> View </button>
                                            </form>

                                            <form action="\FSMS\Invoice\Invoice-Edit.php" method="get">
                                                <input type="hidden" value="<?php echo $row['invoiceID']; ?>" name="id">
                                                <button type="submit" class="btn btn-info btn-sm m-1 editbtn"><i class="fas fa-pencil-alt"></i> Edit </button>
                                            </form>

                                            <form class="">
                                                <input type="hidden" value="<?php echo $row['invoiceID']; ?>" name="id">
                                                <button type="button" class="btn btn-danger deletebtn btn-sm m-1"><i class="fas fa-trash"></i> Cancel </button>
                                            </form>

                                        </div>
                                    </td>
                                </div>

                            </tr>
                        </tbody>

                <?php
                    }
                } else {
                    echo "No Record Found";
                }
                ?>

                <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-weight: bold;" class="modal-title" id="exampleModalLabel"> Delete Invoice Data </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="other_invoice_func.php" method="POST">

                                <div class="modal-body">

                                    <input type="hidden" name="delete_id" id="delete_id">

                                    <h5 class="text-center"> Are you sure want to cancel this invoice?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                                    <button type="submit" name="deletedata" class="btn btn-primary">Yes</button>
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