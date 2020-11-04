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
    <div class="row">
        <div class='row'>
            <div class="col-sm-3">
                <figure class="sign">
                    <p><a href="#"><img src=<?php echo $book['cover'] ?> width="250px" height="326px"></a></p>
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
    </div>
</div>

<?php
include getcwd() . "/footer.php";
?>