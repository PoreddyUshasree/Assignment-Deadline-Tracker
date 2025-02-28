<?php 
require_once 'includes/auth.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) header("Location: index.php");

$userId = $_SESSION['user_id'];
$assignments = getUserAssignments($userId);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_dashboard.css"> 
</head>
<body>
<div class="navbar">
    <h1>Assignment Dashboard</h1>
    <div class="nav-buttons">
        <a href="dashboard.php">Dashboard</a>
        <a href="add-assignment.php">Add Assignment</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<h2>Your Assignments</h2>

<div class="table-container">
    <?php if (empty($assignments)): ?>
        <!-- Display message if no assignments are available -->
        <p class="no-assignments">No assignments found. Click <a href="add-assignment.php">here</a> to add a new assignment.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th class="heading">Assignment</th>
                <th class="heading">Description</th>
                <th class="heading">Due Date</th>
                <th class="heading">Days Remaining</th>
                <th class="heading">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment): 
                $dueDate = new DateTime($assignment['due_date']);
                $today = new DateTime();
                $daysRemaining = $today->diff($dueDate)->days;
                $isOverdue = $dueDate < $today;
                $isCritical = !$isOverdue && $daysRemaining < 2; // Highlight if days remaining < 2
            ?>
                <tr class="<?= $isCritical ? 'critical' : ''; ?>">
                    <td><?= htmlspecialchars($assignment['subject']); ?></td>
                    <td><?= htmlspecialchars($assignment['description']); ?></td>
                    <td><?= htmlspecialchars($assignment['due_date']); ?></td>
                    <td><?= $isOverdue ? 'Overdue' : $daysRemaining . ' days'; ?></td>
                    <td class="action-buttons">
                        <a href="edit-assignment.php?id=<?= $assignment['id']; ?>" class="edit-btn">Edit</a>
                        <a href="delete-assignment.php?id=<?= $assignment['id']; ?>" class="delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
</body>
</html>