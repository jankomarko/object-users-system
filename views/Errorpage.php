<?php
namespace views;
$_SESSION['errors']=array();
class errorpage
{
    function errormessage()
    {
        foreach ($_SESSION['errors'] as $message){
            echo $message;
        }
        $_SESSION['errors']=array();
    }
}