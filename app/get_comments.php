<?php
require "db.php";
@session_start();
$book_id = mysqli_real_escape_string($connect, $_POST['book_id']);


if (mysqli_query($connect, 'select 1 from `comments` LIMIT 1') !== FALSE) {
    $amountReviews = 0;

    $reviews = mysqli_query($connect, "SELECT * FROM `comments` WHERE `book_id` = '$book_id'");


    while ($c = mysqli_fetch_assoc($reviews)) {

        $amountReviews++;


        $comment['comment'] = $c['comment'];
        $comment['comment_id'] = $c['id'];
        $comment['date'] = $c['publish_date'];

        $user_id = $c['user_id'];

        if (mysqli_query($connect, 'select 1 from `users` LIMIT 1') !== FALSE) {


            $result = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id'");

            $user = mysqli_fetch_assoc($result);
            $comment['author'] = $user['surname'] . " " . $user['name'];
            if (isset($_SESSION['logged_user'])) {
                if ($_SESSION['logged_user']['id'] === $user_id) {
                    $comment['canEdit'] = TRUE;
                }
            } else {
                $comment['canEdit'] = FALSE;
            }
        }

        $comments[$amountReviews] = $comment;
    }

    echo json_encode($comments);
}
