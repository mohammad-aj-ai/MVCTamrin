<?php

namespace app\app\controller;

use app\database\CRUD;
use app\traits\view;

class authorController extends Controller {

    use view;

    public function index(){
        $crud = new CRUD;
        $books = $crud->select("SELECT * FROM `author`;")->fetchAll();
        $this->loadView("authorBook", $books);
    }
    public function show($id){
        $crud = new CRUD;
        $book = $crud->select("SELECT * FROM `author` WHERE `id` = ?;", [$id])->fetch();
        $this->loadView("authorView", $book);
    }
    public function add(){
        $this->loadView("createAuthor");
    }
    public function store($request){
        $crud = new CRUD;
        $crud->insert("author", array_keys($request), $request);

    }
}