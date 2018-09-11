<?php
//session_start();
if(isset($_SESSION['key'])) {
    echo "wellkome<br>";
}else header("Location:index.php");
