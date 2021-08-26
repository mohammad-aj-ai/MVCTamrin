<?php

return [

    "CREATE TABLE `categories`(
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
        `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        PRIMARY KEY (`id`)
    );",
];