<?php
include getcwd() . "/header.php";
?>

<?php

if (isset($_POST['add_book'])) {
    require "db.php";

    $name = $_POST['name'];
    $description = $_POST['description'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $cover_type = $_POST['cover_type'];
    $ISBN = $_POST['ISBN'];
    $publisher = $_POST['publisher'];
    $language  = $_POST['language'];
    $size_in_pages = $_POST['size_in_pages'];
    $price = $_POST['price'];
    $cover = $_FILES['cover'];

    $cover = 'www/media/' . uniqid() . '.' . pathinfo($cover["name"])['extension'];

    $create_table_query = "CREATE TABLE `books` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
                `description` TEXT(500) CHARACTER SET utf8 COLLATE utf8_general_ci,
                `author` VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_general_ci,
                `genre` ENUM('Detective','Любовный роман','Учебная и образовательная литература','Классическая литература','Биографии и мемуары'),
                `release_date` DATE,
                `cover_type` ENUM('Твердый переплет','Мягкий переплет'),
                `ISBN` VARCHAR(13)  CHARACTER SET utf8 COLLATE utf8_general_ci,
                `publisher` VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_general_ci,
                `language` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
                `size_in_pages` DECIMAL,
                `price` DECIMAL,
                `cover` VARCHAR(200)  CHARACTER SET utf8 COLLATE utf8_general_ci,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB;";

    $is_added = FALSE;
    if (mysqli_query($connect, 'select 1 from `books` LIMIT 1')) {

        move_uploaded_file($_FILES['cover']['tmp_name'], $cover);
        $insert_query = "INSERT INTO `books` (`name`, `description`, `author`, `genre`, `release_date` , `cover_type` , `ISBN`, `publisher`, `language`,`size_in_pages`, `price`, `cover`)
                         VALUES ('$name', '$description', '$author', '$genre', '$release_date', '$cover_type', '$ISBN', '$publisher', '$language', '$size_in_pages', '$price', '$cover');
                        ";
        if (mysqli_query($connect, $insert_query)) {
            $is_added = TRUE;
        }
    } else {
        mysqli_query($connect, $create_table_query);
    }

    mysqli_close($connect);
}
?>



<div class="container body-content">
    <div class="container">
        <?php
        if ($is_added) {
            echo "<div class='row'>
                    <div class='col'>
                        <div class='alert alert-success' role='alert'>
                            Книга \"'.$name.'\" успешно добавлена !
                        </div>
                    </div>
                  </div>";
        }
        echo $_SERVER['QUERY_STRING'];
        ?>
        <div class="row">
            <div class="col">
                <h2>Добавление книги</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="post" action="add_book.php" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="name">
                        <h4>Название книги</h4>
                    </label>
                    <input id="name" name="name" class="form-control" type="text">
                </div>


                <div class="form-group">
                    <label for="description">
                        <h4>Описание</h4>
                    </label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="author">
                        <h4>Автор</h4>
                    </label>
                    <input id="author" name="author" class="form-control" type="text">
                </div>


                <div class="form-group">
                    <label for="genre">
                        <h4>Жанр</h4>
                    </label>
                    <select id="genre" name="genre" class="form-control">
                        <option>Детектив</option>
                        <option>Любовный роман</option>
                        <option>Учебная и образовательная литература</option>
                        <option>Классическая литература</option>
                        <option>Биографии и мемуары</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="release_date">
                        <h4>Дата выпуска</h4>
                    </label>
                    <input id="release_date" name="release_date" class="form-control" type="date">
                </div>


                <div class="form-group">
                    <label for="cover_type">
                        <h4>Тип обложки</h4>
                    </label>
                    <select id="cover_type" name="cover_type" class="form-control">
                        <option>Твердый переплет</option>
                        <option>Мягкий переплет</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="ISBN">
                        <h4>ISBN</h4>
                    </label>
                    <input id="ISBN" name="ISBN" class="form-control" type="text">
                </div>


                <div class="form-group">
                    <label for="publisher">
                        <h4>Издательство</h4>
                    </label>
                    <input id="publisher" name="publisher" class="form-control" type="text">
                </div>


                <div class="form-group">
                    <label for="language">
                        <h4>Язык издания</h4>
                    </label>
                    <input id="language" name="language" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label for="size_in_pages">
                        <h4>Объем издания</h4>
                    </label>
                    <input id="size_in_pages" name="size_in_pages" class="form-control" type="number">
                </div>

                <div class="form-group">
                    <label for="price">
                        <h4>Стоимость</h4>
                    </label>
                    <div class="form-group-prepend">
                        <span class="form-group-text">₽</span>
                    </div>
                    <input id="price" name="price" class="form-control" type="number">
                </div>


                <div class="form-group">
                    <label for="cover">
                        <h4>Обложка</h4>
                    </label>
                    <input id="cover" name="cover" class="form-control-file" type="file">
                </div>
                <div class="form-group">
                    <button type="submit" name='add_book' class="btn btn-primary" data-toggle="button">Добавить</button>
                </div>

            </form>
        </div>
    </div>
</div>






<?php
include getcwd() . "/footer.php";
?>