-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 04:47 PM
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
-- Database: `logindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ID` varchar(11) NOT NULL,
  `CATEGORY` varchar(255) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `STATUS` varchar(255) NOT NULL,
  `DATE_RESERVED` date DEFAULT NULL,
  `DATE_BORROWED` date DEFAULT NULL,
  `DATE_RETURNED` date DEFAULT NULL,
  `RESERVEDBY` varchar(255) DEFAULT NULL,
  `USEDBY` varchar(255) DEFAULT NULL,
  `IMAGE` varchar(255) DEFAULT NULL,
  `DATE_RESERVED_END` date DEFAULT NULL,
  `UNIQUEID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ID`, `CATEGORY`, `NAME`, `STATUS`, `DATE_RESERVED`, `DATE_BORROWED`, `DATE_RETURNED`, `RESERVEDBY`, `USEDBY`, `IMAGE`, `DATE_RESERVED_END`, `UNIQUEID`) VALUES
('CRMP', 'Crimp', 'Cable Crimping Tool Set', 'Available', NULL, '2024-12-01', NULL, NULL, NULL, 'Cable Crimping Tool Set.png', NULL, 'CRMP003'),
('CTT', 'CableTester', 'Cable Testers', 'Available', NULL, NULL, NULL, NULL, NULL, 'Cable Testers.png', NULL, 'CTT001'),
('CTT', 'CableTester', 'Advanced Cable Tester', 'Available', NULL, NULL, NULL, NULL, NULL, 'Advanced Cable Tester.png', NULL, 'CTT002'),
('CTT', 'CableTester', 'Digital Cable Tester', 'Available', NULL, NULL, NULL, NULL, NULL, 'Digital Cable Tester.png', NULL, 'CTT003'),
('EXT', 'Extension', 'Extension Cord', 'Available', NULL, NULL, NULL, NULL, NULL, 'Extension Cord.png', NULL, 'EXT001'),
('EXT', 'Extension', 'Heavy Duty Extension Cord', 'Available', NULL, NULL, NULL, NULL, NULL, 'Heavy Duty Extension Cord.png', NULL, 'EXT002'),
('EXT', 'Extension', 'Outdoor Extension Cord', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'EXT003'),
('HDMI', 'HDMI', 'HDMI Cable', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HDMI001'),
('HDMI', 'HDMI', 'HDMI to VGA Adapter', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HDMI002'),
('HDMI', 'HDMI', '4K HDMI Cable', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HDMI003'),
('KEYS', 'Keys', 'Laboratory Room Keys', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KEYS001'),
('KEYS', 'Keys', 'Master Laboratory Room Keys', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KEYS002'),
('KEYS', 'Keys', 'Building Access Keys', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KEYS003'),
('LPTP', 'Laptop', 'Laptop (With Charger)', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LPTP001'),
('LPTP', 'Laptop', 'Dell Laptop (With Charger)', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LPTP002'),
('LPTP', 'Laptop', 'MacBook Pro (With Charger)', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LPTP003'),
('LPTP', 'Laptop', 'ASUS', 'Available', NULL, NULL, NULL, NULL, NULL, 'ASUS.png', NULL, 'LPTP004'),
('PRP', 'Peripherals', 'Keyboard and Mouse (With Lightning Cable)', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PRP001'),
('PRP', 'Peripherals', 'Wireless Keyboard and Mouse Set', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PRP002'),
('PRP', 'Peripherals', 'Gaming Mouse and Keyboard Combo', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PRP003'),
('PWR', 'Power', 'Power Cable', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PWR001'),
('PWR', 'Power', 'Surge Protector Power Strip', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PWR002'),
('PWR', 'Power', 'Portable Power Bank', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PWR003'),
('RMT', 'Remote', 'DLP Remote Control', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RMT001'),
('RMT', 'Remote', 'TV Remote Control', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RMT002'),
('RMT', 'Remote', 'Universal Remote Control', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RMT003'),
('SPKR', 'Speaker', 'Speaker Sets', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SPKR001'),
('SPKR', 'Speaker', 'Bose Speaker Set', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SPKR002'),
('SPKR', 'Speaker', 'JBL Speaker Set', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SPKR003'),
('SPKR', 'Speaker', 'asus', 'Available', NULL, NULL, NULL, NULL, NULL, 'asus.png', NULL, 'SPKR004'),
('TBLT', 'Tablets', 'Drawing Tablets (With Stylus)', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TBLT001'),
('TBLT', 'Tablets', 'Wacom Tablet (With Stylus)', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TBLT002'),
('TBLT', 'Tablets', 'iPad Pro (With Stylus)', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TBLT003'),
('VGA', 'VGA', 'VGA Cable', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'VGA001'),
('VGA', 'VGA', 'VGA to HDMI Adapter', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'VGA002'),
('VGA', 'VGA', 'VGA Splitter', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'VGA003'),
('WBCM', 'Webcam', 'Webcam', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WBCM001'),
('WBCM', 'Webcam', 'Logitech Webcam', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WBCM002'),
('WBCM', 'Webcam', 'Microsoft Webcam', 'Available', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WBCM003');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `action`, `item_id`, `user`, `timestamp`) VALUES
(1, 'Add', 31, 'admin', '2024-12-01 09:22:49'),
(2, 'Add', 32, 'admin', '2024-12-01 09:27:01'),
(3, 'Delete', 31, 'admin', '2024-12-01 09:27:12'),
(4, 'Borrow', 26, '2022210839', '2024-12-01 09:27:27'),
(5, 'Add', 0, 'admin', '2024-12-01 13:51:45'),
(6, 'Delete', 0, 'admin', '2024-12-01 13:59:51'),
(7, 'Edit', 0, 'admin', '2024-12-01 14:40:11'),
(8, 'Edit', 0, 'admin', '2024-12-01 14:40:45'),
(9, 'Delete', 0, 'admin', '2024-12-01 14:42:16'),
(10, 'Edit', 0, 'admin', '2024-12-01 14:42:23'),
(11, 'Delete', 0, 'admin', '2024-12-01 14:45:24'),
(12, 'Add', 0, 'admin', '2024-12-01 14:57:51'),
(13, 'Edit', 0, 'admin', '2024-12-01 14:58:24'),
(14, 'Edit', 0, 'admin', '2024-12-01 14:58:59'),
(15, 'Edit', 0, 'admin', '2024-12-01 15:01:12'),
(16, 'Edit', 0, 'admin', '2024-12-01 15:01:31'),
(17, 'Edit', 0, 'admin', '2024-12-01 15:01:59'),
(18, 'Edit', 0, 'admin', '2024-12-01 15:02:40'),
(19, 'Edit', 0, 'admin', '2024-12-01 15:03:04'),
(20, 'Add', 0, 'admin', '2024-12-01 15:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `activationcode` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL,
  `reset_code` varchar(6) DEFAULT NULL,
  `reset_expiry` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `username`, `password`, `email`, `fullname`, `datecreated`, `activationcode`, `active`, `role`, `reset_code`, `reset_expiry`) VALUES
(202400000, 'admin', 'Password123!', 'admin@gmail.com', 'Main Admin', '2024-10-15 00:07:39', 'dfgw45', 1, 'Admin', '512955', '2024-11-26 17:45:53'),
(202400002, 'dalet', 'pASSWORD123!', 'clayd0423@gmail.com', 'Clayton Dale Tambis', '2024-11-30 14:29:59', '674c7f1f14813', 0, 'Student', NULL, NULL),
(202400003, 'dalet', 'Password1234!', 'clayd0423@gmail.com', 'Clayton Dale Tambis', '2024-11-30 14:30:23', '674ab0ff247e9', 0, 'Student', NULL, NULL),
(202400004, 'letlet', 'Password0423!', 'clayd0423@gmail.com', 'Clayton Dale Tambis', '2024-11-30 14:35:25', '674ab22d3041a', 0, 'Student', NULL, NULL),
(202400005, 'trial', 'Password0423!', 'clayd0423@gmail.com', 'Clayton Dale Tambis', '2024-11-30 14:40:41', '674ab369bb7aa', 1, 'Student', NULL, NULL),
(202400006, 'prof dalet', 'Password123!', 'clayd0423@gmail.com', 'Clayton Dale Tambis', '2024-11-30 15:02:48', '674ab898e04d7', 0, 'Associate', NULL, NULL),
(202400007, 'dalet', 'Password123!', 'clayd0423@gmail.com', 'Clayton Dale Tambis', '2024-11-30 15:03:22', '674ab8ba6383a', 0, 'Associate', NULL, NULL),
(202400008, 'dalet', 'Password123!', 'clayd0423@gmail.com', 'Clayton Dale Tambis', '2024-11-30 15:03:38', '674ab8ca59ad8', 0, 'Associate', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`UNIQUEID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202410001;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
