<?php

namespace app\app\controller;

use app\database\CRUD;
use app\traits\view;

class BookController extends Controller {
    use view;

    public function index(){
        $crud = new CRUD;
        $books = $crud->select("SELECT * FROM `book`;")->fetchAll();
        $this->loadView("viewBook", $books);
    }
    public function show($id){
        $crud = new CRUD;
        $book = $crud->select("SELECT * FROM `book` WHERE `id` = ?;", [$id])->fetch();
        $this->loadView("bookView", $book);
    }
    public function add(){
        $this->loadView("createBook");
    }
    public function store($request){
        $crud = new CRUD;
        $crud->insert("book", array_keys($request), $request);

    }
}