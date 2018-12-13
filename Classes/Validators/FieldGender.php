<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:17
 */

namespace Clinic\Classes\Validators;


class FieldGender extends TypeRadioButtonFormElement
{
    public function validate(){
        if(!in_array($this->value, $this->possibleValues)){
           return $this->error = "Виберіть значення із списку досутпних!";
        }
    }
}