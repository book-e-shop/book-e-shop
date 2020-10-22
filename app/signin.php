<?php

require "db.php";

$login = $_POST['login'];

if (isset($_POST['do_login'])) {

    $errors = array();

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");

    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        echo $_POST['password'];
        echo json_encode($user);

        if (password_verify($_POST['password'], $user['password'])) {

            echo "a1";
            $_SESSION['logged_user'] = $user;

            header('Location: index.php');
        }
    } else {

        $errors[] = 'Неверный логин или пароль';
    }

    if (!empty($errors)) {

        echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
    }
}
