<?php
    $title = 'Products - FSMS';
    $content_title = "Edit Products";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Products</li>';
        echo '<li class="breadcrumb-item active">Edit</li>';
    }
    $childView = '_product-Edit.php';
    include('../shared_layout.php');
?>