<?php

namespace app\core\createDB;

use app\database\DBConnection;

class CreateDB {

    public function __construct()
    {
        $this->createTables();
        echo "tables created !";
    }
    private function createTables()
    {
        $newMigrations = $this->getMigrations();
        $pdoConnection = DBConnection::Connection();
        foreach($newMigrations as $newMigrationArray){
            $stmt = $pdoConnection->prepare($newMigrationArray);
            $stmt->execute();
        }
    }
    private function getMigrations()
    {
        $oldMigrations = $this->getOldMigrations();
        $migrationPath = BASE_DIR.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.
        'migrations'.DIRECTORY_SEPARATOR;
        $allMigrations = glob($migrationPath."*.php");
        $newMigrations = array_diff($allMigrations, $oldMigrations);
        $this->setOldMigrations($allMigrations);
        $array = [];
        foreach($newMigrations as $migration){
            $fileContents = require $migration;
            array_push($array, $fileContents);
        }
        return $array;
    }
    private function getOldMigrations()
    {
        $oldTables = file_get_contents(__DIR__.'/oldTables.db');
        return empty($oldTables) ? [] : unserialize($oldTables);
    }
    private function setOldMigrations($newMigrations)
    {
        file_put_contents(__DIR__."oldTables.db", serialize($newMigrations));
    }
}