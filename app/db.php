<?php

require "libs/rb-mysql.php";



$connect = mysqli_connect('localhost', 'root', '', 'book_shop');

if (!$connect) {
        die('Error connect to DataBase');
}

// Подключаемся к БД
R::setup(
        'mysql:host=localhost;dbname=book_shop',
        'root',
        ''
);
