<?php
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

    $links =  extractHeaders($html);
    echo "<h1>Содержание</h1>";
    echo "<ul class='list-group'>";
    foreach ($links as $id => $value) {
        $a = "<a class='btn-link' href = '#" . $id . "'>" . $value . "</a>";
        echo "<li class=\"list-group-item\">" . $a . "</li>";
    }
    echo "</ul>";
}
