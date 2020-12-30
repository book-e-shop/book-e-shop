<?php
require "db.php";
require "logs.php";

@session_start();

$create_table_query = "CREATE TABLE  `comments` (
    `id` INT UNSIGNED NOT NULL   AUTO_INCREMENT,
    `book_id` INT UNSIGNED,
    `user_id` INT UNSIGNED,
    `comment` TEXT(10000)  CHARACTER SET utf8 COLLATE utf8_general_ci,
    `publish_date` DATE,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`book_id`)  REFERENCES `books` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`)  REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB;";

echo mysqli_error($connect);
$is_added = FALSE;
if (mysqli_query($connect, 'select 1 from `comments` LIMIT 1') === FALSE)
    mysqli_query($connect, $create_table_query);


echo mysqli_error($connect);

$book_id = intval( $_POST['book_id']);
$comment = mysqli_real_escape_string($connect, $_POST['comment']);
$user_id = intval($_SESSION['logged_user']['id']);

$insert_query = "INSERT INTO `comments` (`comment`,`publish_date`, `book_id`, `user_id`)
                         VALUES ('$comment', CURDATE() , '$book_id','$user_id');
                        ";

if (mysqli_query($connect, $insert_query)) {
    $is_added = TRUE;

    echo "Обзор успешно добавлена";
}

add_log('comments', mysqli_insert_id($connect), 'Добавление', $user_id);
echo mysqli_error($connect);

mysqli_close($connect);
