<?php

class connector
{
    function conection(){
        global $pdo;
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=mydb", "root", "");

          //  $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."",DB_USER, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

}