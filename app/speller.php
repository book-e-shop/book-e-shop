<?php

$text = $_POST["text"];
 

$data = array(
    'text' => $text,

);

$url = 'https://speller.yandex.net/services/spellservice.json/checkText';
$ch = curl_init($url);

$postString = http_build_query($data, '', '&');

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo utf8_encode($response);
