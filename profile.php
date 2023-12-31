<?php
/**
 * @author Luca Moser
 * This file is used for the header on each page.
 */
?>
<!DOCTYPE html>
<html lang="en">
<style>
    <?php
    include 'styles/profile.css';
    ?>
</style>
<header>
    <?php



    include "Include/header.php";
    require 'repository/User_Repository.php';
    require "repository/Video_Repository.php"
    ?>
</header>
<head>
    <meta charset="UTF-8">
    <meta name="profile">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#317EFB"/>
    <title>Profile</title>
</head>
<div id="body">
<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    switch (verify($username,$password)){
        case "LOG IN SUCCESFULL": {
            echo "<h1>Du wurdest erfolgreich eingeloggt!</h1>";
            $user = get_user_from_username($username);
            $_SESSION["loggedInUser"] = $user[0];
            sleep(1);
            echo "<script>location.href='./profile'</script>";
            break;
        }
        case "Password is false": {
            unset($_SESSION['loggedInUser']);
            echo "<script>location.href='./login?error=password'</script>";
            break;
        }
        case "Found no User with this Username": {
            unset($_SESSION['loggedInUser']);
            echo "<script>location.href='./login?error=username'</script>";
            break;
        }
    }
}
if(isset($_SESSION["loggedInUser"])){
    $name = $_SESSION["loggedInUser"][0];
    echo "<title>Profile of $name</title>
    <img src='assets/profilepictures/{$_SESSION['loggedInUser'][3]}.png' alt='profilepicture' style='height: 100px; width: auto'>
    <h1>{$_SESSION['loggedInUser'][0]}</h1>
    <h2>{$_SESSION['loggedInUser'][1]}</h2>
    <p class='tab upload' onclick='upload_video()'>UPLOAD VIDEO</p>
    <div id='menu'>";
        // Name, Url, Image
        $tabs = [["Uploaded","Uploaded"],["Saved","Saved"],["Liked","Liked"],["Disliked","Disliked"]];

        $url =  "{$_SERVER['REQUEST_URI']}";
        $specific_tab = substr($url, strpos($url, "/") + 17);
        echo "<title>$specific_tab</title>";
        foreach ($tabs as $tab) {
            if($tab[1] == $specific_tab){
                echo "<p class='tab' id='selected' onclick='send_videos(`$tab[1]`)'>$tab[0]</p>";
            }
            else{
                echo "<p class='tab' onclick='send_videos(`$tab[1]`)'>$tab[0]</p>";
            }
        }

    echo "</div>";
    echo "<div class='videos'>";
    $type = $_GET['type'] ?? "Uploaded";
    function showVideo($videoSelect): void
    {
        echo "
        <video width='112.50' height='200' controls loop>
        <source src='assets/testvideos/$videoSelect' type='video/mp4'>
        Your browser does not support the video tag.
        Your browser does not support the video tag.
        </video>";
    }
    $videoIsThere = false;
    if($type == "Liked"){
        foreach(videos_fetch_liked($_SESSION['loggedInUser'][3]) as $video){
            showVideo($video[0]);
            $videoIsThere = true;
        }
    }
    elseif ($type == "Disliked"){
        foreach(videos_fetch_disliked($_SESSION['loggedInUser'][3]) as $video){
            showVideo($video[0]);
            $videoIsThere = true;
        }
    }
    elseif ($type == "Saved"){
        foreach(get_intermediary_saved($_SESSION['loggedInUser'][3]) as $video){
            showVideo($video[0]);
            $videoIsThere = true;
        }
    }
    elseif ($type == "Uploaded") {
        foreach (videos_get_uploaded($_SESSION['loggedInUser'][3]) as $video) {
            showVideo($video[0]);
            $videoIsThere = true;
        }
    }
    if(!$videoIsThere){
        echo "<p>You don't have any Videos Here!</p>";
    }
    echo "</div>";
}
        else{
            echo "<h1>Du musst eingeloggt sein um Videos sehen zu können!</h1>";
            echo "<div class='review'>
              <a onclick='pagegowoosh(`login`)' class='review_button_comment'>Login</a>
              <a onclick='pagegowoosh(`register`)' class='review_button_comment'>Register</a>
              </div>";
        }
?>
</div>
</html>
<script>
    function send_ajax(site,type) {
        let data = new FormData();
        data.append('site',site)
        data.append('type',type)
        const request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                alert(this.responseText);
            }
        }
        request.open("POST", "ajax_request.php");
        request.send(data);
    }
    function send_videos(type) {
        location.href='./profile?type=' + type;
    }
    function upload_video(){
        location.href='./upload';
    }
    function pagegowoosh(type){
        if(type === "login"){
            location.href='./login';
        }
        else{
            location.href='./register';
        }

    }

</script>