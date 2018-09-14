<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 8/30/2018
 * Time: 4:21 PM
 */

namespace App\Models;


class User extends Model
{
    private $id;
    private $name;
    private $lastname;
    private $usersname;
    private $password;
    private $usersType;
    private $access;
    protected $table = "users";
    protected $filetable = array('name', 'lastname','username','password');


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

    /**
     * @return array
     */
    public function getFiletable(): array
    {
        return $this->filetable;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }
    public function __construct()
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

        return "name: " . $this->name . " " . $this->lastname . ", username: " . $this->usersname . ", usertype: " .
            $this->usersType . ", access: " . $this->access;
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

}
