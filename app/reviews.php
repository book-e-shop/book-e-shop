<?php
$title = "Рецензии";
require 'db.php';
require 'libs/Parsedown.php';
require 'toc_generator.php';
include getcwd() . "/header.php";
@session_start();
?>


<?php
$review_id = $_SERVER['QUERY_STRING'];
$review = mysqli_query($connect, "SELECT * FROM `reviews` WHERE `id` = '$review_id'");
$review = mysqli_fetch_assoc($review);
mysqli_close($connect);
$Parsedown = new Parsedown();
$text =  $Parsedown->text($review["review"]);


$text = set_id($text);
?>


<div class="container body-content">
    <div class="row">
        <div class="col">
            <h1>
                <?php echo $review["title"]; ?>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <i><?php echo $review["author"] . ', ' . $review["publish_date"]; ?></i>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <?php generate_toc($text)
            ?>
        </div>
    </div>


    <div class="row">
        <div id="review" class="col">
            <?php
            echo $text;
            ?>
        </div>
    </div>

    <?php
    if (isset($_SESSION['logged_user']))
        if ($_SESSION['logged_user']['id'] === $review['user_id']) {
            echo "<div class='row'>
        <div class='col'>
        <button class='btn btn-primary' data-toggle='modal' data-target='#updateReview'>Изменить рецензию</button>
        </div>

        <div class='col'>
            <form method='post' action='delete_review.php' enctype='multipart/form-data'>
                <div class='form-group' hidden>
                    <input id='review_id' name='review_id' value='" . $review['id'] . "'class='form-control' type='text'>
                </div>
                <div class='form-group' hidden>
                    <input id='review_id' name='book_id' value='" . $review['book_id'] . "'class='form-control' type='text'>
                </div>
                <div class='form-group'>
                    <button type='submit' name='delete_review' class='btn btn-primary' data-toggle='button'>Удалить рецензию</button>
                </div>
            </form>
        </div>
    </div>";
        } ?>
</div>



<div class="modal fade" id="updateReview" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить новую рецензию</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="update_review.php" enctype="multipart/form-data">
                    <div class='form-group' hidden>
                    <input id="review_id" name="review_id" value="<?php echo $review['id'] ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group" hidden>
                        <input id="book_id" name="book_id" value="<?php echo $review['book_id'] ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="name">
                            <h4>Название рецензии</h4>
                        </label>
                        <input id="title" name="title" maxlength="50" value=<?php echo $review['title']; ?> class="form-control" type="text">
                    </div>


                    <div class="form-group">
                        <label for="description">
                            <h4>Рецензия</h4>
                        </label>
                        <textarea id="review" maxlength="10000" name="review" class="form-control"><?php echo $review['review']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="author">
                            <h4>Автор</h4>
                        </label>
                        <input id="author" maxlength="50" name="author" class="form-control" readonly value=<?php echo $_SESSION['logged_user']['name'] . "&nbsp" . $_SESSION['logged_user']['surname']; ?> type="text">
                    </div>

                    <div class="form-group">
                        <input id="user_id" maxlength="50" name="user_id" class="form-control" hidden value=<?php echo $_SESSION['logged_user']['id']; ?> type="text">
                    </div>


                    <div class="form-group">
                        <button type="submit" name='update_review' class="btn btn-primary" data-toggle="button">Добавить</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>

<?php
include getcwd() . "/footer.php";
?>