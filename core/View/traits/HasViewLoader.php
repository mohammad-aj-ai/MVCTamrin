<?php

namespace app\core\view\traits;

use Exception;

trait HasViewLoader {

    private $viewNameArray = [];

    private function viewLoader($dir)
    {
        $dir = trim($dir, ' .');
        str_replace('.', '/', $dir);
        if(file_exists(dirname(dirname(dirname(__DIR__)))."resorces/views/$dir.blade.php"))
        {
            $this->registerView($dir);
            $content = htmlentities(file_get_contents(dirname(dirname(dirname(__DIR__))).
            "resorces/views/$dir.blade.php"));
            return $content;
        }
        else
            throw new Exception("view not found!!!");
    }
    private function registerView($view)
    {
        array_push($this->viewNameArray, $view);
    }
}