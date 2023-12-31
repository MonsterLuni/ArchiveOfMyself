<?php
require "user_intermediary_video.php";
require 'user_intermediary_comment.php';
/**
 * @author Luca Moser
 * This file is used for the body on each page.
 */

include_once "connection.php";

if(isset($_POST['title'])){
    session_start();
    $id = $_SESSION['loggedInUser'][3];
    $name = $_POST['title'];
    $vids = video_fetch_by_title($name);
    if(!empty($vids)){
        var_dump($name);
        echo "<script>alert('Title already Exists, try again')
                      location.href='../upload';
              </script>";
        die;

    }
    move_uploaded_file($_FILES['video']["tmp_name"],"C:/xampp/htdocs/ArchiveOfMyself/assets/testvideos/$name" . $id . ".mp4");
    upload_video($_POST['title'] . $id . ".mp4",$_POST['title'],$_POST['description']);
    echo "<script>location.href='../profile'</script>";
    die;
}
function videos_fetch_all(): array{
    return makeQueryFetch("SELECT * FROM videos ORDER BY RAND()");
}

function videos_get_uploaded($user_id): array{
    return makeQueryFetch("SELECT * FROM videos WHERE `fk_uploaded_from_id` LIKE $user_id");
}

function videos_fetch_liked($user_id): array{
    $memory = [];
    $intermediary = get_intermediarys_liked_or_disliked($user_id, true);
    foreach ($intermediary as $video){
        array_push($memory,video_fetch($video[1])[0]);
    }
    return $memory;
}
function videos_fetch_disliked($user_id): array{
    $memory = [];
    $intermediary = get_intermediarys_liked_or_disliked($user_id, false);
    foreach ($intermediary as $video){
        array_push($memory,video_fetch($video[1])[0]);
    }
    return $memory;
}
function video_fetch($id): array{
    return makeQueryFetch("SELECT * FROM videos WHERE id LIKE $id");
}
function video_fetch_by_title($title): array{
    return makeQueryFetch("SELECT * FROM videos WHERE text LIKE '$title'");
}

function comments_fetch($video): array{
    return makeQueryFetch("SELECT * FROM comments WHERE video_fk LIKE $video[5] ORDER BY RAND()");
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
            if(!$result[0][4]){
                delete_intermediary($user_id,$video_id);
            }
        }
    }
}

function upload_video($url, $title, $description): bool{
    makeQuery("INSERT INTO `videos`(`url`, `text`, `description`, `fk_uploaded_from_id`,`likes`,`dislikes`) VALUES ('$url','$title','$description','{$_SESSION['loggedInUser'][3]}',0,0)");
    return true;
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