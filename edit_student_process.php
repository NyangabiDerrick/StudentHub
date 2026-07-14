<?php
require "includes/auth_check.php";
require "db_config.php";

$student_id = $_POST['student_id'];
$full_name = $_POST['full_name'];
$registration_number = $_POST['registration_number'];
$course_id = $_POST['course_id'];
$date_of_birth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$year_of_study = $_POST['year_of_study'];
$mode_of_study = $_POST['mode_of_study'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$guardian_name = $_POST['guardian_name'];
$guardian_contact = $_POST['guardian_contact'];
$enrollment_date = $_POST['enrollment_date'];

$stmt = mysqli_prepare($conn, "UPDATE students SET 
    full_name = ?, registration_number = ?, course_id = ?, date_of_birth = ?, 
    gender = ?, year_of_study = ?, mode_of_study = ?, phone = ?, 
    email = ?, address = ?, guardian_name = ?, guardian_contact = ?, enrollment_date = ?
    WHERE student_id = ?");

mysqli_stmt_bind_param($stmt, "ssisssisssssi", 
    $full_name, $registration_number, $course_id, $date_of_birth,
    $gender, $year_of_study, $mode_of_study, $phone,
    $email, $address, $guardian_name, $guardian_contact, $enrollment_date,
    $student_id
);

mysqli_stmt_execute($stmt);

header("Location: view_students.php");
exit();
?>