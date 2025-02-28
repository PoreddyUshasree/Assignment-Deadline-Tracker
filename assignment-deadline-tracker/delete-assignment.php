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

// Delete assignment
$stmt = $conn->prepare("DELETE FROM assignments WHERE id = ?");
$stmt->execute([$assignmentId]);

header("Location: dashboard.php");
exit;
?>