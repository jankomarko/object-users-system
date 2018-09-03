<?php
/*
function conection(){
    global $pdo;
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=biblioteka", "root", "");

      //  $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."",DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}
<?php
*/
try {
 //   $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."",DB_USER, DB_PASSWORD);
    $pdo = new PDO("mysql:host=localhost;dbname=biblioteka", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}