<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:27
 */

namespace Clinic\Classes\Validators;


class FieldText extends TypeTextFormElement {

    public function validate(){
        if(strlen($this->value) > $this->maxlength) {
           return $this->error = "Максимально допустима довжина - " . $this->maxlength . " символів!";
        }
        if(strlen($this->value) < $this->minlength) {
           return $this->error = "Мінімально допустима довжина - " . $this->minlength . " символів!";
        }
    }
}