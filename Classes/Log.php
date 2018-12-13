<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 09.10.2018
 * Time: 19:46
 */

namespace Clinic\Classes;

use Clinic\Classes\Exceptions\ConfigException;
use Clinic\Classes\Exceptions\DbException;
use Clinic\Classes\Exceptions\MailException;


class Log
{
   private static $logFilePath = SITE_ROOT . "files/logs.txt";

   public static function addError(\Exception $exception)
   {
      if (get_class($exception) == 'Exception') {
         $date = new \DateTime();
         $error_message = "\nError: " . $date->format('Y/m/d H:i:s') . " " . $exception->getMessage() . " " . $exception->getFile() . " " . $exception->getLine();
         file_put_contents(static::$logFilePath, $error_message, FILE_APPEND);
      } else if(get_class($exception) == 'PDOException'){
         $date = new \DateTime();
         $error_message = "\nPDO Error: " . $date->format('Y/m/d H:i:s') . " " . $exception->getMessage() . " " . $exception->getFile() . " " . $exception->getLine();
         file_put_contents(static::$logFilePath, $error_message, FILE_APPEND);
      } else {
         file_put_contents(static::$logFilePath, "\n".$exception->getError(), FILE_APPEND);
      }
   }
}