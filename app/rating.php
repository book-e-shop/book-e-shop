<?php
require "db.php";
require "logs.php";

@session_start();

$action = $_POST['action'];

$create_table_query = "CREATE TABLE  `rating` (
    `id` INT UNSIGNED NOT NULL   AUTO_INCREMENT,
    `book_id` INT UNSIGNED,
    `user_id` INT UNSIGNED,
    `rating` INT UNSIGNED NOT NULL ,
    `publish_date` DATE,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`book_id`)  REFERENCES `books` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`)  REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB;";



if (mysqli_query($connect, 'select 1 from `rating` LIMIT 1') === FALSE)
    mysqli_query($connect, $create_table_query);




$book_id = mysqli_real_escape_string($connect, $_POST['book_id']);

if (isset($_SESSION['logged_user']))
    $user_id = mysqli_real_escape_string($connect, $_SESSION['logged_user']['id']);

if ($action === "update") {
    $result = mysqli_query($connect, "SELECT * FROM `rating` WHERE `book_id` = $book_id AND  `user_id` = '$user_id'");

    $rating = mysqli_real_escape_string($connect, $_POST['rating']);

    if (mysqli_num_rows($result) === 0) {
        $insert_query = "INSERT INTO `rating` (`rating`,`publish_date`, `book_id`, `user_id`)
                         VALUES ('$rating', CURDATE() , '$book_id','$user_id');";

        if (mysqli_query($connect, $insert_query)) {
            add_log('rating', mysqli_insert_id($connect), 'Добавление', $user_id);

            echo "Обзор успешно добавлена";
        }
        echo mysqli_error($connect);
    } else {

        $update_query = "UPDATE `rating` SET `rating` = '$rating',`publish_date` = CURDATE() WHERE `book_id` = $book_id AND `user_id`=$user_id ;";

        if (mysqli_query($connect, $update_query)) {
            add_log('rating', mysqli_insert_id($connect), 'Редактирование', $user_id);
        } else {
            echo mysqli_error($connect);
        }
    }

    mysqli_close($connect);
}
if ($action === "delete") {
    $rating = mysqli_real_escape_string($connect, $_POST['rating']);


    $delete_query = "DELETE FROM `rating` WHERE `book_id` = $book_id AND `user_id`=$user_id ";

    if (mysqli_query($connect, $delete_query)) {
        add_log('rating', mysqli_insert_id($connect), 'Удаление', $user_id);

    } else {
        echo mysqli_error($connect);
    }
    mysqli_close($connect);
}
if ($action === "get") {

    $count = 0;
    $rating['canEdit'] = FALSE;
    if (isset($_SESSION['logged_user']))
        $rating['canEdit'] = TRUE;
    $ratings = mysqli_query($connect, "SELECT * FROM `rating` WHERE `book_id` = '$book_id'");

    $total = 0;
    $rating['r1'] = 0;
    $rating['r2'] = 0;
    $rating['r3'] = 0;
    $rating['r4'] = 0;
    $rating['r5'] = 0;
    while ($c = mysqli_fetch_assoc($ratings)) {

        $count++;

        $rate  = $c['rating'];
        if (isset($_SESSION['logged_user']))
            if ($c['user_id'] === $user_id) {
                $rating['rating'] = $rate;
            }
        $total +=   $rate;
        $rating['r' . $rate] += 1;
    }
    $rating['total'] = round($total, 2);
    echo json_encode($rating);
}
