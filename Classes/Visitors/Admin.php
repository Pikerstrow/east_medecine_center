<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 04.10.2018
 * Time: 20:43
 */

namespace Clinic\Classes\Visitors;

use Clinic\Classes\Database\AbstractModel;
use Clinic\Classes\Database\Db;
use Clinic\Classes\Session;


class Admin extends AbstractModel
{
   protected static $tableName = 'admins';
   protected $tableColumnsPrefix = "admin_";

   public $admin_id;
   public $admin_login;
   public $admin_password;
   public $admin_email;
   public $admin_image;
   public $admin_token;

   protected $tableColumns = ['admin_id', 'admin_login', 'admin_image', 'admin_email', 'admin_password', 'admin_token'];
   private $adminImagePath = SITE_ROOT . "admin_panel" . DS . "images" . DS . "admin_avatar" . DS;

   /**
    * @param $login
    * @param $password
    * @return array
    * This method checks whether user entered correct login and password or not! In case of mistakes the method returns
    * an assoc. array with errors where key is name of field where an error was made and value is the text of massage about mistake.
    */
   public static function verifyAndLogin($login, $password)
   {
      $connection = Db::getInstance();

      $query = "SELECT * FROM " . static::$tableName . " WHERE admin_login = :login ";

      try {
         $stmt = $connection->prepare($query);

         $stmt->execute([':login' => $login]);
         $result = $stmt->fetch();

         $possibleErrors = [];

         if(!$result){
            $possibleErrors['login'] = "Введений логін не зареєстрований в системі!";
            return $possibleErrors;
         } else {
            if(!password_verify($password, $result['admin_password'])){
               $possibleErrors['password'] = "Пароль не вірний!";
               return $possibleErrors;
            } else {
               $session = new Session();
               $session->add('admin_login', $login);
               $session->add('admin_auth', true);
               $session->add('ua', $_SERVER['HTTP_USER_AGENT']);
               $session->add('ip', $_SERVER['REMOTE_ADDR']);
               redirect(SITE_URL . "/admin_panel");
            }
         }
      } catch(\PDOException $e){
         Log::addError($e);
      }

   }

   public static function logOut(){
      $session = new Session();
      foreach($session->getAll() as $key => $value){
         $session->remove($key);
      }
      redirect(SITE_URL . "/index.php");
   }

   public function getEmail(){
      return isset($this->admin_email) ? $this->admin_email : false;
   }


   public function hashPassword(){
      return password_hash($this->admin_password, PASSWORD_BCRYPT, array('cost' => 12));
   }


   public function getAvatar(){

      preg_match('#admin_avatar\/(.*?)$#', $this->service_image, $matches);

      if($matches[1] != 'no_avatar.jpg'){
         return $this->titleImagePath . $matches[1];
      } else {
         return null;
      }
   }

}