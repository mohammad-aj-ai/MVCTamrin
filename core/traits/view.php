<?php

namespace app\traits;

trait View {

    private function loadView($view = null, $temp = null) {
        if($view != null){
            ob_start();
           $a =  include_once __DIR__ . "/../view/" . $view . ".php";
            if($temp != null)
                str_replace($a,$temp,"{content}");
            return ob_get_clean();
        }
        ob_start();
        include_once __DIR__ . "/../view/layouts/main.php";
        return ob_get_clean();
    }
    protected function redirectback(){
        header('location: '.$_SERVER['HTTP_REFERER']);
    }

}