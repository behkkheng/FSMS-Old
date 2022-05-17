<?php
    $title = 'Invoice - FSMS';
    $content_title = "Invoice";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Invoice</li>';
        echo '<li class="breadcrumb-item active">Edit</li>';
    }
    $childView = '_invoice-Edit.php';
    include('../shared_layout.php');
?>