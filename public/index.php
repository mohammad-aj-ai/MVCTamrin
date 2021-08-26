<?php

use app\core\Routing;

require_once (dirname(__DIR__)."/vendor/autoload.php");

require_once "../core/helper/helperSessions.php";
require_once "../core/helper/helper.php";

require_once "../routing/web.php";
require_once "../core/Routing.php";

require_once "../config/app.php";
require_once "../config/database.php";

$routing = new Routing;
$routing->run();

