<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 11.10.2018
 * Time: 21:42
 */

namespace Clinic\Classes;

use Clinic\Classes\Database\AbstractModel;
use Clinic\Classes\Database\Db;

class Category extends AbstractModel
{
   private $titleImagePath = SITE_ROOT . "admin_panel" . DS . "images" . DS . "categories_title" . DS;
   private $bodyImagesPath = SITE_ROOT . "admin_panel" . DS . "images" . DS . "categories_body" . DS;

   public static $tableName = 'categories';
   protected $tableColumnsPrefix = "category_";

   public $category_id;
   public $category_title;
   public $category_image;
   public $category_body;

   protected $tableColumns = ['category_id', 'category_title', 'category_body', 'category_image'];


   public function getTitleImage(){
      $imageWithPath = [];

      preg_match('#categories_title\/(.*?)$#', $this->category_image, $matches);

      if($matches[1] != 'service_has_no_photo.jpg'){
         $imageWithPath[] = $this->titleImagePath . $matches[1];
      }
      return $imageWithPath;
   }


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

      preg_match_all("#<img src=\"(.*?)\">#", $this->category_body, $matches);

      $imagesSrc = [];

      if($matches[1] != []){
         foreach($matches[1] as $value){
            if($value != 'upload_error.jpg'){
               preg_match('#categories_body\/(.*?)$#', $value, $matches);
               $imagesSrc[] = $this->bodyImagesPath . $matches[1];
            }
         }
      }
      return $imagesSrc;

   }

   public function getAllImages(){
      return array_merge($this->getTitleImage(), $this->getBodyImages());
   }


   public static function getAllForOptions($cat = '')
   {
      $connection = Db::getInstance();

      try {
         $query = "SELECT category_id, category_title FROM " . static::$tableName;
         $result = $connection->query($query);

         if (!$result) {
            echo "<option value='' selected>Досупні категорії відсутні</option>";
         } else {
            while ($row = $result->fetch()) {
               if($cat == $row['category_id']){
                  echo "<option value='{$row['category_id']}' selected >{$row['category_title']}</option>";
               } else {
                  echo "<option value='{$row['category_id']}'>{$row['category_title']}</option>";
               }
            }
         }
      } catch (\PDOException $e) {
         Log::addError($e);
         echo "<option value='' selected>Помилка відбору даних із бази даних</option>";
      }
   }

   public static function selectByQuery($query){
      $connection = Db::getInstance();

      try {
         $result = $connection->query($query);
         $data = [];

         while ($row = $result->fetch()) {
            $data[] = $row;
         }
         return $data;

      } catch (\PDOException $e) {
         Log::addError($e);
         return null;
      }
   }


}