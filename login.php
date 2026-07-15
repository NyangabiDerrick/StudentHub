<?php
session_start();
require "db_config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Look up this username in the users table
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Check the user exists AND the password matches the stored hash
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['student_id'] = $user['student_id']; // NULL for admin/registrar, set for students

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