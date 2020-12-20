<?php

session_start();


$state = FALSE;
if (password_verify($_POST["captcha_input"], $_SESSION['captcha_code'])) {
 
    $state = TRUE;
}
 
$result["state"] = $state;
echo json_encode($result);
