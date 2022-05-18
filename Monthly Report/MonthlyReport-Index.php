<?php
    $title = 'Monthly Sales Report - FSMS';
    $content_title = "Monthly Sales Report";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Dashboard</li>';
        echo '<li class="breadcrumb-item active">Monthly Sales Report</li>';
    }
    $childView = '_monthlyReport-Index.php';
    include('../shared_layout.php');
?>