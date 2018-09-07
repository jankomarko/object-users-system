<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 8/30/2018
 * Time: 4:21 PM
 */
namespace models;
class User extends Model
{
    private $id;
    private $name;
    private $lastname;
    private $usersname;
    private $password;
    private $usersType;
    private $access;


    public function User($id, $name, $lastname, $usersname, $password, $usersType, $access)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->usersname = $usersname;
        $this->password = $password;
        $this->usersType = $usersType;
        $this->access = $access;

    }
    public  function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getUsersname()
    {
        return $this->usersname;
    }

    public function setUsersname($usersname)
    {
        $this->usersname = $usersname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getUsersType()
    {
        return $this->usersType;
    }

    public function setUsersType($usersType)
    {
        $this->usersType = $usersType;
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function setAccess($access)
    {
        $this->access = $access;
    }

    public function __toString()
    {

        return "name: " . $this->name . " " . $this->lastname . ", username: " . $this->usersname . ", usertype: " . $this->usersType . ", access: " . $this->access;
    }
}
