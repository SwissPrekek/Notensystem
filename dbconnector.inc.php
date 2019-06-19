<?php
$servername = "localhost";
$username = "User_Noten";
$password = "";
$database = 'notensystem';

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>