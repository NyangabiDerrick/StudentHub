<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";

$id = $_POST['id'];
$student_id = $_POST['student_id'];
$unit_id = $_POST['unit_id'];
$status = $_POST['status'];
$grade = $_POST['grade'] !== "" ? $_POST['grade'] : NULL;
$year_taken = $_POST['year_taken'];
$semester_taken = $_POST['semester_taken'];

$stmt = mysqli_prepare($conn, "UPDATE student_units SET 
    student_id = ?, unit_id = ?, status = ?, grade = ?, year_taken = ?, semester_taken = ?
    WHERE id = ?");
mysqli_stmt_bind_param($stmt, "iissssi", $student_id, $unit_id, $status, $grade, $year_taken, $semester_taken, $id);
mysqli_stmt_execute($stmt);

header("Location: ../views/view_student_units.php");
exit();
?>