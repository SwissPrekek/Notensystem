<?php

$host = 'localhost'; // host

$username = '151'; // username

$password = ''; // password

$database = 'users'; // database


// mit Datenbank verbinden

$mysqli = new mysqli($host, $username, $password, $database);

// fehlermeldung, falls verbindung fehl schlägt.

if ($mysqli->connect_error) {

    die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);

}
?>