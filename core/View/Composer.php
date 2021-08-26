<?php

namespace app\core\view;

class Composer {

    private static $instance = null;
    private $viewArray;
    private $vars = [];

    private function __construct()
    {
        
    }
    private static function getInstance()
    {
        if(self::$instance == null)
            self::$instance = new self;
        return self::$instance;
    }
    private function registerView($name, $callback)
    {
        if(in_array(str_replace('.', '/', $name), $this->viewArray) || $name = '*'){
            $viewVars = $callback();
            foreach($viewVars as $key => $value){
                $this->vars[$key] = $value;
            }
        }
        if(isset($this->viewArray[$name]))
            unset($this->viewArray[$name]);
    }
    private function setViewArray($viewArray)
    {
        $this->viewArray = $viewArray;
    }
    private function getViewArray()
    {
        return $this->vars;
    }
}