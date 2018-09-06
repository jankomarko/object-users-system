<?php

require "views/register.php";

class register
{
    function registeruser($name, $lastname, $username, $password, $repassword)
    {
        $_SESSION['error'] = "";

        if (!empty($username)) {
            $user1 = new User("", "", "", "", "", "", "");
            $d = $user1->select("", $username);
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
            $user = new User("", $name, $lastname, $username, md5($password), "", "");
            $user1->insert($user);
            $_POST['name'] = null;
            echo "Uspesno ste se registrovali kao: username: " . $_POST['username'] . "!<br>";
            $_POST['username'] = null;
            $_POST['lastname'] = null;
        } else {
            $err = new errorpage();
            $err->errormessage();
        }
    }

}

