<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 07.10.2018
 * Time: 10:42
 */

namespace Clinic\Classes;


class ForgotPassword
{
   private $length = 50;
   private $token;


   public function __construct()
   {
      $this->generateToken();
   }

   /**
    * Generated token is used for recovering password.
    */
   private function generateToken()
   {
      $this->token = bin2hex(openssl_random_pseudo_bytes($this->length));
   }

   public function getToken()
   {
      return $this->token;
   }

}