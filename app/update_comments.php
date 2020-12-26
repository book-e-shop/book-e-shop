<?php
require "db.php";

$comment_id = $_POST['comment_id'];
$comment_id = mysqli_real_escape_string($connect, $comment_id);



$comment = mysqli_real_escape_string($connect, $_POST['comment']);



$update_query = "UPDATE `comments` SET `comment` = '$comment',`publish_date` = CURDATE() WHERE `comments`.`id` =  $comment_id ;";

if (mysqli_query($connect, $update_query)) {
    echo "Обзор успешно удален";
} else {
    echo mysqli_error($connect);
}

mysqli_close($connect);
