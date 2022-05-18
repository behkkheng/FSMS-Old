<?php
    $title = 'User - FSMS';
    $content_title = "User Edit";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item">User</li>';
        echo '<li class="breadcrumb-item active">Edit</li>';
    }
    $childView = '_user-Edit.php';
    include('../shared_layout.php');
?>