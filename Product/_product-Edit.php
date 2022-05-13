<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <?php
                        if(isset($_GET["id"])){
                            

                            $dbhost = "localhost";
                            $dbuser = "root";
                            $dbpassword = "";
                            $dbname = "fsms";

                            if (!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
                            {
                                die("Failed to connect the database.");
                            }

                            $employeeID = mysqli_real_escape_string($con, $_GET['id']);;
                            $query = "SELECT * FROM employee WHERE employeeID = '$employeeID' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $employee = mysqli_fetch_assoc($query_run);
                        ?>
                    <form class="needs-validation"
                          novalidate
                          method="post"
                          action="create user.php">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Name</label>
                                <input type="text"
                                       class="form-control"
                                       id="name"
                                       name="name"
                                       value="<?= $employee["name"]; ?>"
                                       required>
                                <div class="invalid-feedback">Name field is required.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="hpNo">H/P No</label>
                                <input type="text"
                                       class="form-control"
                                       id="hpNo"
                                       value="<?= $employee["hpNo"]; ?>"
                                       name="hpNo">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text"
                                       class="form-control"
                                       id="username"
                                       name="username"
                                       value="<?= $employee["username"]; ?>"
                                       required>
                                <div class="invalid-feedback">Username field is required.</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Password</label>
                                <input type="password"
                                       class="form-control"
                                       id="inputPassword4"
                                       name="password"
                                       required>
                                <div class="invalid-feedback">Password field is required.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <textarea class="form-control"
                                      id="inputAddress"
                                      rows="3"
                                      value="<?= $employee["address"]; ?>"
                                      name="address"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">City</label>
                                <input type="text"
                                       class="form-control"
                                       id="inputCity"
                                       value="<?= $employee["city"]; ?>"
                                       name="city">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState"
                                        class="custom-select"
                                        value="<?= $employee["state"]; ?>"
                                        name="state">
                                    <option selected
                                            value="">Choose...</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Melaka">Melaka</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Putrajaya">Putrajaya</option>
                                    <option value="Labuan">Labuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPostcode">Postcode</label>
                                <input type="text"
                                       class="form-control"
                                       id="inputPostcode"
                                       value="<?= $employee["postcode"]; ?>"
                                       name="postcode">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="role">Roles</label>
                                <select id="role"
                                        class="custom-select"
                                        name="role"
                                        value="<?= $employee["role"]; ?>"
                                        required>
                                    <option selected
                                            value="">Choose...</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Manager">Manager</option>
                                </select>
                                <div class="invalid-feedback">Please select a role.</div>
                            </div>
                        </div>
                        <button type="submit"
                                class="btn btn-primary">Save</button>
                    </form>
                    <?php
                        }
                        else
                        {
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
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
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