<?php
require 'repository\Video_Repository.php';
session_start();
var_dump("ICH WAR HIER");
$site = $_POST['site'];
if($site == "videos"){
    $id = $_POST['id'];
    $operator = $_POST['operator'];
    $type = $_POST['type'];
    if($type == "video"){
        video_review($id,$operator,$_SESSION['loggedInUser'][3]);
    }
    elseif($type == "comment"){
        comment_review($id,$operator,$_SESSION['loggedInUser'][3]);
    }
}
elseif($site == "profile"){
    $type = $_POST['type'];
    if($type == "login"){
        var_dump("LOGIN");
        echo "<script>location.href='./login'</script>";
        exit();
    }
    else{
        var_dump("REGISTER");
        echo "<script>location.href='./register'</script>";
        exit();
    }
}




