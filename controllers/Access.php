<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 9/10/2018
 * Time: 3:48 PM
 */

namespace Controllers;


class Access
{
    function accessUser($url, $access)
    {
        $accessList = array(
            'Admin' => [
                '/object-users-system/index.php?opcija=Search',
                '/url/stranica2',
                '/url/stranica3',
            ],
            'User' => [
                '/url/stranica1',
                '/url/stranica2',
            ]
        );
        foreach ($accessList as $as => $er) {
            echo $as;
            echo "<br>";
            if ($as == $access) {
                foreach ($er as $w) {
                    if ($w == $url) return true;
                }
            }
            echo "<br>";
        }
        return false;
    }
}