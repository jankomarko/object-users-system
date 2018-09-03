<?php
require "views/layout/header.php";
require "models/connector.php";
require "views/meni.php";
session_start();

if (isset($_SESSION['id'])) {
    menilogin();
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
    menilogout();
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


require "views/layout/foother.php";







