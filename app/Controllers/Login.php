<?php

namespace App\Controllers;

if (isset($_SESSION['key'])) {
    header("Location:index.php?opcija=Home");
} else {
    $log = new \App\Controllers\Login();
    $log->loginuser($_POST['username'], $_POST['password']);
    require "views/Login.php";
}

class Login
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
                    $sess = new \Models\SessionKey();
                    $sess->insertSessionKey($user->getId());
                    header("Location:index.php?opcija=Home");
                } else {
                    array_push($_SESSION['errors'], "-Pristup odbijen<br>");
                    print $_SESSION['acount'];
                }
            } else {
                array_push($_SESSION['errors'], "-Pogresni podaci<br>");
            }
        }
        require "views/Errorpage.php";
        //   $err = new \Views\errorpage();
        //   $err->errormessage();
    }
}