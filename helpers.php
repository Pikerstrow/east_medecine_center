<?php

use Clinic\Classes\Session;
use Clinic\Classes\Visitors\Admin;

/*CONSTANTS*/
define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'C:' . DS . 'wamp64' . DS . 'www' . DS . "east_medicine_center" . DS);
define('SITE_URL', 'http://localhost/east_medicine_center');


/*AUTOLOAD FUNCTION*/
function autoloader($class_name) {
    $firstSlash = strpos($class_name, '\\') + 1;
    $class_name = substr($class_name, $firstSlash);
    $directory = __DIR__. DS . str_replace('\\', DS, $class_name);
    $filename =  $directory . '.php';

    if(file_exists($filename)){
        require_once "$filename";
    }
}

/*REDIRECT*/
function redirect($location){
   header("Location: {$location}");
}

/*CHECKING AUTHORIZATION
Is used in admin panel.
*/
function checkAuth (Session $session) {
   if(!$session->check(['admin_auth', 'admin_login'])){
      exit(redirect(SITE_URL . "/login.php"));
   } else if($session->get('ua') != $_SERVER['HTTP_USER_AGENT'] or $session->get('ip') != $_SERVER['REMOTE_ADDR']){
      Admin::logOut();
   }
}

/*Shows inf-blocks*/
function showInfoBlock($message, $type){
   $class = '';
   $intro = '';

   switch($type){
      case 'danger':
         $class = 'alert alert-danger';
         $intro = "Помилка!";
         break;
      case 'success':
         $class = 'alert alert-success';
         $intro = "Дія пройшла успішно!";
         break;
      case 'warning':
         $class = 'alert alert-warning';
         $intro = "Увага!";
         break;
      case 'info':
         $class = 'alert alert-info';
         $intro = "Повідомляємо!";
         break;
   }

   $infoBlock = <<<BLOCK
<div class="$class">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <p><b>$intro </b> $message </p>
</div>
BLOCK;

   echo $infoBlock;
}





