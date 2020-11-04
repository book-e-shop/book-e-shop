<?php
require_once "render_file.php";




function generate_sitemap()
{


    include getcwd() . '/parser.php';
    $path = getcwd();


    $files = scandir($path);
    foreach ($files as $file) {

        if (strpos($file, 'php') && in_array($file, $not_indexing) === false) {
            echo "<h2>" . $file . "/<h2>";
            echo "<ul class=\"list-group list-group-flush\">";
            $html = render_file($file);


            $links =  extractLinks($html);
            foreach ($links as $value => $href) {
                $a = "<a class='btn-link' href = '" . $href . "'>" . $value . "</a>";
                echo "<li class=\"list-group-item\">" . $a . "</li>";
            }
            echo "</ul>";
        }
    }
}