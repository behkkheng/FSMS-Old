<?php
    $title = 'Monthly Sales Report - FSMS';
    $content_title = "Monthly Sales Report Details";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Monthly Sales Report</li>';
        echo '<li class="breadcrumb-item active">Detail</li>';
    }
    $childView = '_monthlyReport-Detail.php';
    include('../shared_layout.php');
?>