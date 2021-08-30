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
        $attributeInArray = $statment->fetch();
        $this->resetAll();
        if($attributeInArray == null)
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
    protected function whereOr($attribute, $firstValue, $secendValue = null){
        if($secendValue === null){
            $condition = $this->attributeName($attribute)." =?";
            $this->setValue($attribute, $firstValue);
        }
        else{
            $condition = $this->attributeName($attribute)." ".$firstValue."?";
            $this->setValue($attribute, $secendValue);
        }
       
        $this->setWhere($condition, "OR");
        return $this;
    }
    protected function whereNull($attribute){
        $condition = $this->attributeName($attribute)." IS NULL ";
        $this->setWhere($condition, "AND");
        return $this;
    }
    protected function whereNotNull($attribute){
        $condition = $this->attributeName($attribute)." IS NOT NULL ";
        $this->setWhere($condition, "AND");
        return $this;
    }
    protected function whereIn($attribute, $values){
        if(is_array($values)){
            $valuesArray = [];
            foreach($values as $value){
                $this->setValue($attribute, $value);
                array_push($valuesArray, '?');
            }
            $condition = $this->attributeName($attribute)." IN ( ".implode(',', $valuesArray)." ) ";
            $this->setWhere($condition, "AND");
        return $this;
        }
    }
    protected function get($array = []){
        if($this->sql == ''){
            if(empty($array)){
                $filds = $this->tableName().'*';
            }
            else{
                foreach($array as $key=>$field){
                    $array[$key] = $this->attributeName($field);
                }
                $filds = implode(',', $array);
            }
            $this->sql = "SELECT ".$filds." FROM ".$this->tableName();
        }
        $statment = $this->Query();
        $data = $statment->fetchAll();
        if($data){
            $this->arrayToObject($data);
            return $this->collection;
        }
        return []; 
    }

}