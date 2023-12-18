<?php
include_once "connection.php";

if(isset($_POST['description'])){
    session_start();
    add_user($_POST['username'],$_POST['description'],"bild.png",$_POST['password']);
    $user = get_user_from_username($_POST['username']);
    $_SESSION["loggedInUser"] = $user[0];
    $id = $_SESSION['loggedInUser'][3];
    $info = move_uploaded_file($_FILES['avatar']["tmp_name"],"../assets/profilepictures/" . $id . ".png");
    echo "<script>location.href='../profile'</script>";
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
function add_user($username,$description,$image,$passwd): true
{
    $hash = password_hash($passwd,PASSWORD_BCRYPT);
    makeQuery("INSERT INTO `user`(`username`, `description`, `image`,`passwd`) VALUES ('$username','$description','$image','$hash')");
    return true;
}
function get_user_from_username($username): array{
    return makeQueryFetch("SELECT * FROM `user` WHERE `username` LIKE '$username'");
}
function get_user($id): array
{
    return makeQueryFetch("SELECT * FROM `user` WHERE $id");
}