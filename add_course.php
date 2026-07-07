<!DOCTYPE html>
<html>
    <head>
        <title>Add Courses</title>
    </head>
    <body>
        <h1>Add New Courses</h1>

        <form action="add_course_process.php" method="POST">
            <label for="course_title">Course Title:</label><br>
            <input type="text" id="course_title" name="course_title" required><br>

            <label for="duration">Duration (years):</label><br>
            <input type="number" id="duration" name="duration" required><br>

            <label for="levl">Level:</label><br>
            <input type="text" id="level" name="level" required><br>

            <label for="department">Department:</label><br>
            <input type="text" id="department" name="department" requried><br>

            <button type="submit">Add Courses</button>
        </form>
    </body>
</html>
