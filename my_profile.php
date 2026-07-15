<?php
$allowed_roles = ['student'];
require "includes/auth_check.php";
require "db_config.php";

// Get this student's own ID from the session - never trust a URL parameter for this
$student_id = $_SESSION['student_id'];

// Fetch their personal + course info
$stmt = mysqli_prepare($conn, "
    SELECT students.*, courses.course_title 
    FROM students 
    JOIN courses ON students.course_id = courses.course_id 
    WHERE students.student_id = ?
");
mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
$student = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

// Fetch their unit records
$stmt2 = mysqli_prepare($conn, "
    SELECT units.unit_code, units.unit_title, student_units.status, student_units.grade, 
           student_units.year_taken, student_units.semester_taken
    FROM student_units
    JOIN units ON student_units.unit_id = units.unit_id
    WHERE student_units.student_id = ?
");
mysqli_stmt_bind_param($stmt2, "i", $student_id);
mysqli_stmt_execute($stmt2);
$units_result = mysqli_stmt_get_result($stmt2);

// Fetch their status history
$stmt3 = mysqli_prepare($conn, "SELECT * FROM student_status_history WHERE student_id = ?");
mysqli_stmt_bind_param($stmt3, "i", $student_id);
mysqli_stmt_execute($stmt3);
$status_result = mysqli_stmt_get_result($stmt3);

// Fetch their certificates
$stmt4 = mysqli_prepare($conn, "SELECT * FROM certificates WHERE student_id = ?");
mysqli_stmt_bind_param($stmt4, "i", $student_id);
mysqli_stmt_execute($stmt4);
$certs_result = mysqli_stmt_get_result($stmt4);

include "includes/header.php";
?>
    <h2>My Profile</h2>

    <h3>Personal Details</h3>
    <table cellpadding="8">
        <tbody>
            <tr><th>Full Name</th><td><?php echo $student['full_name']; ?></td></tr>
            <tr><th>Registration Number</th><td><?php echo $student['registration_number']; ?></td></tr>
            <tr><th>Course</th><td><?php echo $student['course_title']; ?></td></tr>
            <tr><th>Date of Birth</th><td><?php echo $student['date_of_birth']; ?></td></tr>
            <tr><th>Gender</th><td><?php echo $student['gender']; ?></td></tr>
            <tr><th>Year of Study</th><td><?php echo $student['year_of_study']; ?></td></tr>
            <tr><th>Mode of Study</th><td><?php echo $student['mode_of_study']; ?></td></tr>
            <tr><th>Phone</th><td><?php echo $student['phone']; ?></td></tr>
            <tr><th>Email</th><td><?php echo $student['email']; ?></td></tr>
            <tr><th>Address</th><td><?php echo $student['address']; ?></td></tr>
            <tr><th>Guardian Name</th><td><?php echo $student['guardian_name']; ?></td></tr>
            <tr><th>Guardian Contact</th><td><?php echo $student['guardian_contact']; ?></td></tr>
            <tr><th>Enrollment Date</th><td><?php echo $student['enrollment_date']; ?></td></tr>
        </tbody>
    </table>

    <h3>My Units</h3>
    <table cellpadding="8">
        <thead><tr><th>Unit</th><th>Status</th><th>Grade</th><th>Year</th><th>Semester</th></tr></thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($units_result)) { ?>
                <tr>
                    <td><?php echo $row['unit_code'] . " - " . $row['unit_title']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['grade'] ?? "-"; ?></td>
                    <td><?php echo $row['year_taken']; ?></td>
                    <td><?php echo $row['semester_taken']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3>Status History</h3>
    <table cellpadding="8">
        <thead><tr><th>Status</th><th>Reason</th><th>Date</th></tr></thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($status_result)) { ?>
                <tr>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['reason'] ?? "-"; ?></td>
                    <td><?php echo $row['date_changed']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3>Certificates</h3>
    <table cellpadding="8">
        <thead><tr><th>Certificate</th><th>Issuing Body</th><th>Date Earned</th></tr></thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($certs_result)) { ?>
                <tr>
                    <td><?php echo $row['certificate_name']; ?></td>
                    <td><?php echo $row['issuing_body']; ?></td>
                    <td><?php echo $row['date_earned']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php include "includes/footer.php"; mysqli_close($conn); ?>