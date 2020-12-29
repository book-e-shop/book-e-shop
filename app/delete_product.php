<?php
@session_start();

if (isset($_POST["book_id"])) {
    $book_id = $_POST["book_id"];
    $book_id = intval($book_id);

    $_SESSION['list_product'] = array_diff($_SESSION['list_product'], array($book_id));
}
