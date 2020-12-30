<?php
@session_start();

require 'db.php';
$output = '';

if (isset($_SESSION['logged_user'])) {
    if (isset($_SESSION['list_product'])) {

        $sum = 0;
        $list_product = $_SESSION['list_product'];
       
        $output .= '
        <div class="container body-content">
            <table class="table table-hover">
            ';

        $output .= '<thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Название книги</th>
                                <th scope="col">Стоимость</th>
                                <th scope="col"></th>
                            </tr>
                        </thead><tbody>';


        foreach ($list_product as $i => $value) {
            $book = mysqli_query($connect, "SELECT * FROM `books` WHERE `id` = '$list_product[$i]'");
            $book = mysqli_fetch_assoc($book);


            $output .=
                '
                        <tr>
                            <td><img src="' . $book['cover'] . '" width="100px" height="150px"></td>
                            <td>' . $book['name'] . '</td>
                            <td>' . $book['price'] . ' руб.</td>
                            <td><button   deletedBookId="' . $list_product[$i] . '" class="btn btn-danger btn-sm rounded-0 deleteBook" type="button"><i class="fa fa-trash"></i></button></td>
                        </tr>
                   ';

            $sum += intval($book['price']);
        }
        $output .= ' </tbody></table>
                <br></br>
                <h4>Общая стоимость: ' . $sum . ' руб.</h4>
                <br></br>
                <a href="/add_order.php" class="btn btn-primary" name="createOrder" id="createOrder" role="button">Оформить заказ</a>
            </div>';
    } else {
        $output .= '<div class="container body-content h-100 d-flex justify-content-center">
                    <h4 class="display-4">В корзине пусто</h4>
                </div>
            </div>';
    }
} else {
    $output .= '<div class="container body-content h-100 d-flex justify-content-center">
                <h4 class="display-4">Для начала покупок необходимо авторизоваться</h4>
            </div>
        </div>';
}

$_SESSION['sum_order'] = $sum;
$arr_output['output'] = $output;
echo json_encode($arr_output);
