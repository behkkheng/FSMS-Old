<?php
    $title = 'Invoice - FSMS';
    $content_title = "Invoice";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Dashboard</li>';
        echo '<li class="breadcrumb-item active">Invoice</li>';
    }
    $childView = '_Invoice-Index.php';
    include('../shared_layout.php');
?>