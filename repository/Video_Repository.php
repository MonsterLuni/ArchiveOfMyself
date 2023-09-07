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

function videos_fetch_all(): array{
    global $conn;
    //ORDER BY RAND() for random, if not needed, delete
    $query = $conn->query("SELECT * FROM videos");
    return $query->fetch_all();
}
function videos_fetch_filter(){
}
function video_fetch($id): array{
    global $conn;
    $query = $conn->query("SELECT * FROM videos WHERE id LIKE $id ORDER BY RAND()");
    return $query->fetch_all();
}
function comments_fetch($video): array{
    global $conn;
    $query = $conn->query("SELECT * FROM comments WHERE video_fk LIKE $video[5] ORDER BY RAND()");
    return $query->fetch_all();
}
function video_review($year_id,$operator,$id_user): bool{
    global $conn;
    var_dump($operator);
    $query = $conn->query("SELECT * FROM user_intermediary_video WHERE fk_user_id LIKE $id_user AND fk_video_id LIKE $year_id");
    $result = $query->fetch_all();
    //TODO: replace true with checker if video is already liked or not.
    if(empty($result)) {
        $query = $conn->query("SELECT * FROM videos WHERE id LIKE $year_id");
        $year = $query->fetch_all();
        //TODO: Evtl Natalie Schuhmacher fragen warum die scheisse hier nicht funktioniert hat.
        if ($operator == "plus") {
            var_dump("TRUE");
            $like = $year[0][1] + 1;
            $conn->query("UPDATE videos SET `likes`='$like' WHERE id LIKE $year_id");
        } elseif ($operator == "minus") {
            var_dump("FALSE");
            $dislike = $year[0][2] + 1;
            $conn->query("UPDATE videos SET `dislikes`='$dislike' WHERE id LIKE $year_id");
        }
        return true;
    }
    else{
        var_dump("Ich habs geschafft");
        return false;
    }

}
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