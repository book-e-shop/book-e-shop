<?php
require 'db.php';
$title = "Книжный  магазин";
include getcwd() . "/header.php";
?>

<div class="container body-content">

    <div class="row">
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li class="bg-dark" data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                    </li>
                    <li class="bg-dark" data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li class="bg-dark" data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="jumbotron bg-light">
                            <div class="container">
                                <h1 id='stock' class="display-4">Акция</h1>
                                <p class="lead">Две книги по цене 1</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="jumbotron bg-light">
                            <div class="container">
                                <h1 class="display-4">Акция</h1>
                                <p class="lead">50 % на всю научную литературу</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="jumbotron bg-light">
                            <div class="container">
                                <h1 class="display-4">Акция</h1>
                                <p class="lead">Сдай старую книги и получи 2 новых</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 id='newBooks'>Новинки</h1>
        </div>
    </div>


    <div class='container'>
        <div class='row justify-content-center'>
            <div class='col-3'>

                <?php


                $amountBooks = 0;
                $books = mysqli_query($connect, "SELECT * FROM `books`");

                while ($book = mysqli_fetch_assoc($books)) {
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

                    if ($amountBooks % 3 === 0 && $amountBooks != 0) {
                        echo "</div>";
                        echo "</div>";
                        echo "<br>";

                        echo "<div class='row justify-content-center'>";

                        echo "<div class='col-3'>";
                    } else if($amountBooks != $books->num_rows) {
                        echo "</div>";
                        echo "<div class='col-3'>";
                    } else {
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col align-items-stretch">
            <h1 id='packs'>Подборки</h1>
        </div>
    </div>

    <div class="row">
        <div class="col align-items-stretch">
            <div class="card text-white bg-secondary">
                <div class="card-header">Топ-100</div>
                <div class="card-body">
                    <h5 id='classicBooks' class="card-title">Классическая литература</h5>
                    <p class="card-text">...</p>
                </div>
            </div>
        </div>

        <div class="col align-items-stretch">
            <div class="card text-white bg-success">
                <div class="card-header">Топ-100</div>
                <div class="card-body">
                    <h5 id='detectives' class="card-title">Детективы</h5>
                    <p class="card-text">...</p>
                </div>
            </div>
        </div>

        <div class="col align-items-stretch">
            <div class="card text-white bg-danger">
                <div class="card-header">Топ-100</div>
                <div class="card-body">
                    <h5 id='biographies' class="card-title">Биографии</h5>
                    <p class="card-text">...</p>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include getcwd() . "/footer.php";
?>