<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";

$unit_id = $_POST['unit_id'];
$unit_code = $_POST['unit_code'];
$unit_title = $_POST['unit_title'];
$course_id = $_POST['course_id'];

$stmt = mysqli_prepare($conn, "UPDATE units SET unit_code = ?, unit_title = ?, course_id = ? WHERE unit_id = ?");
mysqli_stmt_bind_param($stmt, "ssii", $unit_code, $unit_title, $course_id, $unit_id);
mysqli_stmt_execute($stmt);

header("Location: ../views/view_units.php");
exit();
?>