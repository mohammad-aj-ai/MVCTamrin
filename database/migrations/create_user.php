<?php

return [

    "CREATE TABLE `users`(
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
        `email`  VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
        `password`  VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
        `permistion` enum ('user','admin') NOT NULL COLLATE utf8_persian_ci DEFAULT 'user',
        `created_at` DATETIME NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `email` (`email`)
         
    );"
];