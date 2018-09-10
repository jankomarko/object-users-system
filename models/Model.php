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
        $user = 0;
        $qlogin = ("SELECT users.id, users.name,users.lastname , users.username,users.password, users.access, user_types.user_type FROM `users` INNER JOIN `user_types` ON users.user_type_id=user_types.id WHERE users.username=:username AND users.password=:password");
        $log = $pdo->prepare($qlogin);
        $log->execute(array(
            ':username' => $username,
            ':password' => md5($password)
        ));
        if ($log->rowCount() == 1) {
            $ac = $log->fetchAll(\PDO::FETCH_OBJ);
            foreach ($ac as $aco) {
                $user = new User();
                $user->setId($aco->id);
                $user->setName($aco->name);
                $user->setLastname($aco->lastname);
                $user->setUsersname($aco->username);
                $user->setUsersType($aco->user_type);
                $user->setAccess($aco->access);
            }
        }
        return $user;
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

    function insertSessionKey($userId)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $token = '';
        for ($i = 0; $i < 10; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }

        $today = date("d/m/Y");
        settype($today, 'string');
        $token .= $today;
        global $pdo;
        $insert = ("INSERT INTO `user_tokens`(`token`, `id_user`)   VALUES (:token, :id_user)");
        $d = $pdo->prepare($insert);
        $d->execute(array(
            ':token' => $token,
            'id_user' => $userId
        ));
        $_SESSION['key'] = $token;
    }

    function deleteSessionKey($token)
    {
        global $pdo;
        $delete = ("DELETE FROM `user_tokens` WHERE `token`=:token");
        $del = $pdo->prepare($delete);
        $del->execute(array(
            ':token' => $token
        ));
    }
}

