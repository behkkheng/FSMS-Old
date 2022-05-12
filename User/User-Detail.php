<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Privacy - AAASCR</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="lib/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="lib/jquery-ui-1.13.0.custom/jquery-ui.min.css" />
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="css/site.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini">
    <header>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

  
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="home.php" class="brand-link">
                <img src="images/logo.png" alt="Prototype Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">FSMS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="images/avatar5.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block"><?php echo $_SESSION["name"]; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="home.php" class="nav-link">
                                <p>
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                <p>
                                    Accounting
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="ml-4 fas fa-file-contract nav-icon"></i>
                                        <p>Quotation</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="ml-4 fas fa-file-invoice nav-icon"></i>
                                        <p>Invoice</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="ml-4 fas fa-shuttle-van nav-icon"></i>
                                        <p>Delivery Order</p>
                                    </a>
                                </li>
                                <li class="nav-item pointer">
                                    <a data-target="#sales-modal" data-toggle="modal" class="nav-link">
                                        <i class="ml-4 nav-icon fas fa-file-alt"></i>
                                        <p>
                                            Sales Reports
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>
                                    Products
                                </p>
                            </a>
                        </li>
                        <li class="nav-item pointer">
                            <a data-target="#user-modal" data-toggle="modal" class="nav-link">
                                <p>
                                <i class="nav-icon fas fa-user"></i>
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Log Out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-2">
                                Name
                            </dt>
                            <?php
                                $id = $_POST['id'];

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
                                echo'<dd class="col-sm-10">@Html.DisplayFor(model => model.Username)</dd>
                                <dt class="col-sm-2">Username</dt>
                                <dd class="col-sm-10">'.$row["name"].'</dd>
                                <dt class="col-sm-2">Handphone Number</dt>
                                <dd class="col-sm-10">'.$row["hpNo"].'</dd>
                                <dt class="col-sm-2">Address</dt>
                                <dd class="col-sm-10">'.$row["address"].'</dd>
                                <dt class="col-sm-2">City</dt>
                                <dd class="col-sm-10">'.$row["city"].'</dd>
                                <dt class="col-sm-2">State</dt>
                                <dd class="col-sm-10">'.$row["state"].'</dd>
                                <dt class="col-sm-2">Postcode</dt>
                                <dd class="col-sm-10">'.$row["postcode"].'</dd>
                                <dt class="col-sm-2">Role</dt>
                                <dd class="col-sm-10">'.$row["role"].'</dd>';
                                
                                } else {
                                echo "0 results";
                                }
                                $conn->close();
                                ?>

                            
                        </dl>
                    </div>
                
                    <div class="m-3">
                        <a href="@Url.Action("Edit")" class="btn btn-primary">
                            <i class="fas fa-pen fa-lg mr-2"></i>
                            User Details
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteModal">
                            <i class="fas fa-trash">
                            </i>
                            Delete User
                        </button>
                    </div>
                </div>
                
                <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Warning!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span>Are you sure you want to delete admin?</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <a id="ok-btn" class="btn btn-danger" href="@Url.Action("Index", new { delete = "yes" })">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content -->


    <footer class="main-footer no-print">
        <div class="container">
            &copy; 2022 - FSMS - <a href="privacy.html">Privacy</a>
        </div>
    </footer>

    <div class="modal fade" id="sales-modal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Warning!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Access Denied</span><br />
                    <span>Only Manager allowed to access.</span>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="@Url.Action("Index", "SalesReport")">Ok</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Warning!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Access Denied</span><br />
                    <span>Only Manager allowed to access.</span>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="User/User-Index.php">Ok</a>
                </div>
            </div>
        </div>
    </div>

    <script src="lib/jquery/dist/jquery.min.js"></script>
    <script src="lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/jquery-ui-1.13.0.custom/jquery-ui.min.js"></script>
    <script src="js/adminlte.min.js"></script>
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <script src=".js/site.js" asp-append-version="true"></script>
</body>
</html>
