<?php

namespace app\database;
use PDO;
use PDOException;

class DBConnection{

    private static $DBConnectionObject = null;
    private $option = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC);

    private function __construct()
    {
        
    }
    public static function Connection(){

        if(self::$DBConnectionObject === null){
            $DBConnectionI = new DBConnection;
            self::$DBConnectionObject = $DBConnectionI->DBConnectionPDO();
        }
        return self::$DBConnectionObject;

    }
    private function DBConnectionPDO(){
        
        try {
            return new \PDO('mysql:host='.DBHOST.';dbname='.DBNAME,DBUSERNAME,
            DBPASSWORD,$this->option);
        }
        catch (PDOException $e){
            echo "there is some problom in connection  : ".$e->getMessage();
       }
    }
}