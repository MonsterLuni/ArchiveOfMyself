<?php
require 'repository\Video_Repository.php';
$site = $_POST['site'];
//TODO: Einfügen, dass User_id vom user kommt.
if($site == "videos"){
    $id = $_POST['id'];
    $operator = $_POST['operator'];
    $type = $_POST['type'];
    if($type == "video"){
        video_review($id,$operator,1);
    }
    elseif($type == "comment"){
        comment_review($id,$operator,1);
    }
}
elseif($site == "profile"){
    $type = $_POST['type'];
    if($type == "login"){
        var_dump("LOGIN");
        header("Location: http://localhost/ArchiveOfMyself/login");
        exit();
    }
    else{
        var_dump("REGISTER");
        header("Location: http://localhost/ArchiveOfMyself/register");
        exit();
    }
}




