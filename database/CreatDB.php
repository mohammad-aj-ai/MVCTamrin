<?php

namespace app\database;

require_once "CRUD.php";

use app\database\CRUD;

class CreatDB {

    private $createDatabase = array(

        "CREATE TABLE `users`(
            `id` int (11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
            `email`  VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
            `password`  VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
            `permistion` enum ('user','admin') NOT NULL COLLATE utf8_persian_ci DEFAULT 'user',
            `created_at` DATETIME NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `email` (`email`)
             
        );",
        "CREATE TABLE `book`(
            `id` int (11) NOT NULL AUTO_INCREMENT,
            `title`  VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
            `summery` text NOT NULL COLLATE utf8_persian_ci,
            `user_id` int (11) NOT NULL,
            `image` VARCHAR(250) COLLATE utf8_persian_ci DEFAULT NULL,
            `created_at` DATETIME NOT NULL,
             PRIMARY KEY (`id`),
          FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE,
          FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
          FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        );",
        "CREATE TABLE `author`(
            `id` int (11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
            `created_at` DATETIME NOT NULL,
            `information` text DEFAULT NULL COLLATE utf8_persian_ci,
              PRIMARY KEY (`id`),
        );",
        "CREATE TABLE `categories`(
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR (250) NOT NULL COLLATE utf8_persian_ci,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
            PRIMARY KEY (`id`)
        );",
        "CREATE TABLE `reserved`(
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
            PRIMARY KEY (`id`),
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`book_id`) REFERENCES `users` (`book`) ON DELETE CASCADE 
        );",
         "CREATE TABLE `request`(
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`book_id`) REFERENCES `users` (`book`) ON DELETE CASCADE, 
            PRIMARY KEY (`id`)
        );",
    );
    
    public function createdb(){

        $crud = new CRUD;

        foreach($this->createDatabase as $db){
            $crud->createTable($db);
        }
    }

}
