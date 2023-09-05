<?php
require 'repository\Video_Repository.php';
var_dump($_POST['id']);
var_dump($_POST['operator']);
video_review($_POST['id'],$_POST['operator']);