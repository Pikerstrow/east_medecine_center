<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:27
 */

namespace Clinic\Classes\Validators;


class FieldPhone extends TypeTextFormElement
{
   protected $maxlength = 17;
   protected $minlength = 6;

   public function validate()
   {
      if (strlen($this->value) > $this->maxlength) {
         return $this->error = "Максимально допустима довжина - " . $this->maxlength . " символів!";
      }
      if (strlen($this->value) < $this->minlength) {
         return $this->error = "Мінімально допустима довжина - " . $this->minlength . " символів!";
      }
      if (!preg_match('#^(\+38|38)?\(?0(50|6(3|6|7)|73|9(3|7|8|9|6|5))\)?(\d{3}|\d{2})\-?\d{2}\-?(\d{3}|\d{2})$#', $this->value)) {
         return $this->error = 'Не вірний формат запису номеру телефону!';
      }
   }
}