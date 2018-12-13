<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:12
 */

namespace Clinic\Classes\Validators;


abstract class FormElement {
    protected $value;
    protected $attributes;
    protected $error;
    protected $name;

    public function __construct(array $data){
        $this->value = $data['value'];
        $this->attributes = $data['attributes'];
        $this->name = $data['name'];
    }

    public function getError(){
        if(isset($this->error)){
            return $this->error;
        }
        return false;
    }

    public function getValue(){
        if(!isset($this->error) or empty($this->error)){
           if(!is_array($this->value)){
              return trim($this->value);
           } else {
              return $this->value;
           }
        }
        return false;
    }

    abstract public function validate();
}