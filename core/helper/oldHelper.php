<?php

session_start();

if(isset($_SESSION['old']))
    unset($_SESSION['tmp_old']);

if(isset($_SESSION['old'])){
    $_SESSION['tmp_old'] = $_SESSION['old'];
    unset($_SESSION['old']);
}

$param = [];
isset($_GET) ? $param : array_merge($param, $_GET);
isset($_POST) ? $param : array_merge($param, $_POST);
$_SESSION['old'] = $param;
unset($param);