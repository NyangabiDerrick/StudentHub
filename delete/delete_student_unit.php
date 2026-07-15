<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "DELETE FROM student_units WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
header("Location: ../views/view_student_units.php");
exit();
?>