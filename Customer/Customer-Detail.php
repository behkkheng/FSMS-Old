<?php
    $title = 'Customer - FSMS';
    $content_title = "Customer Detail";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Customer</li>';
        echo '<li class="breadcrumb-item active">Detail</li>';
    }
    $childView = '_customer-Detail.php';
    include('../shared_layout.php');
?>