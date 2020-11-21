<?php
require "db.php";

$review_id = settype(mysqli_real_escape_string($connect, $_POST['review_id']), 'integer');
$title = mysqli_real_escape_string($connect, $_POST['title']);
$review = mysqli_real_escape_string($connect, $_POST['review']);



$update_query = "UPDATE `reviews` SET `title` = '$title', `review` = '$review', `publish_date` = CURDATE() WHERE `reviews`.`id` =  $review_id ;";

if (mysqli_query($connect, $update_query)) {
    echo "Обзор успешно удален";
} else {
    echo mysqli_error($connect);
}

mysqli_close($connect);
echo "<script>window.location = 'http://localhost/reviews.php?" . $review_id . "'</script>";
