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

                        $employeeID = mysqli_real_escape_string($con, $_GET['id']);;
                        $query = "SELECT * FROM employee WHERE employeeID = '$employeeID' ";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $employee = mysqli_fetch_assoc($query_run);
                    ?>
                            <form class="needs-validation" novalidate method="post" action="other_user_func.php">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $employee["name"]; ?>" required>
                                        <div class="invalid-feedback">Name field is required.</div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="hpNo">H/P No</label>
                                        <input type="text" class="form-control" id="hpNo" value="<?= $employee["hpNo"]; ?>" name="hpNo">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" value="<?= $employee["email"]; ?>" name="email" aria-describedby="emailHelp">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $employee["username"]; ?>" required>
                                        <div class="invalid-feedback">Username field is required.</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Password</label>
                                        <input type="password" class="form-control" id="inputPassword4" name="password" required>
                                        <div class="invalid-feedback">Password field is required.</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Address</label>
                                    <textarea class="form-control" id="inputAddress" rows="3" name="address"><?= $employee["address"]; ?></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="role">Roles</label>
                                        <select id="role" class="custom-select" name="role" value="<?= $employee["role"]; ?>" required>
                                            <option selected value="">Choose...</option>
                                            <option value="Staff" <?php if ($employee["role"] == 'Staff') echo ' selected="selected"'; ?>>Staff</option>
                                            <option value="Manager" <?php if ($employee["role"] == 'Manager') echo ' selected="selected"'; ?>>Manager</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a role.</div>
                                    </div>
                                </div>
                                <input type="hidden" name="employee_id" value="<?= $employee['employeeID']; ?>">
                                <button type="submit" class="btn btn-success float-right" name="update"><i class="fas fa-save"></i> Save</button>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
                        } else {
                            echo "<h4>No Such Id Found</h4>";
                        }
                    }
?>
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