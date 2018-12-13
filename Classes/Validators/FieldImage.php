<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:17
 */

namespace Clinic\Classes\Validators;


class FieldImage extends TypeFileFormElement
{
   protected $extensions = ['png', 'jpeg', 'jpg'];


   public function validate()
   {

      if ($this->value['name'] == '' or empty($this->value['name'])){
         return $this->error = "Ви не вибрали файл!!!";
      }

      if ($this->value['error'] != 0) {
         switch ($this->value['error']) {
            case 1 :
               return $this->error = 'Розмір файлу перевищує допустимі значення';
               break;
            case 2 :
               return $this->error = 'Розмір файлу еревищує допустимі значення';
               break;
            case 3 :
               return $this->error = 'Помилка передачі файлу. Файл передано лише частково';
               break;
            case 4 :
               return $this->error = 'Файл не було завантажено';
               break;
            case 6 :
               return $this->error = 'На сервері відсутня директорія для завантаження файлу.';
               break;
            case 7 :
               return $this->error = 'Не вдалося записати файл на диск.';
               break;
            case 8 :
               return $this->error = 'Помилка завантаження файлу.';
               break;
         }
      }

      if ($this->value['size'] > $this->maxsize) {
         return $this->error = "Файл надто великий. Максимальний розмір " . floor($this->maxsize/1024/1024) . " Мб";
      }

      $ext = mb_strtolower(pathinfo($this->value['name'], PATHINFO_EXTENSION));
      if (!in_array($ext, $this->extensions)) {
         return $this->error = "Недопустиме розширення файлу. Можливі розширення: \'.png\', \'.jpeg\', \'.jpg\'. '";
      }

      if (false === $image = getimagesize($this->value['tmp_name']))
         return $this->error = 'Файл, який Ви намагаєтесь завантажите не являється зображенням!';


      if($this->preview){
         if ($image[0] != $this->parameters['width'] or $image[1] != $this->parameters['height'])
            return $this->error = "Зображення повинне чітко відповідати розмірам: " . $this->parameters['width'] . "px на " . $this->parameters['height'] . "px";
      } else {
         if ($image[0] > $this->parameters['width'] or $image[1] > $this->parameters['height'])
            return $this->error = "Максимально допустимий розмір зображення: " . $this->parameters['width'] . " х " . $this->parameters['height'];
      }
   }
}