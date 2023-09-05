<?php
/**
 * @author Luca Moser
 * This file is used for the body on each page.
 */
require 'repository/Video_Repository.php';
//require 'User_Repository.php';
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
        if(array_search('id_comment',$_POST)){
            $id = array_search('id_comment',$_POST);
            var_dump($id);
            comment_review($id,true);
            unset($_POST);
            $_POST = array();
        }
    }
    if(array_key_exists('Dislike', $_POST)) {
        comment_review(1,false);
        unset($_POST);
        $_POST = array();
    }
    $videos = videos_fetch_all();
    foreach ($videos as $video) {
        echo "
        <video width='700' height='1244.44' controls>
            <source src='assets/testvideos/{$video[0]}' type='video/mp4'>
            Your browser does not support the video tag.
        </video>";
        echo "<a onclick='send_ajax({$video[5]},true)'>Likes: $video[1]</a>";
        echo "<a onclick='send_ajax({$video[5]},false)'>Dislikes: $video[2]</a>";
        $comments = comments_fetch($video);
        $commentslenght = count($comments);
        echo "<a onclick='togVisibility({$video[5]})' class='commentsSelectable'>Comments: {$commentslenght}</a>";
        if(!empty($comments)){
            foreach ($comments as $comment){
                echo "<div class='comment{$video[5]} commentbox' style='display: none'>
            <p>$comment[0]</p>
            <form id='formId' method='post'>
            <p>LIKES: $comment[1]</p>
            <input type='submit' name='Like'
                class='button' value='Like' />
            <p>Dislikes: $comment[2]</p>
            <input type='submit' name='Dislike'
                class='button' value='Dislike' />
            <input type='submit' name='id_comment'
                class='button' value='{$comment[4]}' />
            </form>
            </div>";
            }
        }
        echo "<br><br><br><br>";
    }
    ?>
</div>

<script>
        let shown = true;
        function togVisibility(id){
            let comments = document.getElementsByClassName("comment" + id);
            Array.prototype.forEach.call(comments, comment => {
                if (comment.getAttribute("style") === "display: block"){
                    comment.setAttribute("style","display: none");
                    shown = false;
                }
                else{
                    comment.setAttribute("style","display: block");
                    shown = true;
                }
            })
        }

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }

        function send_ajax(id,operator) {
            let data = new FormData();
            data.append('id',id);
            data.append('operator',operator);
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    //TODO: Add function to increment or decrement like & dislike.
                }
            };
            request.open("POST", "ajax_request.php", true);
            request.send(data);
        }
</script>
