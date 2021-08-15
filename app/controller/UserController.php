<?php

namespace app\app\controller;

use app\traits\view;
use app\app\Models\User;
use app\app\controller\Controller;

class UserController extends Controller{
    
    public function index()
    {
        $user = User::all();
        var_dump($user);
        exit;
    }
}
$user = new UserController;
$user->index();