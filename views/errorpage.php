<?php

class errorpage
{
    function errormessage()
    {
        echo $_SESSION['error'];
        $_SESSION['error'] = "";
    }
}