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
                                    <div class="form-group col-md-12">
                                        <label for="hpNo">H/P No</label>
                                        <input type="text" class="form-control" id="hpNo" value="<?= $customer["hpNo"]; ?>" name="hpNo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Address</label>
                                    <textarea class="form-control" id="inputAddress" rows="3" name="address"><?= $customer["address"]; ?></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">City</label>
                                        <input type="text" class="form-control" id="inputCity" value="<?= $customer["city"]; ?>" name="city">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">State</label>
                                        <select id="inputState" class="custom-select" value="<?= $customer["state"]; ?>" name="state">
                                        <option selected value="">Choose...</option>
                                            <option value="Kedah" <?php if ($customer["state"] == 'Kedah') echo ' selected="selected"'; ?>>Kedah</option>
                                            <option value="Penang" <?php if ($customer["state"] == 'Penang') echo ' selected="selected"'; ?>>Penang</option>
                                            <option value="Kelantan" <?php if ($customer["state"] == 'Kelantan') echo ' selected="selected"'; ?>>Kelantan</option>
                                            <option value="Perak" <?php if ($customer["state"] == 'Perak') echo ' selected="selected"'; ?>>Perak</option>
                                            <option value="Pahang" <?php if ($customer["state"] == 'Pahang') echo ' selected="selected"'; ?>>Pahang</option>
                                            <option value="Melaka" <?php if ($customer["state"] == 'Melaka') echo ' selected="selected"'; ?>>Melaka</option>
                                            <option value="Selangor" <?php if ($customer["state"] == 'Selangor') echo ' selected="selected"'; ?>>Selangor</option>
                                            <option value="Terengganu" <?php if ($customer["state"] == 'Terengganu') echo ' selected="selected"'; ?>>Terengganu</option>
                                            <option value="Johor" <?php if ($customer["state"] == 'Johor') echo ' selected="selected"'; ?>>Johor</option>
                                            <option value="Perlis" <?php if ($customer["state"] == 'Perlis') echo ' selected="selected"'; ?>>Perlis</option>
                                            <option value="Sarawak" <?php if ($customer["state"] == 'Sarawak') echo ' selected="selected"'; ?>>Sarawak</option>
                                            <option value="Sabah" <?php if ($customer["state"] == 'Sabah') echo ' selected="selected"'; ?>>Sabah</option>
                                            <option value="Kuala Lumpur" <?php if ($customer["state"] == 'Kuala Lumpur') echo ' selected="selected"'; ?>>Kuala Lumpur</option>
                                            <option value="Putrajaya" <?php if ($customer["state"] == 'Putrajaya') echo ' selected="selected"'; ?>>Putrajaya</option>
                                            <option value="Labuan" <?php if ($customer["state"] == 'Labuan') echo ' selected="selected"'; ?>>Labuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPostcode">Postcode</label>
                                        <input type="text" class="form-control" id="inputPostcode" value="<?= $customer["postcode"]; ?>" name="postcode">
                                    </div>
                                </div>
                                <input type="hidden" name="customer_id" value="<?= $customer['customerID']; ?>">
                                <button type="submit" class="btn btn-primary" name="update">Save</button>
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