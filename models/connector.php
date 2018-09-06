<?php

class connector
{
    private static $instance=null;
    protected function __construct(){
    }
    protected function __clone(){
    }
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }


    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }




    function conection(){
        global $pdo;
        try {
          //  $pdo = new PDO("mysql:host=localhost;dbname=mydb", "root", "");
            $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."",DB_USER, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

}