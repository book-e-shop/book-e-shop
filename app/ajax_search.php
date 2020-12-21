<?php

require 'db.php';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($connect, $_POST["query"]);

    $searched_books = mysqli_query(
        $connect,
        "SELECT `books`.*, MATCH (`name`, `description`) AGAINST ('$search') AS score, MATCH (`name`) AGAINST ('$search') AS name_score 
        FROM `books` WHERE MATCH (`name`, `description`) AGAINST ('$search*' IN BOOLEAN MODE)
        ORDER BY name_score DESC, score DESC;"
    );

    if (mysqli_num_rows($searched_books) > 0) {
        $output = '';

        $output .= '
            <ul class="list-group" id="myList">
            ';
        while ($book = mysqli_fetch_assoc($searched_books)) {
            $output .= '
                <li class="list-group-item"><a href="' . 'info_book.php?' . $book['id'] . 
                '">' . $book['name'] . '. ' . $book["author"] . '</a></li>                    
                ';
        }

        $output .= '</ul>';

        echo $output;
    } else {
        echo 'Ничего не найдено';
    }
}
