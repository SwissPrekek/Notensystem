<?php
$servername = "localhost";
$username = "151";
$password = "151";
$database = 'notensystem';

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
