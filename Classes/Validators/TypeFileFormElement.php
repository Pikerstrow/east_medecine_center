<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:15
 */

namespace Clinic\Classes\Validators;


abstract class TypeFileFormElement extends FormElement
{

   protected $extensions = array();
   protected $maxsize;
   protected $parameters = array();
   protected $preview = false;


   public function __construct($data)
   {
      parent::__construct($data);

      foreach ($this->attributes as $key => $value) {
         switch ($key) {
            case 'extensions':
               $this->extensions = $value;
               break;
            case 'maxsize':
               $this->maxsize = $value;
               break;
            case 'parameters':
               $this->parameters = $value;
               break;
            case 'preview':
               $this->preview = $value;
               break;
         }
      }
      $this->validate($this->value);
   }
}