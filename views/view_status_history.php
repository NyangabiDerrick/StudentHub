<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$result = mysqli_query($conn, "
    SELECT student_status_history.id, students.full_name, student_status_history.status,
           student_status_history.reason, student_status_history.date_changed
    FROM student_status_history JOIN students ON student_status_history.student_id = students.student_id
");
include "../includes/header.php";
?>
    <h2>Student Status History</h2>
    <a href="../add/add_status_history.php" class="add-link">+ Add New Record</a>
    <table border="1" cellpadding="8">
        <thead><tr><th>ID</th><th>Student</th><th>Status</th><th>Reason</th><th>Date Changed</th><th>Actions</th></tr></thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['reason'] ?? "-"; ?></td>
                    <td><?php echo $row['date_changed']; ?></td>
                    <td>
                        <a href="../edit/edit_status_history.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="../delete/delete_status_history.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>