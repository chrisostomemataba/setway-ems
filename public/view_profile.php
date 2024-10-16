<?php
require_once '../config/config.php';
require_once '../inc/db.php';

if (!isset($_GET['id'])) {
    die("No employee ID provided");
}

$employeeId = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
    $stmt->execute([$employeeId]);
    $employee = $stmt->fetch();

    if (!$employee) {
        die("Employee not found");
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .printable-card, .printable-card * {
                visibility: visible;
            }
            .printable-card {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto my-8 px-4">
        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center space-y-3 printable-card">
            <img src="../uploads/<?php echo htmlspecialchars($employee['profile_image'] ?? 'default.png'); ?>" alt="<?php echo htmlspecialchars(($employee['first_name'] ?? 'N/A') . ' ' . ($employee['last_name'] ?? 'N/A')); ?>" class="w-24 h-24 rounded-full object-cover">
            <h2 class="text-xl font-semibold text-gray-800"><?php echo htmlspecialchars(($employee['first_name'] ?? 'N/A') . ' ' . ($employee['last_name'] ?? 'N/A')); ?></h2>
            <p class="text-gray-600"><i class="fas fa-envelope text-blue-600"></i> <?php echo htmlspecialchars($employee['email'] ?? 'N/A'); ?></p>
            <p class="text-gray-600"><i class="fas fa-phone text-blue-600"></i> <?php echo htmlspecialchars($employee['phone'] ?? 'N/A'); ?></p>
            <p class="text-gray-600"><i class="fas fa-building text-blue-600"></i> <?php echo htmlspecialchars($employee['department'] ?? 'N/A'); ?></p>
            <p class="text-gray-600"><i class="fas fa-briefcase text-blue-600"></i> <?php echo htmlspecialchars($employee['position'] ?? 'N/A'); ?></p>
            <button onclick="window.print()" class="custom-button bg-blue-600 text-white py-2 px-4 rounded-md mt-4 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                Print Profile
            </button>
        </div>
    </div>
</body>
</html>
