<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";

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

// Step 1: Insert the student record as before
$stmt = mysqli_prepare($conn, "INSERT INTO students 
    (full_name, registration_number, course_id, date_of_birth, gender, year_of_study, mode_of_study, phone, email, address, guardian_name, guardian_contact, enrollment_date) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssissssssssss", 
    $full_name, $registration_number, $course_id, $date_of_birth, 
    $gender, $year_of_study, $mode_of_study, $phone, 
    $email, $address, $guardian_name, $guardian_contact, $enrollment_date
);
mysqli_stmt_execute($stmt);

// Step 2: Get the student_id that was just auto-generated for this new student
$new_student_id = mysqli_insert_id($conn);

// Step 3: Build the username and password
$username = strtolower($registration_number);

$name_parts = explode(" ", $full_name);
$first_name = $name_parts[0];
$password = strtolower($first_name);

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Step 4: Create the matching login account
$stmt2 = mysqli_prepare($conn, "INSERT INTO users (username, password, role, student_id) VALUES (?, ?, 'student', ?)");
mysqli_stmt_bind_param($stmt2, "ssi", $username, $hashed_password, $new_student_id);
mysqli_stmt_execute($stmt2);

mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt2);
mysqli_close($conn);

header("Location: ../views/view_students.php");
exit();
?>