<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users - FSMS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../lib/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../lib/jquery-ui-1.13.0.custom/jquery-ui.min.css" />
    <link rel="stylesheet" href="../lib/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="../css/site.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">

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
            <a href="@Url.Action("Index", "Home")" class="brand-link">
                <img src="../images/logo.png" alt="Prototype Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">FSMS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../images/avatar5.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="@Url.Action("Index", "Home")" class="nav-link @(ViewContext.RouteData.Values["Controller"].ToString() == "Home" ? "active" : "")">
                                <p>
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item @(ViewContext.RouteData.Values["Controller"].ToString() == "Quotation" || ViewContext.RouteData.Values["Controller"].ToString() == "Invoice" || ViewContext.RouteData.Values["Controller"].ToString() == "DeliveryOrder" || ViewContext.RouteData.Values["Controller"].ToString() == "Account" || ViewContext.RouteData.Values["Controller"].ToString() == "SalesReport" ? "menu-open" : "")">
                            <a href="#" class="nav-link @(ViewContext.RouteData.Values["Controller"].ToString() == "Quotation" || ViewContext.RouteData.Values["Controller"].ToString() == "Invoice" || ViewContext.RouteData.Values["Controller"].ToString() == "DeliveryOrder" || ViewContext.RouteData.Values["Controller"].ToString() == "Account" ? "active" : "")">
                                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                <p>
                                    Accounting
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="@Url.Action("Index", "Quotation")" class="nav-link @(ViewContext.RouteData.Values["Controller"].ToString() == "Quotation" ? "active" : "")">
                                        <i class="ml-4 fas fa-file-contract nav-icon"></i>
                                        <p>Quotation</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="@Url.Action("Index", "Invoice")" class="nav-link @(ViewContext.RouteData.Values["Controller"].ToString() == "Invoice" ? "active" : "")">
                                        <i class="ml-4 fas fa-file-invoice nav-icon"></i>
                                        <p>Invoice</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="@Url.Action("Index", "DeliveryOrder")" class="nav-link @(ViewContext.RouteData.Values["Controller"].ToString() == "DeliveryOrder" ? "active" : "")">
                                        <i class="ml-4 fas fa-shuttle-van nav-icon"></i>
                                        <p>Delivery Order</p>
                                    </a>
                                </li>
                                <li class="nav-item pointer">
                                    <a data-target="#sales-modal" data-toggle="modal" class="nav-link @(ViewContext.RouteData.Values["Controller"].ToString() == "SalesReport" ? "active" : "")">
                                        <i class="ml-4 nav-icon fas fa-file-alt"></i>
                                        <p>
                                            Sales Reports
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="@Url.Action("Index", "Stocks")" class="nav-link @(ViewContext.RouteData.Values["Controller"].ToString() == "Stocks" ? "active" : "")">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>
                                    Products
                                </p>
                            </a>
                        </li>
                        <li class="nav-item pointer">
                            <a data-target="#user-modal" data-toggle="modal" class="nav-link @(ViewContext.RouteData.Values["Controller"].ToString() == "User" ? "active" : "")">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@Url.Action("Logout", "User")" class="nav-link">
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                    

                            <h1 class="m-0 ml-2 col">Users</h1>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!--Content-->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6 offset-md-6">
                                        <a class="btn btn-primary float-right" href="User-Create.html" role="button">New User</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "fsms";

                            // Create connection
                            $connection = new mysqli($servername, $username, $password, $dbname);

                            $query = "SELECT * FROM employee";
                            $query_run = mysqli_query($connection, $query);
                            ?>
                                <table id="datatableid" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"> ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">  </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if($query_run)
                                    {
                                        foreach($query_run as $row)
                                        {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td> <?php echo $row['employeeID']; ?> </td>
                                            <td> <?php echo $row['name']; ?> </td>
                                            <td> <?php echo $row['username']; ?> </td>
                                            <td> <?php echo $row['role']; ?> </td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-primary btn-sm m-1 viewbtn"><i class="fas fa-folder"></i> View </button>
                                            
                                                <button type="button" class="btn btn-info btn-sm m-1 editbtn"><i class="fas fa-pencil-alt"></i> Edit </button>
                                            
                                                <button type="button" class="btn btn-danger deletebtn btn-sm m-1"><i class="fas fa-trash"></i> Delete </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php           
                                }
                            }
                            else 
                            {
                                echo "No Record Found";
                            }
                        ?>

                <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel"> Delete Employee Data </h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="delete user.php" method="POST">

                                <div class="modal-body">

                                    <input type="hidden" name="delete_id" id="delete_id delete_name">

                                    <h5 class="text-center"> Are you sure want to delete</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                                    <button type="submit" name="deletedata" class="btn btn-primary">Yes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->

    



    

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
                    <a class="btn btn-primary" href="@Url.Action("Index", "User")">Ok</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../lib/jquery/dist/jquery.min.js"></script>
    <script src="../lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/jquery-ui-1.13.0.custom/jquery-ui.min.js"></script>
    <script src="../js/adminlte.min.js"></script>
    <script src="../lib/sweetalert2/sweetalert2.min.js"></script>
    <script src=".js/site.js" asp-append-version="true"></script>

    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);
                $('#delete_name').val(data[1]);
            });
        });
    </script>

    <!--Footer-->
    <footer class="main-footer no-print">
        <div class="container">
            &copy; 2022 - FSMS - <a href= #>Privacy</a>
        </div>
    </footer>
</body>
</html>
