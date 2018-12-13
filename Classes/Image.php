<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 01.11.2018
 * Time: 19:55
 */

namespace Clinic\Classes;

use Clinic\Classes\File;

class Image extends File
{
   protected $src;

   public function setSrc($src){
      $this->src = SITE_URL . "/" . $src . "/" . $this->filename;
   }

   public function getSrc(){
      return $this->src;
   }
}