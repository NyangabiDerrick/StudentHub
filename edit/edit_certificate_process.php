<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";

$id = $_POST['id'];
$student_id = $_POST['student_id'];
$certificate_name = $_POST['certificate_name'];
$issuing_body = $_POST['issuing_body'];
$date_earned = $_POST['date_earned'];

$stmt = mysqli_prepare($conn, "UPDATE certificates SET 
    student_id = ?, certificate_name = ?, issuing_body = ?, date_earned = ?
    WHERE id = ?");
mysqli_stmt_bind_param($stmt, "isssi", $student_id, $certificate_name, $issuing_body, $date_earned, $id);
mysqli_stmt_execute($stmt);

header("Location: ../views/view_certificates.php");
exit();
?>