<?php
/**
 * @author Luca Moser
 * This file is used for the body on each page.
 */
?>
<style>
    <?php include 'styles/body.css'; ?>
</style>
<div id="body">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ArchiveOfMyself";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Url, Likes, Dislikes, Comments
    $query = $conn->query("SELECT * FROM videos");
    $videos = $query->fetch_all();
    foreach ($videos as $video) {
        echo "<p>URL: $video[0]</p>";
        echo "<p>Likes: $video[1]</p>";
        echo "<p>Dislikes: $video[2]</p>";
        echo "<p>Comments: $video[3]</p>";
        //var_dump($video[0]);
    }

    ?>
</div>
