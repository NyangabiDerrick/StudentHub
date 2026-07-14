<?php
require "includes/auth_check.php";
require "db_config.php";
$result = mysqli_query($conn, "SELECT course_id, course_title FROM courses");
include "includes/header.php";
?>
    <h2>Add New Student</h2>
    <form action="add_student_process.php" method="POST">
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" required><br><br>
        <label for="registration_number">Registration Number:</label><br>
        <input type="text" id="registration_number" name="registration_number" required><br><br>
        <label for="course_id">Course:</label><br>
        <select id="course_id" name="course_id" required>
            <option value="">-- Select a course --</option>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['course_id']; ?>"><?php echo $row['course_title']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="date_of_birth">Date of Birth:</label><br>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>
        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender" required>
            <option value="">-- Select --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>
        <label for="year_of_study">Year of Study:</label><br>
        <input type="number" id="year_of_study" name="year_of_study" required><br><br>
        <label for="mode_of_study">Mode of Study:</label><br>
        <select id="mode_of_study" name="mode_of_study" required>
            <option value="">-- Select --</option>
            <option value="Full-time">Full-time</option>
            <option value="Part-time">Part-time</option>
            <option value="Online">Online</option>
        </select><br><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"><br><br>
        <label for="guardian_name">Guardian Name:</label><br>
        <input type="text" id="guardian_name" name="guardian_name"><br><br>
        <label for="guardian_contact">Guardian Contact:</label><br>
        <input type="text" id="guardian_contact" name="guardian_contact"><br><br>
        <label for="enrollment_date">Enrollment Date:</label><br>
        <input type="date" id="enrollment_date" name="enrollment_date" required><br><br>
        <button type="submit">Add Student</button>
    </form>
<?php include "includes/footer.php"; mysqli_close($conn); ?>