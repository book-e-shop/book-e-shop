<?php
require 'db.php';
$title = "Каталог";
include getcwd() . "/header.php";
?>

<?php

$choosedGenre = $_SERVER['QUERY_STRING'];

if($choosedGenre === 'all') {
    $books = mysqli_query($connect, "SELECT * FROM `books`");
} else {
    $books = mysqli_query($connect, "SELECT * FROM `books` WHERE `genre` = '$choosedGenre'");
}

?>

<div class='container body-content'>
    <div class='row'>
        <div class='row'>

            <?php
            $amountBooks = 0;

            while ($book = mysqli_fetch_assoc($books)) {
                $amountBooks++;
            ?>

                <div class="col">
                    <figure class="sign">
                        <a href="/"><img src=<?php echo $book['cover'] ?> width="180px" height="256px"></a>
                        <figcaption>
                            <?php echo $book['author'] . '. ' . wordwrap($book['name'], 30, "<br/>", 1) ?>
                        </figcaption>
                    </figure>
                </div>

            <?php
                if ($amountBooks != 0 && $amountBooks % 5 == 0) {
                    echo "</div>";
                    echo "<div class='row'>";
                }
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