<?php
$_SESSION['invoice_customerID'] = "";
$connection = mysqli_connect("localhost", "root", "", "fsms");
?>
<section>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">

                    <?php
                    $get_product_quantity = "SELECT SUM(quantity) FROM product";
                    $run_query = mysqli_query($connection, $get_product_quantity);
                    $product_quantity = mysqli_fetch_assoc($run_query);
                    $quantity = $product_quantity['SUM(quantity)'];

                    ?>
                    <h3><?php echo $quantity; ?></h3>

                    <p>Stocks in warehouse</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <?php
                    $get_customer_quantity = "SELECT COUNT(customerID) FROM customer";
                    $run_query = mysqli_query($connection, $get_customer_quantity);
                    $customer_quantity = mysqli_fetch_assoc($run_query);
                    $quantity = $customer_quantity['COUNT(customerID)'];
                    ?>
                    <h3><?php echo $quantity; ?></h3>

                    <p>Number of customer</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner text-white">
                    <?php
                    $get_employee_quantity = "SELECT COUNT(employeeID) FROM employee";
                    $run_query = mysqli_query($connection, $get_employee_quantity);
                    $employee_quantity = mysqli_fetch_assoc($run_query);
                    $quantity = $employee_quantity['COUNT(employeeID)'];
                    ?>
                    <h3><?php echo $quantity; ?></h3>

                    <p>Number of users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <?php
                    $get_invoice_quantity = "SELECT COUNT(invoiceID) FROM invoice";
                    $run_query = mysqli_query($connection, $get_invoice_quantity);
                    $invoice_quantity = mysqli_fetch_assoc($run_query);
                    $quantity = $invoice_quantity['COUNT(invoiceID)'];
                    ?>
                    <h3><?php echo $quantity; ?></h3>

                    <p>Number of invoice</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
</section>


<div class="card">
<div class="card-header">
    <h4 class="mt-1">Featured Furniture Today</h4>
  </div>
    <div class="card-body">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/FSMS/images/amazon-rivet-furniture-1533048038.webp" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/FSMS/images/617iX+rY6pL._SX425_.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/FSMS/images/sofa_ct.png" class="d-block w-100" alt="">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </div>
</div>