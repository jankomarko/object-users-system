<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 9/3/2018
 * Time: 3:42 PM
 */

class errorpage
{
    function errormessage()
    {
        echo $_SESSION['error'];
        $_SESSION['error'] = "";
    }
}