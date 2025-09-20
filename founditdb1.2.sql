-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 20, 2025 at 05:35 AM
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
-- Database: `founditdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `claim_table`
--

CREATE TABLE `claim_table` (
  `claim_id` int(10) UNSIGNED NOT NULL,
  `fnd_id` int(10) UNSIGNED NOT NULL,
  `clmr_name` varchar(255) NOT NULL,
  `clmr_number` varchar(255) NOT NULL,
  `clmr_email` varchar(255) NOT NULL,
  `witness_name` varchar(255) NOT NULL,
  `officer_name` varchar(255) NOT NULL,
  `claim_date` datetime NOT NULL DEFAULT current_timestamp(),
  `claim_condition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `claim_table`
--

INSERT INTO `claim_table` (`claim_id`, `fnd_id`, `clmr_name`, `clmr_number`, `clmr_email`, `witness_name`, `officer_name`, `claim_date`, `claim_condition`) VALUES
(1, 1, 'Juan Dela Cruz', '0999888777', 'juan@email.com', 'Maria Santos', 'Officer Reyes', '2025-09-20 11:29:29', 'Good condition');

-- --------------------------------------------------------

--
-- Table structure for table `found_items`
--

CREATE TABLE `found_items` (
  `fnd_id` int(10) UNSIGNED NOT NULL,
  `fnd_category` enum('Electronics','Accessories','Bags','Clothing','Stationery','Drinkware','Keys','Others') NOT NULL,
  `fnd_name` varchar(255) NOT NULL,
  `fnd_desc` text DEFAULT NULL,
  `fnd_location` varchar(255) NOT NULL,
  `fnd_datetime` datetime NOT NULL,
  `fndr_name` varchar(255) NOT NULL,
  `fndr_number` varchar(255) NOT NULL,
  `fndr_email` varchar(255) NOT NULL,
  `fnd_status` enum('unclaimed','claimed','discarded') NOT NULL,
  `fnd_image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `found_items`
--

INSERT INTO `found_items` (`fnd_id`, `fnd_category`, `fnd_name`, `fnd_desc`, `fnd_location`, `fnd_datetime`, `fndr_name`, `fndr_number`, `fndr_email`, `fnd_status`, `fnd_image`) VALUES
(1, 'Electronics', 'iPhone 12', NULL, 'GZB', '2025-09-20 11:29:29', 'Alice', '09123456789', 'alice@email.com', 'unclaimed', NULL),
(2, 'Drinkware', 'Water bottle', 'Fiji Water', 'GZB', '2025-09-20 05:33:06', 'John Romell Diaz', '09192092003', 'jromell099@gmail.com', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lost_reports`
--

CREATE TABLE `lost_reports` (
  `lost_id` bigint(20) UNSIGNED NOT NULL,
  `lost_category` enum('Electronics','Accessories','Bags','Clothing','Stationery','Drinkware','Keys','Others') NOT NULL,
  `lost_name` varchar(255) NOT NULL,
  `lost_desc` text DEFAULT NULL,
  `lost_location` varchar(255) NOT NULL,
  `lost_datetime` datetime NOT NULL,
  `reporter_name` varchar(255) NOT NULL,
  `reporter_number` varchar(255) NOT NULL,
  `reporter_email` varchar(255) NOT NULL,
  `lost_status` enum('ongoing','done','resolved') NOT NULL,
  `lost_image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claim_table`
--
ALTER TABLE `claim_table`
  ADD PRIMARY KEY (`claim_id`),
  ADD KEY `claim_table_fnd_id_foreign` (`fnd_id`);

--
-- Indexes for table `found_items`
--
ALTER TABLE `found_items`
  ADD PRIMARY KEY (`fnd_id`);

--
-- Indexes for table `lost_reports`
--
ALTER TABLE `lost_reports`
  ADD PRIMARY KEY (`lost_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claim_table`
--
ALTER TABLE `claim_table`
  MODIFY `claim_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `found_items`
--
ALTER TABLE `found_items`
  MODIFY `fnd_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lost_reports`
--
ALTER TABLE `lost_reports`
  MODIFY `lost_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claim_table`
--
ALTER TABLE `claim_table`
  ADD CONSTRAINT `claim_table_fnd_id_foreign` FOREIGN KEY (`fnd_id`) REFERENCES `found_items` (`fnd_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
