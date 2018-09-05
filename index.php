<?php
require "views/errorpage.php";
require "views/layout/header.php";
require "views/layout/foother.php";
require "views/meni.php";
//require "views/login.php";
require "models/connector.php";
require "config/database.php";
require "models/DAOuser.php";
require "models/User.php";



$hed= new header();
$fut= new foother();
$hed->headerline();
$meni = new meni();
$con = new connector();
$con->conection();

session_start();

if (isset($_SESSION['id'])) {
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
            echo "trazena stranica ne postoji vratite se <a href='index.php'>POCETNU STRANICU</a>";
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
            echo "trazena stranica ne postoji vratite se <a href='index.php'>POCETNU STRANICU</a>";
        }
    } else {
        echo "POCETNA STRANICA";
        include_once('views/login.php');
        include_once('views/register.php');
    }
}


$fut->footherline();








