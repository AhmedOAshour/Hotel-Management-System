-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 11:51 AM
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
(5, 5),
(6, 6),
(7, 7);

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
(1, 1, 'Item1', 0, 50.00),
(2, 5, 'Single', 1, 60.00),
(3, 6, 'Single', 1, 60.00),
(4, 6, 'Double', 1, 70.00),
(5, 6, 'Triple', 1, 80.00),
(6, 7, 'Family', 1, 90.00);

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
(6, '101'),
(6, '302'),
(6, '403');

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
(1, 'client', 'client', 'client', 'client', 'client', 'client', 'client'),
(2, 'client1', 'client1', 'client1', 'client1', 'client1', 'client1', 'client1');

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

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`ID`, `malfunction_no`, `date`, `materials_bought`, `cost_of_materials`, `technician_name`, `work_done`) VALUES
(1, 1, '2021-06-19 00:00:00', 'Capacitor', '200', 'Mohamed', 'installed capacitor');

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
(1, 'AC not working 301', 'Archived', 'front', '2021-06-23 00:00:00');

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
(5, 1, 5, 1, 0, '2021-06-19', '2021-06-20', NULL, NULL, ''),
(6, 1, 6, 3, 0, '2021-06-19', '2021-06-20', '2021-06-19 11:48:27', NULL, ''),
(7, 2, 7, 1, 0, '2021-06-19', '2021-06-20', NULL, NULL, '');

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
(5, 'Single'),
(6, 'Single'),
(6, 'Double'),
(6, 'Triple'),
(7, 'Family');

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
('201', 'Single', 'available', ''),
('202', 'Double', 'available', ''),
('203', 'Triple', 'unavailable', ''),
('204', 'Family', 'available', ''),
('205', 'Suite', 'available', ''),
('301', 'Single', 'unavailable', ''),
('302', 'Double', 'booked', ''),
('303', 'Triple', 'available', ''),
('304', 'Family', 'available', ''),
('305', 'Suite', 'available', ''),
('401', 'Single', 'available', ''),
('402', 'Double', 'available', ''),
('403', 'Triple', 'booked', ''),
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
('Single', 60.00),
('Double', 70.00),
('Triple', 80.00),
('Family', 90.00),
('Suite', 100.00);

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
(1, 'admin', 'admin', 'admin', '$2y$10$0t.7cmUzCbrFxQXhhYMIJ.0k9XckBogMuauZPIHc8LzE0o17z9pjq', 'admin', 'admin', 'admin'),
(2, 'front', 'front', 'front', '$2y$10$FxkC7d.r0ngBwSywobOBguJ9G0g1GJZ75okj9i.wrJ8lwJkz9wBL6', 'front_clerk', 'front', 'front'),
(3, 'hk', 'hk', 'hk', '$2y$10$pPe2pU8Nlsr/C.s03bZXeu7r1nZskfoFnf5hb5H769HKa7VzjDvy2', 'HK_employee', 'hk', 'hk');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `malfunction`
--
ALTER TABLE `malfunction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
