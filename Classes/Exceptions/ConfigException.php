<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 02.10.2018
 * Time: 21:04
 */

namespace Clinic\Classes\Exceptions;


class ConfigException extends \Exception
{
    public function getError(){
        $date = new \DateTime();
        $error_message = "\nConfig error:" . $date->format('Y/m/d H:i:s') . " " . $this->message . " " .  $this->getFile() . " " . $this->getLine();
        return $error_message;
    }
}