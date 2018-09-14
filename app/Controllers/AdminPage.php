<?php

namespace App\Controllers;

class AdminPage
{
    public function rrrr()
    {
        $d = new \App\Models\UserType();
       $d= $d->getStatistic();


     //  print_r($d->select());
        return($d);
    }


}