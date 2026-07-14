<?php
session_start();

// If the user is NOT logged in, kick them back to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /StudentHub/login.php");
    exit();
}
?>