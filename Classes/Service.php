<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 11.10.2018
 * Time: 21:42
 */

namespace Clinic\Classes;

use Clinic\Classes\Database\AbstractModel;
use Clinic\Classes\Category;
use Clinic\Classes\Database\Db;

class Service extends AbstractModel
{
   private $titleImagePath = SITE_ROOT . "admin_panel" . DS . "images" . DS . "services_title" . DS;

   protected static $tableName = 'services';
   protected $tableColumnsPrefix = "service_";

   public $service_id;
   public $service_title;
   public $service_image;
   public $service_price;
   public $service_category_id;

   protected $tableColumns = ['service_id', 'service_category_id', 'service_title', 'service_image', 'service_price'];


   public function getTitleImage(){

      preg_match('#services_title\/(.*?)$#', $this->service_image, $matches);

      if($matches[1] != 'service_has_no_photo.jpg'){
         return $this->titleImagePath . $matches[1];
      } else {
         return null;
      }
   }


   public function getCategory($categoryId){
      try{
         $stmt = $this->dbConnection->prepare("SELECT category_title FROM " . Category::$tableName . " WHERE category_id = :param");
         $stmt->execute([':param' => $categoryId]);
         $data = $stmt->fetch();
         return $data !== [] ? $data['category_title'] : false;
      } catch(\PDOException $e){
         Log::addError($e);
         return null;
      }

   }

   public static function getAllWithFilter($categoryId = null)
   {
      $connection = Db::getInstance();

      try {
         if(!$categoryId){
            $query = "SELECT * FROM " . static::$tableName;
         } else {
            $query = "SELECT * FROM " . static::$tableName . " WHERE service_category_id = {$categoryId}";
         }

         $result = $connection->query($query);

         $data = [];

         while ($row = $result->fetch()) {
            $data[] = static::instantiation($row);
         }
         return $data;

      } catch (\PDOException $e) {
         Log::addError($e);
      }
   }


}