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
}