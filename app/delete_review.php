<?php
require "db.php";

$review_id = settype(mysqli_real_escape_string($connect, $_POST['review_id']), 'integer');
$book_id = settype(mysqli_real_escape_string($connect, $_POST['book_id']), 'integer');
$delete_query = "DELETE FROM `reviews` WHERE `reviews`.`id` = $review_id";

if (mysqli_query($connect, $delete_query)) {
    echo "Обзор успешно удален";
} else {
    echo mysqli_error($connect);
}
mysqli_close($connect);

echo "<script>window.location = 'http://localhost/info_book.php?" . $book_id . "'</script>";
