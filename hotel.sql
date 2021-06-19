-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 10:46 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `ID` int(11) NOT NULL,
  `reservation_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`ID`, `reservation_ID`) VALUES
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `ID` int(11) NOT NULL,
  `bill_ID` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `is_Room` tinyint(1) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`ID`, `bill_ID`, `item`, `is_Room`, `price`) VALUES
(8, 7, 'Single', 1, 100.00),
(9, 7, 'test', 0, 123.00),
(10, 8, 'Single', 1, 100.00),
(11, 9, 'Single', 1, 100.00),
(12, 10, 'Single', 1, 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `checked_in`
--

CREATE TABLE `checked_in` (
  `reservation_ID` int(11) NOT NULL,
  `room_no` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checked_in`
--

INSERT INTO `checked_in` (`reservation_ID`, `room_no`) VALUES
(8, '101'),
(10, '201'),
(10, '302'),
(10, '303');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `identification_no` varchar(50) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `company` varchar(255) NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ID`, `first_name`, `last_name`, `identification_no`, `nationality`, `mobile`, `email`, `company`) VALUES
(1, 'test', 'test', 'test', 'test', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `electricity`
--

CREATE TABLE `electricity` (
  `ID` int(11) NOT NULL,
  `reading` int(11) NOT NULL,
  `photo` varchar(256) NOT NULL,
  `date` datetime NOT NULL,
  `entry_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lost_and_found`
--

CREATE TABLE `lost_and_found` (
  `ID` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `item_description` text NOT NULL,
  `HK_Username` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `ID` int(11) NOT NULL,
  `malfunction_no` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `materials_bought` text NOT NULL,
  `cost_of_materials` text NOT NULL,
  `technician_name` varchar(256) NOT NULL,
  `work_done` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `malfunction`
--

CREATE TABLE `malfunction` (
  `ID` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `is_Archived` enum('Pending','Archived','','') NOT NULL,
  `entry_by` varchar(256) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `ID` int(11) NOT NULL,
  `client_ID` int(11) NOT NULL,
  `bill_ID` int(11) DEFAULT NULL,
  `number_of_rooms` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `comments` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`ID`, `client_ID`, `bill_ID`, `number_of_rooms`, `price`, `arrival`, `departure`, `check_in`, `check_out`, `comments`) VALUES
(8, 1, 8, 1, 0, '2021-06-19', '2021-06-20', '2021-06-19 10:45:30', NULL, ''),
(9, 1, 9, 1, 0, '2021-06-19', '2021-06-20', NULL, NULL, ''),
(10, 1, 10, 3, 0, '2021-06-19', '2021-06-20', '2021-06-19 10:46:27', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `reservedrooms`
--

CREATE TABLE `reservedrooms` (
  `RID` int(11) NOT NULL,
  `room_type` enum('Single','Double','Triple','Family','Suite') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservedrooms`
--

INSERT INTO `reservedrooms` (`RID`, `room_type`) VALUES
(8, 'Single'),
(9, 'Single'),
(10, 'Single'),
(10, 'Double'),
(10, 'Triple');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `number` varchar(3) NOT NULL,
  `type` enum('Single','Double','Triple','Family','Suite') NOT NULL,
  `status` enum('available','unavailable','booked','checked_out') NOT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`number`, `type`, `status`, `comments`) VALUES
('101', 'Single', 'booked', ''),
('102', 'Double', 'available', ''),
('103', 'Triple', 'available', ''),
('104', 'Family', 'available', ''),
('105', 'Suite', 'available', ''),
('201', 'Single', 'booked', ''),
('202', 'Double', 'available', ''),
('203', 'Triple', 'available', ''),
('204', 'Family', 'available', ''),
('205', 'Suite', 'available', ''),
('301', 'Single', 'available', ''),
('302', 'Double', 'booked', ''),
('303', 'Triple', 'booked', ''),
('304', 'Family', 'available', ''),
('305', 'Suite', 'available', ''),
('401', 'Single', 'available', ''),
('402', 'Double', 'available', ''),
('403', 'Triple', 'available', ''),
('404', 'Family', 'available', ''),
('405', 'Suite', 'available', '');

-- --------------------------------------------------------

--
-- Table structure for table `room_prices`
--

CREATE TABLE `room_prices` (
  `room_type` enum('Single','Double','Triple','Family','Suite') NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_prices`
--

INSERT INTO `room_prices` (`room_type`, `price`) VALUES
('Single', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `position` enum('front_clerk','HK_employee','admin') NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `first_name`, `last_name`, `username`, `password`, `position`, `security_question`, `security_answer`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$v4wgB9yIC4jGoRF7FXkHuOq9GFBpt2C2Jy7QeeAVlRypcNhjLByuu', 'admin', 'admin', 'admin'),
(2, 'test', 'test', 'test', '$2y$10$cU9EBHLN4bA1mfyacjy3Wuz/yLWjHH7FN0xOJSd2hZzb/YdMCqhEC', 'front_clerk', 'test', 'test'),
(3, 'test1', 'test1', 'test1', '$2y$10$So63JZ/zGSZPzLJgMncJReU69r3qZ1l.4KuQjegclzPJGDuj.APIa', 'HK_employee', 'test1', 'test1');

-- --------------------------------------------------------

--
-- Table structure for table `water_followup`
--

CREATE TABLE `water_followup` (
  `ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `reading` int(11) NOT NULL,
  `photo` varchar(256) NOT NULL,
  `entry_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `reservation_id` (`reservation_ID`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `bill_ID` (`bill_ID`);

--
-- Indexes for table `checked_in`
--
ALTER TABLE `checked_in`
  ADD KEY `room_no` (`room_no`),
  ADD KEY `reservation_ID` (`reservation_ID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `electricity`
--
ALTER TABLE `electricity`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `entry_by` (`entry_by`);

--
-- Indexes for table `lost_and_found`
--
ALTER TABLE `lost_and_found`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `room_number` (`room_number`),
  ADD KEY `HK_Username` (`HK_Username`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `malfunction_no` (`malfunction_no`);

--
-- Indexes for table `malfunction`
--
ALTER TABLE `malfunction`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `entry_by` (`entry_by`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `client_ID` (`client_ID`),
  ADD KEY `bill_ID` (`bill_ID`);

--
-- Indexes for table `reservedrooms`
--
ALTER TABLE `reservedrooms`
  ADD KEY `RID` (`RID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `room_prices`
--
ALTER TABLE `room_prices`
  ADD PRIMARY KEY (`room_type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `water_followup`
--
ALTER TABLE `water_followup`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `entry_by` (`entry_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `electricity`
--
ALTER TABLE `electricity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lost_and_found`
--
ALTER TABLE `lost_and_found`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `malfunction`
--
ALTER TABLE `malfunction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `water_followup`
--
ALTER TABLE `water_followup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`reservation_ID`) REFERENCES `reservation` (`ID`);

--
-- Constraints for table `electricity`
--
ALTER TABLE `electricity`
  ADD CONSTRAINT `electricity_ibfk_1` FOREIGN KEY (`entry_by`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
