<?php
session_start(); // Starts/resumes a session - lets us remember the user is logged in across pages

// Hardcoded admin credentials (simple approach for now)
$admin_username = "admin";
$admin_password = "admin2026"; // change this to whatever you want

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['loggedin'] = true; // mark the session as logged in
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - StudentHub</title>
    <link rel="stylesheet" href="/StudentHub/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <main class="login-page">
    <div class="login-card">
        <h2 style="text-align:center; border:none; padding:0;">Student<span style="color:#d4af37;">Hub</span></h2>
        <p style="text-align:center;">Admin Login</p>

        <?php if ($error) { ?>
            <p style="color:red; text-align:center;"><?php echo $error; ?></p>
        <?php } ?>

        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
    </main>
</body>
</html>