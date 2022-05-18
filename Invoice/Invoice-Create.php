<?php
    $title = 'Invoice - FSMS';
    $content_title = "Create Invoice";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Invoice</li>';
        echo '<li class="breadcrumb-item active">Create</li>';
    }
    $childView = '_Invoice-Create.php';
    include('../shared_layout.php');
?>