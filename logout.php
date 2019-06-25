<?php

// Session starten
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();
// Weiterleitung auf Login
header('Location: login.php');
