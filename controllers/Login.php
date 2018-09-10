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
            $user=$user->login($username, $password);
            if ($user !== 0) {
                if ("Unlock" == $user->getAccess()) {
                    $user->insertSessionKey($user->getId());
                 //   $_SESSION['id'] = $user->getId();
                    header("Location:index.php?opcija=Home");
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