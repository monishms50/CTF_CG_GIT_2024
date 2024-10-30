<?php
session_start();

// Function to authenticate user based on username and password
function authenticateUser($username, $password) {
    require_once '../config/db.php';

    // Get database connection
    $db = getDB();

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user exists and the password matches
    if ($user && $user['password'] === $password) {
        // Start session and store user data
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['id'] = $user['id'];
        return true;
    }
    return false;
}

// Function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['username']);
}

// Function to get user role (admin or user)
function getUserRole() {
    return $_SESSION['role'] ?? null;
}

// Function to log out the user
function logout() {
    session_unset();
    session_destroy();
    header("Location: ../pages/index.php");
    exit();
}
?>
