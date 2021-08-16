<?php

namespace app\core\traits;

trait HasAttribute {

    protected function saveImage(){
        
    }
    protected function tableName(){
        return '`'.$this->table.'`';
    }
    protected function attributeName($attributeName){
        return $this->tableName().'.`'.$attributeName.'`';
    }
    protected function arrayToAttribute(array $array, $object = null)
    {
        if($object == null){
            $className = get_called_class();
            $object = new $className;
        }
        foreach($array as $attributeName =>$value){
            $object->$attributeName = $value;
        }
        return $object;
    }
    protected function arrayToObject(array $array)
    {
        foreach($array as $values){
            $object = $this->arrayToAttribute($values);
            array_push($this->collection, $object);
        }
        return $this->collection;
    }
}