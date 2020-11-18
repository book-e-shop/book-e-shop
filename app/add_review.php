<?php
require "db.php";

 
$create_table_query = "CREATE TABLE  `reviews` (
    `id` INT UNSIGNED NOT NULL   AUTO_INCREMENT,
    `book_id` INT UNSIGNED,
    `user_id` INT UNSIGNED,
    `title` VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_general_ci,
    `review` TEXT(10000) CHARACTER SET utf8 COLLATE utf8_general_ci,
    `author` VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_general_ci,
    `publish_date` DATE,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`book_id`)  REFERENCES `books` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`)  REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB;";

echo mysqli_error($connect);
$is_added = FALSE;
if (mysqli_query($connect, 'select 1 from `reviews` LIMIT 1') === FALSE)
    mysqli_query($connect, $create_table_query);

 
echo mysqli_error($connect);
 
$book_id = $_POST['book_id'];
$title = $_POST['title'];
$review = $_POST['review'];
$author = $_POST['author'];
$user_id = $_POST['user_id'];

$insert_query = "INSERT INTO `reviews` (`title`, `review`, `author`, `publish_date`, `book_id`, `user_id`)
                         VALUES ('$title', '$review', '$author', CURDATE() , '$book_id','$user_id');
                        ";

if (mysqli_query($connect, $insert_query)) {
    $is_added = TRUE;

    echo "Обзор успешно добавлена";
}
echo mysqli_error($connect);

mysqli_close($connect);

echo "<script>window.location = 'http://localhost/info_book.php?" . $book_id . "'</script>";
