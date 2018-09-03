<?php
login($_POST['username'], $_POST['password']);

function login($username, $password)

{
    $_SESSION['error'] = "";
    if ($username == "") {
        $_SESSION['error'] .= "Morate popuniti polje username<br>";
    }
    if ($password == "") {
        $_SESSION['error'] .= "Morate popuniti polje pasword<br>";
    }
    if ($_SESSION['error'] == "") {
        require "models/DAOuser.php";
        loginUsers($username, $password);
        if ($_SESSION['acount'] !== 0) {
            //  require "models/User.php";
            if ("unlock" == $_SESSION['acount']->getAccess()) {
                $_SESSION['id'] = $_SESSION['acount']->getId();
               header("Location:index.php");
            } else $_SESSION['error'] .= "Pristup odbijen";
        } else $_SESSION['error'] .= "Pogresni podaci";


    }
    include_once "views/errorpage.php";


}