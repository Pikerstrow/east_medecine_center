<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 09.10.2018
 * Time: 18:57
 */

namespace Clinic\Classes;


class Session
{
   private $session_id;

   public function __construct()
   {
      if (session_status() == PHP_SESSION_NONE) {
         session_start();
         $this->session_id = session_id();
      }
   }

   public function add($key, $value)
   {
      $_SESSION[$key] = $value;
   }

   public function get($key)
   {
      if(array_key_exists($key, $_SESSION)){
         $value = $_SESSION[$key];
         return $value;
      }
      return null;
   }

   public function update($key, $value){
      if($this->check($key)){
         $_SESSION[$key] = $value;
      }
   }


   public function getAll()
   {
      return $_SESSION;
   }

   public function check($key)
   {

      if(is_array($key)){
         foreach($key as $value){
            if(!in_array($value, array_keys($_SESSION))){
               return false;
            }
         }
         return true;
      } else {
         if(array_key_exists($key, $_SESSION)){
            return true;
         }
         return false;
      }

   }

   public function remove($key){
      if(array_key_exists($key, $_SESSION)){
         unset($_SESSION[$key]);
      }
   }

   public function getId(){
      return $this->session_id;
   }


}