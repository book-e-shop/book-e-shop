<?php
require "db.php";

echo "123";
$create_table_query = "CREATE TABLE `reviews` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `book_id` INT,
    `title` VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_general_ci,
    `review` TEXT(10000) CHARACTER SET utf8 COLLATE utf8_general_ci,
    `author` VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_general_ci,
    `publish_date` DATE,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`book_id`)  REFERENCES `books` (`id`)
    ) ENGINE=InnoDB;";

echo mysqli_error($connect);
$is_added = FALSE;
if (mysqli_query($connect, 'select 1 from `reviews` LIMIT 1') === FALSE)
    mysqli_query($connect, $create_table_query);
echo "123";
echo mysqli_error($connect);
echo "123";
$book_id = $_POST['book_id'];
$title = $_POST['title'];
$review = $_POST['review'];
$author = $_POST['author'];
echo $book_id;
echo $book_id;
$insert_query = "INSERT INTO `reviews` (`title`, `review`, `author`, `publish_date`, `book_id`)
                         VALUES ('$title', '$review', '$author', CURDATE() , '$book_id');
                        ";

if (mysqli_query($connect, $insert_query)) {
    $is_added = TRUE;

    echo "Обзор успешно добавлена";
}
echo mysqli_error($connect);

mysqli_close($connect);

echo "<script>window.location = 'http://localhost/info_book.php?" . $book_id . "'</script>";