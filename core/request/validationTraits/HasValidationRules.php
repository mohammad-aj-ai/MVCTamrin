<?php

namespace app\core\request\validationTraits;

use app\database\DBConnection;

trait HasValidationRules {

    public function normalValidation(String $name,array $ruleArray)
    {
        foreach($ruleArray as $rules){

            if($rules === "required")
                $this->required($name);

            elseif(strpos($rules, "max:") === 0){
                str_replace("max:", "", $rules);
                $this->maxStr($name, $rules);
            }
            elseif(strpos($rules, "min:") === 0){
                str_replace("min:", "", $rules);
                $this->minStr($name, $rules);
            }
            elseif($rules === "email")
                $this->email($name);

            elseif($rules === "date")
                $this->date($name);
            
            elseif(strpos("exists", $rules) === 0)
            {
                str_replace("exists:", "", $rules);
                $rule = explode(',', $rules);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->existsIn($name, $rule[0], $key);
            }
        }
    }

    protected function maxStr(String $name,int $count)
    {
        if($this->checkFieldExist($name)){
            if(strlen($this->request[$name]) >= $count and $this->checkFirstError())
                $this->setError($name, "max length equal or lower than $count ");
        }
    }
    protected function minStr(String $name,int $count)
    {
        if($this->checkFieldExist($name)){
            if(strlen($this->request[$name]) <= $count and $this->checkFirstError())
                $this->setError($name, "min length equal or upper than $count ");
        }
    }
    protected function maxNumber(String $name,int $count)
    {
        if($this->checkFieldExist($name)){
            if($this->request[$name] >= $count and $this->checkFirstError())
                $this->setError($name, "max length equal or lower than $count ");
        }
    }
    protected function minNumber(String $name,int $count)
    {
        if($this->checkFieldExist($name)){
            if($this->request[$name] <= $count and $this->checkFirstError())
                $this->setError($name, "min length equal or lower than $count ");
        }
    }
    protected function required(String $name)
    {
        if((!isset($this->request[$name]) || $this->request[$name] === '') && $this->checkFirstError($name)){
            $this->setError($name,"$name is required");
        }
    }

    protected function number(String $name)
    {
        if($this->checkFieldExist($name)){
            if(!is_numeric($this->request[$name]) && $this->checkFirstError($name))
            {
                $this->setError($name,"$name must be number format");
            }
        }
    }

    protected function date(String $name)
    {
        if($this->checkFieldExist($name)){
           if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->request[$name]) && $this->checkFirstError($name)){
            $this->setError($name,"$name must be date format");
           }
        }
    }
    protected function email(String $name)
    {
        if($this->checkFieldExist($name)){
            if(!filter_var($this->request[$name], FILTER_VALIDATE_EMAIL) && 
            $this->checkFirstError($name))
            {
                $this->setError($name,"$name must be email format");
            }
        }
    }
    protected function existsIn(String $name, String $table, String $field = 'id')
    {
        if($this->checkFieldExist($name)){
            if($this->checkFirstError($name)){
                $value = $this->$field;
                $sql = "SELECT COUNT(*) FROM $table WHERE $field = ?;";
                $stmt = DBConnection::Connection()->prepare($sql);
                $stmt->execute([$value]);
                $result = $stmt->fetchColumn();
                if($result == 0 or $result === false)
                    $this->setError($name,"$name doesnt exist");
            }
        }
    }
}