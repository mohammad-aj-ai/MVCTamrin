<?php

namespace app\app\controller;

use app\app\Auth;
use app\database\CRUD;
use app\traits\view;

class LoginController extends Auth {

    use view;

    public function index(){
        
        $this->loadView("login");
    }
    public function check($email){

        $crud = new CRUD;
        $user = $crud->select("SELECT * FROM `users` WHERE `email` = ?;", [$email])->fetch();
        if(isset($_COOKIE['email'])){
            $this->setSession($user);
            $this->loadView('home');
        }
        else
            $this->loadView('home');
        
    }
    public function logout(){
        $this->logout();
        $this->loadView('login');
    }

}