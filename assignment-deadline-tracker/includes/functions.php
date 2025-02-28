<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserAssignments($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM assignments WHERE user_id = ? ORDER BY due_date ASC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}
?>
