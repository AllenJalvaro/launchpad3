-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 09:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_website_websys`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkins`
--

CREATE TABLE `checkins` (
  `checkinID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date_checkin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkins`
--

INSERT INTO `checkins` (`checkinID`, `userID`, `username`, `date_checkin`) VALUES
(4, 10, 'Recy12', '2023-12-11 23:20:05'),
(5, 9, 'Recy1', '2023-12-11 23:28:30'),
(6, 10, 'Recy12', '2023-12-11 23:29:42'),
(7, 3, 'Gerald123', '2023-12-11 23:37:21'),
(8, 3, 'Gerald123', '2023-12-11 23:39:10'),
(9, 3, 'Gerald123', '2023-12-11 23:39:49'),
(10, 3, 'Gerald123', '2023-12-11 23:40:32'),
(11, 3, 'Gerald123', '2023-12-11 23:43:20'),
(12, 3, 'Gerald123', '2023-12-12 19:14:36'),
(13, 3, 'Gerald123', '2023-12-12 19:15:20'),
(14, 3, 'Gerald123', '2023-12-12 19:15:46'),
(15, 3, 'Gerald123', '2023-12-12 19:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membershipID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `membership_type` varchar(50) NOT NULL,
  `membership_fee` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membershipID`, `userID`, `start_date`, `end_date`, `membership_type`, `membership_fee`, `payment_status`) VALUES
(12, 1, '2023-12-11', '2024-01-11', 'monthly', 300.00, ''),
(13, 11, '2023-12-12', '2024-01-12', 'monthly', 300.00, ''),
(14, 3, '2023-12-13', '2024-12-12', 'annual', 3000.00, ''),
(15, 12, '2023-12-13', '2023-12-27', 'semi-monthly', 150.00, ''),
(17, 7, '2023-12-13', '2023-12-27', 'semi-monthly', 150.00, ''),
(18, 10, '2023-12-13', '2024-01-12', 'monthly', 300.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `qr_codeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `qr_username` varchar(255) NOT NULL,
  `qr_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qrcode`
--

INSERT INTO `qrcode` (`qr_codeID`, `userID`, `qr_username`, `qr_image`) VALUES
(32, 9, 'Recy1', '1702304999.png'),
(33, 9, 'Recy1', '1702305006.png'),
(34, 1, 'Patrick11', '1702305130.png'),
(35, 3, 'Gerald123', '1702308972.png'),
(36, 11, 'Recy123', '1702378698.png'),
(37, 10, 'Recy12', '1702410844.png');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `workout` varchar(50) NOT NULL,
  `date_of_workout` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_of_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `userID`, `workout`, `date_of_workout`, `start_time`, `end_time`, `status`, `date_of_creation`) VALUES
(10, 3, 'chest', '2023-12-25', '07:56:00', '19:56:00', '', '2023-12-10 19:56:47'),
(11, 3, 'back', '2023-12-22', '07:57:00', '19:57:00', '', '2023-12-10 19:57:38'),
(12, 3, 'triceps', '2023-12-21', '07:58:00', '08:58:00', '', '2023-12-10 19:58:33'),
(13, 3, 'core', '2023-12-11', '21:09:00', '22:09:00', '', '2023-12-10 20:09:39'),
(14, 1, 'chest', '2023-12-25', '14:00:00', '15:00:00', '', '2023-12-10 20:54:34'),
(15, 1, 'back', '2023-12-25', '03:21:00', '04:21:00', '', '2023-12-11 10:21:45'),
(16, 11, 'back', '2023-12-15', '20:49:00', '23:49:00', '', '2023-12-12 18:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `tracker`
--

CREATE TABLE `tracker` (
  `tracker_id` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `bmi_classification` varchar(50) NOT NULL,
  `bmi` decimal(10,2) NOT NULL,
  `date_of_bmi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracker`
--

INSERT INTO `tracker` (`tracker_id`, `user_ID`, `weight`, `height`, `bmi_classification`, `bmi`, `date_of_bmi`) VALUES
(26, 7, 50.5, 167, 'Underweight', 18.11, '2023-12-13'),
(27, 7, 60.1, 123, 'Obesity', 39.73, '2023-12-13'),
(28, 1, 50.5, 167, 'Underweight', 18.11, '2023-12-13'),
(29, 1, 53.89, 169, 'Normal weight', 18.87, '2023-12-13'),
(30, 1, 48.98, 169, 'Underweight', 17.15, '2023-12-13'),
(31, 1, 60.1, 173, 'Normal weight', 20.08, '2023-12-13'),
(32, 1, 70.34, 180, 'Normal weight', 21.71, '2023-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `userID` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`userID`, `fname`, `lname`, `sex`, `birthdate`, `phoneNumber`, `username`, `password`, `confirm_password`) VALUES
(1, 'Patrick', 'Tomas', 'male', '2013-12-25', '09084594021', 'Patrick11', 'patpat', 'patpat'),
(3, 'Gerald', 'Tomas', 'male', '2010-10-01', '09123456789', 'Gerald123', 'gerald', 'gerald'),
(4, 'Paulo', 'Tomas', 'male', '2023-12-22', '09897867564', 'Paulo-1.-.', 'paulo', 'paulo'),
(5, 'Paulo', 'Tomas', 'male', '1970-01-01', '09897867564', 'Paulo09', 'asd', 'asd'),
(6, 'Paulo', 'Tomas', 'male', '1970-01-01', '09897867564', 'Paulo010', 'asd', 'asd'),
(7, 'Mingming', 'Tomas', 'female', '2023-09-14', '098789765456', 'Mingming143', 'ming', 'ming'),
(9, 'Recy', 'Alejandre', 'male', '2023-12-13', '09879757975', 'Recy1', '123', '123'),
(10, 'Recy', 'Alejandre', 'male', '2023-12-07', '09879757975', 'Recy12', '123', '123'),
(11, 'Recy', 'Alejandre', 'male', '2023-12-07', '09879757975', 'Recy123', '123', '123'),
(12, 'Recy', 'Alejandre', 'male', '2023-12-04', '09879757975', 'Recy1234', '123', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkins`
--
ALTER TABLE `checkins`
  ADD PRIMARY KEY (`checkinID`),
  ADD KEY `Fk_validate_checkin` (`userID`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membershipID`),
  ADD KEY `Fk_membership_user` (`userID`);

--
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`qr_codeID`),
  ADD KEY `Fk_user_qr` (`userID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `Fk_sched_user` (`userID`);

--
-- Indexes for table `tracker`
--
ALTER TABLE `tracker`
  ADD PRIMARY KEY (`tracker_id`),
  ADD KEY `Fk_user_bmi` (`user_ID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkins`
--
ALTER TABLE `checkins`
  MODIFY `checkinID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membershipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `qr_codeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tracker`
--
ALTER TABLE `tracker`
  MODIFY `tracker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkins`
--
ALTER TABLE `checkins`
  ADD CONSTRAINT `Fk_validate_checkin` FOREIGN KEY (`userID`) REFERENCES `user_info` (`userID`);

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `Fk_membership_user` FOREIGN KEY (`userID`) REFERENCES `user_info` (`userID`);

--
-- Constraints for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD CONSTRAINT `Fk_user_qr` FOREIGN KEY (`userID`) REFERENCES `user_info` (`userID`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `Fk_sched_user` FOREIGN KEY (`userID`) REFERENCES `user_info` (`userID`);

--
-- Constraints for table `tracker`
--
ALTER TABLE `tracker`
  ADD CONSTRAINT `Fk_user_bmi` FOREIGN KEY (`user_ID`) REFERENCES `user_info` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
