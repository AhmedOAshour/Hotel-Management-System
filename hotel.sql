-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 01:46 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

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
  `ID` varchar(11) NOT NULL,
  `reservation_ID` int(11) NOT NULL,
  `initial_amount` int(11) NOT NULL,
  `prepaid_amount` int(11) NOT NULL,
  `remaining_amount` int(11) NOT NULL,
  `additional_fees` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `checked_in`
--

CREATE TABLE `checked_in` (
  `reservation_ID` int(11) NOT NULL,
  `room_no` varchar(3) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(50, 'hazem', 'noistafa', '1', 'egypt', '01060810430', 'hazemhagaarf@gmail.com', 'miu'),
(51, 'test', 'test', 'test', 'test', 'test', 'test', 'test'),
(52, 'test', 'test', 'test', 'test', 'test', 'test', 'test'),
(53, '', '', '', '', '', '', ''),
(54, 'test1', 'test1', 'test1', 'test1', 'test1', 'test1', 'test1'),
(55, '', '', '', '', '', '', ''),
(56, '', '', '', '', '', '', ''),
(57, '', '', '', '', '', '', ''),
(58, '', '', '', '', '', '', ''),
(59, '', '', '', '', '', '', ''),
(60, '', '', '', '', '', '', ''),
(61, '', '', '', '', '', '', ''),
(62, '', '', '', '', '', '', ''),
(63, '', '', '', '', '', '', ''),
(64, '', '', '', '', '', '', ''),
(65, '', '', '', '', '', '', ''),
(66, '', '', '', '', '', '', ''),
(67, '', '', '', '', '', '', ''),
(68, '', '', '', '', '', '', '');

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
  `reservation_ID` int(11) NOT NULL,
  `item_description` text NOT NULL,
  `HK_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `ID` int(11) NOT NULL,
  `malfunction_no` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `materials_bought` varchar(256) NOT NULL,
  `cost_of_materials` varchar(256) NOT NULL,
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
  `is_Archived` tinyint(1) NOT NULL,
  `entry_by` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `ID` int(11) NOT NULL,
  `client_ID` int(11) NOT NULL,
  `bill_ID` varchar(11) DEFAULT NULL,
  `room_type` enum('single','double','triple','family','suite') NOT NULL,
  `room_floor` enum('1','2','3','4') NOT NULL,
  `guest_names` text NOT NULL,
  `guest_count` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`ID`, `client_ID`, `bill_ID`, `room_type`, `room_floor`, `guest_names`, `guest_count`, `price`, `arrival`, `departure`, `comments`) VALUES
(1, 50, NULL, '', '1', 'lol', 0, 0, '0000-00-00', '0000-00-00', 'ooooool'),
(2, 50, NULL, 'single', '1', 'Ahmed', 1, 0, '2021-05-12', '2021-05-19', 'test'),
(4, 50, NULL, 'single', '1', 'ahmed, mohamed', 2, 0, '2021-05-18', '2021-05-24', 'test2'),
(5, 50, NULL, 'single', '1', 'ahmed, mohamed', 2, 0, '2021-05-18', '2021-05-24', 'test2'),
(6, 52, NULL, 'single', '1', 'asdasgedfrfeg', 3, 0, '2021-05-06', '2021-05-18', 'sgdffgsdsdfgadrfg'),
(7, 54, NULL, 'single', '1', 'test', 2, 0, '0000-00-00', '0000-00-00', 'test'),
(8, 54, NULL, 'single', '1', 'sdfgdsfg', 23, 0, '2021-05-12', '2021-05-18', 'sdfgsefdg'),
(9, 54, NULL, 'single', '1', 'sdfgdsfg', 23, 0, '2021-05-12', '2021-05-18', 'sdfgsefdg'),
(10, 54, NULL, 'single', '1', 'asd', 0, 0, '2021-04-28', '2021-05-17', 'asd'),
(11, 50, NULL, 'single', '1', 'Mohamed', 1, 0, '2021-04-29', '2021-05-29', '');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `number` varchar(3) NOT NULL,
  `type` enum('Single','Double','Triple','Family','Suite') NOT NULL,
  `floor` enum('1','2','3','4') NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`number`, `type`, `floor`, `status`, `comments`) VALUES
('101', 'Single', '1', 'available', ''),
('102', 'Double', '1', 'available', NULL),
('103', 'Triple', '1', 'available', NULL),
('104', 'Family', '1', 'available', NULL),
('105', 'Suite', '1', 'available', NULL);

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
  `position` enum('front_clerk','reservation_clerk','HK_employee','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `first_name`, `last_name`, `username`, `password`, `position`) VALUES
(31, 'setsetse', 'setset', 'testse', 'testsetset', 'reservation_clerk'),
(32, 'Mohamed', 'Amin', 'Amin', '123456', 'front_clerk'),
(33, 'admin', 'admin', 'admin', 'admin', 'admin');

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
-- Indexes for table `checked_in`
--
ALTER TABLE `checked_in`
  ADD KEY `reservation_ID` (`reservation_ID`),
  ADD KEY `room_no` (`room_no`);

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
  ADD KEY `reservation_ID` (`reservation_ID`),
  ADD KEY `HK_ID` (`HK_ID`);

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
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`number`);

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
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `electricity`
--
ALTER TABLE `electricity`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  ADD CONSTRAINT `checked_in_ibfk_1` FOREIGN KEY (`reservation_ID`) REFERENCES `reservation` (`ID`),
  ADD CONSTRAINT `checked_in_ibfk_2` FOREIGN KEY (`room_no`) REFERENCES `room` (`number`);

--
-- Constraints for table `electricity`
--
ALTER TABLE `electricity`
  ADD CONSTRAINT `electricity_ibfk_1` FOREIGN KEY (`entry_by`) REFERENCES `user` (`ID`);

--
-- Constraints for table `lost_and_found`
--
ALTER TABLE `lost_and_found`
  ADD CONSTRAINT `lost_and_found_ibfk_1` FOREIGN KEY (`reservation_ID`) REFERENCES `reservation` (`ID`),
  ADD CONSTRAINT `lost_and_found_ibfk_2` FOREIGN KEY (`HK_ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`malfunction_no`) REFERENCES `malfunction` (`ID`);

--
-- Constraints for table `malfunction`
--
ALTER TABLE `malfunction`
  ADD CONSTRAINT `malfunction_ibfk_1` FOREIGN KEY (`entry_by`) REFERENCES `user` (`ID`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`client_ID`) REFERENCES `client` (`ID`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`bill_ID`) REFERENCES `bill` (`ID`);

--
-- Constraints for table `water_followup`
--
ALTER TABLE `water_followup`
  ADD CONSTRAINT `water_followup_ibfk_1` FOREIGN KEY (`entry_by`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
