<?php

namespace App\Controllers;

class Access
{
    public function accessUser($url, $access)
    {
        $accessList = array(
            'Admin' => [
                '/object-users-system/index.php?opcija=Search',
                '/object-users-system/Index.php',
                '/object-users-system/index.php?opcija=Home',
                '/object-users-system/index.php?opcija=logout',
                '/object-users-system/index.php?opcija=AdminPage',
            ],
            'User' => [
                '/object-users-system/Index.php',
                '/object-users-system/index.php?opcija=Home',
                '/object-users-system/index.php?opcija=logout',
            ],
            'Manager' => [
                '/object-users-system/Index.php',
                '/object-users-system/index.php?opcija=Home',
                '/object-users-system/index.php?opcija=logout',

            ],
        );
        foreach ($accessList as $as => $er) {
            if ($as == $access) {
                foreach ($er as $w) {
                    if ($w == $url) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}