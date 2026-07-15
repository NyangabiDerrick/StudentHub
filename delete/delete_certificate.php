<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "DELETE FROM certificates WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
header("Location: ../views/view_certificates.php");
exit();
?>