<?php

function render_file($path)
{
    ob_start();
    include($path);
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
