<?php
    $title = 'Invoice - FSMS';
    $content_title = "Invoice";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Invoice</li>';
        echo '<li class="breadcrumb-item active">Details</li>';
    }
    $childView = '_invoice-Detail.php';
    include('../shared_layout.php');
?>