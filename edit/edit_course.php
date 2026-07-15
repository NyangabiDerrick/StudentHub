<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$course_id = $_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM courses WHERE course_id = ?");
mysqli_stmt_bind_param($stmt, "i", $course_id);
mysqli_stmt_execute($stmt);
$course = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
include "../includes/header.php";
?>
    <h2>Edit Course</h2>
    <form action="edit_course_process.php" method="POST">
        <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
        <label for="course_title">Course Title:</label><br>
        <input type="text" id="course_title" name="course_title" value="<?php echo $course['course_title']; ?>" required><br><br>
        <label for="duration">Duration (years):</label><br>
        <input type="number" id="duration" name="duration" value="<?php echo $course['duration']; ?>" required><br><br>
        <label for="level">Level:</label><br>
        <input type="text" id="level" name="level" value="<?php echo $course['level']; ?>" required><br><br>
        <label for="department">Department:</label><br>
        <input type="text" id="department" name="department" value="<?php echo $course['department']; ?>" required><br><br>
        <button type="submit">Save Changes</button>
    </form>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>