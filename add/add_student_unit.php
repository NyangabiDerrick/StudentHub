<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$students = mysqli_query($conn, "SELECT student_id, full_name FROM students");
$units = mysqli_query($conn, "SELECT unit_id, unit_code, unit_title FROM units");
include "../includes/header.php";
?>
    <h2>Assign Unit to Student</h2>
    <form action="add_student_unit_process.php" method="POST">
        <label for="student_id">Student:</label><br>
        <select id="student_id" name="student_id" required>
            <option value="">-- Select a student --</option>
            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                <option value="<?php echo $row['student_id']; ?>"><?php echo $row['full_name']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="unit_id">Unit:</label><br>
        <select id="unit_id" name="unit_id" required>
            <option value="">-- Select a unit --</option>
            <?php while ($row = mysqli_fetch_assoc($units)) { ?>
                <option value="<?php echo $row['unit_id']; ?>"><?php echo $row['unit_code'] . " - " . $row['unit_title']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <option value="taken">Taken</option>
            <option value="currently taking">Currently Taking</option>
            <option value="future">Future</option>
        </select><br><br>
        <label for="grade">Grade (leave blank if not taken yet):</label><br>
        <input type="text" id="grade" name="grade"><br><br>
        <label for="year_taken">Year Taken:</label><br>
        <input type="text" id="year_taken" name="year_taken" required><br><br>
        <label for="semester_taken">Semester Taken:</label><br>
        <input type="text" id="semester_taken" name="semester_taken" required><br><br>
        <button type="submit">Add Record</button>
    </form>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>