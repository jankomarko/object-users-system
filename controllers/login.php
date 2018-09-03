<?php

require "views/login.php";

class login
{
    function loginuser($username, $password)

    {
        $_SESSION['error'] = "";
        if ($username == "") {
            $_SESSION['error'] .= "Morate popuniti polje username<br>";
        }
        if ($password == "") {
            $_SESSION['error'] .= "Morate popuniti polje pasword<br>";
        }
        if ($_SESSION['error'] == "") {
            $dao= new DAOuser();
            $dao->loginUsers($username, $password);
            if ($_SESSION['acount'] !== 0) {
                if ("Unlock" == $_SESSION['acount']->getAccess()) {
                    $_SESSION['id'] = $_SESSION['acount']->getId();
                    header("Location:index.php");
                } else $_SESSION['error'] .= "Pristup odbijen";
            } else $_SESSION['error'] .= "Pogresni podaci";
        }
        $err= new errorpage();
        $err->errormessage();



    }
}