<?php

namespace app\core\view;

use app\app\providers\AppServiceProvider;
use app\core\view\traits\HasViewLoader;
use app\core\view\traits\HasExtendsContent;
use app\core\view\traits\HasIncludeContent;
use app\core\view\Composer;

class ViewBiulder {

    use HasViewLoader, HasExtendsContent, HasIncludeContent;

    public $content;
    public $vars = [];

    public function run($dir)
    {
        $this->content = $this->viewLoader($dir);
        $this->checkExtendsContent();
        $this->checkIncludesContent();
        Composer::setViews($this-> viewNameArray);
        $appServiceProvider = new AppServiceProvider;
        $appServiceProvider->boot();
        $this->vars = Composer::getVars();
    }
}