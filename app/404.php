<?php
include getcwd() . "/header.php";
?>



<?php



if (isset($_SESSION['logged_user']))
    $user = $_SESSION['logged_user'];

?>



<div class="container body-content">
    <div class="row">
        <div class="col">
            <div class="alert alert-danger" role="alert">
                <h1> Страница не найдена</h1>
            </div>

        </div>
    </div>

</div>


</div>



<?php
include getcwd() . "/footer.php";
?>