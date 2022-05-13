<?php
    $title = 'Products - FSMS';
    $content_title = "Edit Products";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Products</li>';
        echo '<li class="breadcrumb-item active">Edit</li>';
    }
    $childView = '_product-Edit.php';
    include('../shared_layout.php');
?>