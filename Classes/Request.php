<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 09.10.2018
 * Time: 18:56
 */

namespace Clinic\Classes;


class Request
{
   protected $params;
   protected $path;
   protected $file;


   public function __construct()
   {
      $this->params = array_merge($_POST, $_GET, $_FILES);
      $this->file = $_FILES;
      $this->path = $_SERVER['REQUEST_URI'];
   }


   public function retrieveParams()
   {
      return $this->params;
   }


   public function retrieveFile()
   {
      return $this->file;
   }


   public function has($value)
   {
      if(is_array($value)){
         foreach ($value as $prop){
            if(!array_key_exists($prop, $this->params)){
               return false;
            }
         }
         return true;
      }
      if(array_key_exists($value, $this->params)){
         return true;
      }
      return false;
   }



   public function getStringParam($param, $sanitize = false, $numeric = false)
   {
      if ($sanitize) {
         if (array_key_exists($param, $this->params) and is_string($this->params[$param])) {
            return strip_tags(trim($this->params[$param]));
         }
         return '';
      } else if ($sanitize and $numeric) {
         if (array_key_exists($param, $this->params) and is_string($this->params[$param]) and ctype_digit($this->params[$param])) {
            return strip_tags(trim($this->params[$param]));
         }
         return '';
      } else if($numeric){
         if (array_key_exists($param, $this->params) and is_string($this->params[$param]) and ctype_digit($this->params[$param])) {
            return trim($this->params[$param]);
         }
         return '';
      } else {
         if (array_key_exists($param, $this->params) and is_string($this->params[$param])) {
            return trim($this->params[$param]);
         }
         return '';
      }
   }


   public function getArrayParam($param, $sanitize = false)
   {
      if($sanitize){
         if(array_key_exists($param, $this->params) and is_array($this->params[$param])){
            $sanitizedArray = [];
            foreach($this->params[$param] as $key => $value){
               $sanitizedArray[$key] = strip_tags($value);
            }
            return $sanitizedArray;
         }
         return [];
      } else {
         if(array_key_exists($param, $this->params) and is_array($this->params[$param])){
            return $this->params[$param];
         }
         return [];
      }
   }


   public function unsetParam($param)
   {
      if(is_array($param)){
         foreach($param as $key){
            if(array_key_exists($key, $this->params)){
               unset($this->params[$key]);
            }
         }
      }
      if(is_string($param)){
         if(array_key_exists($param, $this->params)){
            unset($this->params[$param]);
         }
      }
   }
}