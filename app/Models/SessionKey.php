<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 9/11/2018
 * Time: 10:36 AM
 */

namespace App\Models;


class SessionKey extends  Model
{
    function insertSessionKey($userId)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $token = '';
        for ($i = 0; $i < 10; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }
        $token .= uniqid();
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