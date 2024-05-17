-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 04:54 PM
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
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(255) NOT NULL,
  `First_name` varchar(100) NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Register_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `Last_login` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `First_name`, `Last_name`, `Username`, `Position`, `Location`, `Password`, `Register_date`, `Last_login`) VALUES
(1, 'Sameera', 'Ayeshmantha', 'ayeshmantha2002@gmail.com', 'OWNER', 'Badulla', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', '2024-05-17 18:33:14.531907', '2024-05-17 20:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Class` varchar(10) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `Note_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ID`, `Student_ID`, `Name`, `Class`, `Type`, `Location`, `Date`, `Note`, `Note_status`) VALUES
(2, 'BW001', 'Sameera Weerawanni', '2024', 'T', 'Bandarawela', '2024-05-17', 'ada athul una aluth lamayek meya. tute eka dunne na', 2);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `ID` int(255) NOT NULL,
  `Year` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ID`, `Year`) VALUES
(0, 2024),
(0, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `class_date`
--

CREATE TABLE `class_date` (
  `ID` int(255) NOT NULL,
  `Class` varchar(20) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_date`
--

INSERT INTO `class_date` (`ID`, `Class`, `Location`, `Type`, `Date`) VALUES
(2, '2024', 'Bandarawela', 'T', '2024-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `class_fees`
--

CREATE TABLE `class_fees` (
  `ID` int(255) NOT NULL,
  `ST_ID` int(100) NOT NULL,
  `Student_ID` varchar(100) NOT NULL,
  `Class` varchar(20) NOT NULL,
  `Year_month` varchar(255) NOT NULL,
  `ST_name` varchar(255) NOT NULL,
  `Date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_fees`
--

INSERT INTO `class_fees` (`ID`, `ST_ID`, `Student_ID`, `Class`, `Year_month`, `ST_name`, `Date`) VALUES
(0, 1, 'BW001', '2024', '2024 January', '', '2024-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `deliverd_tute`
--

CREATE TABLE `deliverd_tute` (
  `ID` int(255) NOT NULL,
  `Tute_ID` int(255) NOT NULL,
  `ST_ID` int(20) NOT NULL,
  `Student_ID` varchar(255) NOT NULL,
  `Class` varchar(20) NOT NULL,
  `ST_name` varchar(255) NOT NULL,
  `Date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliverd_tute`
--

INSERT INTO `deliverd_tute` (`ID`, `Tute_ID`, `ST_ID`, `Student_ID`, `Class`, `ST_name`, `Date`) VALUES
(0, 1, 1, 'BW001', '2024', 'Sameera Weerawanni', '2024-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `ID` int(10) NOT NULL,
  `location` varchar(100) NOT NULL,
  `UID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`ID`, `location`, `UID`) VALUES
(3, 'Badulla', 'BD'),
(4, 'Bandarawela', 'BW');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(100) NOT NULL,
  `Student_ID` varchar(100) NOT NULL,
  `First_name` varchar(100) NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `Class` varchar(10) NOT NULL,
  `Phone_number` varchar(20) NOT NULL,
  `Register_date` varchar(20) NOT NULL,
  `Pro-pic` varchar(255) DEFAULT NULL,
  `Status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `Student_ID`, `First_name`, `Last_name`, `Class`, `Phone_number`, `Register_date`, `Pro-pic`, `Status`) VALUES
(1, 'BW001', 'Sameera', 'Weerawanni', '2024', '711596479', '2024-05-17', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tutes`
--

CREATE TABLE `tutes` (
  `ID` int(100) NOT NULL,
  `Tute_name` varchar(100) NOT NULL,
  `Class` varchar(20) NOT NULL,
  `Start_date` int(100) NOT NULL,
  `Counte` int(50) NOT NULL,
  `Delivered` int(50) NOT NULL,
  `Action` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutes`
--

INSERT INTO `tutes` (`ID`, `Tute_name`, `Class`, `Start_date`, `Counte`, `Delivered`, `Action`) VALUES
(1, 'Organic', '2024', 2024, 20, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `class_date`
--
ALTER TABLE `class_date`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tutes`
--
ALTER TABLE `tutes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_date`
--
ALTER TABLE `class_date`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tutes`
--
ALTER TABLE `tutes`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
