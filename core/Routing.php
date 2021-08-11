<?php

namespace app\core;

use app\core\route\Request;

class Routing extends Request {

    private $route = [];
    private $method;
    private $URLpath;

    public function __construct()
    {
        $this->URLpath = $this->getPath();
        $this->method = $this->method_field();
        global $routes;
        $this->route = $routes;
    }
    public function compare($reseredPath) {

        $reseredPathArray = explode("/", $reseredPath);
        $currentPathArray = explode("/", $this->URLpath);

        if(sizeof($reseredPathArray) == sizeof($currentPathArray)){

        }

    }
    public function match() {

        $reseredPath = $this->route[$this->method];
    }

}