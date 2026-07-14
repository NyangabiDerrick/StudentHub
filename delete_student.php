<?php
require "includes/auth_check.php";
require "db_config.php";
$student_id = $_GET['id'];
$stmt = mysqli_prepare($conn, "DELETE FROM students WHERE student_id = ?");
mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
header("Location: view_students.php");
exit();
?>