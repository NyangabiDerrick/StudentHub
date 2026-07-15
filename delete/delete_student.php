<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";

$student_id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM students WHERE student_id = ?");
mysqli_stmt_bind_param($stmt, "i", $student_id);

// Try the delete, but catch the error instead of crashing
try {
    mysqli_stmt_execute($stmt);
    header("Location: ../views/view_students.php");
    exit();
} catch (mysqli_sql_exception $e) {
    die("Cannot delete this student — they still have linked records (units, status history, or certificates). Please remove those first.");
}
?>