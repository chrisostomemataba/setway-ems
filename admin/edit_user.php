<?php
require_once '../config/config.php';
require_once '../inc/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

    if ($password) {
        $stmt = $pdo->prepare("UPDATE admins SET email = ?, password = ? WHERE id = ?");
        if ($stmt->execute([$email, $password, $id])) {
            echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
        }
    } else {
        $stmt = $pdo->prepare("UPDATE admins SET email = ? WHERE id = ?");
        if ($stmt->execute([$email, $id])) {
            echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
        }
    }
}
?>
