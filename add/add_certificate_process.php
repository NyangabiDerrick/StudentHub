<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";

$student_id = $_POST['student_id'];
$certificate_name = $_POST['certificate_name'];
$issuing_body = $_POST['issuing_body'];
$date_earned = $_POST['date_earned'];

$stmt = mysqli_prepare($conn, "INSERT INTO certificates 
    (student_id, certificate_name, issuing_body, date_earned) 
    VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "isss", $student_id, $certificate_name, $issuing_body, $date_earned);

if (mysqli_stmt_execute($stmt)) {
    echo "Certificate added successfully!";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>