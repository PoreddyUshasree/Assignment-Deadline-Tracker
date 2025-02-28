<?php
require_once 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = login($_POST['email'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assests\css\style_index.css"> 
</head>
<body>
<form method="POST" class="sub-container">
    <h2>Login</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</form>
</body>
</html>
