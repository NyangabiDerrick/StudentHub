<?php
session_start();

// $allowed_roles should be set by the page BEFORE including this file
// Example: $allowed_roles = ['admin', 'registrar'];

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /StudentHub/login.php");
    exit();
}

// If the page specified which roles are allowed, enforce it
if (isset($allowed_roles) && !in_array($_SESSION['role'], $allowed_roles)) {
    // Logged in, but wrong role - block access
    die("Access denied. You do not have permission to view this page.");
}
?>