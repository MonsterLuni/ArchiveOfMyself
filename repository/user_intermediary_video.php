<?php
include_once "connection.php";
function get_intermediarys_liked_or_disliked($user_id,$likeordislike): array{
    global $conn;
    if($likeordislike){
        $query = $conn->query("SELECT * FROM `user_intermediary_video` WHERE `fk_user_id` LIKE $user_id AND `bool_like` LIKE 1");
    }
    else{
        $query = $conn->query("SELECT * FROM `user_intermediary_video` WHERE `fk_user_id` LIKE $user_id AND `bool_dislike` LIKE 1");
    }
    return $query->fetch_all();
}
function get_intermediary_saved($user_id): array{
    return makeQueryFetch("SELECT * FROM `user_intermediary_video` WHERE `fk_user_id` LIKE $user_id AND `saved` LIKE 1");
}
function get_intermediary($user_id, $video_id): array{
    return makeQueryFetch("SELECT * FROM `user_intermediary_video` WHERE `fk_video_id` LIKE $video_id AND `fk_user_id` LIKE $user_id");
}
function add_intermediary($user_id, $video_id,$like,$dislike): bool{
    makeQuery("SELECT * FROM `user_intermediary_video` WHERE `fk_user_id` LIKE $user_id AND `saved` LIKE 1");
    return true;
}
function update_intermediary($video_id,$user_id,$like,$dislike): bool{
    makeQuery("UPDATE `user_intermediary_video` SET `bool_like`='$like',`bool_dislike`='$dislike' WHERE `fk_video_id` LIKE $video_id AND `fk_user_id` LIKE $user_id");
    return true;
}
function delete_intermediary($user_id, $video_id): bool{
    makeQuery("DELETE FROM `user_intermediary_video` WHERE `fk_video_id` LIKE $video_id AND `fk_user_id` LIKE $user_id");
    return true;
}
function update_saved_intermediary($video_id,$user_id,$value): bool{
    makeQuery("UPDATE `user_intermediary_video` SET `saved`= $value  WHERE `fk_video_id` LIKE $video_id AND `fk_user_id` LIKE $user_id");
    return true;
}