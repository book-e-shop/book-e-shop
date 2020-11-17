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
                        <input id="title" name="title" maxlength="50" class="form-control" type="text">
                    </div>


                    <div class="form-group">
                        <label for="description">
                            <h4>Рецензия</h4>
                        </label>
                        <textarea id="review" maxlength="10000" name="review" class="form-control"></textarea>
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
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>