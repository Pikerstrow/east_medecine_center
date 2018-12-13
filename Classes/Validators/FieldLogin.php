<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:20
 */

namespace Clinic\Classes\Validators;


class FieldLogin extends TypeTextFormElement
{
    public function validate()
    {
        if (strlen($this->value) > $this->maxlength) {
           return $this->error = "Максимально допустима довжина логіну - " . $this->maxlength . " символів!";
        }
        if (strlen($this->value) < $this->minlength) {
           return $this->error = "Мінімально допустима довжина логіну - " . $this->minlength . " символів!";
        }
    }
}