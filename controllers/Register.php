<?php
namespace Controllers;
require "views/Register.php";

class register
{
    function registeruser($name, $lastname, $username, $password, $repassword)
    {
        if (!empty($username)) {
            $user = new \Models\User();
            $d = $user->select("", $username);
            if ($d !== 0) {
                array_push($_SESSION['errors'], "-Username postoji, unesite drugi<br>");
            }
        } else array_push($_SESSION['errors'], "-Morate popuniti polje Username<br>");
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
            $user->setName($name);
            $user->setLastname($lastname);
            $user->setUsersname($username);
            $user->setPassword(md5($password));
            $user->insert($user);
            $_POST['username'] = null;
            $_POST['lastname'] = null;
            $_POST['name'] = null;
            echo "Uspesno ste se registrovali kao: username: " . $_POST['username'] . "!<br>";

        } else {
            $err = new \Views\errorpage();
            $err->errormessage();
        }
    }

}

