<?php
/**
 * @author Luca Moser
 * This file is used for the header on each page.
 */
?>
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
            header("Location: http://localhost/ArchiveOfMyself/profile");
            break;
        }
        case "Password is false": {
            unset($_SESSION['loggedInUser']);
            header("Location: http://localhost/ArchiveOfMyself/login?error=password");
            break;
        }
        case "Found no User with this Username": {
            unset($_SESSION['loggedInUser']);
            header("Location: http://localhost/ArchiveOfMyself/login?error=username");
            break;
        }
    }
}
if(isset($_SESSION["loggedInUser"])){
    echo "<img src='assets/profilepictures/{$_SESSION['loggedInUser'][3]}.png' alt='profilepicture'>
          <h1>{$_SESSION['loggedInUser'][0]}</h1>
          <h2>{$_SESSION['loggedInUser'][1]}</h2>";
    echo "<div id='menu'>";
        // Name, Url, Image
        $tabs = [["Uploaded Videos",""],["Saved Videos",""],["Liked Videos",""]];

        $url =  "{$_SERVER['REQUEST_URI']}";
        $specific_tab = substr($url, strpos($url, "/") + 17);
        echo "<title>$specific_tab</title>";
        foreach ($tabs as $tab) {
            if($tab[1] == $specific_tab){
                echo "<a class='tab' id='selected' onclick='send_videos($tab[0])'>$tab[0]</a>";
            }
            else{
                echo "<a class='tab' onclick='send_videos($tab[0])'>$tab[0]</a>";
            }
        }

    echo "</div>";
    echo "<div class='videos'>";
    if(isset($_POST['liked'])){
        foreach(videos_fetch_liked($_SESSION['loggedInUser'][3]) as $video){
                echo "
                <video width='112.50' height='200' controls>
                <source src='assets/testvideos/$video[0]' type='video/mp4'>
                Your browser does not support the video tag.
                Your browser does not support the video tag.
                </video>";
            }
    }
    else{
        foreach(videos_fetch_disliked($_SESSION['loggedInUser'][3]) as $video){
            echo "
                <video width='112.50' height='200' controls>
                <source src='assets/testvideos/$video[0]' type='video/mp4'>
                Your browser does not support the video tag.
                Your browser does not support the video tag.
                </video>";
        }
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
        let data = new FormData();
        data.append('type',type)
        const request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                //alert(this.responseText);
            }
        }
        request.open("POST", "profile.php");
        request.send(data);
    }
    function pagegowoosh(type){
        if(type === "login"){
            window.location.replace("http://localhost/ArchiveOfMyself/login")
        }
        else{
            window.location.replace("http://localhost/ArchiveOfMyself/register")
        }

    }

</script>