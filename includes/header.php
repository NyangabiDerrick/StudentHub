<!DOCTYPE html>
<html>
<head>
    <title>StudentHub</title>
    <link rel="stylesheet" href="/StudentHub/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

    <header class="main-header">
        <div class="logo">Student<span>Hub</span></div>
        <nav>
    <ul>
        <li><a href="/StudentHub/index.php">Home</a></li>
        <?php if ($_SESSION['role'] == 'student') { ?>
            <li><a href="/StudentHub/views/view_courses.php">Courses</a></li>
            <li><a href="/StudentHub/views/view_units.php">Units</a></li>
            <li><a href="/StudentHub/my_profile.php">My Profile</a></li>
        <?php } else { ?>
            <li><a href="/StudentHub/views/view_courses.php">Courses</a></li>
            <li><a href="/StudentHub/views/view_units.php">Units</a></li>
            <li><a href="/StudentHub/views/view_students.php">Students</a></li>
            <li><a href="/StudentHub/views/view_student_units.php">Student Units</a></li>
            <li><a href="/StudentHub/views/view_status_history.php">Status</a></li>
            <li><a href="/StudentHub/views/view_certificates.php">Certificates</a></li>
        <?php } ?>
        <li><a href="/StudentHub/logout.php">Logout</a></li>
    </ul>
</nav>
    </header>

    <main class="container">