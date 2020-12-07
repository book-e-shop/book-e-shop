<?php
require "db.php";

$review_id = $_POST['review_id'];
$review_id = mysqli_real_escape_string($connect, $review_id);

$book_id = $_POST['book_id'];
$book_id = mysqli_real_escape_string($connect, $book_id);


$delete_query = "DELETE FROM `reviews` WHERE `reviews`.`id` = $review_id";

echo $delete_query;
if (mysqli_query($connect, $delete_query)) {
    echo "Обзор успешно удален";
} else {
    echo mysqli_error($connect);
}
mysqli_close($connect);

echo "<script>window.location = 'http://localhost/info_book.php?" . $book_id . "'</script>";
