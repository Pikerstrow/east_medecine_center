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


class Review extends AbstractModel
{
   protected static $tableName = 'reviews';
   protected $tableColumnsPrefix = "review_";

   public $review_id;
   public $review_name;
   public $review_gender;
   public $review_email;
   public $review_text;
   public $review_date;
   public $review_status;

   protected $tableColumns = ['review_id', 'review_name', 'review_gender', 'review_email', 'review_text', 'review_date', 'review_status'];



   public static function approve($review_id)
   {
      $connection = Db::getInstance();
      $query = "UPDATE " . static::$tableName . " SET review_status = 1 WHERE review_id = ?";

      try {
         $stmt = $connection->prepare($query);

         if (!$stmt->execute([$review_id])) {
            throw new DbException("\nExecute statement in approve review method (Review Class) failed!");
         } else {
            return $stmt->rowCount() ? true : false;
         }
      } catch (\PDOException $e) {
         Log::addError($e);
      }
   }



   public static function getApprovedOnly()
   {
      $connection = Db::getInstance();

      try {
         $query = "SELECT * FROM " . static::$tableName . " WHERE review_status = 1";
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


   public static function countItems()
   {
      $connection = Db::getInstance();

      try {
         $query = "SELECT count(*) FROM " . static::$tableName . " WHERE review_status = 1";
         $result = $connection->query($query);
         $row = $result->fetch();

         return array_shift($row);

      } catch (\PDOException $e) {
         Log::addError($e);
      }

   }

   public static function countUnapproved()
   {
      $connection = Db::getInstance();

      try {
         $query = "SELECT count(*) FROM " . static::$tableName . " WHERE review_status = 0";
         $result = $connection->query($query);
         $row = $result->fetch();

         return array_shift($row);

      } catch (\PDOException $e) {
         Log::addError($e);
      }

   }
}