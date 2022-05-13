<?php
    $title = 'Privacy - FSMS';
    $content_title = "Privacy";
    function breadcrumb(){
        echo '<li class="breadcrumb-item active">Privacy</li>';
    }
    $childView = 'Privacy/_privacy.html';
    include('../shared_layout.php');
?>