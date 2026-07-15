<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";

$id = $_POST['id'];
$student_id = $_POST['student_id'];
$status = $_POST['status'];
$reason = $_POST['reason'] !== "" ? $_POST['reason'] : NULL;
$date_changed = $_POST['date_changed'];

$stmt = mysqli_prepare($conn, "UPDATE student_status_history SET 
    student_id = ?, status = ?, reason = ?, date_changed = ?
    WHERE id = ?");
mysqli_stmt_bind_param($stmt, "isssi", $student_id, $status, $reason, $date_changed, $id);
mysqli_stmt_execute($stmt);

header("Location: ../views/view_status_history.php");
exit();
?>