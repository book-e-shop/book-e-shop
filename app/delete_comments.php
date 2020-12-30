<?php
@session_start();
require "db.php";

$comment_id = $_POST['comment_id'];
$comment_id = intval($comment_id);
$user_id = intval($_SESSION['logged_user']['id']);



$delete_query = "DELETE FROM `comments` WHERE `comments`.`id` = $comment_id";


if (mysqli_query($connect, $delete_query)) {
    add_log('comments', $comment_id, 'Удаление', $user_id);
} else {
    echo mysqli_error($connect);
}
