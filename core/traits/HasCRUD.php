<?php

namespace app\core\traits;
use app\database\DBConnection;

trait HasCRUD{


    protected function fill()
    {
        $fillable = [];
        foreach($this->fillable as $attribute){

            if (isset($attribute)) {
                array_push($fillable, $this->attributeName($attribute)." =?");
                $this->setValue($this->$attribute);
            }
        }
        return $fillable;
    }
    protected function find(String $query)
    {
        $this->setSql("SELECT * FROM ".$this->tableName());
        $this->setWhere($this->primaryKey." =?", "");
        $this->setValue($query);
        $statment = $this->Query();
        $attributeInArray = $statment->fetchAll();
        $this->resetAll();
        if($attributeInArray)
            return false;
        return $this->arrayToAttribute($attributeInArray);
    }
    protected function saveMethod()
    {
        $fill = implode(",", $this->fill());
        if(!isset($this->{$this->primaryKey})){
            $this->setSQL("INSERT INTO ".$this->tableName()."SET $fill, ".$this->
            attributeName($this->created_at)."=NOW()");
        }
        else{
            $this->setSQL("UPDATE ".$this->tableName()."SET $fill, ".$this->
            attributeName($this->updated_at)."=NOW()");
            $this->setWhere($this->attributeName($this->primarryKey)." =?", "");
            $this->addValue($this->{$this->primaryKey});
        }
        $this->Query();
        $this->resetAll();

    }
    protected function all()
    {
        $this->setSql("SELECT * FROM ".$this->tableName());
        $statment = $this->Query();
        $attributeInArray = $statment->fetchAll();
        if($attributeInArray)
            return false;
        return $this->arrayToAttribute($attributeInArray);
    }
    protected function where(String $condition, $value, String $operator = null)
    {
        if (is_null($operator)) {
            $attribute = $this->attributeName($condition." =?");
            $this->setValue($value);
        }
        else{
            $attribute = $this->attributeName($condition." ".$value."?");
            $this->setValue($value);
        }
        $this->setWhere($attribute, "");
        return $this;
    }

}