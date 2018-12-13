<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:17
 */

namespace Clinic\Classes\Validators;


class FieldEmail extends TypeEmailFormElement
{
    public function validate(){
        if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)){
           return $this->error = "Передане значення не являється дійсною email адресою!";
        }
        if(strlen($this->value) > $this->maxlength) {
           return $this->error = "Email адреса не може складатися більше ніж із " . $this->maxlength . " символів!";
        }
        if(strlen($this->value) < $this->minlength) {
           return $this->error = "Email адреса не може складатися менеше ніж із " . $this->minlength . " символів!";
        }
    }
}