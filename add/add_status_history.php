<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$students = mysqli_query($conn, "SELECT student_id, full_name FROM students");
include "../includes/header.php";
?>
    <h2>Add Student Status Record</h2>
    <form action="add_status_history_process.php" method="POST">
        <label for="student_id">Student:</label><br>
        <select id="student_id" name="student_id" required>
            <option value="">-- Select a student --</option>
            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                <option value="<?php echo $row['student_id']; ?>"><?php echo $row['full_name']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <option value="active">Active</option>
            <option value="suspended">Suspended</option>
            <option value="graduated">Graduated</option>
            <option value="deferred">Deferred</option>
        </select><br><br>
        <label for="reason">Reason (if applicable):</label><br>
        <input type="text" id="reason" name="reason"><br><br>
        <label for="date_changed">Date Changed:</label><br>
        <input type="date" id="date_changed" name="date_changed" required><br><br>
        <button type="submit">Add Status Record</button>
    </form>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>