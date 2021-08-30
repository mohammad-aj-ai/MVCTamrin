<?php

define('BASE_DIR',realpath(__DIR__."/../"));

return [

    'BASE_DIR' => realpath(__DIR__)."/../",

    'providers' => [

        app\app\providers\SessionProvider::class,
        app\app\providers\AppServiceProvider::class
    ]
];