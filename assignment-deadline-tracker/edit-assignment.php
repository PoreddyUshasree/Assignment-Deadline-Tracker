<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$assignmentId = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $dueDate = $_POST['due_date'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE assignments SET subject = ?, due_date = ?, description = ? WHERE id = ?");
    $stmt->execute([$subject, $dueDate, $description, $assignmentId]);

    header("Location: dashboard.php");
    exit;
}

// Fetch existing assignment details
$stmt = $conn->prepare("SELECT * FROM assignments WHERE id = ?");
$stmt->execute([$assignmentId]);
$assignment = $stmt->fetch();

if (!$assignment) {
    header("Location: dashboard.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Assignment</title>
    <link rel="stylesheet" href="assests\css\style_editassign.css"> <!-- Link the CSS file -->
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
    <h2>Edit Assignment</h2>
    <form method="POST" class="sub-container">
        <input type="text" name="subject" value="<?= htmlspecialchars($assignment['subject']); ?>" required>
        <input type="date" name="due_date" value="<?= $assignment['due_date']; ?>" required>
        <textarea name="description"><?= htmlspecialchars($assignment['description']); ?></textarea>
        <button type="submit">Update Assignment</button>
    </form>
</div>

</body>
</html>

