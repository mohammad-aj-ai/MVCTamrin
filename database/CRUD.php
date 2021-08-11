<?php 

namespace app\database;

use Exception;
use PDO;
use PDOException;

class CRUD {

    private $connection;
    private $dbname = "library";
    private $password = "mysql";
    private $username = "root";
    private $dbhost = "localhost";
    private $option = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC);

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname,$this->username,
        $this->password,$this->option);
        }
       catch (PDOException $e){
            echo "there is some problom in connection  : ".$e->getMessage();
       }
    }
    public function select($sql, $value = null){
        try{
            if($value == null)
                return $this->connection->query($sql);
            else{
                $stmt = $this->connection->prepare($sql);
                return $stmt->execute($value);
            }
        }
        catch(Exception $e){
            echo "issu in selecting : ".$e->getMessage();
        }
    }
    public function insert($tableName, $fields, $values){
        try{
            $stmt= $this->connection->prepare("INSERT INTO ".$tableName."(".implode(', ',$fields).
            ", created_at) VALUES (:". implode(',:',$fields).", NOW());");
            $stmt->execute(array_combine($fields, $values));
        }
        catch(Exception $e){
            echo "problom in inserting : ".$e->getMessage();
        }
    }
    public function createTable($sql){

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
        }
        catch (PDOException $e){
            echo "something went wrong : ".$e->getMessage();
        }
    }
}