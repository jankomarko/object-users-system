<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 9/3/2018
 * Time: 10:30 AM
 */
namespace models;
abstract class Model
{

    function insert($user)
    {
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

    function delete($id)
    {
        global $pdo;
        $delete = ("DELETE FROM `users` WHERE `id_user`=:id");
        $del = $pdo->prepare($delete);
        $del->execute(array(
            ':id' => $id,
        ));
    }

    function select($name, $username)
    {
        global $pdo;
        if ($name !== "" || $username !== "") {
            if ($name !== "") {
                $search = "SELECT id, `name`, lastname, username,user_type_id,access FROM users where CONCAT(`name`, ' ', lastname) like :na";
                $pri = $pdo->prepare($search);
                $pri->execute(array(
                    ':na' => $name . "%"
                ));
                if ($pri->rowCount() == 0) {
                    $search = "SELECT id, `name`, lastname, username,user_type_id,access  FROM users where lastname like :na";
                    $pri = $pdo->prepare($search);
                    $pri->execute(array(
                        ':na' => $name . "%"
                    ));
                }
            } else {
                $search = "SELECT id, `name`, lastname, username,user_type_id,access FROM users where username like :username";
                $pri = $pdo->prepare($search);
                $pri->execute(array(
                    ':username' => $username . "%"
                ));
            }
        } else {
            $search = "SELECT SELECT id, `name`, lastname, username,user_type_id,access FROM users";
            $pri = $pdo->prepare($search);
            $pri->execute(array(
                ':na' => $name,
                ':username' => $username
            ));
        }
        if ($pri->rowCount() > 0) {

            $result = $pri->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        }
        return $result = 0;
    }

    function login($username, $password)
    {
        global $pdo;
        $_SESSION['acount'] = 0;
        $qlogin = ("SELECT users.id, users.name,users.lastname , users.username,users.password, users.access, user_types.user_type FROM `users` INNER JOIN `user_types` ON users.user_type_id=user_types.id WHERE users.username=:username AND users.password=:password");
        $log = $pdo->prepare($qlogin);
        $log->execute(array(
            ':username' => $username,
            ':password' => md5($password)
        ));
        if ($log->rowCount() == 1) {

            $ac = $log->fetchAll(\PDO::FETCH_OBJ);
            foreach ($ac as $aco) {
                $_SESSION['acount'] = new User();
                $_SESSION['acount']->setId($aco->id);
                $_SESSION['acount']->setName($aco->name);
                $_SESSION['acount']->setLastname($aco->lastname);
                $_SESSION['acount']->setUsersname($aco->username);
                $_SESSION['acount']->setUsersType($aco->user_type);
                $_SESSION['acount']->setAccess($aco->access);
            }
        }
        return $_SESSION['acount'];
    }

    function update($user)
    {
        global $pdo;
        $update = ("UPDATE `users` SET `name`=`:name`,`lastname`=:lastname,`username`=:username,`password`=:pasword,`access`=:access,`user_type_id`=:usertype WHERE id=:id");
        $up = $pdo->prepare($update);
        $up->excute(array(
            ':name' => $user->getName(),
            ':lastname' => $user->getlastname(),
            ':usename' => $user->getusername(),
            ':password' => $user->getpassword(),
            ':access' => $user->getaccess(),
            ':usertvpe' => $user->getUserType()

        ));


    }
}