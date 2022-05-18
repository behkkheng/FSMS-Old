<?php
$connection = new mysqli("localhost", "root", "", "fsms");
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <form class="needs-validation" novalidate method="post" action="">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">Name field is required.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="hpNo">H/P No</label>
                                <input type="text" class="form-control" id="hpNo" name="hpNo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <textarea class="form-control" id="inputAddress" rows="3" name="address"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity" name="city">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="custom-select" name="state">
                                    <option selected value="">Choose...</option>
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
                                <input type="text" class="form-control" id="inputPostcode" name="postcode">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right" name="createCustomer"><i class="bi bi-person-plus-fill"></i> Create</button>
                    </form>
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
<!-- /.content -->

<?php
if(isset($_POST['createCustomer'])){
    $name = $_POST['name'];
    $hpNo = $_POST['hpNo'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $state = $_POST['state'];

    $create_customer_query = "INSERT INTO `customer` (`name`, `hpNo`, `address`, `city`, `state`, `postcode`) VALUES ('$name', '$hpNo', '$address', '$city', '$state', '$postcode')";
    $run_query = mysqli_query($connection, $create_customer_query);
    if ($run_query) {
        echo("<script>location.href = 'Customer-Index.php';</script>");
        exit;
    } else {
        echo "Error when create new customer";
    }
}
?>