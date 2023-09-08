<?php
/**
 * @author Luca Moser
 * This file is used for the body on each page.
 */
require 'repository/Video_Repository.php';
//require 'repository/user_intermediary_video.php';
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
            <source src='assets/testvideos/$video[0]' type='video/mp4'>
            Your browser does not support the video tag.
        </video>";
        echo "<div class='review'>
              <a onclick='send_ajax($video[5],`plus`)' class='review_button' id='$video[5]plus'>Likes: $video[1]</a>
              <a onclick='send_ajax($video[5],`minus`)' class='review_button' id='$video[5]minus'>Dislikes: $video[2]</a>
              </div>";
        $comments = comments_fetch($video);
        $commentslenght = count($comments);
        echo "<a onclick='togVisibility($video[5])' class='commentsSelectable'>Comments: $commentslenght</a>";
        if(!empty($comments)){
            foreach ($comments as $comment){
                echo "<div class='comment$video[5] commentbox' style='display: none'>
            <p>$comment[0]</p>
            <form id='formId' method='post'>
            <p>LIKES: $comment[1]</p>
            <input type='submit' name='Like'
                class='button' value='Like' />
            <p>Dislikes: $comment[2]</p>
            <input type='submit' name='Dislike'
                class='button' value='Dislike' />
            <input type='submit' name='id_comment'
                class='button' value='$comment[4]' />
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
            const request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    alert(this.responseText);
                    let inverted_operator;
                    if(operator === "plus"){
                        inverted_operator = "minus"
                    }
                    else{
                        inverted_operator = "plus"
                    }
                    let my_button = document.getElementById(id + operator);
                    let other_button = document.getElementById(id + inverted_operator);
                    //
                    let str_myButton = my_button.innerText;
                    let name_myButton =  str_myButton.split(' ').shift();
                    str_myButton = str_myButton.substring(str_myButton.indexOf(":") + 1);
                    //
                    let str_otherButton = other_button.innerText;
                    let name_otherButton = str_otherButton.split(' ').shift();
                    str_otherButton = str_otherButton.substring(str_otherButton.indexOf(":") + 1);
                    if(my_button.style.backgroundColor === "darkred"){
                        my_button.style.backgroundColor = "";
                        let my_amount = parseInt(str_myButton) - 1;
                        my_button.innerText = name_myButton + " " + my_amount;
                    }
                    else{
                        if(other_button.style.backgroundColor === "darkred"){
                            let other_amount = parseInt(str_otherButton) - 1;
                            console.log(name_otherButton)
                            other_button.innerText = name_otherButton + " " + other_amount;
                        }
                        my_button.style.backgroundColor = "darkred";
                        other_button.style.backgroundColor = "";
                        let amount = parseInt(str_myButton) + 1;
                        my_button.innerText = name_myButton + " " + amount;
                    }
                }
            };
            request.open("POST", "ajax_request.php");
            request.send(data);
        }
</script>
