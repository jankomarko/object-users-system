<?php

namespace Controllers;
if(isset($_SESSION['key'])){
    header("Location:index.php?opcija=Home");
} else require "views/Login.php";

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
            $user = new  \Models\User();
            $user = $user->login($username, $password);
            if ($user !== 0) {
                if ("Unlock" == $user->getAccess()) {
                    $user->insertSessionKey($user->getId());
                    header("Location:index.php?opcija=Home");
                } else {
                    array_push($_SESSION['errors'], "-Pristup odbijen<br>");
                    print $_SESSION['acount'];
                }
            } else {
                array_push($_SESSION['errors'], "-Pogresni podaci<br>");
            }
        }
        $err = new \Views\errorpage();
        $err->errormessage();


    }
}