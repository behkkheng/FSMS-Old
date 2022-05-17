<?php
    $title = 'Invoice - FSMS';
    $content_title = "Create Invoice";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Invoice</li>';
        echo '<li class="breadcrumb-item active">Create</li>';
    }
    $childView = '_Invoice-Create.php';
    include('../shared_layout.php');
?>