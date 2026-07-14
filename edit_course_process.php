<?php
require "includes/auth_check.php";
require "db_config.php";

$course_id = $_POST['course_id'];
$course_title = $_POST['course_title'];
$duration = $_POST['duration'];
$level = $_POST['level'];
$department = $_POST['department'];

$stmt = mysqli_prepare($conn, "UPDATE courses SET course_title = ?, duration = ?, level = ?, department = ? WHERE course_id = ?");
mysqli_stmt_bind_param($stmt, "sissi", $course_title, $duration, $level, $department, $course_id);
mysqli_stmt_execute($stmt);

header("Location: view_courses.php");
exit();
?>