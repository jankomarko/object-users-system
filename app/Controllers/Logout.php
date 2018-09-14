<?php

namespace App\Controllers;

$dess = new  \App\Controllers\Logout();
$dess->destroysession();

class Logout
{
    public function destroysession()
    {
        session_destroy();
        $sess = new \App\Models\SessionKey();
        $sess->deleteSessionKey($_SESSION['key']);
        header("Location:Index.php");
    }
}