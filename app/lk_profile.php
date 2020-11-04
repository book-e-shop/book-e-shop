<?php

require_once "db.php";

$title = "Профиль";
include getcwd() . "/header.php";
?>



<?php



if (isset($_SESSION['logged_user']))
    $user = $_SESSION['logged_user'];

?>



<div class="container body-content">
    <div class="row">
        <div class="col">
            <?php if (isset($_SESSION['logged_user'])) : ?>
                <form action='/' method='post'>
                    <div class="form-group">
                        <label for="surname">Фамилия</label>
                        <input type="text" id="surname" name='surname' placeholder="Фамилия" class="form-control" value=<?php echo $user->surname; ?> required>
                    </div>
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" name='name' placeholder="Имя" class="form-control" value=<?php echo $user->name; ?> required>
                    </div>
                    <div class="form-group">
                        <label for="email">Почта</label>
                        <input type="email" id="email" name='email' class="form-control validate" placeholder="Почта" value=<?php echo $user->email; ?> required>
                    </div>
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input type="text" id="login" name='login' placeholder="Логин" class="form-control" value=<?php echo $user->login; ?> required>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" id="password" name='password' class="form-control validate" placeholder="Пароль" required>
                    </div>
                    <div class="form-group">
                        <label for="password_2">Повторите пароль</label>
                        <input type="password" id="password_2" name='password_2' class="form-control validate" placeholder="Повторите пароль" required>

                    </div>


                    <button type="submit" name="add_address" class="btn btn-success" disabled>Сохранить</button>

                </form>
            <?php else : ?>
               
                <?php echo "<script>window.location = '404.php'</script>"; ?>

            <?php endif; ?>
        </div>
    </div>

</div>


</div>



<?php
include getcwd() . "/footer.php";
?>