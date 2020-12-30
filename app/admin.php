<?php
require 'db.php';
$title = "Каталог";
include getcwd() . "/header.php";
?>

<?php
if (isset($_SESSION['logged_user'])) {
    if ($_SESSION['logged_user']['login'] === 'admin') {

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
                                    <select id="t1user_id-select" class="custom-select">
                                        <option value='0' selected>Все</option>
                                    </select>
                                </th>
                                <th scope="col">
                                    <select id="t1action-select" class="custom-select">
                                        <option value='0' selected>Все</option>
                                    </select>
                                </th>
                                <th scope="col">
                                    <select id="t1table-select" class="custom-select">
                                        <option value='0' selected>Все</option>
                                    </select>
                                </th>
                                <th scope="col">
                                    <select id="t1table_id-select" class="custom-select">
                                        <option value='0' selected>Все</option>
                                    </select>
                                </th>
                                <th scope="col"><input id="t1date1" type="datetime-local"><input id="t1date2" type="datetime-local"></th>
                                <th scope="col"> <button id="update-logs" class="btn btn-primary">Показать</button></th>
                            </tr>
                        </thead>
                        <tbody id="logs">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h1>Комментарии</h1>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <table class="table ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">ID Пользователя</th>
                                <th scope="col">Пользователь</th>
                                <th scope="col">ID книги</th>
                                <th scope="col">Книга</th>
                                <th scope="col">Комментарий</th>
                                <th scope="col">Время</th>
                                <th scope="col"></th>

                            </tr>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">
                                    <select id="t2user_id-select" class="custom-select">
                                        <option value='0' selected>Все</option>
                                    </select>
                                </th>
                                <th scope="col"></th>
                                <th scope="col">
                                    <select id="t2book_id-select" class="custom-select">
                                        <option value='0' selected>Все</option>
                                    </select>
                                </th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"><input id="t2date1" type="date"><input id="t2date2" type="date"></th>
                                <th scope="col"> <button id="update-comments" class="btn btn-primary">Показать</button></th>
                            </tr>
                        </thead>
                        <tbody id="comments">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        <script src="../assets/js/admin-logs.js">
        </script>
        <script src="../assets/js/admin-comments.js">
        </script>

<?php }
}
?>
<?php
include getcwd() . "/footer.php";
?>