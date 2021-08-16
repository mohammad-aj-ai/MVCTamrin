<?php

namespace app\core\route;

use app\traits\view;
use Closure;

class Route {

    use view;
    public function get($path, $callback){
        
        if(is_string($callback) and stripos($callback, "@") != false){
                $executeMethod = explode('@', $callback);
                $class = $executeMethod[0];
                $method = $executeMethod[1];
                global $routes;
                $routes['get'][$path] = ['class' => $class, 'method' => $method]; 
        }
        global $routes;
        $routes['get'][$path] = $callback;
    }
    public function post($path, $callback){
        
        if(is_string($callback) and stripos($callback, "@") != false){
                $executeMethod = explode('@', $callback);
                $class = $executeMethod[0];
                $method = $executeMethod[1];
                global $routes;
                $routes['post'][$path] = ['class' => $class, 'method' => $method]; 
        }
        global $routes;
        $routes['post'][$path] = $callback;
    }
    public function put($path, $callback){
        
        if(is_string($callback) and stripos($callback, "@") != false){
                $executeMethod = explode('@', $callback);
                $class = $executeMethod[0];
                $method = $executeMethod[1];
                global $routes;
                $routes['put'][$path] = ['class' => $class, 'method' => $method]; 
        }
        global $routes;
        $routes['put'][$path] = $callback;
    }
    public function delete($path, $callback){
        
        if(is_string($callback) and stripos($callback, "@") != false){
                $executeMethod = explode('@', $callback);
                $class = $executeMethod[0];
                $method = $executeMethod[1];
                global $routes;
                $routes['delete'][$path] = ['class' => $class, 'method' => $method]; 
        }
        global $routes;
        $routes['delete'][$path] = $callback;
    }
    public function midleware(String $midleware){

        $className = "\app\app\midleware\\".$midleware;
        if(class_exists($className)){
            if(call_user_func(array((string)$className, 'next')))
                return $this;
        } 
        else
            $this->redirectback();
         
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        return call_user_func_array([$instance,$name], $arguments);
    }

    // how to write resource method

}