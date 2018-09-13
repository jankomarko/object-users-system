<?php

//require "vendor/autoload.php";

//$login=new \App\Controllers\Login();
//var_dump($login->loginuser("janko","2222"));


require "views/layouts/Header.php";
require "views/layouts/Footer.php";
require "views/layouts/Navbar.php";
require "app/Models/Connector.php";
require "config/database.php";
require "app/Models/Model.php";
require "app/Models/User.php";
require "app/Models/SessionKey.php";
require "app/Models/UserType.php";
require "app/Controllers/Access.php";
require "app/Controllers/AdminPage.php";


headerline();
Models\connector::getInstance();
session_start();


if (isset($_SESSION['key'])) {
    $access = new App\Controllers\Access();
    if ($access->accessUser($_SERVER['REQUEST_URI'], $_SESSION['acount']->getUsersType())) {
        print $_SESSION['key'];
        menilogin();

        if (isset($_GET['opcija'])) {
            $fajl = $_GET['opcija'] . ".php";
            if (empty($_POST)) {
                $fajl = 'views/' . $fajl;
            } else {
                $fajl = 'app/Controllers/' . $fajl;
            }
            if (file_exists($fajl)) {
                include_once($fajl);
            } else {
                echo "trazena stranica ne postoji vratite se <a href='Index.php'>POCETNU STRANICU</a>";
            }
        } else {
            echo "POCETNA STRANICA";
        }
    } else {
        echo $_SERVER['REQUEST_URI'];
    }
} else {
    menilogout();
    require "views/Errorpage.php";
    if (isset($_GET['opcija'])) {
        $fajl = $_GET['opcija'] . ".php";
        if (empty($_POST)) {
            $fajl = 'views/' . $fajl;
        } else {
            $fajl = 'app/Controllers/' . $fajl;
        }
        if (file_exists($fajl)) {
            include_once($fajl);
        } else {
            echo "trazena stranica ne postoji vratite se <a href='Index.php'>POCETNU STRANICU</a>";
        }
    } else {
        echo "POCETNA STRANICA";
        include_once('views/Login.php');
        include_once('views/Register.php');
    }
}


footerline();








