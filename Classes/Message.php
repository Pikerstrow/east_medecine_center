<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 11.10.2018
 * Time: 21:42
 */

namespace Clinic\Classes;

use Clinic\Classes\Database\AbstractModel;

class Message extends AbstractModel
{
   protected static $tableName = 'messages';
   protected $tableColumnsPrefix = "message_";

   public $message_id;
   public $message_name;
   public $message_email;
   public $message_phone;
   public $message_text;
   public $message_date;

   protected $tableColumns = ['message_id', 'message_name', 'message_email', 'message_phone', 'message_text', 'message_date'];

}