<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 07.10.2018
 * Time: 10:29
 */

namespace Clinic\Classes;

use Clinic\Classes\Exceptions\MailException;

class Mailer
{
   private $recipient;
   private $subject;
   private $header;
   private $message;

   public function __construct()
   {
      $this->setMailHeader();
   }

   public function setRecipient($value)
   {
      $this->recipient = $value;
   }

   public function setSubject($value)
   {
      $this->subject = $value;
   }

   public function setCustomHeader($value)
   {
      $this->header = $value;
   }

   public function setMessage($value)
   {
      $this->message = $value;
   }

   public function send()
   {
      if(mail($this->recipient, $this->subject, $this->message, $this->header)){
         return true;
      } else {
         throw new MailException("Помилка відправки email повідомлення!");
      }
   }

   public function setMailHeader()
   {
      $header  = 'From: admin@coffee.web-ol-mi.pp.ua' . "\r\n" .
                 'MIME-Version: 1.0' . "\r\n" .
                 'Content-type: text/html; charset=utf-8';
      $this->header = $header;
   }
}