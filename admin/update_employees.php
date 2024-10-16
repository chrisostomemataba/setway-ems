<?php
require_once '../inc/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = secureInput($_POST['id']);
    $first_name = secureInput($_POST['first_name']);
    $last_name = secureInput($_POST['last_name']);
    $email = secureInput($_POST['email']);
    $phone = secureInput($_POST['phone']);
    $department = secureInput($_POST['department']);
    $position = secureInput($_POST['position']);
    $profile_image = null;

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $profile_image = file_get_contents($_FILES['profile_image']['tmp_name']);
    }

    $conn = getDBConnection();
    if ($profile_image) {
        $sql = "UPDATE employees SET first_name=?, last_name=?, email=?, phone=?, department=?, position=?, profile_image=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssssi', $first_name, $last_name, $email, $phone, $department, $position, $profile_image, $id);
    } else {
        $sql = "UPDATE employees SET first_name=?, last_name=?, email=?, phone=?, department=?, position=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssi', $first_name, $last_name, $email, $phone, $department, $position, $id);
    }

    if ($stmt->execute()) {
        echo "success";
    } else {
        handleSQLError($conn);
    }

    $stmt->close();
    $conn->close();
}
?>
