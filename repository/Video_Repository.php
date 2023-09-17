<?php
require "user_intermediary_video.php";
require 'repository/user_intermediary_comment.php';
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

function videos_fetch_liked($user_id): array{
    $memory = [];
    $intermediary = get_intermediarys($user_id);
    foreach ($intermediary as $video){
        array_push($memory,video_fetch($video[1])[0]);
    }
    return $memory;
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
function video_review($video_id,$operator,$user_id): void{
    global $conn;
    $result = get_intermediary($user_id,$video_id);
    $query = $conn->query("SELECT * FROM videos WHERE id LIKE $video_id");
    $year = $query->fetch_all();
    if(empty($result)) {
        if ($operator == "plus") {
            $like = $year[0][1] + 1;
            $conn->query("UPDATE videos SET `likes`='$like' WHERE id LIKE $video_id");
            add_intermediary($user_id,$video_id,true,false);
        } elseif ($operator == "minus") {
            $dislike = $year[0][2] + 1;
            $conn->query("UPDATE videos SET `dislikes`='$dislike' WHERE id LIKE $video_id");
            add_intermediary($user_id,$video_id,false,true);
        }
    }
    else{
        if ($operator == "plus") {
            update_intermediary($video_id,$user_id,true,$result[0][3]);
        }
        if ($operator == "minus") {
            update_intermediary($video_id,$user_id,$result[0][2],true);
        }
        $result = get_intermediary($user_id,$video_id);
        var_dump($result);
        if($result[0][2] && $result[0][3]){
            var_dump("HIER IST WICHTIG: both");
            if ($operator == "plus") {
                $like = $year[0][1] + 1;
                $conn->query("UPDATE videos SET `likes`='$like' WHERE id LIKE $video_id");
                $like = $year[0][2] - 1;
                $conn->query("UPDATE videos SET `dislikes`='$like' WHERE id LIKE $video_id");
                update_intermediary($video_id,$user_id,true,false);
            } elseif ($operator == "minus") {
                $like = $year[0][1] - 1;
                $conn->query("UPDATE videos SET `likes`='$like' WHERE id LIKE $video_id");
                $like = $year[0][2] + 1;
                $conn->query("UPDATE videos SET `dislikes`='$like' WHERE id LIKE $video_id");
                update_intermediary($video_id,$user_id,false,true);
            }
        }
        elseif($result[0][2] || $result[0][3]){
            var_dump("HIER IST WICHTIG: some");
            if ($operator == "plus") {
                $like = $year[0][1] - 1;
                $conn->query("UPDATE videos SET `likes`='$like' WHERE id LIKE $video_id");
            }
            if ($operator == "minus") {
                $dislike = $year[0][2] - 1;
                $conn->query("UPDATE videos SET `dislikes`='$dislike' WHERE id LIKE $video_id");
            }
            delete_intermediary($user_id,$video_id);
        }
    }
}
// ------------------------------------------------------------------------------
function comment_review($comment_id, $operator, $user_id): void{
    global $conn;
    $result = comment_get_intermediary($user_id,$comment_id);
    $query = $conn->query("SELECT * FROM comments WHERE id LIKE $comment_id");
    $year = $query->fetch_all();
    if(empty($result)) {
        if ($operator == "plus") {
            $like = $year[0][1] + 1;
            $conn->query("UPDATE comments SET `likes`='$like' WHERE id LIKE $comment_id");
            comment_add_intermediary($user_id,$comment_id,true,false);
        } elseif ($operator == "minus") {
            $dislike = $year[0][2] + 1;
            $conn->query("UPDATE comments SET `dislikes`='$dislike' WHERE id LIKE $comment_id");
            comment_add_intermediary($user_id,$comment_id,false,true);
        }
    }
    else{
        if ($operator == "plus") {
            comment_update_intermediary($comment_id,$user_id,true,$result[0][3]);
        }
        if ($operator == "minus") {
            comment_update_intermediary($comment_id,$user_id,$result[0][2],true);
        }
        $result = comment_get_intermediary($user_id,$comment_id);
        var_dump($result);
        if($result[0][2] && $result[0][3]){
            var_dump("HIER IST WICHTIG: both");
            if ($operator == "plus") {
                $like = $year[0][1] + 1;
                $conn->query("UPDATE comments SET `likes`='$like' WHERE id LIKE $comment_id");
                $like = $year[0][2] - 1;
                $conn->query("UPDATE comments SET `dislikes`='$like' WHERE id LIKE $comment_id");
                comment_update_intermediary($comment_id,$user_id,true,false);
            } elseif ($operator == "minus") {
                $like = $year[0][1] - 1;
                $conn->query("UPDATE comments SET `likes`='$like' WHERE id LIKE $comment_id");
                $like = $year[0][2] + 1;
                $conn->query("UPDATE comments SET `dislikes`='$like' WHERE id LIKE $comment_id");
                comment_update_intermediary($comment_id,$user_id,false,true);
            }
        }
        elseif($result[0][2] || $result[0][3]){
            var_dump("HIER IST WICHTIG: some");
            if ($operator == "plus") {
                $like = $year[0][1] - 1;
                $conn->query("UPDATE comments SET `likes`='$like' WHERE id LIKE $comment_id");
            }
            if ($operator == "minus") {
                $dislike = $year[0][2] - 1;
                $conn->query("UPDATE comments SET `dislikes`='$dislike' WHERE id LIKE $comment_id");
            }
            comment_delete_intermediary($user_id,$comment_id);
        }
    }
}