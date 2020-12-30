<?php
@session_start();
require "db.php";
require "logs.php";
$comment_id = $_POST['comment_id'];
$comment_id = intval($comment_id);

$user_id = intval($_SESSION['logged_user']['id']);

$comment = mysqli_real_escape_string($connect, $_POST['comment']);



$update_query = "UPDATE `comments` SET `comment` = '$comment',`publish_date` = CURDATE() WHERE `comments`.`id` =  $comment_id ;";

if (mysqli_query($connect, $update_query)) {
    add_log('comments', $comment_id, 'Редактирование', $user_id);
} else {
    echo mysqli_error($connect);
}

mysqli_close($connect);
