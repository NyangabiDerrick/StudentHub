<?php
require "includes/auth_check.php";
error_reporting(E_ALL);
ini_set('display errors', 1);
require "db_config.php";

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

$stmt = mysqli_prepare($conn, "INSERT INTO students 
    (full_name, registration_number, course_id, date_of_birth, gender, year_of_study, mode_of_study, phone, email, address, guardian_name, guardian_contact, enrollment_date) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Types in exact order of the columns above:
// s = full_name, s = registration_number, i = course_id, s = date_of_birth,
// s = gender, i = year_of_study, s = mode_of_study, s = phone,
// s = email, s = address, s = guardian_name, s = guardian_contact, s = enrollment_date
mysqli_stmt_bind_param($stmt, "ssissssssssss", 
    $full_name, $registration_number, $course_id, $date_of_birth, 
    $gender, $year_of_study, $mode_of_study, $phone, 
    $email, $address, $guardian_name, $guardian_contact, $enrollment_date
);

if (mysqli_stmt_execute($stmt)) {
    echo "Student added successfully!";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>