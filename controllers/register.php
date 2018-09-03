<?php
register($_POST['name'], $_POST['lastname'], $_POST['username'], $_POST['password'], $_POST['repassword'], $pdo);

function register($name, $lastname, $username, $password, $repassword)
{
    $_SESSION['error'] = "";
    if (!empty($username)) {
        require "models/DAOuser.php";
        $d = selectUsers("", $username);
        if ($d !== 0) {
            $_SESSION['error'].="User postoji u bazu unesite drugi";
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
        require "models/DAOuser.php";
        require "models/User.php";
        $user = new User("", $name, $lastname, $username, md5($password), "", "");
        insertUsers($user);
        echo "Uspesno ste re registrovali!<br>";
    } else {
        require_once('views/errorpage.php');

    }

}
