<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Look up the admin user
$stmt = $pdo->prepare("SELECT * FROM Admin WHERE username = :username");
$stmt->execute([':username' => $username]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Verify password
if ($admin && password_verify($password, $admin['passwordHash'])) {
    $_SESSION['is_admin'] = true;
    header("Location: taskB.html"); // Redirect to movie list
    exit();
} else {
    echo "Login failed. <a href='admin_login.html'>Try again</a>";
}
?>
