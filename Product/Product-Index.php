<?php
    $title = 'Products - FSMS';
    $content_title = "Products";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Dashboard</li>';
        echo '<li class="breadcrumb-item active">Products</li>';
    }
    $childView = '_Product-Index.php';
    include('../shared_layout.php');
?>