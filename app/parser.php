<?php

function extractHeaders($htmlContent)
{
    $htmlContent = mb_convert_encoding($htmlContent, 'HTML-ENTITIES', "UTF-8");

    $htmlDom = new DOMDocument;
    @$htmlDom->loadHTML($htmlContent);

    $extractedHeaders = array();

    $elements = $htmlDom->getElementsByTagName('*');

    $h_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

    foreach ($elements as $element) {
        echo $element->tagName . '<br>';


        if (in_array($element->tagName, $h_array)) {
            foreach ($element->childNodes as $childElement)

                if ($childElement->nodeName == 'a') {

                    $header_id = $childElement->getAttribute('id');
                    $header_text = $element->nodeValue;

                    if (strlen($header_id) > 0 && strlen($header_text) > 0)
                        $extractedHeaders[$header_id] = $htmlDom->saveHtml($element);
                }
        }
    }

    return $extractedHeaders;
}
