<?php
    $title = 'User - FSMS';
    $content_title = "User Edit";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">User</li>';
        echo '<li class="breadcrumb-item active">Edit</li>';
    }
    $childView = '_user-Edit.php';
    include('../shared_layout.php');
?>