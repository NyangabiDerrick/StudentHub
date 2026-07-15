<?php
$allowed_roles = ['admin', 'registrar'];
require "../includes/auth_check.php";
require "../db_config.php";
$result = mysqli_query($conn, "
    SELECT students.student_id, students.full_name, students.registration_number,
           courses.course_title, students.date_of_birth, students.gender,
           students.year_of_study, students.mode_of_study, students.phone,
           students.email, students.enrollment_date
    FROM students JOIN courses ON students.course_id = courses.course_id
");
include "../includes/header.php";
?>
    <h2>All Students</h2>
    <a href="../add/add_student.php" class="add-link">+ Add New Student</a>
    <table border="1" cellpadding="8">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Reg No</th><th>Course</th><th>DOB</th><th>Gender</th><th>Year</th><th>Mode</th><th>Phone</th><th>Email</th><th>Enrolled</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['student_id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['registration_number']; ?></td>
                    <td><?php echo $row['course_title']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['year_of_study']; ?></td>
                    <td><?php echo $row['mode_of_study']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['enrollment_date']; ?></td>
                    <td>
                        <a href="../edit/edit_student.php?id=<?php echo $row['student_id']; ?>">Edit</a> |
                        <a href="../delete/delete_student.php?id=<?php echo $row['student_id']; ?>" onclick="return confirm('Delete this student?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>