<?php

namespace App\Models;

/**
 * Class Connector
 * @package Models
 */
class Connector
{

    /**
     * @var null
     */
    private static $instance = null;

    /**
     * Connector constructor.
     */
    protected function __construct()
    {

    }

    /**
     *
     */
    protected function __clone()
    {
    }

    /**
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }


    /**
     * @return null
     */
    public static function getInstance()
    {
        global $pdo;
        if (static::$instance == null) {
            static::$instance = new static;
            $pdo = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "", DB_USER, DB_PASSWORD);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return static::$instance;
        }
    }


}