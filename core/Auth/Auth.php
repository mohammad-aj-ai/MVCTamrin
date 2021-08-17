<?php

namespace app\core\Auth;

use app\app\Models\User;
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
    public function check()
    {
        if(!Session::get('user'))
            $this->redirect($this->redirectTo);
        
        $user = User::find(Session::get('user'));
        if(empty($user)){
            Session::remove('user');
            $this->redirect($this->redirectTo);
        }
        else 
            return true;
    }
    public function loginRegister()
    {

    }
    public function logout()
    {
        if(!Session::get('user'))
            $this->redirect($this->redirectTo);
        
        $user = User::find(Session::get('user'));
        if (empty($user)) {
            Session::remove('user');
            $this->redirect($this->redirectTo);
        }
    }
    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        return call_user_func_array([$instance,$name], $arguments);
    }
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this, $name], $arguments);
    }
}