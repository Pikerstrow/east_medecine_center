<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 09.10.2018
 * Time: 18:58
 */

namespace Clinic\Classes;

use Clinic\Classes\Validators\ValidateFormData;
use Clinic\Classes\Request;

class Form
{

   protected $attributes;
   protected $method;
   protected $request;
   protected $names;
   private $compiledData = array();
   private $validatedData = array();

   private $errors = array();
   private $data = array();


   public function __construct(Request $request, $method){
      $this->request = $request;
      $this->method = $method;
   }


   public function setAttributes(array $attributes){
      $this->attributes = $attributes;
   }


   public function __call($method, $args){
      return method_exists($this->request, $method) ? $this->request->{$method}($args) : false;
   }


   private function compile(){
      $elem = null;

      foreach($this->attributes as $key => $value){
         $this->names[] = $key;
      }


      if($this->method === 'post' or $this->method === 'get'){

         foreach($this->retrieveParams() as $key=>$value){

            if(in_array($key, $this->names)){
               $elem['name']       = $key;
               $elem['attributes'] = $this->attributes[$key];

               if(!is_array($value)){
                  $elem['value']   = trim($value);
               } else {
                  $elem['value']   = $value;
               }

               $this->compiledData[] = $elem;
            }
         }
      }
   }


   public function validate(){
      $this->compile();
      $this->validatedData = ValidateFormData::validate($this->compiledData);
      $this->errors        = $this->validatedData['errors'];
      $this->data          = $this->validatedData['data'];
   }


   public function hasErrors(){
      if($this->errors != []){
         return true;
      }
      return false;
   }

   public function getErrors(){
      return $this->errors;
   }

   public function getData(){
      return $this->data;
   }

   public function getValidatedData(){
      return $this->validatedData;
   }

}