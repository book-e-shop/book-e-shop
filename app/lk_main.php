<?php
include getcwd() . "/header.php";
?>


<div class="container body-content">
    <?php if (isset($_SESSION['logged_user'])) : ?>
        <?php $user = $_SESSION['logged_user']; ?>
        <div class="row ">
            <div class="col-sm bg-light">
                <div class="row">
                    <div class="col-sm">
                        <h1> Мои данные <h1>
                                <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <h3> Личная информация <h3>
                    </div>
                    <div class="col-sm">
                        <h3> Сбособы оплаты <h3>
                    </div>
                    <div class="col-sm">
                        <h3> Адрес доставки <h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $user->name . ' ' . $user->surname; ?></h5>
                                <?php echo $user->email; ?>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary"> Редактировать </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Основной сбособ оплаты</h5>
                                This is some text within a card body.
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary"> Редактировать </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Основной адрес доставки</h5>
                                This is some text within a card body.
                            </div>
                            <div class="card-footer">
                                <a href="/addresses.php" class="btn btn-primary"> Редактировать </a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm">
                        <h1> Активные заказы<h1>
                                <hr>
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