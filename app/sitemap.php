<?php
$title = "Карта сайта";
include getcwd() . "/header.php";
?>

<?php
$not_indexing = ["header.php", "footer.php", "logout.php", "parser.php", "signup.php", "signin.php", "db.php", "sitemap.php"];


function render_php($path)
{
    ob_start();
    include($path);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

?>


<div class="container body-content">
    <div class="row">
        <div class="col">
            <?php
            include getcwd() . '/parser.php';
            $path = getcwd();




            $files = scandir($path);
            foreach ($files as $file) {

                if (strpos($file, 'php') && in_array($file, $not_indexing) === false) {
                    echo "<h2>" . $file . "/<h2>";
                    echo "<ul class=\"list-group list-group-flush\">";
                    $html = render_php($file);
                    $links =  extractLinks($html);



                    foreach ($links as $href => $value) {
                         
                        if (mb_strlen($value, 'UTF-8')  < 1000) {
                            $a = "<a class='btn-link' href = '" . $href . "'>" . $value . mb_strlen($value, 'UTF-8') . "</a>";
                            echo "<li class=\"list-group-item\">" . $a . "</li>";
                        }
                    }
                    echo "</ul>";
                }
            }



            ?>


        </div>
    </div>
</div>

<?php
include getcwd() . "/footer.php";
?>