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

        $extractedLinks[$linkHref] = $linkText;
    }

    return $extractedLinks;
}
