<?php
require "includes/auth_check.php";
require "db_config.php";
$unit_id = $_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM units WHERE unit_id = ?");
mysqli_stmt_bind_param($stmt, "i", $unit_id);
mysqli_stmt_execute($stmt);
$unit = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
$courses = mysqli_query($conn, "SELECT course_id, course_title FROM courses");
include "includes/header.php";
?>
    <h2>Edit Unit</h2>
    <form action="edit_unit_process.php" method="POST">
        <input type="hidden" name="unit_id" value="<?php echo $unit['unit_id']; ?>">
        <label for="unit_code">Unit Code:</label><br>
        <input type="text" id="unit_code" name="unit_code" value="<?php echo $unit['unit_code']; ?>" required><br><br>
        <label for="unit_title">Unit Title:</label><br>
        <input type="text" id="unit_title" name="unit_title" value="<?php echo $unit['unit_title']; ?>" required><br><br>
        <label for="course_id">Course:</label><br>
        <select id="course_id" name="course_id" required>
            <?php while ($row = mysqli_fetch_assoc($courses)) { ?>
                <option value="<?php echo $row['course_id']; ?>" <?php if ($row['course_id'] == $unit['course_id']) echo "selected"; ?>><?php echo $row['course_title']; ?></option>
            <?php } ?>
        </select><br><br>
        <button type="submit">Save Changes</button>
    </form>
<?php include "includes/footer.php"; mysqli_close($conn); ?>