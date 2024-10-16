<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/index.php");
    exit;
}

require_once '../config/config.php';
require_once '../inc/db.php';

// Fetch all admins
$admins = [];
$stmt = $pdo->query("SELECT * FROM admins");
while ($row = $stmt->fetch()) {
    $admins[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-100">

<header class="bg-white shadow-md py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <div>
            <img src="images/setway-logo.png" alt="Setways Logo" class="w-32 h-auto">
        </div>
        <nav>
        <ul class="flex space-x-4">
    <li><a href="employees.php" class="custom-button">Employees</a></li>
    <li>
        <a href="logout.php" class="Btn">
            <div class="sign">
                <svg viewBox="0 0 512 512">
                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                </svg>
            </div>
            <div class="text">Logout</div>
        </a>
    </li>
</ul>

        </nav>
    </div>
</header>

<div class="container mx-auto my-8">
    <div class="flex justify-end mb-4">
        <button id="add-user-btn" class="custom-button">Create User</button>
    </div>
    <div class="overflow-x-auto">
        <table id="users-table" class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($admins as $admin): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap"><?= $admin['id'] ?></td>
                    <td class="py-3 px-6 text-left"><?= $admin['email'] ?></td>
                    <td class="py-3 px-6 text-center">
                        <button class="custom-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded edit-btn" data-id="<?= $admin['id'] ?>" data-email="<?= $admin['email'] ?>">Edit</button>
                        <button class="custom-button bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-btn" data-id="<?= $admin['id'] ?>">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Create User Modal -->
<div id="create-user-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Create User</h2>
        <form id="create-user-form">
            <div class="mb-4">
                <label for="create-email" class="block text-gray-700">Email:</label>
                <input type="email" id="create-email" name="email" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="create-password" class="block text-gray-700">Password:</label>
                <input type="password" id="create-password" name="password" class="w-full p-2 border rounded">
            </div>
            <div class="flex justify-end">
                <button type="button" id="close-create-user-modal" class="custom-button">Cancel</button>
                <button type="submit" class="custom-button ml-2">Create</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="edit-user-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Edit User</h2>
        <form id="edit-user-form">
            <input type="hidden" id="edit-id" name="id">
            <div class="mb-4">
                <label for="edit-email" class="block text-gray-700">Email:</label>
                <input type="email" id="edit-email" name="email" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="edit-password" class="block text-gray-700">New Password:</label>
                <input type="password" id="edit-password" name="password" class="w-full p-2 border rounded">
            </div>
            <div class="flex justify-end">
                <button type="button" id="close-edit-user-modal" class="custom-button">Cancel</button>
                <button type="submit" class="custom-button ml-2">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#users-table').DataTable();

    // Create user modal
    $('#add-user-btn').click(function() {
        $('#create-user-modal').removeClass('hidden');
    });

    $('#close-create-user-modal').click(function() {
        $('#create-user-modal').addClass('hidden');
    });

    $('#create-user-form').submit(function(event) {
        event.preventDefault();
        const formData = $(this).serialize();

        $.post('create_user.php', formData, function(response) {
            if (response.status === 'success') {
                Swal.fire('Success', response.message, 'success').then(() => location.reload());
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        }, 'json');
    });

    // Edit user modal
    $(document).on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        const email = $(this).data('email');
        $('#edit-id').val(id);
        $('#edit-email').val(email);
        $('#edit-user-modal').removeClass('hidden');
    });

    $('#close-edit-user-modal').click(function() {
        $('#edit-user-modal').addClass('hidden');
    });

    $('#edit-user-form').submit(function(event) {
        event.preventDefault();
        const formData = $(this).serialize();

        $.post('edit_user.php', formData, function(response) {
            if (response.status === 'success') {
                Swal.fire('Success', response.message, 'success').then(() => location.reload());
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        }, 'json');
    });

    // Delete user
    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('delete_user.php', { id: id }, function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Deleted!', response.message, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                }, 'json');
            }
        });
    });
});
</script>

<style>
.custom-button {
    background-color: #173c80;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.custom-button:hover {
    background-color: #00adee;
}

.Btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background-color: #173c80;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.Btn:hover {
    background-color: #00adee;
}

.sign {
    width: 16px;
    height: 16px;
}

.text {
    font-size: 16px;
}

table {
    width: 100%;
}

th, td {
    padding: 12px 15px;
    text-align: left;
}

th {
    background-color: #8d98c7;
}

td {
    border-bottom: 1px solid #ddd;
}

th, td {
    min-width: 150px;
}
</style>

</body>
</html>
<?php include '../inc/footer.php'; ?>