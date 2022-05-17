<?php
    $title = 'Customer - FSMS';
    $content_title = "Edit Customer";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Customer</li>';
        echo '<li class="breadcrumb-item active">Edit</li>';
    }
    $childView = '_customer-Edit.php';
    include('../shared_layout.php');
?>