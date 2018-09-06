<?php

require "views/login.php";


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
            $user = new  User("", "", "", "", "", "", "");
            $user->login($username, $password);
            if ($_SESSION['acount'] !== 0) {
                if ("Unlock" == $_SESSION['acount']->getAccess()) {
                    $_SESSION['id'] = $_SESSION['acount']->getId();
                    header("Location:index.php");
                } else{
                    array_push($_SESSION['errors'],"-Pristup odbijen<br>");
                }
            } else {
                array_push($_SESSION['errors'],"-Pogresni podaci<br>");
            }
        }
        $err = new errorpage();
        $err->errormessage();


    }
}