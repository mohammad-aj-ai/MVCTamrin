<?php 

namespace app\app;

use app\app\controller\Controller;

class Auth extends Controller{

    public function setSession($user){
        foreach($user as $key => $value){
            $_SESSION[$user['id']][$key] = $value;
            setcookie("id", $user['id'], time() + 3600);
        }
    }
    public function logout(){
        unset($_SESSION[$_COOKIE['id']]);
        setcookie('id', time() - 1);
    }

}