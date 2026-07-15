<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$result = mysqli_query($conn, "
    SELECT certificates.id, students.full_name, certificates.certificate_name,
           certificates.issuing_body, certificates.date_earned
    FROM certificates JOIN students ON certificates.student_id = students.student_id
");
include "../includes/header.php";
?>
    <h2>Certificates</h2>
    <a href="../add/add_certificate.php" class="add-link">+ Add New Certificate</a>
    <table border="1" cellpadding="8">
        <thead><tr><th>ID</th><th>Student</th><th>Certificate</th><th>Issuing Body</th><th>Date Earned</th><th>Actions</th></tr></thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['certificate_name']; ?></td>
                    <td><?php echo $row['issuing_body']; ?></td>
                    <td><?php echo $row['date_earned']; ?></td>
                    <td>
                        <a href="../edit/edit_certificate.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="../delete/delete_certificate.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this certificate?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>