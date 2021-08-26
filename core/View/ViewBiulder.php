<?php

namespace app\core\view;

use app\core\view\traits\HasViewLoader;
use app\core\view\traits\HasExtendsContent;

class ViewBiulder {

    use HasViewLoader, HasExtendsContent;

    public $content;

    public function run($dir)
    {
        $this->content = $this->viewLoader($dir);
        $this->checkExtendsContent();
        $this->checkIncludsContent();
    }
}