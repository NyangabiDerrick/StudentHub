<?php
require "includes/auth_check.php";
require "db_config.php";

// $_GET reads data passed through the URL (like ?id=3), unlike $_POST which reads form submissions
$course_id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM courses WHERE course_id = ?");
mysqli_stmt_bind_param($stmt, "i", $course_id);
mysqli_stmt_execute($stmt);

// Redirect back to the courses list after deleting
header("Location: view_courses.php");
exit();
?>