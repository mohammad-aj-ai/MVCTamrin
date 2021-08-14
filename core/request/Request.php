<?php 

namespace app\core\request;

use app\core\request\validationTraits\FileValidation;
use app\core\request\validationTraits\NumberValidation;
use app\core\request\validationTraits\Normallidation;
use app\core\request\validationTraits\NormalValidation;

class Request {

    use NumberValidation,NormalValidation,FileValidation;

    private $errorExists = false;
    private $request;
    private $file = null;
    private $errorMessage = [];

    public function __construct()
    {
        if(isset($_POST))
            $this->request = $_POST;
        if(isset($_FILES))
            $this->file = $_FILES;
        $rules = $this->rules();
        empty($this->rules()) ? : $this->run($rules);
        $this->redirectError();
    }

    protected function run($rules)
    {
        foreach($rules as $key => $value){
            $arrayRules = explode('|', $value);
            if(in_array("number", $arrayRules)){
                $this->numberValidation($key, $arrayRules);
            }
            if(in_array("file", $arrayRules)){
                $this->fileValidation($key, $arrayRules);
            }
            else{
                $this->normalValidation($key, $arrayRules);
            }
        }
    }

    public function file($name){

        return isset($this->file[$name]) ? $this->file[$name] : false;
    }

    protected function requestAtt(){

        foreach($this->request as $key => $value){
            $this->$key = htmlentities($value);
            $this->request[$key] = htmlentities($value);
        }
    }
    public function all()
    {
        return $this->request;
    }
    protected function rules()
    {
        return [];
    }
}