<?php

class connector
{
    private static $instances = [];
    protected function __construct(){
    }
    protected function __clone(){
    }
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }


    public static function getInstance(): connector
    {
        $cls = get_called_class();
        if (! isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }

        return self::$instances[$cls];
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