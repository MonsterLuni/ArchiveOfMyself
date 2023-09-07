<?php
require "user_intermediary_video.php";
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

function videos_fetch_all(): array{
    global $conn;
    //ORDER BY RAND() for random, if not needed, delete
    $query = $conn->query("SELECT * FROM videos");
    return $query->fetch_all();
}
//TODO: MAKE / USE
/*
function videos_fetch_filter(){
}
function video_fetch($id): array{
    global $conn;
    $query = $conn->query("SELECT * FROM videos WHERE id LIKE $id ORDER BY RAND()");
    return $query->fetch_all();
}
*/
function comments_fetch($video): array{
    global $conn;
    $query = $conn->query("SELECT * FROM comments WHERE video_fk LIKE $video[5] ORDER BY RAND()");
    return $query->fetch_all();
}
function video_review($video_id,$operator,$user_id): bool{
    global $conn;
    $result = get_intermediary($user_id,$video_id);
    $query = $conn->query("SELECT * FROM videos WHERE id LIKE $video_id");
    $year = $query->fetch_all();
    //TODO: check if video is liked or disliked
    if(empty($result)) {
        //Evtl Natalie Schuhmacher fragen warum die scheisse hier nicht funktioniert hat.
        if ($operator == "plus") {
            var_dump("TRUE");
            $like = $year[0][1] + 1;
            $conn->query("UPDATE videos SET `likes`='$like' WHERE id LIKE $video_id");
        } elseif ($operator == "minus") {
            var_dump("FALSE");
            $dislike = $year[0][2] + 1;
            $conn->query("UPDATE videos SET `dislikes`='$dislike' WHERE id LIKE $video_id");
        }
        add_intermediary($user_id,$video_id);
        return true;
    }
    else{
        var_dump("Ich habs geschafft");
        if ($operator == "plus") {
            var_dump("TRUE");
            $like = $year[0][1] - 1;
            $conn->query("UPDATE videos SET `likes`='$like' WHERE id LIKE $video_id");
        } elseif ($operator == "minus") {
            var_dump("FALSE");
            $dislike = $year[0][2] - 1;
            $conn->query("UPDATE videos SET `dislikes`='$dislike' WHERE id LIKE $video_id");
        }
        delete_intermediary($user_id,$video_id);
        return false;
    }

}
// ------------------------------------------------------------------------------
function comment_review($comment_id,$operator): bool{
    global $conn;
    $query = $conn->query("SELECT * FROM user_intermediary_video WHERE fk_user_id LIKE 1 AND fk_video_id LIKE $comment_id");
    var_dump($query->fetch_all());
    if($comment_id) {
        $query = $conn->query("SELECT * FROM comments WHERE id LIKE 1");
        $comment = $query->fetch_all();
        if ($operator) {
            $like = $comment[0][1] + 1;
            $conn->query("UPDATE comments SET `likes`='$like' WHERE id LIKE $comment_id");
        } else {
            $dislike = $comment[0][2] + 1;
            $conn->query("UPDATE comments SET `dislikes`='$dislike' WHERE id LIKE $comment_id");
        }
        return true;
    }
    else{
        return false;
    }
}