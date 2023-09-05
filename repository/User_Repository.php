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
function verify(){
}
function add_user($username,$description,$image){
    global $conn;
    $query = $conn->query("INSERT INTO `user`(`username`, `description`, `image`) VALUES ('{$username}','{$description}','{$image}')");
    return true;
}
function get_user($id){
    global $conn;
    $query = $conn->query("SELECT * FROM `user` WHERE {$id}");
    return $query->fetch_all();
}