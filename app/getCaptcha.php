<?php

session_start();

$captchastring = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz1234567890';
 
$code = substr(str_shuffle($captchastring), 0, 5);

$width = $_POST['width'];



$_SESSION['captcha_code'] = password_hash($code, PASSWORD_DEFAULT);


$im = imagecreate(400, 400);

$bg = imagecolorallocate($im, 255, 255, 255);
$textcolor = imagecolorallocate($im, 0, 0, 255);

$font = 'assets/fonts/Play-Regular.ttf';

imagettftext($im, 30, rand(0,360), 200, 150, $textcolor, $font, $code);
ob_start();

imagejpeg($im);
$contents = ob_get_contents();

ob_end_clean();

$base64 = 'data:image/jpeg;base64,' . base64_encode($contents);

echo $base64;
