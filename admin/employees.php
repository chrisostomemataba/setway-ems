<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Info Cards</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
<header class="bg-white shadow-md py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <div>
            <img src="images/setway-logo.png" alt="Setways Logo" class="w-32 h-auto">
        </div>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="users.php" class="custom-button">Users</a></li>
                <li><a href="employees.php" class="custom-button">Employees</a></li>
                <li><button id="add-employee-btn" class="custom-button">Add Employee</button></li> 
                <li><a href="logout.php" class="Btn">
                    <div class="sign">
                        <svg viewBox="0 0 512 512">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                        </svg>
                    </div>
                    <div class="text">Logout</div>
                </a></li> 
            </ul>
        </nav>
    </div>
</header>

<div class="container mx-auto my-8 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Employees</h1>
        <div class="relative">
            <input type="text" id="search" placeholder="Search employees..." class="px-4 py-2 border rounded-md w-64 focus:outline-none focus:ring-2 focus:ring-blue-600">
            <button id="search-btn" class="absolute right-0 top-0 mt-2 mr-2 text-blue-600">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div id="employee-cards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Employee cards will be appended here -->
    </div>
</div>

 <!-- View Profile Modal -->
 <div id="view-profile-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-xl overflow-hidden w-full max-w-md">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-700">Employee Profile</h2>
                    <div id="profile-content" class="space-y-4">
                        <!-- Profile content will be appended here -->
                    </div>
                    <div class="mt-4">
                        <label for="profile-url" class="block text-gray-700">Profile URL:</label>
                        <input type="text" id="profile-url" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" readonly>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" id="close-profile-modal" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--  Edit Modal -->
<div id="edit-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden w-full max-w-md">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-gray-700">Edit Employee</h2>
                <form id="edit-form" class="space-y-4">
                    <input type="hidden" id="edit-id" name="id">
                    <div>
                        <label for="edit-first_name" class="block text-gray-700">First Name</label>
                        <input type="text" id="edit-first_name" name="first_name" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    </div>
                    <div>
                        <label for="edit-last_name" class="block text-gray-700">Last Name</label>
                        <input type="text" id="edit-last_name" name="last_name" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    </div>
                    <div>
                        <label for="edit-email" class="block text-gray-700">Email</label>
                        <input type="email" id="edit-email" name="email" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    </div>
                    <div>
                        <label for="edit-phone" class="block text-gray-700">Phone</label>
                        <input type="text" id="edit-phone" name="phone" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    </div>
                    <div>
                        <label for="edit-department" class="block text-gray-700">Department</label>
                        <input type="text" id="edit-department" name="department" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    </div>
                    <div>
                        <label for="edit-position" class="block text-gray-700">Position</label>
                        <input type="text" id="edit-position" name="position" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    </div>
                    <div>
                        <label for="edit-profile_image" class="block text-gray-700">Profile Image</label>
                        <input type="file" id="edit-profile_image" name="profile_image" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="close-modal" class="px-4 py-2 mr-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Employee Modal -->
<div id="add-employee-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
            <div class="flex justify-center mb-3">
                <img src="images/setway-logo.png" alt="Setways Logo" class="w-36 h-20">
            </div>
            <h2 class="text-xl font-semibold text-center text-gray-800 mb-4">Add a new Employee</h2>
            <button id="close-add-employee-modal" class="text-gray-500 hover:text-gray-800">&times;</button>
            <form id="create-employee-form" class="space-y-3" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="first_name" class="block text-gray-700">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="John" class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                </div>
                <div>
                    <label for="last_name" class="block text-gray-700">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Doe" class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                </div>
                <div>
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" placeholder="john.doe@example.com" class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                </div>
                <div>
                    <label for="phone" class="block text-gray-700">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="+1234567890" class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                </div>
                <div>
                    <label for="department" class="block text-gray-700">Department</label>
                    <input type="text" id="department" name="department" placeholder="HR" class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                </div>
                <div>
                    <label for="position" class="block text-gray-700">Position</label>
                    <input type="text" id="position" name="position" placeholder="Manager" class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                </div>
                <div>
                    <label for="profile_image" class="block text-gray-700">Profile Image</label>
                    <input type="file" id="profile_image" name="profile_image" class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                </div>
                < class="flex justify-center">
                    <button type="submit" class="px-4 py-2 mt-4 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Create Employee</button>
</div>
            </form>
        </div>
    </div>
</div>
<script src="js/script.js"></script>
</body>
</html>
<?php include '../inc/footer.php'; ?>