<?php
    $title = 'Privacy - FSMS';
    $content_title = "Privacy";
    function back_button(){
        echo '<button type="button" class="btn btn-danger btn-lg ml-3" onclick="history.back();"><i class="bi bi-arrow-left-circle-fill"></i></button>';
    }
    function breadcrumb(){
        echo '<li class="breadcrumb-item active">Privacy</li>';
    }
    $childView = 'Privacy/_privacy.html';
    include('../shared_layout.php');
?>