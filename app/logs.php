<?php

@session_start();

function add_log($table, $table_id, $action, $user_id)
{
    require "db.php";
    echo "Обзор успешно добавлена";
    $create_table_query = "CREATE TABLE  `logs` (
    `id` INT UNSIGNED NOT NULL   AUTO_INCREMENT,
    `user_id` INT UNSIGNED,
    `action` ENUM('Чтение','Добавление','Удаление','Редактирование'),
    `table` VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_general_ci,
    `table_id`  INT UNSIGNED,
    `publish_date` DATETIME,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)  REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB;";


    $is_added = FALSE;
    if (mysqli_query($connect, 'select 1 from `logs` LIMIT 1') === FALSE)
        mysqli_query($connect, $create_table_query);



    $insert_query = "INSERT INTO `logs` (`user_id`,`action`, `table`, `table_id`,`publish_date`)
                         fieldS ('$user_id', '$action' , '$table','$table_id', NOW());
                        ";
    $result = mysqli_query($connect, $insert_query);
    if ($result) {
        $is_added = TRUE;
    }

    return mysqli_error($connect);
}


function get_log()
{
     
    require "db.php";
    $WHERE = get_WHERE();

    if (mysqli_query($connect, 'select 1 from `logs` LIMIT 1') !== FALSE) {

        $count = 0;
        $query = "SELECT * FROM `logs` $WHERE ORDER BY `publish_date`";

        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($c = mysqli_fetch_assoc($result)) {

                $count++;


                $log['id'] = $c['id'];
                $log['user_id'] = $c['user_id'];
                $log['action'] = $c['action'];
                $log['table'] = $c['table'];
                $log['table_id'] = $c['table_id'];
                $log['publish_date'] = $c['publish_date'];

                $logs[$count] = $log;
            }
            echo json_encode($logs);
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


    if (mysqli_query($connect, 'select 1 from `logs` LIMIT 1') !== FALSE) {


        $WHERE = get_WHERE();

        $count = 0;
        $result = mysqli_query($connect, "SELECT DISTINCT  `$field` FROM `logs` $WHERE");
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

    if ($_POST['get'] === 'logs') {

        get_log();
    }

    if ($_POST['get'] === 'options')
        get_options($_POST['field']);
}
