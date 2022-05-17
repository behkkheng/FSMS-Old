<?php
    $title = 'Customer - FSMS';
    $content_title = "Create Customer";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Customer</li>';
        echo '<li class="breadcrumb-item active">Create</li>';
    }
    $childView = '_customer-Create.php';
    include('../shared_layout.php');
?>