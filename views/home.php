<?php
//session_start();
if (isset($_SESSION['key'])) {
    ?>

    <h1 style="text-align: center"> WELCOME!
    <?php
} else {
    header("Location:index.php");
}
