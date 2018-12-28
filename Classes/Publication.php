<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 14.10.2018
 * Time: 18:58
 */

namespace Clinic\Classes;

use Clinic\Classes\Database\AbstractModel;
use Clinic\Classes\Database\Db;
use Clinic\Classes\Image;


class Publication extends AbstractModel
{
   private $titleImagePath = SITE_ROOT . "admin_panel" . DS . "images" . DS . "publications_title" . DS;
   private $bodyImagesPath = SITE_ROOT . "admin_panel" . DS . "images" . DS . "publications_body" . DS;

   protected static $tableName = 'publications';
   protected $tableColumnsPrefix = "publication_";

   public $publication_id;
   public $publication_title;
   public $publication_body;
   public $publication_image;
   public $publication_date;

   protected $tableColumns = ['publication_id', 'publication_title', 'publication_body', 'publication_image', 'publication_date'];


   public function unlinkImages(){
      foreach($this->getAllImages() as $value){
         if(is_file($value)){
            Image::delete($value);
         } else {
            return false;
         }
      }
      return true;
   }


   public function getBodyImages(){

      preg_match_all("#<img src=\"(.*?)\">#", $this->publication_body, $matches);

      $imagesSrc = [];

      if($matches[1] != []){
         foreach($matches[1] as $value){
            if($value != 'upload_error.jpg'){
               preg_match('#publications_body\/(.*?)$#', $value, $matches);
               $imagesSrc[] = $this->bodyImagesPath . $matches[1];
            }
         }
      }
      return $imagesSrc;
   }


   public function getTitleImage(){
      $imageWithPath = [];
      preg_match('#publications_title\/(.*?)$#', $this->publication_image, $matches);
      $imageWithPath[] = $this->titleImagePath . $matches[1];

      return $imageWithPath;
   }


   public function getAllImages(){
      return array_merge($this->getTitleImage(), $this->getBodyImages());
   }

    public function getFirstParagraph(){
        $firstParagraphOpenTag = mb_strpos($this->publication_body, '<p>');
        $firstParagraphCloseTag = mb_strpos($this->publication_body, '</p>');
        $paragraph = mb_substr($this->publication_body, $firstParagraphOpenTag, $firstParagraphCloseTag);

        return $paragraph;
    }

}