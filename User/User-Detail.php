<?php
    $title = 'User - FSMS';
    $content_title = "User Detail";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">User</li>';
        echo '<li class="breadcrumb-item active">Detail</li>';
    }
    $childView = '_user-Detail.php';
    include('../shared_layout.php');
?>