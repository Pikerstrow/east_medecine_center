<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 02.10.2018
 * Time: 20:42
 */

namespace Clinic\Classes;

use Clinic\Classes\Exceptions\ConfigException;
use Clinic\Classes;

class Config
{
    private static $data;
    private static $instance;

    public function __construct()
    {
        $path = SITE_ROOT . "files" . DS . "config.json";

        if (!$json = file_get_contents($path)){
            throw new ConfigException("Config file not found!");
        }
        self::$data = json_decode($json, true);

    }

    public static function getInstance(){
        if(self::$instance == null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function get($key){
        if(!isset(self::$data[$key])){
            throw new ConfigException("Config file doesn't contain requested properties!");
        }
        return self::$data[$key];
    }
}

