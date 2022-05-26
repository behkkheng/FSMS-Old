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

                        $productID = mysqli_real_escape_string($con, $_GET['id']);;
                        $query = "SELECT * FROM product WHERE productID = '$productID' ";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $product = mysqli_fetch_assoc($query_run);
                    ?>
                            <form class="needs-validation" novalidate method="post" action="other_product_func.php" enctype="multipart/form-data">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $product["name"]; ?>" required>
                                        <div class="invalid-feedback">Name field is required.</div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" class="form-control" id="quantity" value="<?= $product["quantity"]; ?>" name="quantity" required>
                                        <div class="invalid-feedback">Quantity is required.</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">RM</span>
                                        <input type="text" class="form-control" id="price" name="price" value="<?= $product["price"]; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                    </div>
                                    <div class="invalid-feedback">Price is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="desc" rows="3"><?= $product["description"]; ?></textarea>
                                </div>

                                <label for="image">Image</label>
                                <div class="input-group mb-3">

                                    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js" async></script>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            bsCustomFileInput.init()
                                        })
                                    </script>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>

                                <input type="hidden" value="<?= $product["productID"]; ?>" name="id">

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
<!-- /.content -->