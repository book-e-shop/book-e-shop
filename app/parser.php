<?php

function extractLinks($html)
{
    $htmlDom = new DOMDocument;
    $extractedLinks = array();

    @$htmlDom->loadHTML($html);
    $links = $htmlDom->getElementsByTagName('a');

    foreach ($links as $link) {

        $linkText = $link->nodeValue;
        $linkHref = $link->getAttribute('href');

        if(strlen(trim($linkHref)) != 0 && $linkHref[0] != '#') {
            $extractedLinks[$linkHref] = $linkText;
        }        
    }

    return $extractedLinks;
}
