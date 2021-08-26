<?php

namespace app\core;

use app\core\route\GetPath;

class Routing extends GetPath {

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
        foreach($this->route[$this->method] as $value){

            if($this->compare($value['url'])){
                if(count($value) === 4)
                    return ['class' => array_values($value)[1], 'method' => array_values($value)[2]];
                elseif(array_values($value)[0] instanceof \Closure)
                    return $value;
            }  
        }
        return [];
    }
    public function run()
    {
        if(empty($this->match()))
            return "404 error";

        $match = $this->match();
        $class = array_values($match)[0];
        $method = array_values($match)[1];
        if(is_array($match)){
            $Path = __DIR__.'\app\controller\\'.$class.'.php';
            if(file_exists($Path))
                return "404 error";
            
            $className = "\app\app\controller\\".$class;
            $classObject = new $className;
            if(method_exists($classObject, $method))
                empty($this->values) ? call_user_func(array($classObject, $method)) :
                call_user_func_array(array($classObject, $method), $this->values);
        }
        else{
            call_user_func_array($match, $this->values);
        }
    }

}