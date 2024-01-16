-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2023 at 12:08 PM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_challenge`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `dated` date NOT NULL,
  `checkin_at` varchar(50) NOT NULL,
  `checkout_at` varchar(50) NOT NULL,
  `checkin_flag` enum('present','late','absent') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `checkout_flag` enum('early') DEFAULT NULL,
  `justification` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `break_start` varchar(50) DEFAULT NULL,
  `break_end` varchar(50) DEFAULT NULL,
  `working_hours` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `dated`, `checkin_at`, `checkout_at`, `checkin_flag`, `checkout_flag`, `justification`, `break_start`, `break_end`, `working_hours`) VALUES
(9, 17, '2023-03-29', '1680087703', '1680091080', 'present', NULL, NULL, '1680091061', '1680091069', 0.94),
(10, 17, '2023-03-29', '1680090853', '1680091080', 'late', NULL, NULL, '1680091061', '1680091069', 0.94);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES
(1, 'work_starts', '07:00:00'),
(2, 'work_ends', '16:00:00'),
(3, 'break_starts', '12:00:00'),
(4, 'break_ends', '13:00:00'),
(5, 'checkin_last', '08:00:00'),
(6, 'checkout_least', '15:00:00'),
(7, 'late_flag', '08:30:00'),
(8, 'weekly_hours_required', '40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `status` enum('pending','approved','blocked') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pending',
  `type` enum('admin','employee') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'employee',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `status`, `type`, `created_at`) VALUES
(1, 'nisar khalid', 'nisar@test.com', '123456', 'approved', 'admin', '2023-03-27 10:05:42'),
(17, 'ammar', 'ammar@test.com', '123456', 'approved', 'employee', '2023-03-28 05:24:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
