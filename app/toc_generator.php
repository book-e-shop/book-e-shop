<?php

use RedBeanPHP\Facade;

require_once "render_file.php";
include getcwd() . '/parser.php';


function set_id($text)
{
    $htmlContent = mb_convert_encoding($text, 'HTML-ENTITIES', "UTF-8");

    $htmlDom = new DOMDocument;
    @$htmlDom->loadHTML($htmlContent);

    for ($i = 1; $i < 7; $i++) {

        $headers = $htmlDom->getElementsByTagName('h' . $i);
        $j = 0;
        foreach ($headers as $header) {

            $header->setAttribute('id', 'h' . $i . '_' . $j);
            $j++;
        }
    }
    $text = $htmlDom->saveHTML();

    return $text;
}

function add_item($key, $value)
{
    $a = "<a class='btn-link'  href = '#" . $key . "'>" . $value . "</a>";
    echo "<li>" . $a . "</li>";
}
function generate_toc($html)
{
    $links =  extractHeaders($html);
    $keys = array_keys($links);
    echo "<h1>Содержание</h1>";
    $p = 0;
    for ($i = 0; $i < count($keys); $i++) {
        $I = intval(substr(explode("_", $keys[$i])[0], 1));
        if ($I > $p) {
            echo "<ul>";
            add_item($keys[$i], $links[$keys[$i]]);
        }

        if ($I == $p) {
            add_item($keys[$i], $links[$keys[$i]]);
        }

        if ($I < $p) {
            for ($j = 0; $j <=  ($p - $I); $j++) {
                echo "</ul>";
            }
            echo "<ul>";
            add_item($keys[$i], $links[$keys[$i]]);
        }

        $p = $I;
    }
}
