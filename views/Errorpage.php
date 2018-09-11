<?php
namespace Views;
$_SESSION['errors']=array();
class errorpage
{
    function errormessage()
    {
        foreach ($_SESSION['errors'] as $message) {
            echo $message;
        }
       // echo $_SERVER['REQUEST_URI'];
        $_SESSION['errors'] = array();

    }
}