<?php

namespace app\core\request\validationTraits;

trait HasFileValidation {

    public function fileValidation(String $name, array $ruleArray)
    {
        foreach($ruleArray as $rules){
            if($rules === "required")
                $this->fileRequire($name);
            elseif(strpos($rules, "mimes")){
                str_replace("mimes:", "", $rules);
                $rule = explode(',', $rules);
                $this->fileType($name, $rule);
            }
            elseif(strpos($rules, "max:") === 0){
                str_replace("max:", "", $rules);
                $this->maxFile($name, $rules);
            }
            elseif(strpos($rules, "min:") === 0){
                str_replace("min:", "", $rules);
                $this->minFile($name, $rules);
            }
        }
    }
}