<?php
require_once 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = register($_POST['username'], $_POST['email'], $_POST['password']);
    
    // Check if the registration message indicates success
    if ($message === "Registration successful! Please log in.") {
        header("Location: index.php"); // Redirect to login page
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assests\css\styles_register.css"> <!-- Link the CSS file -->
</head>
<body>
    <div class="main-container">
        <h2>Register</h2>
        <form method="POST" class="sub-container">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
            <?php if (isset($message)) echo "<p class='error-message'>$message</p>"; ?>
            <p>Already have an account? <a href="index.php">Login</a></p>
        </form>
    </div>
</body>
</html>





