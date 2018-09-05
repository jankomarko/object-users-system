<?php

class errorpage
{
    function errormessage()
    {
        echo $_SESSION['error'];
        $_SESSION['error'] = "";
        define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
        define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
        echo ROOT;
        echo "<br>".APP;
    }
}