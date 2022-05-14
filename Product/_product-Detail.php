<div class="card">
    <div class="card-body">
        <dl class="row">
            <div class="col-12 col-sm-6">
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

                $sql = "SELECT * FROM product WHERE productID = $id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = mysqli_fetch_array($result);
                    // output data of each row
                    echo '
                <h3 class="d-inline-block d-sm-none">
                ' . $row["name"] . '
                </h3>
                <div class="col-12">';
                    echo '<img class="img-thumbnail" src="' . $row["productPath"] . '"/>

                </div>
                
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3">' . $row["name"] . '</h3>
                <p>' . $row["description"] . '</p>

                <hr>

                <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">' . $row["price"] . '</h2>
                </div>';
                } else {
                    echo "0 results";
                }
                ?>

                <div class="row">
                    <form action="\FSMS\Product\Product-Edit.php" method="get">
                        <input type="hidden" value="<?php echo $row['productID']; ?>" name="id">
                        <button type="submit" class="btn btn-info btn-sm m-1 editbtn"><i class="fas fa-pencil-alt"></i> Edit </button>
                    </form>

                    <form>
                        <input type="hidden" value="<?php echo $row["productID"]; ?>" name="id">
                        <button type="button" class="btn btn-danger deletebtn btn-sm m-1"><i class="fas fa-trash"></i> Delete </button>
                    </form>
                </div>

            </div>

        </dl>



    </div>

</div>



<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: bold;" class="modal-title" id="exampleModalLabel"> Delete Product Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="other_product_func.php" method="POST">

                <div class="modal-body">

                    <input type="hidden" name="delete_id" id="delete_id">

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