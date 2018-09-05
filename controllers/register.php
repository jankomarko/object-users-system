<?php

require "views/register.php";

class register
{
    function registeruser($name, $lastname, $username, $password, $repassword)
    {
        $_SESSION['error'] = "";
        $dao = new DAOuser();
        if (!empty($username)) {
            $d = $dao->selectUsers("", $username);
            if ($d !== 0) {
                $_SESSION['error'] .= "-User postoji, unesite drugi<br>";
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
            $_POST['name']=null;
            echo "Uspesno ste se registrovali kao: username: ".$_POST['username']."!<br>";
            $_POST['username']=null;
            $_POST['lastname']=null;
        } else {
            $err= new errorpage();
            $err->errormessage();
        }
    }

}

