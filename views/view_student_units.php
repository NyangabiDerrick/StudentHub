<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$result = mysqli_query($conn, "
    SELECT student_units.id, students.full_name, units.unit_code, units.unit_title,
           student_units.status, student_units.grade, student_units.year_taken, student_units.semester_taken
    FROM student_units
    JOIN students ON student_units.student_id = students.student_id
    JOIN units ON student_units.unit_id = units.unit_id
");
include "../includes/header.php";
?>
    <h2>Student Unit Records</h2>
    <a href="../add/add_student_unit.php" class="add-link">+ Add New Record</a>
    <table border="1" cellpadding="8">
        <thead><tr><th>ID</th><th>Student</th><th>Unit</th><th>Status</th><th>Grade</th><th>Year</th><th>Semester</th><th>Actions</th></tr></thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['unit_code'] . " - " . $row['unit_title']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['grade'] ?? "-"; ?></td>
                    <td><?php echo $row['year_taken']; ?></td>
                    <td><?php echo $row['semester_taken']; ?></td>
                    <td>
                        <a href="../edit/edit_student_unit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="../delete/delete_student_unit.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>