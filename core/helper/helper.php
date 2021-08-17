<?php

function dd($input, bool $stop = true)
{
    var_dump($input);
    if($stop)
        exit;
}
function old($name)
{
    if(isset($_SESSION['tmp_old'][$name]))
        return $_SESSION['tmp_old'][$name];
}