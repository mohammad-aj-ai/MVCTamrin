<?php

namespace app\app\controller;

use app\core\createDB\CreateDB;

class HomeController extends Controller {

    public function index()
    {
        $createDB = new CreateDB;
    }
}