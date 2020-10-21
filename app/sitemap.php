<?php
$title = "Карта сайта";
include getcwd() . "/header.php";
?>

<?php
$not_indexing = ["logout.php", "parser.php", "signup.php", "signin.php", "db.php", "sitemap.php"]
?>
<div class="container body-content">
    <div class="row">
        <div class="col">
            <?php
            $path = getcwd();
            echo "<ul class=\"list-group list-group-flush\">";



            $files = scandir($path);
            foreach ($files as $file) {

                if (strpos($file, 'php') && in_array($file, $not_indexing) === false) {
                    $html = file_get_contents("index.php");
                    echo "<li class=\"list-group-item\">" . $file . "</li>";
                }
            }
            echo "</ul>";


            ?>


        </div>
    </div>
</div>

<?php
include getcwd() . "/footer.php";
?>