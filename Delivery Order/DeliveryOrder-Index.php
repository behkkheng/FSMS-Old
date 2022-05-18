<?php
    $title = 'Delivery Order - FSMS';
    $content_title = "Delivery Order";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Dashboard</li>';
        echo '<li class="breadcrumb-item active">Delivery Order</li>';
    }
    $childView = '_deliveryOrder-Index.php';
    include('../shared_layout.php');
?>