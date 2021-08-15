<?php

namespace app\core\traits;

use app\database\DBConnection;

trait HasQueryBuilder{

    private $where = [];
    private $value = [];
    private $sql = '';
    private $limit = [];
    private $orderBy = [];

    protected function setSql(String $sql){
        $this->sql = $sql;
    }
    protected function resetSql(){
        $this->sql = '';
    }
    protected function setWhere(String $condition, String $operator){
        $array = ['operator'=>$operator, 'condition'=>$condition];
        array_push($this->where, $array);
    }
    protected function resetWhere(){
        $this->where = [];
    }
    protected function setValue(array $value){
        array_push($this->value, $value);
    }
    protected function resetValue(){
        $this->value = [];
    }
    protected function setLimit(String $limit){
       $this->limit['limit'] = $limit;
    }
    protected function resetLimit(){
        $this->limit = [];
    }
    protected function resetAll(){
        $this->resetSql();
        $this->resetValue();
        $this->resetWhere();
        $this->resetLimit();
    }
    protected function Query(){

        $this->resetAll();
        $sql = $this->sql;
        $whereSql = '';
        if(isset($this->where)){
            foreach($this->where as $where){
                if ($where['operator'] === "") {
                    $whereSql.= " WHERE ".$where['condition'];
                    break;
                }
                $whereSql.= " WHERE ".$where['condition']." ".$where['operator'];
            }
            $sql.= $whereSql;
        }
        if(isset($this->limit)){
            $sql.= " LIMIT ".$this->limit['limit'];
        }
        $sql.= ";";
        
        if(isset($this->value)){
            $statment = DBConnection::Connection()->prepare($sql);
            $statment->execute($this->value);
              return $statment->fetchColumn();
        }
        else{
            $statment = DBConnection::Connection()->prepare($sql);
            $statment->execute();
            return $statment->fetchColumn();
        }
    }
}