<?php
/**
 * Created by PhpStorm.
 * User: benj
 * Date: 13.06.19
 * Time: 10:29
 */

// Session starten
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();

header('Location: login.php');


?>