<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:15
 */

namespace Clinic\Classes\Validators;


abstract class TypeRadioButtonFormElement extends FormElement {
    protected $possibleValues = array();

   public function __construct($data){
      parent::__construct($data);

      foreach($this->attributes as $key => $value) {
         switch ($key) {
            case 'possible_values':
               $this->possibleValues = $value;
               break;
         }
      }
      $this->validate($this->value);
   }
}