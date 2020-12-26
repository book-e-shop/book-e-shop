<?php

if (isset($_SESSION['list_product'])) {
    $_SESSION['list_product'] = array();
}

$book_id = $_SERVER['QUERY_STRING'];
$book_id = intval($book_id);

array_push($_SESSION['list_product'], $book_id);

echo "<pre>";
print_r($_SESSION['list_product']);
echo "</pre>";



