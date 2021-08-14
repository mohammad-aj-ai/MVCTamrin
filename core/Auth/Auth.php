<?php

namespace app\core\Auth;

use app\core\session\Session;

class Auth {

    private $redirectTo = "/login";

    public function user()
    {
        if(!Session::get('user'))
            $this->redirect($this->redirectTo);
        
        $user = User::find(Session::get('user'));
        if(empty($user)){
            Session::remove('user');
            $this->redirect($this->redirectTo);
        }
        else 
            return $user;
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        return call_user_func_array([$instance,$name], $arguments);
    }
}