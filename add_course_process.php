<?php
require "includes/auth_check.php";
require "db_config.php";

$course_title = $_POST['course_title'];
$duration = $_POST['duration'];
$level = $_POST['level'];
$department = $_POST['department'];

$stmt = mysqli_prepare($conn, "INSERT INTO courses (course_title, duration, level, department) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "siss", $course_title, $duration, $level, $department);
mysqli_stmt_execute($stmt);

echo "Course Added Successfully!";

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
