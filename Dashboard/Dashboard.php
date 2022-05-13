<?php
    $title = 'Dashboard - FSMS';
    $content_title = "Dashboard";
    function breadcrumb(){
        echo '<li class="breadcrumb-item active">Dashboard</li>';
    }
    $childView = '_dashboard.php';
    include('../shared_layout.php');
?>