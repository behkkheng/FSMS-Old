<?php
    $title = 'Quotation - FSMS';
    $content_title = "Create Quotation";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Quotation</li>';
        echo '<li class="breadcrumb-item active">Create</li>';
    }
    $childView = '_Quotation-Create.php';
    include('../shared_layout.php');
?>