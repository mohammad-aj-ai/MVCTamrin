<?php

namespace app\core\route;

use app\core\traits\view;
use Closure;

class Route {

    public function get($path, $callback, $name = null){
        
        if(is_string($callback) and stripos($callback, "@") != false){
                $executeMethod = explode('@', $callback);
                $class = $executeMethod[0];
                $method = $executeMethod[1];
                global $routes;
                $routes['get'][] = ['url' => $path, 'class' => $class, 'method' => $method,
             'name' => $name];
        }
        else{
            global $routes;
            $routes['get'][] = ['closure' => $callback, 'url' => $path, 'name' => $name];
        }
    }
    public function post($path, $callback, $name = null){
        
        if(is_string($callback) and stripos($callback, "@") != false){
                $executeMethod = explode('@', $callback);
                $class = $executeMethod[0];
                $method = $executeMethod[1];
                global $routes;
                $routes['post'][] = ['url' => $path, 'class' => $class, 'method' => $method,
             'name' => $name]; 
        }
        else{
            global $routes;
            $routes['post'] = ['closure' => $callback, 'url' => $path, 'name' => $name];
        }
    }
    public function put($path, $callback, $name = null){
        
        if(is_string($callback) and stripos($callback, "@") != false){
                $executeMethod = explode('@', $callback);
                $class = $executeMethod[0];
                $method = $executeMethod[1];
                global $routes;
                $routes['put'][] = ['url' => $path, 'class' => $class, 'method' => $method,
             'name' => $name]; 
        }
        else{
            global $routes;
            $routes['put'] = ['closure' => $callback, 'url' => $path, 'name' => $name];
        }
    }
    public function delete($path, $callback, $name = null){
        
        if(is_string($callback) and stripos($callback, "@") != false){
                $executeMethod = explode('@', $callback);
                $class = $executeMethod[0];
                $method = $executeMethod[1];
                global $routes;
                $routes['delete'][] = ['url' => $path, 'class' => $class, 'method' => $method,
             'name' => $name]; 
        }
         else{
            global $routes;
            $routes['delete'] = ['closure' => $callback, 'url' => $path, 'name' => $name];
        }
    }
    public function midleware(String $midleware){

        $className = "\app\app\midleware\\".$midleware;
        if(class_exists($className)){
            if(call_user_func(array((string)$className, 'next')))
                return $this;
        } 
        else
            redirectback();
         
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        return call_user_func_array([$instance,$name], $arguments);
    }

    // how to write resource method

}