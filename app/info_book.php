<?php
require 'db.php';
$title = "Каталог";
include getcwd() . "/header.php";
?>

<?php
$book_id = $_SERVER['QUERY_STRING'];
settype($book_id, 'integer');
$book = mysqli_query($connect, "SELECT * FROM `books` WHERE `id` = '$book_id'");
$book = mysqli_fetch_assoc($book);
?>


<style>
    .review {
        width: 100%;
        height: 100px;
        border: 1px solid black;
        resize: vertical;
        overflow: auto;
    }
</style>
<div class='container body-content'>

    <div class='row'>
        <div class="col-sm-3">
            <figure class="sign">
                <p><img src=<?php echo $book['cover'] ?> width="250px" height="326px"></p>
            </figure>
        </div>

        <div class="col-sm-7">
            <h1><?php echo $book['author'] . '. ' . $book['name'] ?></h1>
            <h3>Описание</h3>
            <div class='info_book'>
                <?php echo $book['description']; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">Жанр</th>
                        <th scope="col">Тип обложки</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Издательство</th>
                        <th scope="col">Объем издания</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $book['genre']; ?></td>
                        <td><?php echo $book['cover_type']; ?></td>
                        <td><?php echo $book['ISBN']; ?></td>
                        <td><?php echo $book['publisher']; ?></td>
                        <td><?php echo $book['size_in_pages']; ?> </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="card mcard">
                <div class="card-header">
                    <h1>Рейтинг</h1>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm">
                                        <h3>Моя оценка</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                1
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                2
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                3
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                4
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                5
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm">
                                        <h3>Средняя оценка</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h1><i class="fas fa-star">5</i></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm">
                                        <h3>Распределение оценок</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                                <i class="fas fa-star">5</i>
                                                <span class="badge badge-success  badge-pill">14</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <i class="fas fa-star"> 4</i>
                                                <span class="badge badge-primary badge-pill">2</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <i class="fas fa-star">3</i>
                                                <span class="badge badge-info badge-pill">1</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <i class="fas fa-star">2</i>
                                                <span class="badge badge-warning  badge-pill">1</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <i class="fas fa-star">1</i>
                                                <span class="badge badge-danger badge-pill">1</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="card mcard">
                <div class="card-header">

                    <h1>Рецензии</h1>

                    <button id="addReviewBTN" class="btn btn-primary" data-toggle="modal" data-target="#addReview">Добавить рецензию</button>

                </div>
                <div class="card-body">
                    <?php

                    if (mysqli_query($connect, 'select 1 from `reviews` LIMIT 1') !== FALSE) {
                        $amountReviews = 0;

                        $reviews = mysqli_query($connect, "SELECT * FROM `reviews` WHERE `book_id` = '$book_id'");

                        echo "<ul class='list-group-flush'>";
                        while ($review = mysqli_fetch_assoc($reviews)) {

                            $amountReviews++;
                            $a = "<a href=reviews.php?" . $review['id'] . "><h3>" . $review["title"] . "</h3></a>";
                            echo "<li class=\"list-group-item\">" . $a . "</li>";
                        }
                        echo "</ul>";
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div id="content" class="col-sm">

            <div class="card mcard">
                <div class="card-header">
                    <h1>Комментарии</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <form id="comments-form" onsubmit="return getContent()" method="post" action="add_review.php" enctype="multipart/form-data">

                            
                                <div class="form-group">
                                    <textarea id="comment" maxlength="500" name="comment" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <button id="add-comment-btn" type="button" class="btn btn-primary" data-toggle="button">Добавить</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm" id="comments">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <div class="card mcard">
                <div class="card-header">
                    <h1>Фрагмент книги</h1>
                </div>
                <div class="card-body">
                    <script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
                    <script type="text/javascript">
                        google.books.load();

                        function alertInitialized() {
                            $("#viewerCanvas").html("<h4>Фрагмент не найден</h4>")
                            $("#viewerCanvas").height(10);

                        }

                        function initialize() {
                            var viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'));
                            viewer.load("<?php echo "ISBN:" . str_replace("-", "", $book['ISBN']); ?>", alertInitialized);
                        }

                        google.books.setOnLoadCallback(initialize);
                    </script>
                    <div id="viewerCanvas" style="width: 100%; height: 50vh;text-align: center;"></div>
                </div>
            </div>

        </div>
    </div>

</div>


<script>
    function getContent() {
        document.getElementById("review").value = document.getElementById("reviewDIV").innerHTML;
    }
</script>







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
                <form id="speller-form" onsubmit="return getContent()" method="post" action="add_review.php" enctype="multipart/form-data">

                    <div class="form-group" hidden>
                        <input id="book_id" name="book_id" value="<?php echo $book['id'] ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="name">
                            <h4>Название рецензии</h4>
                        </label>
                        <input id="title" name="title" maxlength="50" class="form-control" type="text">
                    </div>


                    <div class="form-group">
                        <label for="description">
                            <h4>Рецензия</h4>
                        </label>
                        <div id="reviewDIV" class="review" contenteditable="true"></div>
                        <textarea id="review" maxlength="10000" style="display:none" name="review" class="form-control"></textarea>
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
                        <button type="submit" name='add_book' class="btn btn-primary" data-toggle="button">Добавить</button>

                        <button type="button" id='speller' class="btn btn-primary" data-toggle="button">Проверить ошибки</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>


<script src="../assets/js/speller.js">
</script>

<script src="../assets/js/comments.js">
</script>


<?php
include getcwd() . "/footer.php";
?>