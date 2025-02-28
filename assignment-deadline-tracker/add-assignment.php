<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $subject = $_POST['subject'];
    $dueDate = $_POST['due_date'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO assignments (user_id, subject, due_date, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $subject, $dueDate, $description]);

    header("Location: dashboard.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Assignment</title>
    <link rel="stylesheet" href="style_addasign.css"> <!-- Link the CSS file -->
</head>
<body>

<div class="navbar">
    <h1>Assignment Manager</h1>
    <div class="nav-buttons">
        <a href="dashboard.php">Dashboard</a>
        <a href="add-assignment.php">Add Assignment</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="main-container">
    <h2>Add Assignment</h2>
    <form method="POST" class="sub-container">
        <input type="text" name="subject" placeholder="Subject" required>
        <input type="date" name="due_date" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit">Add Assignment</button>
    </form>
</div>

</body>
</html>
