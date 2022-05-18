<?php
    $title = 'Customer - FSMS';
    $content_title = "Customer Detail";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Customer</li>';
        echo '<li class="breadcrumb-item active">Detail</li>';
    }
    $childView = '_customer-Detail.php';
    include('../shared_layout.php');
?>