<?php
require "db.php";

$book_id = $_SERVER['QUERY_STRING'];
settype($book_id, 'integer');

$book = mysqli_query($connect, "SELECT * FROM `books` WHERE `id` = '$book_id'");
$book = mysqli_fetch_assoc($book);
unlink($book['cover']);

$delete_query = "DELETE FROM `books` WHERE `books`.`id` = $book_id";

if (mysqli_query($connect, $delete_query)) {
    echo "Книга успешно удалена";
}
echo mysqli_error($connect);

mysqli_close($connect);
