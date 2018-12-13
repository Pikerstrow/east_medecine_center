<?php
require_once("helpers.php");
require_once("mail_templates.php");

use Clinic\Classes\Session;
use Clinic\Classes\Request;

spl_autoload_register('autoloader');

ob_start();

$session = new Session();
$request = new Request();





