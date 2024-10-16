<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between">
                <!-- Logo and company name -->
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <img src="images/setway-logo.png" alt="Setways Logo" class="w-32 h-auto mb-4">
                    <p class="text-gray-400">Setways Company</p>
                </div>
                <!-- Navigation links -->
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="text-gray-400">
                        <li><a href="users.php" class="hover:text-blue-400">Users</a></li>
                        <li><a href="employees.php" class="hover:text-blue-400">Employees</a></li>
                        <li><a href="about.php" class="hover:text-blue-400">About Us</a></li>
                        <li><a href="contact.php" class="hover:text-blue-400">Contact</a></li>
                    </ul>
                </div>
                <!-- Contact information -->
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="text-gray-400">
                        <li class="mb-2"><i class="fas fa-phone mr-2"></i> +1 234 567 890</li>
                        <li class="mb-2"><i class="fas fa-envelope mr-2"></i> support@setways.com</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i> 123 Setways Street, City, Country</li>
                    </ul>
                </div>
            </div>
            <!-- Social media links -->
            <div class="mt-8 flex justify-center space-x-6">
                <a href="https://www.facebook.com" target="_blank" class="text-gray-400 hover:text-blue-600"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.twitter.com" target="_blank" class="text-gray-400 hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                <a href="https://www.linkedin.com" target="_blank" class="text-gray-400 hover:text-blue-500"><i class="fab fa-linkedin"></i></a>
                <a href="https://www.instagram.com" target="_blank" class="text-gray-400 hover:text-pink-600"><i class="fab fa-instagram"></i></a>
            </div>
            <!-- Footer bottom text -->
            <div class="mt-8 text-center text-gray-500">
                &copy; <?php echo date('Y'); ?> Setways Company. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Include Font Awesome for social media icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
