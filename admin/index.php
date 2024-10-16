<?php
session_start();
require_once '../inc/db.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = secureInput($_POST['email']);
    $password = secureInput($_POST['password']);

    // Fetch admin user from the database
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: employees.php");
        exit;
    } else {
        $error_message = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="index.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Admin Login</h2>
        <?php if ($error_message): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($error_message); ?></span>
            </div>
        <?php endif; ?>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </span>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-2 pl-10 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="admin@example.com">
                </div>
            </div>
            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-lock text-gray-400"></i>
                    </span>
                    <input type="password" id="password" name="password" required class="w-full px-4 py-2 pl-10 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="••••••••">
                </div>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="px-4 py-2 mt-4 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Login</button>
            </div>
        </form>
    </div>

    <!-- Success Modal -->
    <div id="success-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-green-600 mb-4">Login Successful</h2>
            <p class="text-gray-700">You have successfully logged in.</p>
            <button onclick="closeModal('success-modal')" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Close</button>
        </div>
    </div>

    <!-- Failure Modal -->
    <div id="failure-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-red-600 mb-4">Login Failed</h2>
            <p class="text-gray-700">Invalid email or password. Please try again.</p>
            <button onclick="closeModal('failure-modal')" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Close</button>
        </div>
    </div>

    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        <?php if ($error_message): ?>
            document.getElementById('failure-modal').classList.remove('hidden');
        <?php endif; ?>
    </script>
</body>
</html>
