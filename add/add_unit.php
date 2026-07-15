<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$result = mysqli_query($conn, "SELECT course_id, course_title FROM courses");
include "../includes/header.php";
?>
    <h2>Add New Unit</h2>
    <form action="add_unit_process.php" method="POST">
        <label for="unit_code">Unit Code:</label><br>
        <input type="text" id="unit_code" name="unit_code" required><br><br>
        <label for="unit_title">Unit Title:</label><br>
        <input type="text" id="unit_title" name="unit_title" required><br><br>
        <label for="course_id">Course:</label><br>
        <select id="course_id" name="course_id" required>
            <option value="">-- Select a course --</option>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['course_id']; ?>"><?php echo $row['course_title']; ?></option>
            <?php } ?>
        </select><br><br>
        <button type="submit">Add Unit</button>
    </form>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>