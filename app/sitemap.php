<?php
$title = "Карта сайта";
include getcwd() . "/header.php";
?>




<div class="container body-content">
    <div class="row">
        <div class="col">
            <?php
            include getcwd() . '/sitemap_generator.php';
            
            generate_sitemap();

            ?>


        </div>
    </div>
</div>

<?php
include getcwd() . "/footer.php";
?>