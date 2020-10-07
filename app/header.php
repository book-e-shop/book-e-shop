<?php
require "db.php"; // подключаем файл для соединения с БД

// Создаем переменную для сбора данных от пользователя по методу POST
$data = $_POST;

// Пользователь нажимает на кнопку "Зарегистрировать" и код начинает выполняться
if (isset($data['do_signup'])) {

    // Регистрируем
    // Создаем массив для сбора ошибок
    $errors = array();

    // Проводим проверки

    if ($data['password_2'] != $data['password']) {

        $errors[] = "Повторный пароль введен не верно!";
    }
    // функция mb_strlen - получает длину строки
    // Если логин будет меньше 5 символов и больше 90, то выйдет ошибка
    if (mb_strlen($data['login']) < 5 || mb_strlen($data['login']) > 90) {

        $errors[] = "Недопустимая длина логина";
    }

    if (mb_strlen($data['name']) < 3 || mb_strlen($data['name']) > 50) {

        $errors[] = "Недопустимая длина имени";
    }

    if (mb_strlen($data['surname']) < 5 || mb_strlen($data['surname']) > 50) {

        $errors[] = "Недопустимая длина фамилии";
    }

    if (mb_strlen($data['password']) < 2 || mb_strlen($data['password']) > 8) {

        $errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";
    }

    // Проверка на уникальность логина
    if (R::count('users', "login = ?", array($data['login'])) > 0) {

        $errors[] = "Пользователь с таким логином существует!";
    }

    // Проверка на уникальность email

    if (R::count('users', "email = ?", array($data['email'])) > 0) {

        $errors[] = "Пользователь с таким Email существует!";
    }


    if (empty($errors)) {

        // Все проверено, регистрируем
        // Создаем таблицу users
        $user = R::dispense('users');

        // добавляем в таблицу записи
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->surname = $data['surname'];

        // Хешируем пароль
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);

        // Сохраняем таблицу
        R::store($user);
        echo '<div style="color: green; ">Вы успешно зарегистрированы! Можно <a href="login.php">авторизоваться</a>.</div><hr>';
    } else {
        // array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
        echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
    }
}

$data = $_POST;

// Пользователь нажимает на кнопку "Авторизоваться" и код начинает выполняться
if (isset($data['do_login'])) {
    // Создаем массив для сбора ошибок
    $errors = array();

    // Проводим поиск пользователей в таблице users
    $user = R::findOne('users', 'login = ?', array($data['login']));
    echo '<div style="color: red; ">' . $data['login'] . '</div><hr>';

    if ($user) {

        // Если логин существует, тогда проверяем пароль
        if (password_verify($data['password'], $user->password)) {

            // Все верно, пускаем пользователя
            $_SESSION['logged_user'] = $user;

            // Редирект на главную страницу
            header('Location: index.php');
        } else {

            $errors[] = 'Пароль неверно введен!';
        }
    } else {
        $errors[] = 'Пользователь с таким логином не найден!';
    }

    if (!empty($errors)) {

        echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
    }
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../assets/css/books.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>


</head>

<body>

    <nav class="navbar fixed-top bg-light  menu" id="menu">

        <div class="col-md-2">
            <a href="/">
                <h2>Книжный магазин</h2>
            </a>
        </div>
        <div class="col-md-2">
            <a type="button" id="sidebarCollapse">
                <h2><i class="fas fa-bars"></i> Каталог</h2>
            </a>
        </div>
        <div class="col-md-5">
            <input class="form-control" type="search" placeholder="Поиск" aria-label="Search">
        </div>

        <div class="col-md-1">
            <a href="cart">
                <h2><i class="fas fa-shopping-cart"></i></h2>
            </a>

        </div>
        <div class="col-md-2">
            <?php if (isset($_SESSION['logged_user'])) : ?>

                <a href="/lk_main.php">
                    <h2><?php echo $_SESSION['logged_user']->name . ' ' . $_SESSION['logged_user']->surname; ?></h2>
                </a>

            <?php else : ?>

                <a href="" data-toggle="modal" data-target="#modalLoginForm">
                    <h2><i class="fas fa-sign-in-alt"></i></h2>
                </a>

            <?php endif; ?>
        </div>
    </nav>

    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Авторизация/Регистрация</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Login" role='tab'>Авторизация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Registration" role='tab'>Регистрация</a>
                        </li>
                    </ul>

                    <div class='tab-content'>
                        <div class="tab-pane fade show active" id="Login">
                            <form action='/' method='post'>
                                <input type="text" id="login" name='login' placeholder="Логин" class="form-control" required>
                                <p></p>
                                <input type="password" name='password' id="defaultForm-pass" class="form-control validate" placeholder="Пароль" required>
                                <p></p>
                                <button type="submit" name='do_login' class="btn btn-primary" data-toggle="button">Войти</button>
                                <p></p>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="Registration">
                            <form action='/' method='post'>
                                <input type="text" id="surname" name='surname' placeholder="Фамилия" class="form-control" required>
                                <p></p>
                                <input type="text" id="name" name='name' placeholder="Имя" class="form-control" required>
                                <p></p>
                                <input type="email" id="email" name='email' class="form-control validate" placeholder="Почта" required>
                                <p></p>
                                <input type="text" id="login" name='login' placeholder="Логин" class="form-control" required>
                                <p></p>
                                <input type="password" id="password" name='password' class="form-control validate" placeholder="Пароль" required>
                                <p></p>
                                <input type="password" id="password_2" name='password_2' class="form-control validate" placeholder="Повторите пароль" required>
                                <p></p>
                                <button type="submit" name='do_signup' class="btn btn-primary" data-toggle="button">Зарегистрироваться</button>
                                <p></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <nav id="sidebar">

        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>


        <ul class="list-unstyled components">
            <p>Категории книг</p>
            <li class="active"><a href="#">Все книги</a></li>
            <li><a href="#">Классическая литература</a></li>
            <li><a href="#">Детективы</a></li>
            <li><a href="#">Для детей</a></li>
            <li><a href="#">Исторические</a></li>
        </ul>

    </nav>