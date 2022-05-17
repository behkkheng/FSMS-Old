<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>

    <!--Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/FSMS/lib/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../lib/jquery-ui-1.13.0.custom/jquery-ui.min.css" />
    <link rel="stylesheet" href="../lib/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="../css/site.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">

    <!--Bootstrap CDN-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">


</head>

<body class="hold-transition sidebar-mini">

    <!--script-->

    <script src="../lib/jquery/dist/jquery.min.js" async></script>
    <script src="../lib/jquery-ui-1.13.0.custom/jquery-ui.min.js" async></script>
    <script src="../js/adminlte.min.js" async></script>
    <script src="../lib/sweetalert2/sweetalert2.min.js" async></script>
    <script src="../lib/bootstrap/dist/js/bootstrap.bundle.min.js" async></script>

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
                <img src="../images/logo.png" alt="Prototype Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">FSMS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../images/avatar5.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block"><?php echo $_SESSION["name"]; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="/FSMS/Dashboard/Dashboard.php" class="nav-link">
                                <p>
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    Dashboard
                                </p>
                            </a>
                            <table>
                                <?php
                                echo "Session";
                                foreach ($_SESSION as $key => $value) {
                                    echo "<tr style='color:white;'>";
                                    echo "<td style='color:white;'>";
                                    echo $key;
                                    echo "</td>";
                                    echo "<td style='color:white;'>";
                                    echo $value;
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
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
                                    <a href="/FSMS/Invoice/Invoice-Index.php" class="nav-link">
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
                                        <p>Sales Reports</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/FSMS/Product/Product-Index.php" class="nav-link">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>Products</p>
                            </a>
                            <table>
                                <?php


                                foreach ($_POST as $key => $value) {
                                    echo "Post";
                                    echo "<tr style='color:white;'>";
                                    echo "<td style='color:white;'>";
                                    echo $key;
                                    echo "</td>";
                                    echo "<td style='color:white;'>";
                                    echo $value;
                                    echo "</td>";
                                    echo "</tr>";
                                }


                                ?>
                            </table>
                        </li>

                        <?php
                        if ($_SESSION['role'] == "Manager") {
                            echo '<li class="nav-item pointer">
                                <a href="/FSMS/User/User-Index.php" class="nav-link">
                                    <p>
                                        <i class="nav-icon fas fa-user"></i>
                                        User
                                    </p>
                                </a>
                            </li>';
                        } else {
                            echo '<li class="nav-item pointer">
                                <a data-target="#user-modal" data-toggle="modal" class="nav-link">
                                    <p>
                                        <i class="nav-icon fas fa-user"></i>
                                        User
                                    </p>
                                </a>
                            </li>';
                        }
                        ?>

                        <li class="nav-item pointer">
                            <a href="/FSMS/Customer/Customer-Index.php" class="nav-link">
                                <p>
                                    <i class="nav-icon fas fa-user-edit"></i>
                                    Customer
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/FSMS/logout_func.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Log Out
                                </p>
                            </a>
                            <table>
                                <?php

                                echo "Get";
                                foreach ($_GET as $key => $value) {
                                    echo "<tr style='color:white;'>";
                                    echo "<td style='color:white;'>";
                                    echo $key;
                                    echo "</td>";
                                    echo "<td style='color:white;'>";
                                    echo $value;
                                    echo "</td>";
                                    echo "</tr>";
                                }


                                ?>
                            </table>
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
                        <button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>
                            <h1 class="m-0 ml-2 col mt-2" style="font-weight: bold;"><?php echo $content_title; ?></h1>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <?php
                            breadcrumb();
                            ?>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="content">
            <div class="container-fluid">

                <!--Content-->
                <?php include($childView); ?>

            </div>
        </div>

    </div>

    <footer class="main-footer no-print">
        <div class="container">
            &copy; 2022 - FSMS - <a href="/FSMS/Privacy/Privacy.php">Privacy</a>
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
                    <a class="btn btn-primary" href="@Url.Action(" Index", "SalesReport" )">Ok</a>
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
                    <a class="btn btn-primary" data-dismiss="modal" class="close" style="color:white">Ok</a>
                </div>
            </div>
        </div>
    </div>


</body>

</html>