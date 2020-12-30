<?php
function get_comments()
{
    require "db.php";
    @session_start();



    if (mysqli_query($connect, 'select 1 from `comments` LIMIT 1') !== FALSE) {


        $WHERE = get_WHERE();

        $count = 0;

        $result = mysqli_query($connect, "SELECT * FROM `comments` $WHERE");
        if ($result)
            if (mysqli_num_rows($result) > 0) {

                while ($c = mysqli_fetch_assoc($result)) {

                    $count++;


                    $comment['comment'] = $c['comment'];
                    $comment['comment_id'] = $c['id'];
                    $comment['date'] = $c['publish_date'];
                    $comment['book_id'] = $c['book_id'];
                    $comment['id'] = $c['id'];
                    $user_id = $c['user_id'];

                    if (mysqli_query($connect, 'select 1 from `users` LIMIT 1') !== FALSE) {


                        $result1 = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id'");

                        $user = mysqli_fetch_assoc($result1);
                        $comment['author'] = $user['surname'] . " " . $user['name'];
                        $comment['author_id'] = $user_id;
                        if (isset($_SESSION['logged_user'])) {
                            if ($_SESSION['logged_user']['id'] === $user_id) {
                                $comment['canEdit'] = TRUE;
                            }
                        } else {
                            $comment['canEdit'] = FALSE;
                        }
                    }

                    $comments[$count] = $comment;
                }

                echo json_encode($comments);
            }
    }
}

function get_WHERE()
{
    $WHERE = "";
    if (isset($_POST['conditions'])) {
        $v = 0;
        $WHERE = " WHERE ";
        foreach ($_POST['conditions'] as $key => $value) {

            $WHERE =  $WHERE . "`{$key}` = '{$value}'";


            if ($v < count($_POST['conditions']) - 1) {
                $WHERE =  $WHERE . " AND ";
            }
            $v++;
        }
    }
    return $WHERE;
}

function get_options($field)
{

    require "db.php";


    if (mysqli_query($connect, 'select 1 from `comments` LIMIT 1') !== FALSE) {


        $WHERE = get_WHERE();

        $count = 0;
        $result = mysqli_query($connect, "SELECT DISTINCT  `$field` FROM `comments` $WHERE");
        if ($result)
            if (mysqli_num_rows($result) > 0) {
                while ($c = mysqli_fetch_assoc($result)) {

                    $count++;


                    $options['option' . $count] = $c[$field];
                }
                $options['field'] = $field;
                echo json_encode($options);
            }
    }
}

if (isset($_POST['get'])) {

    if ($_POST['get'] === 'comments') {

        get_comments();
    }

    if ($_POST['get'] === 'options')
        get_options($_POST['field']);
}
