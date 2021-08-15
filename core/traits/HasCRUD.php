<?php

namespace app\core\traits;
use app\database\DBConnection;

trait HasCRUD{

    public function save()
    {

    }
    protected function fill()
    {

    }
    protected function find(String $query)
    {

    }
    protected function insert()
    {

    }
    protected function update()
    {

    }
    protected function all()
    {
        $this->setSql("SELECT * FROM ".$this->tableName());
        return $this->Query();
    }

}