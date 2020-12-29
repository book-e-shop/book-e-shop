<?php
@session_start();

if (isset($_POST["book_id"])) {
    if (!isset($_SESSION['list_product'])) {
        $_SESSION['list_product'] = array();
    }

    $book_id = $_POST["book_id"];
    $book_id = intval($book_id);

    if (!in_array($book_id, $_SESSION['list_product'])) {
        array_push($_SESSION['list_product'], $book_id);
    }
}
