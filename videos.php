<?php
/**
 * @author Luca Moser
 * This file is used for the body on each page.
 */
require 'repository/Video_Repository.php';
//require 'data.php';
?>
<style>
    <?php
    include 'styles/videos.css';
    ?>
</style>
<div id="body">
    <?php

    // Url, Likes, Dislikes, text, Beschreibung, ID
    if(array_key_exists('Like', $_POST)) {
        //if(verify(1,0,"liked_comments")){
            comment_review(1,true);
            unset($_POST);
            $_POST = array();
        //}
    }
    if(array_key_exists('Dislike', $_POST)) {
        comment_review(1,false);
        unset($_POST);
        $_POST = array();
    }
    $videos = videos_fetch_all();
    foreach ($videos as $video) {
        echo "
        <video width='400' height='800' controls>
            <source src='assets/testvideos/${video[0]}' type='video/mp4'>
            Your browser does not support the video tag.
        </video>";
        echo "<a>Likes: $video[1]</a>";
        echo "<a>Dislikes: $video[2]</a>";
        echo "<h2>Comments:</h2>";
        $comments = comments_fetch($video);
        foreach ($comments as $comment){
            echo "<p>$comment[0]</p>";
            echo "
            <form id='formId' method='post'>
            <p>LIKES: $comment[1]</p>
            <input type='submit' name='Like'
                class='button' value='Like' />
            <p>Dislikes: $comment[2]</p>
            <input type='submit' name='Dislike'
                class='button' value='Dislike' />
            </form>";
        }
        echo "<br><br><br><br>";
    }
    ?>
</div>

<script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
