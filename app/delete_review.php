<?php
require "db.php";

$review_id = $_POST['review_id'];
$book_id = $_POST['book_id'];
$delete_query = "DELETE FROM `reviews` WHERE `reviews`.`id` = $review_id";

if (mysqli_query($connect, $delete_query)) {
    echo "Обзор успешно удален";
}
echo mysqli_error($connect);

mysqli_close($connect);

echo "<script>window.location = 'http://localhost/info_book.php?" . $book_id . "'</script>";