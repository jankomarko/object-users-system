<?php

namespace Models;

class UserType
{
    private $id;
    private $usertype;
    private $amount;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsertype()
    {
        return $this->usertype;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $usertype
     */
    public function setUsertype($usertype)
    {
        $this->usertype = $usertype;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function select()
    {
        global $pdo;
        $qselect = ("SELECT user_types.id, user_types.user_type,(SELECT COUNT(users.id)FROM users WHERE users.user_type_id=user_types.id)\"amount\" FROM `user_types`");
        $usertype = $pdo->prepare($qselect);
     //   $usertype->execute;

        $usertype->execute(array(
        ));

        $result = $usertype->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }


//SELECT user_types.id, user_types.user_type,COUNT(SELECT users.user_type_id from `users`,`user_types` WHERE users.user_type_id=user_types.id)"amount" FROM `user_types`
// SELECT COUNT(users.id)FROM users WHERE users.user_type_id=1


}