<?php

use app\core\route\Route;

$route = new Route;
//routes will be here

$route->get('/home', 'HomeController@index');
$route->get('/', 'HomeController@index');
$route->get('/index', 'HomeController@index');