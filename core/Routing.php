<?php

namespace app\core;

use app\core\route\Request;

class Routing extends Request {

    private $route = [];
    private $method;
    private $URLpath;
    private $values = [];

    public function __construct()
    {
        $this->URLpath = $this->getPath();
        $this->method = $this->method_field();
        global $routes;
        $this->route = $routes;
    }
    public function compare(String $reseredPath)
    {
        $reseredPathArray = explode("/", $reseredPath);
        $currentPathArray = explode("/", $this->URLpath);

        if(sizeof($reseredPathArray) != sizeof($currentPathArray)){
            return false;
        }
        foreach($currentPathArray as $key => $currentPathArrayValue){

            if(substr($currentPathArrayValue, 0, 1) == "{" and 
                substr($currentPathArrayValue, -1) == "}")
                array_push($this->values, $currentPathArrayValue);
            elseif($currentPathArrayValue != $reseredPathArray[$key])
                return false;
        }
        return true;
    }
    public function match()
    {
        foreach($this->route[$this->method] as $path => $value){

            if($this->compare($path)){
                if(is_array($value))
                    return ['class' => $value[0], 'method' => $value[1]];
                if($value instanceof \Closure)
                    return $value;
            }
            else
                return [];
                
        }
    }
    public function run()
    {
        if(empty($this->match()))
            return "404 error";

        $match = $this->match();
        if(is_array($match)){
            $Path = __DIR__.'\app\controller\\'.$match['class'].'.php';
            if(!file_exists($Path))
                return "404 error";
            
            $className = "\app\app\controller\\".$match['class'];
            $classObject = new $className;

            if(method_exists($classObject, $match['method']))
                empty($this->values) ? call_user_func(array($classObject, $match['method'])) :
                call_user_func_array(array($classObject, $match['method']), $this->values);
        }
        else{
            call_user_func_array($match, $this->values);
        }
    }

}