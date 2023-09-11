<?php
/**
 * @author Luca Moser
 * This file is used for the body on each page.
 */
require 'repository/Video_Repository.php';
?>
<style>
    <?php
    include 'styles/videos.css';
    ?>
</style>
<div id="body">
    <?php
    $videos = videos_fetch_all();
    foreach ($videos as $video) {
        //TODO: USER MAKE DIFFERENT
        $intermediary = get_intermediary($_SESSION['loggedInUser'][3],$video[5]);
        echo "
        <video width='700' height='1244.44' controls>
            <source src='assets/testvideos/$video[0]' type='video/mp4'>
            Your browser does not support the video tag.
            Your browser does not support the video tag.
        </video>";
        if(isset($intermediary[0])){
            if($intermediary[0][1]){
                if($intermediary[0][2] && $intermediary[0][3]){
                    echo "<div class='review'>
                       <a onclick='send_ajax($video[5],`plus`,`video`,`videos`)' class='review_button' id='$video[5]plusvideo' style='background-color: darkred'>Likes: $video[1]</a>
                       <a onclick='send_ajax($video[5],`minus`,`video`,`videos`)' class='review_button' id='$video[5]minusvideo' style='background-color: darkred'>Dislikes: $video[2]</a>
                       </div>";
                }
                else{
                    if($intermediary[0][2]){
                        echo "<div class='review'>
                          <a onclick='send_ajax($video[5],`plus`,`video`,`videos`)' class='review_button' id='$video[5]plusvideo' style='background-color: darkred'>Likes: $video[1]</a>
                          <a onclick='send_ajax($video[5],`minus`,`video`,`videos`)' class='review_button' id='$video[5]minusvideo'>Dislikes: $video[2]</a>
                          </div>";
                    }
                    elseif($intermediary[0][3]){
                        echo "<div class='review'>
                          <a onclick='send_ajax($video[5],`plus`,`video`,`videos`)' class='review_button' id='$video[5]plusvideo'>Likes: $video[1]</a>
                          <a onclick='send_ajax($video[5],`minus`,`video`,`videos`)' class='review_button' id='$video[5]minusvideo' style='background-color: darkred'>Dislikes: $video[2]</a>
                          </div>";
                    }
                }
            }
        }
        else{
            echo "<div class='review'>
              <a onclick='send_ajax($video[5],`plus`,`video`,`videos`)' class='review_button' id='$video[5]plusvideo'>Likes: $video[1]</a>
              <a onclick='send_ajax($video[5],`minus`,`video`,`videos`)' class='review_button' id='$video[5]minusvideo'>Dislikes: $video[2]</a>
              </div>";
        }
        $comments = comments_fetch($video);
        $commentslenght = count($comments);
        echo "<a onclick='togVisibility($video[5])' class='commentsSelectable'>Comments: $commentslenght</a>";
        if(!empty($comments)){
            foreach ($comments as $comment){
                $intermediary = comment_get_intermediary($_SESSION['loggedInUser'][3],$comment[4]);
                echo "<div class='comment$video[5] commentbox' style='display: none'>";
                echo "<p style='font-size: 30px; max-width: 700px'>$comment[0]</p>";
                if(isset($intermediary[0])){
                    if($intermediary[0][1]){
                        if($intermediary[0][2] && $intermediary[0][3]){
                            echo "<div class='review'>
                       <a onclick='send_ajax($comment[4],`plus`,`comment`,`videos`)' class='review_button_comment' id='$comment[4]pluscomment' style='background-color: darkred'>Likes: $comment[1]</a>
                       <a onclick='send_ajax($comment[4],`minus`,`comment`,`videos`)' class='review_button_comment' id='$comment[4]minuscomment' style='background-color: darkred'>Dislikes: $comment[2]</a>
                       </div>";
                        }
                        else{
                            if($intermediary[0][2]){
                                echo "<div class='review'>
                          <a onclick='send_ajax($comment[4],`plus`,`comment`,`videos`)' class='review_button_comment' id='$comment[4]pluscomment' style='background-color: darkred'>Likes: $comment[1]</a>
                          <a onclick='send_ajax($comment[4],`minus`,`comment`,`videos`)' class='review_button_comment' id='$comment[4]minuscomment'>Dislikes: $comment[2]</a>
                          </div>";
                            }
                            elseif($intermediary[0][3]){
                                echo "<div class='review'>
                          <a onclick='send_ajax($comment[4],`plus`,`comment`,`videos`)' class='review_button_comment' id='$comment[4]pluscomment'>Likes: $comment[1]</a>
                          <a onclick='send_ajax($comment[4],`minus`,`comment`,`videos`)' class='review_button_comment' id='$comment[4]minuscomment' style='background-color: darkred'>Dislikes: $comment[2]</a>
                          </div>";
                            }
                        }

                    }
                }
                else{
                    echo "<div class='review'>
                    <a onclick='send_ajax($comment[4],`plus`,`comment`,`videos`)' class='review_button_comment' id='$comment[4]pluscomment'>Likes: $comment[1]</a>
                    <a onclick='send_ajax($comment[4],`minus`,`comment`,`videos`)' class='review_button_comment' id='$comment[4]minuscomment'>Dislikes: $comment[2]</a>
                    </div>";
                }
                echo "</div>";
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
            return true;
        }

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        function send_ajax(id,operator,type, site) {
            let data = new FormData();
            data.append('id',id);
            data.append('operator',operator);
            data.append('type',type);
            data.append('site',site)
            const request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    //alert(this.responseText);
                    let inverted_operator;
                    if(operator === "plus"){
                        inverted_operator = "minus"
                    }
                    else{
                        inverted_operator = "plus"
                    }
                    let my_button = document.getElementById(id + operator + type);
                    let other_button = document.getElementById(id + inverted_operator + type);
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
            return true;
        }
</script>
