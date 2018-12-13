<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:27
 */

namespace Clinic\Classes\Validators;

use Clinic\Classes\Category;


class FieldCategory_id extends TypeNumberFormElement
{

   public function validate()
   {
      if ($this->value > $this->maxValue) {
         return $this->error = "Максимально допустиме значення - " . $this->maxValue;
      }
      if ($this->value < $this->minValue) {
         return $this->error = "Мінімально допустиме значення - " . $this->minValue;
      }

      if(!in_array($this->value, $this->getAllCatsId())){
         return $this->error = "Вибрана категорія не існує!";
      }
   }

   private function getAllCatsId(){
      $existentCategories = Category::getAll();
      $existentCategoriesId = [];

      foreach ($existentCategories as $category){
         $existentCategoriesId[] = $category->category_id;
      }

      return $existentCategoriesId;
   }
}