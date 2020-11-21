<?php
require 'db.php';
$title = "Каталог";
include getcwd() . "/header.php";
?>

<?php

$choosedGenre = mysqli_real_escape_string($connect, $_SERVER['QUERY_STRING']);


if ($choosedGenre === 'all') {
    $books = mysqli_query($connect, "SELECT * FROM `books`");
} else {

    $books = mysqli_query($connect, "SELECT * FROM `books` WHERE `genre` = '" . rawurldecode($choosedGenre) . "'");
}

?>

<div class='container body-content'>
    <div class='row'>
        <div class='col'>

            <?php


            $amountBooks = 0;

            while ($book = mysqli_fetch_assoc($books)) {

                if ($amountBooks == 0)
                    echo "<div class='card-deck'>";
            ?>
                <div class="card ">
                    <a href=<?php echo 'info_book.php?' . $book['id'] ?>><img src=<?php echo $book['cover'] ?> width="180px" height="400px" class="card-img-top"></a>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $book['name']; ?></h5>
                        <p class="card-text"><?php echo $book['author']; ?></p>
                    </div>

                    <?php if (isset($_SESSION['logged_user'])) : ?>
                        <?php if ($_SESSION['logged_user']['login'] === 'admin') :  ?>
                            <div class='container'>
                                <div class='row'>
                                    <div class='col'>
                                        <form action=<?php echo 'update_book.php?' . $book['id'] ?> method='post'>
                                            <button class="btn btn-success btn-sm rounded-0" name='edit' type="submit" data-toggle="tooltip" data-placement="top">Редактировать <i class="fa fa-edit"></i></button>
                                        </form>
                                    </div>
                                    <div class='col'>
                                        <form action=<?php echo 'delete_book.php?' . $book['id'] ?> method='post'>
                                            <button class="btn btn-danger btn-sm rounded-0" name='delete' type="submit" data-toggle="tooltip" data-placement="top">Удалить <i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>

            <?php
                $amountBooks++;
                if ($amountBooks == 3) {
                    $amountBooks = 0;
                    echo "</div>";
                    echo "<br>";
                }
            }
            if ($amountBooks < 3 && $amountBooks != 0) {

                echo "</div>";
                echo "<br>";
            }

            ?>
        </div>
    </div>
</div>

<p></p>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Назад</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Вперед</a>
        </li>
    </ul>
</nav>

<?php
include getcwd() . "/footer.php";
?>