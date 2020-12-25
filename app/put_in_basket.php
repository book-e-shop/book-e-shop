<?php
require "db.php";


$is_added = FALSE;

if (isset($_POST['in_basket'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $cover_type = $_POST['cover_type'];
    $ISBN = $_POST['ISBN'];
    $publisher = $_POST['publisher'];
    $language  = $_POST['language'];
    $size_in_pages = $_POST['size_in_pages'];
    $price = $_POST['price'];
    $cover = $_FILES['cover'];

    $cover = 'www/media/' . uniqid() . '.' . pathinfo($cover["name"])['extension'];

    $create_table_query = "CREATE TABLE `basket` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `order_id` INT UNSIGNED,
                `book_id` INT UNSIGNED,
                `amount_book` INT UNSIGNED,
                `added_date` DATE,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE
                ) ENGINE=InnoDB;";


    if (mysqli_query($connect, 'select 1 from `basket` LIMIT 1') === FALSE)
        mysqli_query($connect, $create_table_query);

    $insert_query = "INSERT INTO `basket` (`name`, `description`, `author`, `genre`, `release_date` , `cover_type` , `ISBN`, `publisher`, `language`,`size_in_pages`, `price`, `cover`)
                             VALUES ('$name', '$description', '$author', '$genre', '$release_date', '$cover_type', '$ISBN', '$publisher', '$language', '$size_in_pages', '$price', '$cover');
                            ";
    if (mysqli_query($connect, $insert_query)) {
        $is_added = TRUE;
    }

    mysqli_close($connect);
}
