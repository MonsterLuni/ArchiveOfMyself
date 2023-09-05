<?php
/**
 * @author Luca Moser
 * This file is used for the body on each page.
 */

$servername = "localhost";
$username = "root";
$password = "";
$database = "ArchiveOfMyself";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

function videos_fetch_all(){
    global $conn;
    $query = $conn->query("SELECT * FROM videos ORDER BY RAND()");
    return $query->fetch_all();
}
function videos_fetch_filter(){
}
function video_fetch($id){
    global $conn;
    $query = $conn->query("SELECT * FROM videos WHERE id LIKE {$id} ORDER BY RAND()");
    return $query->fetch_all();
}
function comments_fetch($video){
    global $conn;
    $query = $conn->query("SELECT * FROM comments WHERE video_fk LIKE {$video[5]} ORDER BY RAND()");
    return $query->fetch_all();
}
function video_review($year_id,$operator){
    global $conn;
    //$query = $conn->query("SELECT * FROM user_intermediary_video WHERE fk_user_id LIKE 1 AND fk_video_id LIKE {$year_id}");
    //var_dump($query->fetch_all());
    if(true) {
        $query = $conn->query("SELECT * FROM videos WHERE id LIKE 1");
        $year = $query->fetch_all();
        //FIXME: I don't fucking know why this works.
        if ($operator == false) {
            $like = $year[0][1] + 1;
            $conn->query("UPDATE videos SET `likes`='{$like}' WHERE id LIKE {$year_id}");
        } else {
            $dislike = $year[0][2] + 1;
            $conn->query("UPDATE videos SET `dislikes`='{$dislike}' WHERE id LIKE {$year_id}");
        }
        return true;
    }
    else{
        return false;
    }

}
function comment_review($comment_id,$operator){
    global $conn;
    $query = $conn->query("SELECT * FROM user_intermediary_video WHERE fk_user_id LIKE 1 AND fk_video_id LIKE {$comment_id}");
    var_dump($query->fetch_all());
    if($comment_id) {
        $query = $conn->query("SELECT * FROM comments WHERE id LIKE 1");
        $comment = $query->fetch_all();
        if ($operator) {
            $like = $comment[0][1] + 1;
            $conn->query("UPDATE comments SET `likes`='{$like}' WHERE id LIKE {$comment_id}");
        } else {
            $dislike = $comment[0][2] + 1;
            $conn->query("UPDATE comments SET `dislikes`='{$dislike}' WHERE id LIKE {$comment_id}");
        }
        return true;
    }
    else{
        return false;
    }

}