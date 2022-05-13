<?php
    $title = 'User - FSMS';
    $content_title = "User";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">Dashboard</li>';
        echo '<li class="breadcrumb-item active">User</li>';
    }
    $childView = '_User-Index.php';
    include('../shared_layout.php');
?>