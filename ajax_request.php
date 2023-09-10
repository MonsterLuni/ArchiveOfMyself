<?php
require 'repository\Video_Repository.php';
$id = $_POST['id'];
$operator = $_POST['operator'];
$type = $_POST['type'];
var_dump($id);
var_dump($operator);
//TODO: Einfügen, dass User_id vom user kommt.
if($type == "video"){
    video_review($id,$operator,1);
}
elseif($type == "comment"){
    var_dump("HIER HIN BIN ICH GEKOMMEN");
    comment_review($id,$operator,1);
}



