<?php

namespace app\core\application;

use app\core\Routing;

class Application {

    public function __construct()
    {
        $this->loadhelpers();
        $this->loadProviders();
        $this->registerRoutes();
        $this->routing();
    }

    private function loadProviders()
    {
        $appConfigs = require dirname(dirname(__DIR__))."/config/app.php";
        $serviceProviders = $appConfigs['providers'];
        foreach($serviceProviders as $provider){
            $bootCaller = new $provider();
            $bootCaller->boot();
        }
    }
    private function loadhelpers()
    {
        require_once dirname(__DIR__)."/helper/helper.php";
    }
    private function registerRoutes()
    {
        global $routes; 
        $routes = ['get' => [], 'put' => [], 'post' => [], 'delete' => []];
        require_once dirname(dirname(__DIR__))."/routing/web.php";
    }
    private function routing()
    {
        $routing = new Routing;
        $routing->run();
    }

}