<?php
    $title = 'Customer - FSMS';
    $content_title = "Customer";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Dashboard</li>';
        echo '<li class="breadcrumb-item active">Customer</li>';
    }
    $childView = '_customer-Index.php';
    include('../shared_layout.php');
?>