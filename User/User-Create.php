<?php
    $title = 'User - FSMS';
    $content_title = "Create User";
    function breadcrumb(){
        echo '<li class="breadcrumb-item">User</li>';
        echo '<li class="breadcrumb-item active">Create</li>';
    }
    $childView = '_user-Create.html';
    include('../shared_layout.php');
?>