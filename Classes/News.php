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


class News extends AbstractModel
{
   private $titleImagePath = SITE_ROOT . "admin_panel" . DS . "images" . DS . "news_title" . DS;
   private $bodyImagesPath = SITE_ROOT . "admin_panel" . DS . "images" . DS . "news_body" . DS;

   protected static $tableName = 'news';
   protected $tableColumnsPrefix = "news_";

   public $news_id;
   public $news_title;
   public $news_body;
   public $news_image;
   public $news_date;

   protected $tableColumns = ['news_id', 'news_title', 'news_body', 'news_image', 'news_date'];


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

      preg_match_all("#<img src=\"(.*?)\">#", $this->news_body, $matches);

      $imagesSrc = [];

      if($matches[1] != []){
         foreach($matches[1] as $value){
            if($value != 'upload_error.jpg'){
               preg_match('#news_body\/(.*?)$#', $value, $matches);
               $imagesSrc[] = $this->bodyImagesPath . $matches[1];
            }
         }
      }
      return $imagesSrc;
   }


   public function getTitleImage(){
      $imageWithPath = [];
      preg_match('#news_title\/(.*?)$#', $this->news_image, $matches);
      $imageWithPath[] = $this->titleImagePath . $matches[1];

      return $imageWithPath;
   }


   public function getAllImages(){
      return array_merge($this->getTitleImage(), $this->getBodyImages());
   }

   public function getFirstParagraph(){
       $firstParagraphOpenTag = mb_strpos($this->news_body, '<p>');
       $firstParagraphCloseTag = mb_strpos($this->news_body, '</p>');
       $paragraph = mb_substr($this->news_body, $firstParagraphOpenTag, $firstParagraphCloseTag);

       return $paragraph;
   }

}