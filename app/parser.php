<?php

function extractHeaders($htmlContent)
{
    $htmlContent = mb_convert_encoding($htmlContent, 'HTML-ENTITIES', "UTF-8");

    $htmlDom = new DOMDocument;
    @$htmlDom->loadHTML($htmlContent);

    $extractedHeaders = array();

    for ($i = 1; $i < 7; $i++) {

        $headers = $htmlDom->getElementsByTagName('h' . $i);        

        foreach($headers as $header) {
            
            $header_id = $header->getAttribute('id');
            $header_text = $header->nodeValue;

            if(strlen($header_id) > 0 && strlen($header_text) > 0)
                $extractedHeaders[$header_id] = $htmlDom->saveHtml($header);
        }        
    }

    return $extractedHeaders;
}
