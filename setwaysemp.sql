-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 06:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `setwaysemp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'admin1@example.com', '$2y$10$AxQt1wUKgvRoAfra6OlhbOO9Whacqda8d5Mf4nzHC9KvRTro3ttAS'),
(2, 'admin2@example.com', '$2y$10$s62CxRp3442n9MpKIXC93u87zepO5PzfXVZnKkQ7ybB7SUSN9vJIe'),
(3, 'admin3@example.com', '$2y$10$xXu/8ZL7TusVwYGYpqjw5e9RIqGL4IupQ/86Df4brmNmd1mP3/5Lq');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `phone`, `department`, `position`, `profile_image`) VALUES
(1, 'Johnie', 'Doe', 'john.doe@example.com', '123-456-7890', 'HR', 'Manager', 'profile.jpg'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '987-654-3210', 'Finance', 'Analyst', 'female.png'),
(3, 'Alice', 'Johnson', 'alice.johnson@example.com', '555-123-4567', 'IT', 'Developer', 'female.png'),
(4, 'Bob', 'Williams', 'bob.williams@example.com', '555-765-4321', 'Marketing', 'Specialist', 'profile.jpg'),
(5, 'Charlie', 'Brown', 'charlie.brown@example.com', '555-234-5678', 'Operations', 'Coordinator', 'profile.jpg'),
(6, 'David', 'Davis', 'david.davis@example.com', '555-876-5432', 'Sales', 'Representative', 'profile.jpg'),
(7, 'Ella', 'Miller', 'ella.miller@example.com', '555-345-6789', 'Customer Support', 'Agent', 'profile.jpg'),
(8, 'Frank', 'Garcia', 'frank.garcia@example.com', '555-987-6543', 'Legal', 'Advisors', 'profile.jpg'),
(9, 'Grace', 'Martinez', 'grace.martinez@example.com', '555-456-7890', 'R&D', 'Engineer', 'female.png'),
(10, 'Hank', 'Rodriguez', 'hank.rodriguez@example.com', '555-543-9876', 'Logistics', 'Manager', 'profile.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
