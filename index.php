<?php
require "views/errorpage.php";
require "views/layouts/header.php";
require "views/layouts/footer.php";
require "views/layouts/meni.php";
//require "views/login.php";
require "models/connector.php";
require "config/Database.php";
require "models/Model.php";
require "models/User.php";



$hed= new header();
$fut= new footer();
$hed->headerline();
$meni = new meni();


connector::getInstance()->conection();
//$con = new connector();
//$con->conection();

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
if(!empty($_SESSION['acount'])){
    print ("<br>".$_SESSION['acount']->getname().", ".$_SESSION['acount']->getUsersType());
}else echo "<br> no login";







