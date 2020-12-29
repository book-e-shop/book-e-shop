<?php
require "db.php";
$title = "Оформление заказа";
include getcwd() . "/header.php";

$is_added = FALSE;

if (isset($_POST['add_order'])) {

    $create_table_query = "CREATE TABLE  `orders` (
        `id` INT UNSIGNED NOT NULL,
        `book_id` INT UNSIGNED,
        `user_id` INT UNSIGNED,
        `payment_method` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
        `address` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
        `add_date` DATE,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`book_id`)  REFERENCES `books` (`id`) ON DELETE CASCADE,
        FOREIGN KEY (`user_id`)  REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB;";

    $last_id = 0;

    if (mysqli_query($connect, 'select 1 from `books` LIMIT 1') === FALSE) {
        mysqli_query($connect, $create_table_query);
        $order_id = 1;
    } else {
        $res_query = mysqli_query($connect, "SELECT id FROM `order` ORDER BY id DESC LIMIT 1");
        $order_id = mysqli_fetch_assoc($res_query)['id'] + 1;
    }

    $user_id = mysqli_real_escape_string($connect, $_SESSION['logged_user']['id']);
    $payment_method = mysqli_real_escape_string($connect, $_POST['payment_method']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);

    $list_products = $_SESSION['list_product'];

    foreach ($list_products as $product_id) {
        $book = mysqli_query($connect, "SELECT * FROM `books` WHERE `id` = '$product_id'");
        $book = mysqli_fetch_assoc($book);

        $book_id = $book['id'];

        $insert_query = "INSERT INTO `orders` (`id`, `book_id`, `user_id`, `payment_method`, `address`, `add_date`)
                            VALUES ('$order_id', '$book_id','$user_id', '$payment_method', '$address', CURDATE());
                            ";
                        
        $_SESSION['list_product'] = array_diff($_SESSION['list_product'], array($book_id));
    }

    if (mysqli_query($connect, $insert_query)) {
        $is_added = TRUE;

        echo "Заказ успешно оформлен";
    }
} else {
    $user_id = mysqli_real_escape_string($connect, $_SESSION['logged_user']['id']);
    $user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id'");
    $user = mysqli_fetch_assoc($user);
}
?>


<div class="container body-content">
    <div class="container">
        <?php
        if ($is_added) {
            echo "<div class='row'>
                    <div class='col'>
                        <div class='alert alert-success' role='alert'>
                            Заказ успешно оформлен!
                        </div>
                    </div>
                  </div>";
        }
        ?>
        <div class="row">
            <div class="col">
                <h2>Оформление заказа</h2>
            </div>
        </div>
        <br></br>
        <div class="row">
            <div class="col">
                <form method="post" action="/add_order.php">

                    <div class="form-group">
                        <label for="surname">
                            <h4>Фамилия</h4>
                        </label>
                        <input id="surname" name="surname" class="form-control" maxlength="100" type="text" value="<?php echo htmlspecialchars($user['surname']); ?>">
                    </div>


                    <div class="form-group">
                        <label for="name">
                            <h4>Имя</h4>
                        </label>
                        <input id="name" name="name" maxlength="100" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <h4>Почта</h4>
                        </label>
                        <input id="email" name="email" maxlength="100" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="address">
                            <h4>Адрес доставки</h4>
                        </label>
                        <input id="address" name="address" class="form-control" maxlength="100" type="text">
                    </div>

                    <div class="form-group">
                        <label for="payment_method">
                            <h4>Способ оплаты</h4>
                        </label>
                        <select id="payment_method" name="payment_method" class="form-control">
                            <option>Картой онлайн</option>
                            <option>Картой курьеру</option>
                            <option>Наличными курьеру</option>
                        </select>
                    </div>

                    <br></br>
                    <h4>Общая стоимость: <?php echo $_SESSION['sum_order']; ?> руб.</h4>

                    <br></br>

                    <div class="form-group">
                        <button type="submit" name='add_order' class="btn btn-primary" data-toggle="button">Оформить заказ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include getcwd() . "/footer.php"; ?>