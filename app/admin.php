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



<div class='container-fluid body-content'>
    <div class="row">
        <div class="col">
            <a class="nav-link" href="/add_book.php">
                <h1>Добавить книгу</h1>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1>Логи</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table ">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ID Пользователя</th>
                        <th scope="col">Действие</th>
                        <th scope="col">Таблица</th>
                        <th scope="col">ID записи в таблице</th>
                        <th scope="col">Время</th>
                        <th scope="col"></th>
                    </tr>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">
                            <select id="user_id-select" class="custom-select">
                                <option value='0' selected>Все</option>
                            </select>
                        </th>
                        <th scope="col">
                            <select id="action-select" class="custom-select">
                                <option value='0' selected>Все</option>
                            </select>
                        </th>
                        <th scope="col">
                            <select id="table-select" class="custom-select">
                                <option value='0' selected>Все</option>
                            </select>
                        </th>
                        <th scope="col">
                            <select id="table_id-select" class="custom-select">
                                <option value='0' selected>Все</option>
                            </select>
                        </th>
                        <th scope="col"><input id="" type="datetime-local"><input id="date" type="datetime-local"></th>
                        <th scope="col"> <button id="update-logs" class="btn btn-primary">Показать</button></th>
                    </tr>
                </thead>
                <tbody id="logs">

                </tbody>
            </table>
        </div>
    </div>


</div>


<script src="../assets/js/logs.js">
</script>

<?php
include getcwd() . "/footer.php";
?>