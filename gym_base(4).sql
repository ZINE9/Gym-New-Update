-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 05:09 PM
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
-- Database: `gym_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `weight` float NOT NULL,
  `weight_unit` enum('lb','kg') NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `select_option2` varchar(50) NOT NULL,
  `select_option3` varchar(50) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `phone`, `weight`, `weight_unit`, `gender`, `select_option2`, `select_option3`, `start`, `end`) VALUES
(11, 'Ko Wai Yan (1)', 'NULL', 1, 'lb', 'male', 'Under 3 Months', '1', '2024-10-01', '2024-11-01'),
(12, 'Ma Hsu Po', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-01', '2024-11-01'),
(13, 'Ko Aung Ko Ko', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-01', '2024-11-01'),
(14, 'Ko Nyein Satt', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-01', '2024-11-01'),
(15, 'Ko Wai Yan (2)', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-02', '2024-11-02'),
(16, 'Ma Soe', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-02', '2024-11-02'),
(17, 'Ko Thant Zin Oo', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '3', '2024-10-02', '2025-01-02'),
(18, 'Khine Myat Oo', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-03', '2024-11-03'),
(19, 'Ko Arkar Myo Thant', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-02', '2024-11-02'),
(20, 'Nan Say Muu Phew', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-05', '2024-11-05'),
(21, 'Ma Moe Moe', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-05', '2024-11-05'),
(22, 'Nan Say Muu Phew\'s Fri', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-05', '2024-11-05'),
(23, 'Ma Tha Zin Hlaing', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-05', '2024-11-05'),
(24, 'Ko Than Zaw Tun', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-04', '2024-11-04'),
(25, 'Ma Naw Say Htoo Phew', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-05', '2024-11-05'),
(26, 'Wai Min Oo', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-07', '2024-11-07'),
(27, 'Ko Phyo Gyi', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-07', '2024-11-07'),
(28, 'Euu Wel', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-07', '2024-11-07'),
(29, 'Ma Thet Su Hlaing', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-07', '2024-11-07'),
(30, 'Ma Phyu Zin Wint Aung', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-07', '2024-11-07'),
(31, 'Ko Khin Hlaing', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-07', '2024-11-07'),
(32, 'Ma Khin Thu Hlaing', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-07', '2024-11-07'),
(33, 'Phyo Mi Mi', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-08', '2024-11-08'),
(34, 'Emily', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-08', '2024-11-08'),
(35, 'Soe Than Than Lwin', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-08', '2024-11-08'),
(36, 'Ko Aung Phyo Kyaw', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-08', '2024-11-08'),
(37, 'Thar Htet Aung', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-08', '2024-11-08'),
(38, 'Ko Pyae Phyo Aung', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-08', '2024-11-08'),
(39, 'Ma Wai Hnin Phyu', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-08', '2024-11-08'),
(40, 'Min Chit Thu', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-09', '2024-11-09'),
(41, 'Ko Phyo', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-10', '2024-11-10'),
(42, 'Ag Khant Naung', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-10', '2024-11-10'),
(43, 'Ko Htain Linn', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-14', '2024-11-14'),
(44, 'Ko Par Kyae', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-14', '2024-11-14'),
(45, 'Ko Zar Ni Aung', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-14', '2024-11-14'),
(46, 'Ko Min Thar', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-14', '2024-11-14'),
(47, 'Ko Aung Min Myat', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-16', '2024-11-16'),
(48, 'Naing Min Htet', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-18', '2024-11-18'),
(49, 'Ma Thiri Aung', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-18', '2024-11-18'),
(50, 'Ma Kit', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-19', '2024-11-19'),
(51, 'Ko Myat Min Aung', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-21', '2024-11-21'),
(52, 'Ma Nadi Aung', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-22', '2024-11-22'),
(53, 'Ma Thandar Tun', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-18', '2024-11-18'),
(54, 'Ma Thit Sar', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-24', '2024-11-24'),
(55, 'Ma Myat Noe Zin', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-26', '2024-11-26'),
(56, 'Yu Nandar Thin', 'NULL', 0, 'lb', 'female', 'Under 3 Months', '1', '2024-10-28', '2024-11-28'),
(57, 'Ko Zaw Paing', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-29', '2024-11-29'),
(58, 'Ko Thet Minn', 'NULL', 0, 'lb', 'male', 'Under 3 Months', '1', '2024-10-29', '2024-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `dolist`
--

CREATE TABLE `dolist` (
  `id` int(11) NOT NULL,
  `task` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `done_normal`
--

CREATE TABLE `done_normal` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `weight` float NOT NULL,
  `weight_unit` enum('lb','kg') NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `select_option2` varchar(50) NOT NULL,
  `select_option3` varchar(50) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `done_vip`
--

CREATE TABLE `done_vip` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `weight_unit` varchar(10) DEFAULT 'kg',
  `gender` varchar(10) DEFAULT NULL,
  `select_option1` varchar(50) NOT NULL,
  `select_option2` varchar(50) NOT NULL,
  `select_option3` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('staff','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `password`, `role`, `created_at`) VALUES
(14, 'root', '09766458306', '$2y$10$heRmO50VKUqkXJuULS7rJe3yoE.gwlrVQkmmT1dwYcUbNeAJPOjyK', 'admin', '2024-10-26 02:02:06'),
(19, 'djrangas', '099744482825', '$2y$10$S5n7QT18H5uM.FPcYVHNI.GC2kVTzPad6OBMGIUlrXtnVQxHBE6rK', 'staff', '2024-10-31 01:34:47'),
(20, 'Jaemax', '09750413510', '$2y$10$ltx4ZttUNPw6HNr1u62Bh.hg.zG5rkvb01wTP8j23JqbIpNEEIhp2', 'staff', '2024-10-31 03:31:51'),
(21, 'Zin Min', '09677027867', '$2y$10$TTpGYPGRfOfotfwnQpwZ/Opd6E/hUdFX2pjhhA8xL8KKCtQY4BZU6', 'admin', '2024-11-01 04:03:41'),
(22, 'Min Min', '09255824132', '$2y$10$thaWz4ryOL4SoBToZmWLUOg6pBxLMntA.tb7w9r324UHDdraWESrO', 'staff', '2024-11-07 15:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `vip`
--

CREATE TABLE `vip` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `weight` float NOT NULL,
  `weight_unit` enum('lb','kg') NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `select_option1` varchar(50) NOT NULL,
  `select_option2` varchar(50) NOT NULL,
  `select_option3` varchar(50) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vip`
--

INSERT INTO `vip` (`id`, `name`, `phone`, `weight`, `weight_unit`, `gender`, `select_option1`, `select_option2`, `select_option3`, `start`, `end`) VALUES
(7, 'Ma Nwe Ni Tun Khing', '', 1, 'lb', 'female', 'Trainer 1', 'Under 3 Months', '2', '2024-09-09', '2024-11-09'),
(8, 'Ma Cherry Win', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-09-02', '2024-11-02'),
(9, 'Ma Pan Yanent', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-09-06', '2024-11-06'),
(10, 'Ma Hsu Hla Phyu', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-09-12', '2024-11-12'),
(11, 'Ma Pyae Pyae Phyo', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-09-16', '2024-11-16'),
(12, 'Ma Nan Tint', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-09-16', '2024-11-16'),
(13, 'Ko John', 'NULL', 0, 'lb', 'male', 'Knee', 'Under 3 Months', '3', '2024-09-16', '2024-12-16'),
(14, 'Ma Nan Ei', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-09-16', '2024-11-16'),
(15, 'Nwe Nwe Ei', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-10-02', '2024-12-02'),
(16, 'U Thit', 'NULL', 0, 'lb', 'male', 'Knee', 'Under 3 Months', '2', '2024-10-01', '2024-12-01'),
(17, 'Ma Myat Lin', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-10-02', '2024-12-02'),
(18, 'Ko Wai Yan', 'NULL', 0, 'lb', 'male', 'Knee', 'Under 3 Months', '1', '2024-10-10', '2024-11-10'),
(19, 'Thazin Htun', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-10-09', '2024-12-09'),
(20, 'Ma Moe Moe', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-10-10', '2024-12-10'),
(21, 'Ei Kyaw Nandar Aung', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '1', '2024-10-12', '2024-11-12'),
(22, 'Kyaw Zaya', 'NULL', 0, 'lb', 'male', 'Knee', 'Under 3 Months', '1', '2024-10-14', '2024-11-14'),
(23, 'Ma Zar Chi', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '1', '2024-10-21', '2024-11-21'),
(24, 'Nan Su Myat Khaing', 'NULL', 0, 'lb', 'female', 'Knee', 'Under 3 Months', '2', '2024-10-30', '2024-12-30'),
(25, 'Eh Fu', 'NULL', 0, 'lb', 'male', 'Knee', 'Under 3 Months', '2', '2024-10-04', '2024-12-04'),
(26, 'Ma Mee Mee', 'NULL', 1, 'lb', 'female', 'Trainer 1', 'Under 3 Months', '2', '2024-10-21', '2024-12-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dolist`
--
ALTER TABLE `dolist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `done_normal`
--
ALTER TABLE `done_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `done_vip`
--
ALTER TABLE `done_vip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`phone`);

--
-- Indexes for table `vip`
--
ALTER TABLE `vip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `dolist`
--
ALTER TABLE `dolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `done_normal`
--
ALTER TABLE `done_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `done_vip`
--
ALTER TABLE `done_vip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `vip`
--
ALTER TABLE `vip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
