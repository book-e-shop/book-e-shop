<?php
require "db.php";

$book_id = $_SERVER['QUERY_STRING'];
settype($book_id, 'integer');
$delete_query = "DELETE FROM `books` WHERE `books`.`id` = $book_id";

if (mysqli_query($connect, $delete_query)) {
    echo "Книга успешно удалена";
}
echo mysqli_error($connect);

mysqli_close($connect);
