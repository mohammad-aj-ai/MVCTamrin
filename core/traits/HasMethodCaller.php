<?php

namespace app\core\traits;

trait HasMethodCaller {

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this,$name], $arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        return call_user_func_array([$instance,$name], $arguments);
    } 
}