<?php

//namespace phpProject;

abstract class Db
{
    private static $conn;

    private static function getConfig()
    {
        // get the config file
        return parse_ini_file(__DIR__.'/../config/config.ini');
    }

    public static function getInstance()
    {
        if (self::$conn != null) {
            return self::$conn;
        } else {
            $config = self::getConfig();
            $database = $config['db_database'];
            $server = $config['db_servername'];
            $user = $config['db_user'];
            $password = $config['db_password'];
            $port = $config['db_port'];

            try {
                self::$conn = new PDO('mysql:host='.$server.';dbname='.$database.';port='.$port.';charset=utf8mb4', $user, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                var_dump($e);
                die();
            }

            return self::$conn;
        }
    }
}
