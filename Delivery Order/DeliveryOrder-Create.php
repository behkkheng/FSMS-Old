<?php
    $title = 'Delivery Order - FSMS';
    $content_title = "Create Delivery Order";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Delivery Order</li>';
        echo '<li class="breadcrumb-item active">Create</li>';
    }
    $childView = '_deliveryOrder-Create.php';
    include('../shared_layout.php');
?>