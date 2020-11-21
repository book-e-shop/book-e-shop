<?php
require "db.php";
$title = "Редактирование информации о книге";
include getcwd() . "/header.php";


if (isset($_POST['save'])) {

    $book_id = $_SERVER['QUERY_STRING'];
    settype($book_id, 'integer');
    $book = mysqli_query($connect, "SELECT * FROM `books` WHERE `id` = '$book_id'");
    $book = mysqli_fetch_assoc($book);

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

    if ($cover['name']) {
        $cover_name = 'www/media/' . uniqid() . '.' . pathinfo($cover["name"])['extension'];
        move_uploaded_file($cover['tmp_name'], $cover_name);

        $update_query = "UPDATE `books` SET `name` = '$name', `description` = '$description', 
                `author` = '$author', `genre` = '$genre', `release_date` = '$release_date', 
                `cover_type` = '$cover_type', `ISBN` = '$ISBN', `language` = '$language', 
                `size_in_pages` = '$size_in_pages', `price` = '$price', `cover` = '$cover_name' WHERE `books`.`id` = '$book_id';";
    } else {
        $update_query = "UPDATE `books` SET `name` = '$name', `description` = '$description', 
                `author` = '$author', `genre` = '$genre', `release_date` = '$release_date', 
                `cover_type` = '$cover_type', `ISBN` = '$ISBN', `language` = '$language', 
                `size_in_pages` = '$size_in_pages', `price` = '$price' WHERE `books`.`id` = '$book_id';";
    }

    if (mysqli_query($connect, $update_query)) {
        echo "Книга успешно обновлена";
    }

    echo mysqli_error($connect);
} else {
    $book_id = $_SERVER['QUERY_STRING'];
    settype($book_id, 'integer');
    $book = mysqli_query($connect, "SELECT * FROM `books` WHERE `id` = '$book_id'");
    $book = mysqli_fetch_assoc($book);

    $name = $book['name'];
    $description = $book['description'];
    $author = $book['author'];
    $genre = $book['genre'];
    $release_date = $book['release_date'];
    $cover_type = $book['cover_type'];
    $ISBN = $book['ISBN'];
    $publisher = $book['publisher'];
    $language  = $book['language'];
    $size_in_pages = $book['size_in_pages'];
    $price = $book['price'];
}

?>

<div class="container body-content">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Редактирование информации о книге</h2>
                <br></br>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form method="post" action="<?php "update_book.php?" . $book_id ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">
                            <h4>Название книги</h4>
                        </label>
                        <input id="name" name="name" class="form-control" maxlength="100" type="text" value="<?php echo htmlspecialchars($name); ?>">
                    </div>

                    <div class="form-group">
                        <label for="description">
                            <h4>Описание</h4>
                        </label>
                        <textarea id="description" name="description" maxlength="500" class="form-control"><?php echo htmlspecialchars($description); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="author">
                            <h4>Автор</h4>
                        </label>
                        <input id="author" name="author" class="form-control" maxlength="50" type="text" value="<?php echo htmlspecialchars($author); ?>">
                    </div>

                    <div class="form-group">
                        <label for="genre">
                            <h4>Жанр</h4>
                        </label>
                        <select id="genre" name="genre" class="form-control">
                            <option <?php if ($genre === 'Детектив') echo ' selected="selected"'; ?>>Детектив</option>
                            <option <?php if ($genre === 'Любовный роман') echo ' selected="selected"'; ?>>Любовный роман</option>
                            <option <?php if ($genre === 'Учебная и образовательная литература') echo ' selected="selected"'; ?>>Учебная и образовательная литература</option>
                            <option <?php if ($genre === 'Классическая литература') echo ' selected="selected"'; ?>>Классическая литература</option>
                            <option <?php if ($genre === 'Биографии и мемуары') echo ' selected="selected"'; ?>>Биографии и мемуары</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="release_date">
                            <h4>Дата выпуска</h4>
                        </label>
                        <input id="release_date" name="release_date" class="form-control" type="date" value="<?php echo htmlspecialchars($release_date); ?>">
                    </div>


                    <div class="form-group">
                        <label for="cover_type">
                            <h4>Тип обложки</h4>
                        </label>
                        <select id="cover_type" name="cover_type" class="form-control" selected="<?php echo htmlspecialchars($cover_type); ?>">
                            <option <?php if ($cover_type === 'Твердый переплет') echo ' selected="selected"'; ?>>Твердый переплет</option>
                            <option <?php if ($cover_type === 'Мягкий переплет') echo ' selected="selected"'; ?>>Мягкий переплет</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="ISBN">
                            <h4>ISBN</h4>
                        </label>
                        <input id="ISBN" name="ISBN" class="form-control" maxlength="20" type="text" value="<?php echo htmlspecialchars($ISBN); ?>">
                    </div>

                    <div class="form-group">
                        <label for="publisher">
                            <h4>Издательство</h4>
                        </label>
                        <input id="publisher" name="publisher" class="form-control" maxlength="50" type="text" value="<?php echo htmlspecialchars($publisher); ?>">
                    </div>


                    <div class="form-group">
                        <label for="language">
                            <h4>Язык издания</h4>
                        </label>
                        <input id="language" name="language" class="form-control" maxlength="50" type="text" value="<?php echo htmlspecialchars($language); ?>">
                    </div>

                    <div class="form-group">
                        <label for="size_in_pages">
                            <h4>Объем издания</h4>
                        </label>
                        <input id="size_in_pages" name="size_in_pages" min="1" max="5000" class="form-control" type="number" value="<?php echo htmlspecialchars($size_in_pages); ?>">
                    </div>

                    <div class="form-group">
                        <label for="price">
                            <h4>Стоимость</h4>
                        </label>
                        <div class="form-group-prepend">
                            <span class="form-group-text">₽</span>
                        </div>
                        <input id="price" name="price" class="form-control" min="0" type="number" value="<?php echo htmlspecialchars($price); ?>">
                    </div>

                    <div class="form-group">
                        <label for="cover">
                            <h4>Обложка</h4>
                        </label>
                        <input id="cover" name="cover" class="form-control-file" type="file">
                    </div>
                    <div class="form-group">
                        <button type="submit" name='save' class="btn btn-primary" data-toggle="button">Сохранить</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php
include getcwd() . "/footer.php";
?>