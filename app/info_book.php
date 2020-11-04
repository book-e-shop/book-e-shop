<?php
require 'db.php';
$title = "Каталог";
include getcwd() . "/header.php";
?>

<?php
$book_id = $_SERVER['QUERY_STRING'];
$book = mysqli_query($connect, "SELECT * FROM `books` WHERE `id` = '$book_id'");
$book = mysqli_fetch_assoc($book);
?>



<div class='container body-content'>

    <div class='row'>
        <div class="col-sm-3">
            <figure class="sign">
                <p><img src=<?php echo $book['cover'] ?> width="250px" height="326px"></p>
            </figure>
        </div>

        <div class="col-sm-7">
            <h2><?php echo $book['author'] . '. ' . $book['name'] ?></h2>
            <h3>Описание</h3>
            <div class='info_book'>
                <?php echo $book['description']; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="content" class="col-sm">
            <h2>Рецензии</h2>
        </div>

        <div id="content" class="col-sm">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addReview">Добавить рецензию</button>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <?php
            $amountReviews = 0;

            $reviews = mysqli_query($connect, "SELECT * FROM `reviews` WHERE `book_id` = '$book_id'");

            echo "<ul class='list-group'>";
            while ($review = mysqli_fetch_assoc($reviews)) {
                $amountReviews++;
                $a = "<a href=reviews.php?" . $review['id'] . ">
        <h3>" . $review["title"] . "</h3>
        </a>";
                echo "<li class=\"list-group-item\">" . $a . "</li>";
            }
            echo "</ul>";
            ?>
        </div>
    </div>
</div>




<div class="modal fade" id="addReview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить новую рецензию</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="add_review.php" enctype="multipart/form-data">

                    <div class="form-group" hidden>
                        <input id="book_id" name="book_id" value="<?php echo $book['id'] ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="name">
                            <h4>Название рецензии</h4>
                        </label>
                        <input id="title" name="title" class="form-control" type="text">
                    </div>


                    <div class="form-group">
                        <label for="description">
                            <h4>Рецензия</h4>
                        </label>
                        <textarea id="review" name="review" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="author">
                            <h4>Автор</h4>
                        </label>
                        <input id="author" name="author" class="form-control" type="text">
                    </div>

                    <div class="form-group">
                        <button type="submit" name='add_book' class="btn btn-primary" data-toggle="button">Добавить</button>
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