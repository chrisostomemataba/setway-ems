<?php
require_once '../config/config.php';
require_once '../inc/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
    if ($stmt->execute([$email, $password])) {
        echo json_encode(['status' => 'success', 'message' => 'User created successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create user']);
    }
}
?>
