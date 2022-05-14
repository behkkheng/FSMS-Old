<?php
    $title = 'Products - FSMS';
    $content_title = "Products Detail";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Products</li>';
        echo '<li class="breadcrumb-item active">Detail</li>';
    }
    $childView = '_product-Detail.php';
    include('../shared_layout.php');
?>