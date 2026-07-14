<?php
require "includes/auth_check.php";
require "db_config.php";
$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "DELETE FROM student_status_history WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
header("Location: view_status_history.php");
exit();
?>