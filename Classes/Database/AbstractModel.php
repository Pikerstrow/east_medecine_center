<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 04.10.2018
 * Time: 20:50
 */

namespace Clinic\Classes\Database;

use Clinic\Classes\Database\Db;
use Clinic\Classes\Exceptions\DbException;
use Clinic\Classes\Log;


class AbstractModel
{
   protected static $tableName;
   protected $tableColumns;
   protected $tableColumnsPrefix;
   protected $dbConnection;


   /**
    * AbstractModel constructor.
    * dbConnection property contains connection with DB;
    */
   public function __construct()
   {
      $this->dbConnection = Db::getInstance();
   }

   /**
    * @param $property
    * @return bool
    * This method checks whether instance of class contains necessary property or not.
    */
   protected function hasProperty($property)
   {
      $instanceProperties = get_object_vars($this);
      return (array_key_exists($property, $instanceProperties)) ? true : false;
   }

   /**
    * @param $data
    * @return array|string
    * This method is used for sanitizing data before its transferring to DB.
    */
   protected function sanitizeData($data)
   {
      $cleanData = [];

      if (is_array($data)) {
         foreach ($data as $key => $value) {
            $cleanData[$key] = strip_tags($value);
         }
         return $cleanData;
      }

      return strip_tags((string)$data);
   }

   /**
    * @param array $data
    * @return mixed
    * This method creates objects. As a rule, is used for fetching data from DB.
    */
   public static function instantiation(array $data)
   {
      $callingClass = get_called_class();
      $instance = new $callingClass();

      foreach ($data as $property => $value) {
         if ($instance->hasProperty($property)) {
            $instance->$property = $value;
         }
      }
      return $instance;
   }

   /**
    * @return array
    * this methods allows to select all records from DB and returns array of instances.
    */
   public static function getAll()
   {
      $connection = Db::getInstance();

      try {
         $query = "SELECT * FROM " . static::$tableName;
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

    /**
 * @return array
 * @param $limit
 * this methods allows to select necessary quantity of records from DB and returns array of instances.
 */
    public static function getAllWithLimit($limit)
    {
        $connection = Db::getInstance();

        try {
            $query = "SELECT * FROM " . static::$tableName . " LIMIT {$limit}";
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

    /**
     * @return array
     * @param $limit
     * this methods allows to select necessary quantity of records from DB and returns array of instances.
     */
    public static function getWithLimitByParam($limit, $dbField, $param)
    {
        $connection = Db::getInstance();

        try {
            $stmt = $connection->prepare("SELECT * FROM " . static::$tableName . " WHERE {$dbField} = :param" . " LIMIT {$limit}");
            $stmt->execute([':param' => $param]);

            $data = [];

            while ($row = $stmt->fetch()) {
                $data[] = static::instantiation($row);
            }
            return $data;

        } catch (\PDOException $e) {
            Log::addError($e);
        }
    }
   /**
    * @param $dbField
    * @param $param
    * @return mixed|null
    * This method allows to get only one row from DB and returns instance of called class.
    */
   public static function getByParam($dbField, $param)
   {
      $connection = Db::getInstance();

      try {
         $stmt = $connection->prepare("SELECT * FROM " . static::$tableName . " WHERE {$dbField} = :param");
         $stmt->execute([':param' => $param]);
         $data = $stmt->fetch();
         return $data !== false ? static::instantiation($data) : false;
      } catch (\PDOException $e) {
         Log::addError($e);
         return null;
      }
   }


   public static function getLast($dateField){
       $connection = Db::getInstance();

       try {
           $stmt = $connection->query("SELECT * FROM " . static::$tableName . " WHERE {$dateField} = (SELECT MAX({$dateField}) FROM " . static::$tableName . ")");
           $data = $stmt->fetch();
           return $data !== false ? static::instantiation($data) : false;
       } catch (\PDOException $e) {
           Log::addError($e);
           return null;
       }
   }


   public static function selectByQuery($query){
      $connection = Db::getInstance();

      try {
         $result = $connection->query($query);
         $data = [];

         while ($row = $result->fetch()) {
            $data[] = static::instantiation($row);
         }
         return $data;

      } catch (\PDOException $e) {
         Log::addError($e);
         return null;
      }
   }

   /**
    * @param array $data
    * @param bool $sanitize
    * This method creates new records in DB.
    */

   public function create(array $data, $sanitize = false)
   {
      if ($sanitize) {
         $data = $this->sanitizeData($data);
      }

      $dataForDb = [];


      foreach ($data as $key => $value) {
         if (in_array($this->tableColumnsPrefix . $key, $this->tableColumns)) {
            if(!is_array($value)){
               $dataForDb[$this->tableColumnsPrefix . $key] = $value;
            }
         }
      }

      $query = "INSERT INTO " . static::$tableName . " (" . implode(",", array_keys($dataForDb)) . ") ";
      $query .= "VALUES (" . implode(",", array_fill(0, count($dataForDb), '?')) . ")";


      try {
         $stmt = $this->dbConnection->prepare($query);

         $counter = 0;
         foreach ($dataForDb as $key => &$value) {
            $counter++;
            $stmt->bindParam($counter, $value);
         }

         if (!$stmt->execute()) {
            throw new DbException("\nExecute statement in create method failed!");
         } else {
            $instanceId = $this->tableColumnsPrefix . "id";
            $this->$instanceId = $this->dbConnection->lastInsertId();
            return true;
         }
      } catch (\PDOException $e) {
         Log::addError($e);
      }

   }

   /**
    * @param array $data
    * @param bool $sanitize
    * @param $dbField
    * @param $param
    * @return bool
    */
   public function update(array $data, $dbField, $param, $sanitize = false)
   {
      if ($sanitize) {
         $data = $this->sanitizeData($data);
      }

      $dataForDb = [];

      foreach ($data as $key => $value) {
         if (in_array($this->tableColumnsPrefix . $key, $this->tableColumns)) {
            $key = $this->tableColumnsPrefix . $key;
            $dataForDb[] = "{$key}=:$key";
         }
      }

      $query = "UPDATE " . static::$tableName . " SET " . implode(",", $dataForDb) . " WHERE {$dbField} = :param";

      try {
         $stmt = $this->dbConnection->prepare($query);

         foreach ($data as $key => &$value) {
            $key = $this->tableColumnsPrefix . $key;
            $stmt->bindParam(":" . $key, $value);
         }
         $stmt->bindParam(":param", $param);

         if (!$stmt->execute()) {
            throw new DbException("\nExecute statement in update method failed!");
         } else {
            return $stmt->rowCount() ? true : false;
         }
      } catch (\PDOException $e) {
         Log::addError($e);
      }
   }

   /**
    * @param $dbField
    * @param $param
    * @return bool
    */
   public static function delete($dbField, $param)
   {
      $connection = Db::getInstance();
      $query = "DELETE FROM " . static::$tableName . " WHERE {$dbField} = :param";

      try {
         $stmt = $connection->prepare($query);
         $stmt->bindParam(":param", $param);

         if (!$stmt->execute()) {
            throw new DbException("\nExecute statement in delete method failed!");
         } else {
            return $stmt->rowCount() ? true : false;
         }
      } catch (\PDOException $e) {
         Log::addError($e);
      }

   }

   /**
    * @return mixed
    * This method allows to calculate number of rows in DB and returns its quantity.
    */
   public static function countItems()
   {
      $connection = Db::getInstance();

      try {
         $query = "SELECT count(*) FROM " . static::$tableName;
         $result = $connection->query($query);
         $row = $result->fetch();

         return array_shift($row);

      } catch (\PDOException $e) {
         Log::addError($e);
      }

   }

}