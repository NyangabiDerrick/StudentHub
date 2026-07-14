<?php
require "includes/auth_check.php";
require "db_config.php";
$result = mysqli_query($conn, "
    SELECT units.unit_id, units.unit_code, units.unit_title, courses.course_title
    FROM units JOIN courses ON units.course_id = courses.course_id
");
include "includes/header.php";
?>
    <h2>All Units</h2>
    <a href="add_unit.php" class="add-link">+ Add New Unit</a>
    <table border="1" cellpadding="8">
        <thead><tr><th>ID</th><th>Code</th><th>Title</th><th>Course</th><th>Actions</th></tr></thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['unit_id']; ?></td>
                    <td><?php echo $row['unit_code']; ?></td>
                    <td><?php echo $row['unit_title']; ?></td>
                    <td><?php echo $row['course_title']; ?></td>
                    <td>
                        <a href="edit_unit.php?id=<?php echo $row['unit_id']; ?>">Edit</a> |
                        <a href="delete_unit.php?id=<?php echo $row['unit_id']; ?>" onclick="return confirm('Delete this unit?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php include "includes/footer.php"; mysqli_close($conn); ?>