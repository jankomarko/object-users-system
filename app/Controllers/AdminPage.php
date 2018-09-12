<?php

namespace App\Controllers;

class AdminPage
{
    public function rrrr()
    {
        $d = new \Models\UserType();
       $d= $d->select();


     //  print_r($d->select());
        return($d);
    }


}