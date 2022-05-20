<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <?php
                    if (isset($_GET["id"])) {


                        $dbhost = "localhost";
                        $dbuser = "root";
                        $dbpassword = "";
                        $dbname = "fsms";

                        if (!$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname)) {
                            die("Failed to connect the database.");
                        }

                        $customerID = mysqli_real_escape_string($con, $_GET['id']);;
                        $query = "SELECT * FROM customer WHERE customerID = '$customerID' ";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $customer = mysqli_fetch_assoc($query_run);
                    ?>
                            <form class="needs-validation" novalidate method="post" action="other_customer_func.php">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $customer["name"]; ?>" required>
                                        <div class="invalid-feedback">Name field is required.</div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="hpNo">H/P No</label>
                                        <input type="text" class="form-control" id="hpNo" value="<?= $customer["hpNo"]; ?>" name="hpNo">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" value="<?= $customer["email"]; ?>" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Address</label>
                                    <textarea class="form-control" id="inputAddress" rows="3" name="address"><?= $customer["address"]; ?></textarea>
                                </div>
                                
                                <input type="hidden" name="customer_id" value="<?= $customer['customerID']; ?>">
                                <button type="submit" class="btn btn-success float-right" name="update"><i class="fas fa-save"></i> Save</button>
                            </form>
                    <?php
                        } else {
                            echo "<h4>No Such Id Found</h4>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

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