<?php
require "includes/auth_check.php";
require "db_config.php";
$student_id = $_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM students WHERE student_id = ?");
mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
$student = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
$courses = mysqli_query($conn, "SELECT course_id, course_title FROM courses");
include "includes/header.php";
?>
    <h2>Edit Student</h2>
    <form action="edit_student_process.php" method="POST">
        <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" value="<?php echo $student['full_name']; ?>" required><br><br>
        <label for="registration_number">Registration Number:</label><br>
        <input type="text" id="registration_number" name="registration_number" value="<?php echo $student['registration_number']; ?>" required><br><br>
        <label for="course_id">Course:</label><br>
        <select id="course_id" name="course_id" required>
            <?php while ($row = mysqli_fetch_assoc($courses)) { ?>
                <option value="<?php echo $row['course_id']; ?>" <?php if ($row['course_id'] == $student['course_id']) echo "selected"; ?>><?php echo $row['course_title']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="date_of_birth">Date of Birth:</label><br>
        <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $student['date_of_birth']; ?>" required><br><br>
        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender" required>
            <?php foreach (["Male", "Female", "Other"] as $option) { ?>
                <option value="<?php echo $option; ?>" <?php if ($student['gender'] == $option) echo "selected"; ?>><?php echo $option; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="year_of_study">Year of Study:</label><br>
        <input type="number" id="year_of_study" name="year_of_study" value="<?php echo $student['year_of_study']; ?>" required><br><br>
        <label for="mode_of_study">Mode of Study:</label><br>
        <select id="mode_of_study" name="mode_of_study" required>
            <?php foreach (["Full-time", "Part-time", "Online"] as $option) { ?>
                <option value="<?php echo $option; ?>" <?php if ($student['mode_of_study'] == $option) echo "selected"; ?>><?php echo $option; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="<?php echo $student['phone']; ?>"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>"><br><br>
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" value="<?php echo $student['address']; ?>"><br><br>
        <label for="guardian_name">Guardian Name:</label><br>
        <input type="text" id="guardian_name" name="guardian_name" value="<?php echo $student['guardian_name']; ?>"><br><br>
        <label for="guardian_contact">Guardian Contact:</label><br>
        <input type="text" id="guardian_contact" name="guardian_contact" value="<?php echo $student['guardian_contact']; ?>"><br><br>
        <label for="enrollment_date">Enrollment Date:</label><br>
        <input type="date" id="enrollment_date" name="enrollment_date" value="<?php echo $student['enrollment_date']; ?>" required><br><br>
        <button type="submit">Save Changes</button>
    </form>
<?php include "includes/footer.php"; mysqli_close($conn); ?>