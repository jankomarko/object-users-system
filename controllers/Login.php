<?php

namespace controllers;
require "views/Login.php";

class login
{
    public function loginuser($username, $password)
    {
        if ($username == "") {
            array_push($_SESSION['errors'], "-Morate popuniti polje username<br>");
        }
        if ($password == "") {
            array_push($_SESSION['errors'], "-Morate popuniti polje password<br>");
        }
        if (empty($_SESSION['errors'])) {
            $user = new  \models\User();
            $user->login($username, $password);
            if ($_SESSION['acount'] !== 0) {
                if ("Unlock" == $_SESSION['acount']->getAccess()) {
                    $_SESSION['id'] = $_SESSION['acount']->getId();
                    header("Location:Index.php");
                } else {
                    array_push($_SESSION['errors'], "-Pristup odbijen<br>");
                    print $_SESSION['acount'];
                }
            } else {
                array_push($_SESSION['errors'], "-Pogresni podaci<br>");
            }
        }
        $err = new \views\errorpage();
        $err->errormessage();


    }
}