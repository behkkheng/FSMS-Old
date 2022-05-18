<div class="card">
    <div class="card-body">
        <dl class="row">
            <?php
            $id = $_GET['id'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fsms";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM employee WHERE employeeID = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_array($result);
                // output data of each row
                echo '
                    <dt class="col-sm-4">Name: </dt>
                    <dd class="col-sm-8">' . $row["name"] . '</dd>
                    <dt class="col-sm-4">Username: </dt>
                    <dd class="col-sm-8">' . $row["username"] . '</dd>
                    <dt class="col-sm-4">Handphone Number: </dt>
                    <dd class="col-sm-8">' . $row["hpNo"] . '</dd>
                    <dt class="col-sm-4">Address: </dt>
                    <dd class="col-sm-8">' . $row["address"] . '</dd>
                    <dt class="col-sm-4">City: </dt>
                    <dd class="col-sm-8">' . $row["city"] . '</dd>
                    <dt class="col-sm-4">State: </dt>
                    <dd class="col-sm-8">' . $row["state"] . '</dd>
                    <dt class="col-sm-4">Postcode: </dt>
                    <dd class="col-sm-8">' . $row["postcode"] . '</dd>
                    <dt class="col-sm-4">Role: </dt>
                    <dd class="col-sm-8">' . $row["role"] . '</dd>';
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </dl>

        <div class="row float-right">
            <form action="\FSMS\User\User-Edit.php" method="get">
                <input type="hidden" value="<?php echo $row['employeeID']; ?>" name="id">
                <button type="submit" class="btn btn-info editbtn float-right m-1"><i class="fas fa-pencil-alt"></i> Edit </button>
            </form>

            <form class="">
                <input type="hidden" value="<?php echo $row['employeeID']; ?>" name="id">
                <button type="button" class="btn btn-danger deletebtn float-right m-1 mr-3"><i class="fas fa-trash"></i> Delete </button>
            </form>
        </div>

    </div>

</div>



<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: bold;" class="modal-title" id="exampleModalLabel"> Delete Employee Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="other_user_func.php" method="POST">

                <div class="modal-body">

                    <input type="hidden" name="delete_id" value="<?php echo $id ?>">

                    <h5 class="text-center"> Are you sure want to delete?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" name="deletedata" class="btn btn-primary">Yes</button>
                </div>
            </form>

        </div>
    </div>
</div>

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