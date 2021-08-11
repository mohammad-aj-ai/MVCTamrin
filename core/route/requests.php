<?php

namespace app\core\route;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];

        $pos = explode("?", $path);
        $path = $pos[0];
        if ($pos[0] === "" or $pos[0] === "/") {
            return "/";
        }

        return $pos[0];
    }
    public function method_field(){

        $getMethod = strtolower($_SERVER['REQUEST_METHOD']);

        if($getMethod == 'post'){

            if(isset($_POST['_method'])){
                
                if($_POST['_method'] == 'put'){
                    $getMethod = 'put';
                }
                elseif($_POST['_mrthod'] == 'delete'){
                    $getMethod = 'delete';
                }
            }
        }
        return $getMethod;
    }
}