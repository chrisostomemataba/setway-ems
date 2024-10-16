<?php
require_once '../inc/db.php';

$response = ['status' => 'error', 'message' => 'An error occurred while creating the employee.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDBConnection();

    $firstName = $conn->real_escape_string($_POST['first_name']);
    $lastName = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $department = $conn->real_escape_string($_POST['department']);
    $position = $conn->real_escape_string($_POST['position']);
    $profileImage = '';

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileSize = $_FILES['profile_image']['size'];
        $fileType = $_FILES['profile_image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../uploads/';
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profileImage = $newFileName;
            } else {
                $response['message'] = 'There was an error moving the uploaded file.';
                echo json_encode($response);
                exit;
            }
        } else {
            $response['message'] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            echo json_encode($response);
            exit;
        }
    }

    $sql = "INSERT INTO employees (first_name, last_name, email, phone, department, position, profile_image) VALUES ('$firstName', '$lastName', '$email', '$phone', '$department', '$position', '$profileImage')";

    if ($conn->query($sql) === TRUE) {
        $response = ['status' => 'success', 'message' => 'Employee created successfully.'];
    } else {
        $response['message'] = 'Error: ' . $conn->error;
    }

    $conn->close();
}

echo json_encode($response);
?>