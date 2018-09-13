<?php
if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $message) {
        echo $message;
    }
}
$_SESSION['errors'] = array();
