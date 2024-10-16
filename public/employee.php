<?php
require_once '../inc/db.php';
$conn = getDBConnection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $employee = $result->fetch_assoc();
        } else {
            header("Location: error.php");
        }
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Employee Profile</h2>
        <?php if (isset($employee)): ?>
            <div class="card">
                <div class="card-body">
                    <img src="<?php echo $employee['profile_image']; ?>" class="img-fluid rounded-circle mb-3" alt="Profile Image">
                    <h5 class="card-title"><?php echo $employee['first_name'] . ' ' . $employee['last_name']; ?></h5>
                    <p class="card-text"><i class="fas fa-envelope"></i> <?php echo $employee['email']; ?></p>
                    <p class="card-text"><i class="fas fa-phone"></i> <?php echo $employee['phone']; ?></p>
                    <p class="card-text"><i class="fas fa-building"></i> <?php echo $employee['department']; ?></p>
                    <p class="card-text"><i class="fas fa-briefcase"></i> <?php echo $employee['position']; ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>Employee not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
