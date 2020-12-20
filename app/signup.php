<?php


require "db.php";

$name = $_POST['name'];
$surname = $_POST['surname'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$errors = array();

if ($password != $password_confirm) {
    $errors[] = "Повторный пароль введен не верно!";
}

if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
    $errors[] = "Недопустимая длина логина";
}

if (mb_strlen($name) < 3 || mb_strlen($name) > 50) {
    $errors[] = "Недопустимая длина имени";
}

if (mb_strlen($surname) < 5 || mb_strlen($surname) > 50) {
    $errors[] = "Недопустимая длина фамилии";
}

if (mb_strlen($password) < 2 || mb_strlen($password) > 8) {
    $errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";
}

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");

if (mysqli_num_rows($check_user) != 0) {
    $errors[] = "Пользователь с таким логином уже существует";
}

// сделать проверку на уникальность логина и почты

if (empty($errors)) {

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($connect, "INSERT INTO `users` (`id`, `login`, `email`, `name`, `surname`, `password`) VALUES (NULL, '$login', '$email', '$name', '$surname', '$password')");

    header('Location: index.php');
} else {
    // array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
    echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
}
