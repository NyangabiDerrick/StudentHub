<?php
session_start();
session_destroy(); // wipes the entire session, logging the user out
header("Location: login.php");
exit();
?>