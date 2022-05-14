<?php
    $title = 'User - FSMS';
    $content_title = "Create Product";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Product</li>';
        echo '<li class="breadcrumb-item active">Create</li>';
    }
    $childView = '_product-Create.php';
    include('../shared_layout.php');
?>