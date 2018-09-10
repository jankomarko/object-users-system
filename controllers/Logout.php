<?php
session_destroy();

$user= new \models\User();
$user->deleteSessionKey($_SESSION['key']);


header("Location:Index.php");

class logout
{

}