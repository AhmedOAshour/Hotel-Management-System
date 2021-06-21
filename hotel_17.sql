-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 11:06 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
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
(14, 2, 'Alcohols', 0, 50.00),
(15, 1, 'Alcohols', 0, 50.00),
(16, 2, 'Alcohols', 0, 50.00),
(17, 1, 'Single', 1, 5.00),
(18, 1, 'Double', 1, 1.00),
(19, 1, 'Single', 1, 5.00),
(20, 3, 'Single', 1, 5.00),
(21, 3, 'Single', 1, 5.00),
(22, 3, 'Single', 1, 5.00),
(23, 4, 'Single', 1, 5.00),
(24, 4, 'Single', 1, 5.00),
(25, 4, 'Single', 1, 5.00),
(26, 5, 'Single', 1, 5.00),
(27, 5, 'Single', 1, 5.00),
(28, 5, 'Single', 1, 5.00),
(32, 6, 'Single', 1, 5.00),
(34, 8, 'Single', 1, 5.00),
(37, 10, 'Double', 1, 1.00),
(38, 7, 'Single', 1, 5.00),
(40, 9, 'Single', 1, 5.00),
(41, 9, 'Single', 1, 5.00),
(42, 9, 'Single', 1, 5.00),
(43, 9, 'Single', 1, 5.00),
(44, 1, 'Alcohols', 0, 1500.00);

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
(3, '101'),
(3, '101');

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
(1, 'customer1', 'customer', 'customer', 'customer', 'customer', 'customer', 'customer'),
(7, 'MohamedA111', 'mostafa1111', '2145214421', 'Egypt', '01060810430', 'admin@gmail.com', 'amco'),
(8, 'MohamedA123214', 'AminA', '2145214421', 'Egypt', '01060810430', 'adminzzzz@gmail.com', 'amco'),
(9, 'MohamedA4214', 'AminA214124', '10101010', 'Egypt', '01060810430', 'adminzzzzzzzzz@gmail.com', 'amco'),
(10, 'MohamedA1221', 'AminA', '2145214421', 'Egypt', '01960810430', 'adzzzzzzzmin@gmail.com', 'amco'),
(20, 'amin', 'AminA', '2145214421', 'Egypt', '01060810430', 'admin@gmail.com', 'A');

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

--
-- Dumping data for table `lost_and_found`
--

INSERT INTO `lost_and_found` (`ID`, `room_number`, `item_description`, `HK_Username`, `date`) VALUES
(1, '102', '412412142', 'hk2', '2021-06-21');

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

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`ID`, `malfunction_no`, `date`, `materials_bought`, `cost_of_materials`, `technician_name`, `work_done`) VALUES
(1, 2, '2021-06-21 00:00:00', '1242,124421', '142124,124124', 'MOHAMED', 'LOL');

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

--
-- Dumping data for table `malfunction`
--

INSERT INTO `malfunction` (`ID`, `description`, `is_Archived`, `entry_by`, `date`) VALUES
(1, 'lol', 'Pending', 'hk2', '2021-06-21 00:00:00'),
(2, 'Lol', 'Archived', 'hk2', '2021-06-22 00:00:00'),
(3, 'Lol22323', 'Pending', 'hk2', '2021-06-22 00:00:00');

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
(1, 1, 1, 3, 0, '2021-06-18', '2021-06-26', NULL, NULL, 'Nope'),
(2, 1, 2, 1, 0, '2021-06-19', '2021-06-23', NULL, NULL, 'lol'),
(3, 1, 3, 3, 0, '2021-06-11', '2021-06-26', NULL, NULL, ''),
(4, 1, 4, 3, 0, '2021-06-11', '2021-06-26', NULL, NULL, ''),
(5, 1, 5, 3, 0, '2021-06-11', '2021-06-26', NULL, NULL, ''),
(6, 1, 6, 1, 0, '2021-06-11', '2021-06-26', NULL, NULL, 'lol'),
(7, 20, 7, 1, 0, '2021-06-21', '2021-06-26', NULL, NULL, ''),
(8, 20, 8, 1, 0, '2021-06-21', '2021-06-22', NULL, NULL, ''),
(9, 10, 9, 4, 0, '2021-06-21', '2021-06-30', NULL, NULL, ''),
(10, 1, 10, 1, 0, '2021-06-21', '2021-06-22', NULL, NULL, 'Nope');

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
(10, 'Double'),
(10, 'Double'),
(7, 'Single'),
(7, 'Single'),
(9, 'Single'),
(9, 'Single'),
(9, 'Single'),
(9, 'Single'),
(9, 'Single'),
(9, 'Single'),
(9, 'Single'),
(9, 'Single');

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
('101', 'Single', 'available', ''),
('102', 'Double', 'unavailable', ''),
('103', 'Triple', 'available', ''),
('104', 'Family', 'available', ''),
('105', 'Double', 'unavailable', ''),
('115', 'Single', 'available', ''),
('201', 'Single', 'available', ''),
('202', 'Double', 'available', ''),
('203', 'Triple', 'available', ''),
('204', 'Family', 'available', '');

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
('Single', 5.00),
('Double', 1.00),
('Triple', 1.00),
('Family', 1.00);

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
  `position` enum('front_clerk','reservation_clerk','HK_employee','admin') NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `first_name`, `last_name`, `username`, `password`, `position`, `security_question`, `security_answer`) VALUES
(10, 'MohamedA', 'AminA', 'admin23', '$2y$10$r8CN./modokXCamTH55OyeqNXpH1CBrCl3fR8htwjDL4mQ61JQxvC', 'front_clerk', 'Where did you travel in twenty eighteen?', 'alex'),
(12, 'MohamedAs', 'AminAs', 'amino', '$2y$10$VjvhY0VLEUa0lzLSbOoBv.R63vv97I3y/P4PtBrGOSkCdaXpwRT8a', 'front_clerk', 'Where did you travel in twenty eighteen?', 'alex'),
(40, 'MohamedA', 'AminA', 'hk', '$2y$10$zjOyTfF9ufagwxYY2psOh.8XGAHtoA7yWBBW.3szdCEEQBONNWLZS', 'admin', 'Where did you travel in twenty eighteen?', 'alex'),
(41, 'MohamedA', 'AminA', 'hk2', '$2y$10$cI.ELPDCvSNMvdOFsDkANOS0nEArLoC0xGArEttQKYFGo0uCURcKC', 'HK_employee', 'Where did you travel in twenty eighteen?', 'alex');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `electricity`
--
ALTER TABLE `electricity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lost_and_found`
--
ALTER TABLE `lost_and_found`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `malfunction`
--
ALTER TABLE `malfunction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
-- Constraints for table `checked_in`
--
ALTER TABLE `checked_in`
  ADD CONSTRAINT `checked_in_ibfk_2` FOREIGN KEY (`room_no`) REFERENCES `room` (`number`),
  ADD CONSTRAINT `checked_in_ibfk_3` FOREIGN KEY (`reservation_ID`) REFERENCES `reservation` (`ID`);

--
-- Constraints for table `electricity`
--
ALTER TABLE `electricity`
  ADD CONSTRAINT `electricity_ibfk_1` FOREIGN KEY (`entry_by`) REFERENCES `user` (`ID`);

--
-- Constraints for table `lost_and_found`
--
ALTER TABLE `lost_and_found`
  ADD CONSTRAINT `lost_and_found_ibfk_3` FOREIGN KEY (`room_number`) REFERENCES `room` (`number`),
  ADD CONSTRAINT `lost_and_found_ibfk_4` FOREIGN KEY (`HK_Username`) REFERENCES `user` (`username`);

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`malfunction_no`) REFERENCES `malfunction` (`ID`);

--
-- Constraints for table `malfunction`
--
ALTER TABLE `malfunction`
  ADD CONSTRAINT `malfunction_ibfk_1` FOREIGN KEY (`entry_by`) REFERENCES `user` (`username`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`client_ID`) REFERENCES `client` (`ID`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`bill_ID`) REFERENCES `bill` (`ID`);

--
-- Constraints for table `reservedrooms`
--
ALTER TABLE `reservedrooms`
  ADD CONSTRAINT `reservedrooms_ibfk_1` FOREIGN KEY (`RID`) REFERENCES `reservation` (`ID`);

--
-- Constraints for table `water_followup`
--
ALTER TABLE `water_followup`
  ADD CONSTRAINT `water_followup_ibfk_1` FOREIGN KEY (`entry_by`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
