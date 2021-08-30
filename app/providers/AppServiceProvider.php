<?php

namespace app\app\providers;

use app\core\view\Composer;

class AppServiceProvider extends Provider
{
    public function boot()
    {
        Composer::view("", function (){
           
            return [];
        });

    }
}