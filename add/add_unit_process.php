<?php
// Connect to the database
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";

// Grab the submitted form values (names must match the "name" attributes in the form)
$unit_code = $_POST['unit_code'];
$unit_title = $_POST['unit_title'];
$course_id = $_POST['course_id'];

// Prepared statement: keeps user input safe from SQL injection
$stmt = mysqli_prepare($conn, "INSERT INTO units (unit_code, unit_title, course_id) VALUES (?, ?, ?)");
// "s" = string (unit_code), "s" = string (unit_title), "i" = integer (course_id)
mysqli_stmt_bind_param($stmt, "ssi", $unit_code, $unit_title, $course_id);
mysqli_stmt_execute($stmt);

echo "Unit added successfully!";

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>