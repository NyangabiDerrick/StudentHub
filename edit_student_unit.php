<?php
require "includes/auth_check.php";
require "db_config.php";
$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM student_units WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$record = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
$students = mysqli_query($conn, "SELECT student_id, full_name FROM students");
$units = mysqli_query($conn, "SELECT unit_id, unit_code, unit_title FROM units");
include "includes/header.php";
?>
    <h2>Edit Student Unit Record</h2>
    <form action="edit_student_unit_process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
        <label for="student_id">Student:</label><br>
        <select id="student_id" name="student_id" required>
            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                <option value="<?php echo $row['student_id']; ?>" <?php if ($row['student_id'] == $record['student_id']) echo "selected"; ?>><?php echo $row['full_name']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="unit_id">Unit:</label><br>
        <select id="unit_id" name="unit_id" required>
            <?php while ($row = mysqli_fetch_assoc($units)) { ?>
                <option value="<?php echo $row['unit_id']; ?>" <?php if ($row['unit_id'] == $record['unit_id']) echo "selected"; ?>><?php echo $row['unit_code'] . " - " . $row['unit_title']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <?php foreach (["taken", "currently taking", "future"] as $option) { ?>
                <option value="<?php echo $option; ?>" <?php if ($record['status'] == $option) echo "selected"; ?>><?php echo ucfirst($option); ?></option>
            <?php } ?>
        </select><br><br>
        <label for="grade">Grade:</label><br>
        <input type="text" id="grade" name="grade" value="<?php echo $record['grade']; ?>"><br><br>
        <label for="year_taken">Year Taken:</label><br>
        <input type="text" id="year_taken" name="year_taken" value="<?php echo $record['year_taken']; ?>" required><br><br>
        <label for="semester_taken">Semester Taken:</label><br>
        <input type="text" id="semester_taken" name="semester_taken" value="<?php echo $record['semester_taken']; ?>" required><br><br>
        <button type="submit">Save Changes</button>
    </form>
<?php include "includes/footer.php"; mysqli_close($conn); ?>