<?php
//This file is a reference/ learning script demonstrating how to insert data into MySQL using PHP prepared statements.
//It is not part of the actual application - kept here for reference while learning.

require "db_config.php";

$course_title = "Bachelor of Computer Science";
$duration = 4;
$level = "Degree";
$department = "School of Computing";

$stmt = mysqli_prepare($conn, "INSERT INTO courses (course_title, duration, level, department) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "siss", $course_title, $duration, $level, $department);
mysqli_stmt_execute($stmt);

echo "New Course Added Successfully!";

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>