<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 02.10.2018
 * Time: 21:39
 */

namespace Clinic\Classes\Database;

use Clinic\Classes\Config;
use Clinic\Classes\Exceptions\DbException;
use PDO;

class Db
{
    private static $instance;
    private static $dsn;
    private static $user;
    private static $password;

    private static function connect() {

        $db_config = Config::getInstance()->get('db');

        self::$user = $db_config['user'];
        self::$password = $db_config['password'];
        self::$dsn = $db_config['driver'] . ":dbname=" . $db_config['name'] . ";charset=utf8;host=" . $db_config['host'];

        try {
            if(!$connection = new PDO(self::$dsn, self::$user, self::$password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            )){
                throw new DbException("Помилка підключення до бази даних!");
            }
            return $connection;
        } catch (DbException $e) {
           Log::addError($e);
        }
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = self::connect();
        }
        return self::$instance;
    }
}

