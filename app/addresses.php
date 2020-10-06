<?php
include getcwd() . "/header.php";
?>



<?php
$data = $_POST;

if (isset($data['add_address'])) {


    $datata =  implode(' ', $data);
    if (isset($_SESSION['logged_user']))
        $user = $_SESSION['logged_user'];

    $address = R::dispense('addresses');

    $address->zip_code = $data['zip_code'];
    $address->region = $data['region'];
    $address->district = $data['district'];
    $address->city = $data['city'];
    $address->street = $data['street'];
    $address->house = $data['house'];

    R::store($address);

    $user->ownAddressesList[] = $address;

    R::store($user);
}
?>



<div class="container body-content">
    <div class="row">
        <div class="col">
            <?php if (isset($_SESSION['logged_user'])) : ?>

                <?php $user = $_SESSION['logged_user']; ?>

                <?php

                $addresses = R::getAll(
                    'select * from addresses where users_id= :user_id',
                    array(':user_id' => $user->id)
                );


                if (count($addresses) > 0) {

                    echo '<ul class="list-group">';
                    foreach ($addresses as $address) {
                        $str = $address['zip_code'] . ' ' . $address['region'] . ' ' . $address['district'] . ' ' . $address['city'];
                        echo '<li class="list-group-item">' . $str . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<h1> Адреса не найдены </h1>';
                }
                ?>
        </div>
    </div>
    <div class="row">
        <a href="" data-toggle="modal" data-target="#modalAddAddress">
            <h2>Добавить адресс</i></h2>
        </a>
    </div>

    <div class="modal fade" id="modalAddAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddAddress">Добавление нового адреса</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action='/addresses.php' method='post'>
                        <div class="form-group">
                            <label for="zip_code">Индекс</label>
                            <input type="text" class="form-control" name="zip_code" id="zip_code">
                        </div>
                        <div class="form-group">
                            <label for="region">Область</label>
                            <input type="text" class="form-control" name="region" id="region">
                        </div>
                        <div class="form-group">
                            <label for="district">Район</label>
                            <input type="text" class="form-control" name="district" id="district">
                        </div>
                        <div class="form-group">
                            <label for="city">Город</label>
                            <input type="text" class="form-control" name="city" id="city">
                        </div>
                        <div class="form-group">
                            <label for="street">Улица</label>
                            <input type="text" class="form-control" name="street" id="street">
                        </div>
                        <div class="form-group">
                            <label for="house">Дом</label>
                            <input type="text" class="form-control" name="house" id="house">
                        </div>


                        <button type="submit" name="add_address" class="btn btn-success">Добавить</button>
                    </form>
                </div>


            </div>
        </div>
    </div>


</div>
<?php else : ?>

    <h1>Страница не найдена</h1>

<?php endif; ?>

</div>



<?php
include getcwd() . "/footer.php";
?>