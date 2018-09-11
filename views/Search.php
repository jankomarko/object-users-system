<?php

if (isset($_SESSION['key'])) {
    $access=new \Controllers\Access();
    if($access->accessUser($_SERVER['REQUEST_URI'],$_SESSION['acount']->getUsersType())) {

        ?>
        <h1 style="text-align: center"> Pretraga clanova
            <h1>
                <form action="index.php?opcija=search" method="post">
                    <h6 align="center"> Ime i prezime:
                        <h5>
                            <h6 align="center"><input type="text" name="name" value=""></h6>
                            <h6 align="center"> korisnicko ime:
                                <h5>
                                    <h6 align="center"><input type="text" name="username" value=""></h6>
                                    <h6 align="center"><input type="submit" name="action" value="Pronadji"></h6>


                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>

                                    </div>


                </form>


        <?php
        if (isset($_POST['action'])) {
            if (!empty($result)) {
                echo "<table class='table table-striped'>";
                echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Ime</th>";
                echo "<th>Prezime</th>";
                echo "<th>Korisnicko ime</th>";
                echo "<th>Users_type</th>";
                echo "</tr>";

                foreach ($result as $acount) {
                    $acount->id_clana;

                    echo "<tr>";
                    echo "<td>" . $acount->id_clana . "</td>";
                    echo "<td>" . $acount->ime . "</td>";
                    echo "<td>" . $acount->prezime . "</td>";
                    echo "<td>" . $acount->korisnicko_ime . "</td>";
                    echo "<td>" . $acount->user_type . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

            } else {
                echo "No records matching your query were found.";
            }
        }

    }else header("Location:index.php");
}