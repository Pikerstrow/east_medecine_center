<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:27
 */

namespace Clinic\Classes\Validators;


class FieldPrice extends TypeTextFormElement
{
   protected $maxlength = 8;
   protected $minlength = 1;

   public function validate()
   {
      if (strlen($this->value) > $this->maxlength) {
         return $this->error = "Максимально допустима величина - " . $this->maxlength . " символів!";
      }
      if (strlen($this->value) < $this->minlength) {
         return $this->error = "Мінімально допустима величина - " . $this->minlength . " символів!";
      }
      if(!is_numeric($this->value)){
         return $this->error = "Ціна повинна складатися лише із цифер та не може містити інших символів! Використання пробілу не допускається.";
      }

   }
}