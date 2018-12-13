<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:28
 */

namespace Clinic\Classes\Validators;


class ValidateFormData
{

   private static $form_data = array();
   private static $form_errors = array();
   private static $avail_types = ['email', 'password', 'phone', 'login', 'file', 'gender', 'image', 'price', 'category_id'];

   /**
    * @param array $form_data
    * @return mixed
    * This method validates forms data dynamically creating objects of separate validators classes. The method returns
    * an array with validated data and mistakes
    */
   public static function validate(array $form_data)
   {

      foreach ($form_data as $value) {
         if (in_array(strtolower($value['name']), static::$avail_types)) {
            $field = 'Field' . ucfirst($value['name']);
         } else {
            $field = 'FieldText';
         }

         $classname = __NAMESPACE__ . "\\" . $field;
         $obj = new $classname($value);

         if ($obj->getValue()) {
            static::$form_data[$value['name']] = $obj->getValue();
         }

         if ($obj->getError()) {
            static::$form_errors[$value['name']] = $obj->getError();
         }
      }

      $validated_data['data'] = static::$form_data;
      $validated_data['errors'] = static::$form_errors;

      return $validated_data;
   }

}

