<?php
require "db.php";

$book_id = mysqli_real_escape_string($connect, $_POST['book_id']);

 
if (mysqli_query($connect, 'select 1 from `comments` LIMIT 1') !== FALSE) {
    $amountReviews = 0;

    $reviews = mysqli_query($connect, "SELECT * FROM `comments` WHERE `book_id` = '$book_id'");


    while ($c = mysqli_fetch_assoc($reviews)) {

        $amountReviews++;
        $comment['author'] = "Вася";
        $comment['comment'] = $c['comment'];
        $comment['date'] = $c['publish_date'];
        $comments[$amountReviews] = $comment;
    }

    echo json_encode($comments);
}
