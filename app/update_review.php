<?php
require "db.php";
require "logs.php";
$review_id = $_POST['review_id'];
$review_id = intval($review_id);

 

$title = mysqli_real_escape_string($connect, $_POST['title']);
$review = mysqli_real_escape_string($connect, $_POST['review']);

$user_id = intval($_SESSION['logged_user']['id']);


$update_query = "UPDATE `reviews` SET `title` = '$title', `review` = '$review', `publish_date` = CURDATE() WHERE `reviews`.`id` =  $review_id ;";

if (mysqli_query($connect, $update_query)) {
    echo "Обзор успешно обнавлен";
    add_log('reviews', $review_id, 'Редактирование', $user_id);

} else {
    echo mysqli_error($connect);
}

mysqli_close($connect);
echo "<script>window.location = 'http://localhost/reviews.php?" . $review_id . "'</script>";
