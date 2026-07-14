<?php
require "includes/auth_check.php";
require "db_config.php";
$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM certificates WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$record = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
$students = mysqli_query($conn, "SELECT student_id, full_name FROM students");
include "includes/header.php";
?>
    <h2>Edit Certificate</h2>
    <form action="edit_certificate_process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
        <label for="student_id">Student:</label><br>
        <select id="student_id" name="student_id" required>
            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                <option value="<?php echo $row['student_id']; ?>" <?php if ($row['student_id'] == $record['student_id']) echo "selected"; ?>><?php echo $row['full_name']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="certificate_name">Certificate Name:</label><br>
        <input type="text" id="certificate_name" name="certificate_name" value="<?php echo $record['certificate_name']; ?>" required><br><br>
        <label for="issuing_body">Issuing Body:</label><br>
        <input type="text" id="issuing_body" name="issuing_body" value="<?php echo $record['issuing_body']; ?>" required><br><br>
        <label for="date_earned">Date Earned:</label><br>
        <input type="date" id="date_earned" name="date_earned" value="<?php echo $record['date_earned']; ?>" required><br><br>
        <button type="submit">Save Changes</button>
    </form>
<?php include "includes/footer.php"; mysqli_close($conn); ?>