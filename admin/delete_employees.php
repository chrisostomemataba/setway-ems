<?php
require_once '../inc/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = secureInput($_POST['id']);

    $conn = getDBConnection();
    $sql = "DELETE FROM employees WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        handleSQLError($conn);
    }

    $stmt->close();
    $conn->close();
}

