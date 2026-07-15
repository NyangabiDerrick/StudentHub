<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
include "../includes/header.php";
?>
    <h2>Add New Course</h2>
    <form action="add_course_process.php" method="POST">
        <label for="course_title">Course Title:</label><br>
        <input type="text" id="course_title" name="course_title" required><br><br>
        <label for="duration">Duration (years):</label><br>
        <input type="number" id="duration" name="duration" required><br><br>
        <label for="level">Level:</label><br>
        <input type="text" id="level" name="level" required><br><br>
        <label for="department">Department:</label><br>
        <input type="text" id="department" name="department" required><br><br>
        <button type="submit">Add Course</button>
    </form>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>