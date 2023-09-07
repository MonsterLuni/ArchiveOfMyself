<?php
// 5 == comments, 6 == videos
$servername = "localhost";
$username = "root";
$password = "";
$database = "ArchiveOfMyself";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function get_intermediary($user_id, $video_id): array{
    global $conn;
    $query = $conn->query("SELECT * FROM `user_intermediary_video` WHERE `fk_video_id` LIKE $video_id AND `fk_user_id` LIKE $user_id");
    return $query->fetch_all();
}
function add_intermediary($user_id, $video_id): bool{
    global $conn;
    $conn->query("INSERT INTO `user_intermediary_video`(`fk_user_id`, `fk_video_id`) VALUES ('$user_id','$video_id')");
    return true;
}

function delete_intermediary($user_id, $video_id): bool{
    global $conn;
    $conn->query("DELETE FROM `user_intermediary_video` WHERE `fk_video_id` LIKE $video_id AND `fk_user_id` LIKE $user_id");
    return true;
}

//function get_intermediary(){}