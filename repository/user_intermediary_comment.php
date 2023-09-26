<?php
require "connection.php";
function comment_get_intermediary($user_id, $comment_id): array{
    global $conn;
    $query = $conn->query("SELECT * FROM `user_intermediary_comment` WHERE `fk_comment_id` LIKE $comment_id AND `fk_user_id` LIKE $user_id");
    return $query->fetch_all();
}
function comment_add_intermediary($user_id, $comment_id,$like,$dislike): bool{
    global $conn;
    $conn->query("INSERT INTO `user_intermediary_comment`(`fk_user_id`, `fk_comment_id`,`bool_like`,`bool_dislike`) VALUES ('$user_id','$comment_id','$like','$dislike')");
    return true;
}
function comment_update_intermediary($comment_id,$user_id,$like,$dislike): bool{
    global $conn;
    $conn->query("UPDATE `user_intermediary_comment` SET `bool_like`='$like',`bool_dislike`='$dislike' WHERE `fk_comment_id` LIKE $comment_id AND `fk_user_id` LIKE $user_id");
    return true;
}
function comment_delete_intermediary($user_id, $comment_id): bool{
    global $conn;
    $conn->query("DELETE FROM `user_intermediary_comment` WHERE `fk_comment_id` LIKE $comment_id AND `fk_user_id` LIKE $user_id");
    return true;
}