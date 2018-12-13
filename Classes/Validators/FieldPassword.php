<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:23
 */

namespace Clinic\Classes\Validators;


class FieldPassword extends TypePasswordFormElement
{
    private $salt_symbols = '!@#$%^&*()_=+-"/\\~';

    public function validate(){
        if(strlen($this->value) > $this->maxlength) {
           return $this->error = "Максимально допустима довжина паролю - " . $this->maxlength . " символів!";
        }
        if(strlen($this->value) < $this->minlength) {
           return $this->error = "Мінімально допустима довжина паролю - " . $this->minlength . " смиволів!";
        }
        if(!strpbrk($this->value, $this->salt_symbols)){
           return $this->error = "Пароль повинен містити хоча б один спецсимвол типу: @\$_%&*+ тощо!";
        }
        if(!preg_match('#[0-9]#', $this->value)){
           return $this->error = "Пароль повинен містити хоча б одну цифру!";
        }
        if(is_numeric($this->value)){
           return $this->error = "Пароль не може бути лише числом!";
        }
    }
}