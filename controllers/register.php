<?php

require "views/register.php";

class register
{
    function registeruser($name, $lastname, $username, $password, $repassword)
    {
        require "models/User.php";
        require "models/DAOuser.php";
        $_SESSION['error'] = "";
        $dao = new DAOuser();
        if (!empty($username)) {

            $d = $dao->selectUsers("", $username);
            if ($d !== 0) {
                $_SESSION['error'] .= "User postoji u bazu unesite drugi";
            }
        } else $_SESSION['error'] .= "- Morate popuniti polje Username<br>";

        if (empty($password)) {
            $_SESSION['error'] .= "- Morate popuniti polje Password<br>";
        }
        if (!empty($repassword)) {
            if ($repassword == $password) {
            } else $_SESSION['error'] .= "Vase lozinke se ne podudaraju<br>";
        } else $_SESSION['error'] .= "- Morate popuniti polje Repassword<br>";
        if (empty($name)) {
            $_SESSION['error'] .= "- Morate popuniti polje Name<br>";
        }
        if (empty($lastname)) $_SESSION['error'] .= "- Morate popuniti polje Lastname<br>";
        if ($_SESSION['error'] == "") {

            $user = new User("", $name, $lastname, $username, md5($password), "", "");
            $dao->insertUsers($user);
            echo "Uspesno ste re registrovali!<br>";
        } else {
            require('views/errorpage.php');
        }
    }

}

