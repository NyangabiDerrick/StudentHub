<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$students = mysqli_query($conn, "SELECT student_id, full_name FROM students");
include "../includes/header.php";
?>
    <h2>Add Certificate</h2>
    <form action="add_certificate_process.php" method="POST">
        <label for="student_id">Student:</label><br>
        <select id="student_id" name="student_id" required>
            <option value="">-- Select a student --</option>
            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                <option value="<?php echo $row['student_id']; ?>"><?php echo $row['full_name']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="certificate_name">Certificate Name:</label><br>
        <input type="text" id="certificate_name" name="certificate_name" required><br><br>
        <label for="issuing_body">Issuing Body:</label><br>
        <input type="text" id="issuing_body" name="issuing_body" required><br><br>
        <label for="date_earned">Date Earned:</label><br>
        <input type="date" id="date_earned" name="date_earned" required><br><br>
        <button type="submit">Add Certificate</button>
    </form>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>