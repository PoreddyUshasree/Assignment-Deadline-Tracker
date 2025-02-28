<?php
session_start();
require_once 'db.php';

// Functions for login and register
function login($email, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit;
    }
    return "Invalid credentials!";
}

function register($username, $email, $password) {
    global $conn;

    try {
        // Check if the email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            return "Email is already registered. Please log in or use a different email.";
        }

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword]);

        return "Registration successful! Please log in.";

    } catch (PDOException $e) {
        error_log("Error during registration: " . $e->getMessage());
        return "An error occurred during registration. Please try again later.";
    }
}
?>
