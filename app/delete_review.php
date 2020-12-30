<?php
require "db.php";
require "logs.php";
$review_id = $_POST['review_id'];
$review_id = intval($review_id);

$book_id = $_POST['book_id'];
$book_id =  intval($book_id);

$user_id = intval($_SESSION['logged_user']['id']);

$delete_query = "DELETE FROM `reviews` WHERE `reviews`.`id` = $review_id";

echo $delete_query;
if (mysqli_query($connect, $delete_query)) {
    echo "Обзор успешно удален";
    add_log('reviews', $review_id, 'Удаление', $user_id);
} else {
    echo mysqli_error($connect);
}
mysqli_close($connect);

echo "<script>window.location = 'http://localhost/info_book.php?" . $book_id . "'</script>";
