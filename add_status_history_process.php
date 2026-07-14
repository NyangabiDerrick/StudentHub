<?php
require "includes/auth_check.php";
require "db_config.php";

$student_id = $_POST['student_id'];
$status = $_POST['status'];
$reason = $_POST['reason'] !== "" ? $_POST['reason'] : NULL;
$date_changed = $_POST['date_changed'];

$stmt = mysqli_prepare($conn, "INSERT INTO student_status_history 
    (student_id, status, reason, date_changed) 
    VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "isss", $student_id, $status, $reason, $date_changed);

if (mysqli_stmt_execute($stmt)) {
    echo "Status record added successfully!";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>