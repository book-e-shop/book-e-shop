<?php

use RedBeanPHP\Facade;

require_once "render_file.php";
include getcwd() . '/parser.php';


function set_id($text)
{
    $htmlContent = mb_convert_encoding($text, 'HTML-ENTITIES', "UTF-8");

    $htmlDom = new DOMDocument;
    @$htmlDom->loadHTML($htmlContent);

    $extractedHeaders = array();

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

function generate_toc($html)
{
    $iter = 0;

    $links =  extractHeaders($html);
    $keys = array_keys($links);
    echo "<h1>Содержание</h1>";
    $is_open = FALSE;
    $p = 0;

    $opened = 0;
    for ($i = 0; $i < count($keys); $i++) {
        $I = intval(substr(explode("_", $keys[$i])[0], 1));
        echo $opened;
        echo $I;
        if ($I > $p) {
            echo "<ul>";
            $opened++;
            $a = "<a class='btn-link'  href = '#" . $keys[$i] . "'>" . $links[$keys[$i]] . "</a>";
            echo "<li>" . $a . "</li>";
        }
        if ($I === $p) {
            $a = "<a class='btn-link'  href = '#" . $keys[$i] . "'>" . $links[$keys[$i]] . "</a>";
            echo "<li>" . $a . "</li>";
        }
        if ($I < $p) {

            for ($j = 0; $j < $opened - $I + 1; $j++)
                echo "</ul>";
            $opened = $opened - $I ;
            echo "<ul>";
            $a = "<a class='btn-link'  href = '#" . $keys[$i] . "'>" . $links[$keys[$i]] . "</a>";
            echo "<li>" . $a . "</li>";
        }
       
        $p = $I;
    }
}
