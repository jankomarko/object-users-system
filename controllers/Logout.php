<?php
session_destroy();

$user= new \Models\User();
$user->deleteSessionKey($_SESSION['key']);


header("Location:Index.php");

class logout
{

}