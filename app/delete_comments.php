<?php
require "db.php";

$comment_id = $_POST['comment_id'];
$comment_id = mysqli_real_escape_string($connect, $comment_id);




$delete_query = "DELETE FROM `comments` WHERE `comments`.`id` = $comment_id";

echo $delete_query;
if (mysqli_query($connect, $delete_query)) {
    echo "Обзор успешно удален";
} else {
    echo mysqli_error($connect);
}
mysqli_close($connect);
