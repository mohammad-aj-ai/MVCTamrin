<?php

namespace app\app\controller;

use app\app\Auth;
use app\database\CRUD;
use app\traits\view;

class UserController extends Auth {
    use view;
    public function index(){
        $crud = new CRUD;
        $users = $crud->select("SELECT * FROM `users`;")->fetchAll();
        $this->loadView("viewUsers", $users);
    }
    public function show($id){
        $crud = new CRUD;
        $user = $crud->select("SELECT * FROM `users` WHERE `id` = ?;", [$id])->fetch();
        $this->loadView("userView", $user);
    }
    public function add(){
        $this->loadView("createUser");
    }
    public function store($request){
        $crud = new CRUD;
        $crud->insert("users", array_keys($request), $request);

    }
}