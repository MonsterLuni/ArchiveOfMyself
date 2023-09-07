<?php
require 'repository\Video_Repository.php';
$id = $_POST['id'];
$operator = $_POST['operator'];
var_dump($id);
var_dump($operator);
//TODO: Einfügen, dass User_id vom user kommt.
video_review($id,$operator,1);
