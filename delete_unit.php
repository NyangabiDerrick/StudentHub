<?php
require "includes/auth_check.php";
require "db_config.php";
$unit_id = $_GET['id'];
$stmt = mysqli_prepare($conn, "DELETE FROM units WHERE unit_id = ?");
mysqli_stmt_bind_param($stmt, "i", $unit_id);
mysqli_stmt_execute($stmt);
header("Location: view_units.php");
exit();
?>