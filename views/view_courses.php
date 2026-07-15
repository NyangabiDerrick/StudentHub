<?php
require "../includes/auth_check.php";
require "../db_config.php";
$result = mysqli_query($conn, "SELECT * FROM courses");
include "../includes/header.php";
?>
    <h2>All Courses</h2>
    <a href="../add/add_course.php" class="add-link">+ Add New Course</a>
    <table border="1" cellpadding="8">
        <thead>
            <tr><th>ID</th><th>Course Title</th><th>Duration</th><th>Level</th><th>Department</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['course_id']; ?></td>
                    <td><?php echo $row['course_title']; ?></td>
                    <td><?php echo $row['duration']; ?></td>
                    <td><?php echo $row['level']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td>
                        <a href="../edit/edit_course.php?id=<?php echo $row['course_id']; ?>">Edit</a> |
                        <a href="../delete/delete_course.php?id=<?php echo $row['course_id']; ?>" onclick="return confirm('Delete this course?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php include "../includes/footer.php"; mysqli_close($conn); ?>