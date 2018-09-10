<?php
require "views/Errorpage.php";
require "views/layouts/Header.php";
require "views/layouts/Footer.php";
require "views/layouts/Navbar.php";
require "models/Connector.php";
require "config/Database.php";
require "models/Model.php";
require "models/User.php";

//$_SESSION['errors']=array();

$hed= new views\layouts\header();
$fut= new views\layouts\footer();
$meni = new views\layouts\navbar();
$hed->headerline();


models\connector::getInstance()->conection();
session_start();

if (isset($_SESSION['key'])) {
    print $_SESSION['key'];
    $meni->menilogin();
    if (isset($_GET['opcija'])) {
        $fajl = $_GET['opcija'] . ".php";
        if (empty($_POST)) {
            $fajl = 'views/' . $fajl;
        } else {
            $fajl = 'controllers/' . $fajl;
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
    $meni->menilogout();
    if (isset($_GET['opcija'])) {
        $fajl = $_GET['opcija'] . ".php";
        if (empty($_POST)) {
            $fajl = 'views/' . $fajl;
        } else {
            $fajl = 'controllers/' . $fajl;
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


$fut->footerline();








