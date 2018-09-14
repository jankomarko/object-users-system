<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 9/3/2018
 * Time: 10:30 AM
 */

namespace App\Models;

abstract class Model
{
    public function insert($user, $table, $filetable)
    {
        $insert = "INSERT INTO " . $table . "(`" . implode("`, `", $filetable) . "`)  VALUES ('" . implode("', '", $user) . "')";
        global $pdo;
        //  $insert = ("INSERT INTO `users`(`name`, `lastname`, `username`, `password`)   VALUES (:nam, :las, :use, :pas)");
        $d = $pdo->prepare($insert);
        $d->execute(array());
    }

    public function delete($id, $tablename)
    {
        global $pdo;
        $delete = ("DELETE FROM :tablename WHERE `id_user`=:id");
        $del = $pdo->prepare($delete);
        $del->execute(array(
            ':tablename' => $tablename,
            ':id' => $id,
        ));
    }

    function select($name, $username)
    {
        global $pdo;
        if ($name !== "" || $username !== "") {
            if ($name !== "") {
                $search = "SELECT users.id, `name`, lastname, username,user_types.user_type,access FROM users, user_types where CONCAT(`name`, ' ', lastname) like :na and user_types.id=users.user_type_id";
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


    public function update($user, $tablename, $filetable)
    {

        $update = "UPDATE " . $tablename . " SET `" . implode("`=?, `", $filetable) . "`=? Where id=? ";
        global $pdo;
        //  $update = ("UPDATE `users` SET `name`=`:name`,`lastname`=:lastname,`username`=:username,`password`=:pasword,`access`=:access,`user_type_id`=:usertype WHERE id=:id");
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
//SELECT users.id, users.name,users.lastname, users.username,user_types.user_type FROM `users`,`user_tokens`, `user_types` WHERE users.id=user_tokens.id_user and user_tokens.token='dttBsWTJZs5b964991ae9aa' and user_types.id=users.user_type_id

