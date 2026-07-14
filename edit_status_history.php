<?php
require "includes/auth_check.php";
require "db_config.php";
$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM student_status_history WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$record = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
$students = mysqli_query($conn, "SELECT student_id, full_name FROM students");
include "includes/header.php";
?>
    <h2>Edit Status Record</h2>
    <form action="edit_status_history_process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
        <label for="student_id">Student:</label><br>
        <select id="student_id" name="student_id" required>
            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                <option value="<?php echo $row['student_id']; ?>" <?php if ($row['student_id'] == $record['student_id']) echo "selected"; ?>><?php echo $row['full_name']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <?php foreach (["active", "suspended", "graduated", "deferred"] as $option) { ?>
                <option value="<?php echo $option; ?>" <?php if ($record['status'] == $option) echo "selected"; ?>><?php echo ucfirst($option); ?></option>
            <?php } ?>
        </select><br><br>
        <label for="reason">Reason:</label><br>
        <input type="text" id="reason" name="reason" value="<?php echo $record['reason']; ?>"><br><br>
        <label for="date_changed">Date Changed:</label><br>
        <input type="date" id="date_changed" name="date_changed" value="<?php echo $record['date_changed']; ?>" required><br><br>
        <button type="submit">Save Changes</button>
    </form>
<?php include "includes/footer.php"; mysqli_close($conn); ?>