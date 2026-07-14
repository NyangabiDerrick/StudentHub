<?php
require "includes/auth_check.php";
require "db_config.php";

$student_id = $_POST['student_id'];
$unit_id = $_POST['unit_id'];
$status = $_POST['status'];
// Grade might be empty - if so, store NULL instead of an empty string
$grade = $_POST['grade'] !== "" ? $_POST['grade'] : NULL;
$year_taken = $_POST['year_taken'];
$semester_taken = $_POST['semester_taken'];

$stmt = mysqli_prepare($conn, "INSERT INTO student_units 
    (student_id, unit_id, status, grade, year_taken, semester_taken) 
    VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "iissss", $student_id, $unit_id, $status, $grade, $year_taken, $semester_taken);

if (mysqli_stmt_execute($stmt)) {
    echo "Student unit record added successfully!";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>