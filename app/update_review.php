<?php
require "db.php";

$review_id = $_POST['review_id'];
$title = $_POST['title'];
$review = $_POST['review'];

$update_query = "UPDATE `reviews` SET `title` = '$title', `review` = '$review', `publish_date` = CURDATE() WHERE `reviews`.`id` = $review_id;";

if (mysqli_query($connect, $update_query)) {
    echo "Обзор успешно удален";
}
echo mysqli_error($connect);

mysqli_close($connect);

echo "<script>window.location = 'http://localhost/reviews.php?" . $review_id . "'</script>";
