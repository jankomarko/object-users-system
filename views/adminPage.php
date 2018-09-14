<?php

$usertypes = new App\Controllers\AdminPage();
$arrut = $usertypes->rrrr();
echo "<table class='table table-striped'>";
echo "<tr>";
echo "<th>Id</th>";
echo "<th>User type</th>";
echo "<th>Number</th>";
echo "</tr>";

foreach ($arrut as $usertype) {
    echo "<tr>";
    echo "<td>" . $usertype->id . "</td>";
    echo "<td>" . $usertype->user_type . "</td>";
    echo "<td>" . $usertype->amount . "</td>";
    echo "</tr>";
}
echo "</table>";
