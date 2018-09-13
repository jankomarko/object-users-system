<?php

namespace App\Controllers;

$r = new \App\Controllers\Register();
$r->registeruser($_POST['name'], $_POST['lastname'], $_POST['username'], $_POST['password'], $_POST['repassword']);
require "views/Register.php";

class Register
{
    public function registeruser($name, $lastname, $username, $password, $repassword)
    {
        if (!empty($username)) {
            $user = new \Models\User();
            $d = $user->select("", $username);
            if ($d !== 0) {
                array_push($_SESSION['errors'], "-Username postoji, unesite drugi<br>");
            }
        } else {
            array_push($_SESSION['errors'], "-Morate popuniti polje Username<br>");
        }
        if (empty($password)) {
            array_push($_SESSION['errors'], "-Morate popuniti polje Password<br>");
        }
        if (!empty($repassword)) {
            if ($repassword != $password) {
                array_push($_SESSION['errors'], "-Vase lozinke se ne podudaraju<br>");
            }
        } else {
            array_push($_SESSION['errors'], "-Morate popuniti polje Repassword<br>");
        }
        if (empty($name)) {
            array_push($_SESSION['errors'], "-Morate popuniti polje Name<br>");
        }
        if (empty($lastname)) {
            array_push($_SESSION['errors'], "-Morate popuniti polje Lastname<br>");
        }
        if (empty($_SESSION['errors'])) {
            $reg = array($name, $lastname, $username, md5($password));
            /*       $user->setName($name);
                   $user->setLastname($lastname);
                   $user->setUsersname($username);
                   $user->setPassword(md5($password));*/
            $user->insert($reg, $user->getTable(), $user->getFiletable());
            $_POST['username'] = null;
            $_POST['lastname'] = null;
            $_POST['name'] = null;
            echo "Uspesno ste se registrovali kao: username: " . $_POST['username'] . "!<br>";

        } else {
            require "views/Errorpage.php";
            // $err = new \Views\errorpage();
            // $err->errormessage();
        }
    }

}

