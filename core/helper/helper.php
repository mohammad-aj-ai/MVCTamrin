<?php

function dd($input = null, bool $stop = true)
{
    if(is_null($input)){
        echo "error";
        exit;
    }
    var_dump($input);
    if($stop)
        exit;
}
function old($name)
{
    if(isset($_SESSION['tmp_old'][$name]))
        return $_SESSION['tmp_old'][$name];
    else
        return false;
}
function redirectback()
{
    $http_referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    redirect($http_referer); 
}
function flash($name, $message = null)
{
    if($message === null)
    {
        if(isset($_SESSION['tmp_flash'][$name])){
            $tmp = $_SESSION['tmp_flash'][$name];
            unset($_SESSION['tmp_flash'][$name]);
            return $tmp;
        }
        else
            return false;

    }
    else
        $_SESSION['flash'][$name] = $message;
}
function currentDomain()
{
    if(isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] === "on")
        $protocol = "https://";
    else 
        $protocol = "https://";
    $host = $_SERVER['HTTP_HOST'];

    return $protocol.$host;
}
function redirect($url)
{
    $url = trim($url, '/ ');
    $route = strpos($url, currentDomain()) === 0 ? $url : currentDomain().'/'
    .$url;
    header('Location: '.$url);
    exit;
}
function asset($url)
{
    return currentDomain().'/'.trim($url, '/ ');
}
function url($url)
{
    return currentDomain().'/'.trim($url, '/ ');
}
function findRouteByName($name)
{
    global $routes;
    $allRoutes = array_merge($routes['get'], $routes['post'], $routes['put'], $routes['delete']);
    $route = [];
    foreach($allRoutes as $element){
        if($element['name'] == $name and $element['name'] !== null)
            $route = $element['name'];
    }
    return $route;
}
function route($name, $params = [])
{
    if(is_array($params) === false)
        throw new Exception("params are not array");
    
    $route = findRouteByName($name);
    if($route === null)
        throw new Exception("route not found");
    
    $params = array_reverse($params);
    $routeParamsMatch = [];
    preg_match_all("/{[^}.]*}/", $route, $routeParamsMatch);
    if(count($routeParamsMatch[0]) > count($params))
        throw new Exception("route params dosent match");
    
    foreach($routeParamsMatch[0] as $key => $value){

        str_replace($value, array_pop($params), $route);
    }
    return currentDomain().'/'.trim($route, " /");
}