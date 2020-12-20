<?php

require "db.php";
@session_start();

$login = $_POST['login'];


$errors = array();

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");

if (mysqli_num_rows($check_user) > 0) {

    $user = mysqli_fetch_assoc($check_user);

    if (password_verify($_POST['password'], $user['password'])) {


        $_SESSION['logged_user'] = $user;
        echo "<div class='dropdown'>
        <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
           " . $_SESSION['logged_user']['name'] . " " . $_SESSION['logged_user']['surname'] . "
        </button>
        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
            <a class='dropdown-item' href='/lk_main.php'>Личный кабинет</a>
            <a class='dropdown-item' href='/logout.php'>Выйти</a>
        </div>
    </div>";
    }
} else {

    $errors[] = 'Неверный логин или пароль';
}

if (!empty($errors)) {

    echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
}
