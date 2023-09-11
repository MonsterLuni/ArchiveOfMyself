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

if(isset($_POST['description'])){
    session_start();
    add_user($_POST['username'],$_POST['description'],"bild.png",$_POST['password']);
    $user = get_user_from_username($_POST['username']);
    $_SESSION["loggedInUser"] = $user[0];
    header("Location: http://localhost/ArchiveOfMyself/profile");
    die;
}
function verify($username,$pword): string{
    $user = get_user_from_username($username);
    if(!empty($user[0])){
        if(password_verify($pword,$user[0][4])){
            return "LOG IN SUCCESFULL";
        }
        else{
            return "Password is false";
        }
    }
    else{
        return "Found no User with this Username";
    }
}
function add_user($username,$description,$image,$passwd){
    global $conn;
    $hash = password_hash($passwd,PASSWORD_BCRYPT);
    $query = $conn->query("INSERT INTO `user`(`username`, `description`, `image`,`passwd`) VALUES ('$username','$description','$image','$hash')");
    return true;
}
function get_user_from_username($username): array{
    global $conn;
    $query = $conn->query("SELECT * FROM `user` WHERE `username` LIKE '$username'");
    return $query->fetch_all();
}
function get_user($id){
    global $conn;
    $query = $conn->query("SELECT * FROM `user` WHERE $id");
    return $query->fetch_all();
}