<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 9/3/2018
 * Time: 10:30 AM
 */

class DAOuser
{
    function insertUsers($user)
    {
        require "User.php";
        // require conection();
        global $pdo;
        $insert = ("INSERT INTO `users`(`name`, `lastname`, `username`, `password`)   VALUES (:nam, :las, :use, :pas)");
        $d = $pdo->prepare($insert);
        $d->execute(array(
            ':use' => $user->getUsersname(),
            ':nam' => $user->getName(),
            ':las' => $user->getLastname(),
            ':pas' => $user->getPassword()
        ));
    }

    function deleteUsers($id)
    {
        // require conection();
        global $pdo;
        $delete = ("DELETE FROM `users` WHERE `id_user`=:id");
        $del = $pdo->prepare($delete);
        $del->execute(array(
            ':id' => $id,
        ));

    }

    function selectUsers($name, $username)
    {
        //  require conection();
        global $pdo;
        if ($name !== "" || $username !== "") {
            if ($name !== "") {
                $search = "SELECT id_user, `name`, lastname, username,user_type,access FROM users where CONCAT(`name`, ' ', lastname) like :na";
                $pri = $pdo->prepare($search);
                $pri->execute(array(
                    ':na' => $name . "%"
                ));
                if ($pri->rowCount() == 0) {
                    $search = "SELECT id_user, `name`, lastname, username,user_type,access  FROM users where lastname like :na";
                    $pri = $pdo->prepare($search);
                    $pri->execute(array(
                        ':na' => $name . "%"
                    ));
                }
            } else {
                $search = "SELECT id_user, `name`, lastname, username,user_type,access FROM users where username like :username";
                $pri = $pdo->prepare($search);
                $pri->execute(array(
                    ':username' => $username . "%"
                ));
            }
        } else {
            $search = "SELECT SELECT id_user, `name`, lastname, username,user_type,access FROM users";
            $pri = $pdo->prepare($search);
            $pri->execute(array(
                ':na' => $name,
                ':username' => $username
            ));
        }

        if ($pri->rowCount() > 0) {

            $result = $pri->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        return $result = 0;
    }


    function loginUsers($username, $password)
    {
        global $pdo;
        $_SESSION['acount'] = 0;
        $qlogin = ("SELECT * FROM `clanovi` WHERE korisnicko_ime= :username AND sifra=:password");
        $log = $pdo->prepare($qlogin);
        $log->execute(array(
            ':username' => $username,
            ':password' => md5($password)
        ));
        if ($log->rowCount() == 1) {
            require "User.php";
            $ac = $log->fetchAll(PDO::FETCH_OBJ);
            foreach ($ac as $aco) {
                echo "eeeeeeeee";
                $_SESSION['acount'] = new User($aco->id_clana, $aco->ime, $aco->prezime, $aco->korisnicko_ime, $aco->sifra, $aco->user_type, $aco->access);
                $_SESSION['adm'] = $aco->user_type;
            }

        }
        return $_SESSION['acount'];

    }
}