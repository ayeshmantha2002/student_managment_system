-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 11:09 AM
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
CREATE DATABASE IF NOT EXISTS `student_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `student_management`;

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
(1, 'Sameera', 'Ayeshmantha', 'ayeshmantha2002', 'OWNER', 'Badulla', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', '2024-06-15 11:13:22.456623', '2024-07-21 14:23:16');

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
(1, 'BW001', 'Nuwan Kulasekara', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(2, 'BW002', 'Sajith Premadhasa', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(3, 'BW003', 'Kasun Kalhara', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(4, 'BW004', 'Sugath Silwa', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(5, 'BW005', 'Saman Kumara', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(6, 'BW006', 'Gamini Fonseka', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(7, 'BW007', 'Supun Chinthaka', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(8, 'BW008', 'Chamara Sampath', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(9, 'BW009', 'Kumara Sangakkara', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(10, 'BW010', 'Kanishka Dhananjaya', '2025', 'T', 'Bandarawela', '2024-06-08', '', 0),
(11, 'BW001', 'Nuwan Kulasekara', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(12, 'BW002', 'Sajith Premadhasa', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(13, 'BW003', 'Kasun Kalhara', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(14, 'BW004', 'Sugath Silwa', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(15, 'BW005', 'Saman Kumara', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(16, 'BW006', 'Gamini Fonseka', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(17, 'BW008', 'Chamara Sampath', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(18, 'BW011', 'Avishka Kavinda', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(19, 'BW012', 'Nuwan Kulasekara', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(20, 'BW013', 'Pawan Kumara', '2025', 'T', 'Bandarawela', '2024-07-17', '', 0),
(21, 'BW001', 'Nuwan Kulasekara', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(22, 'BW002', 'Sajith Premadhasa', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(23, 'BW008', 'Chamara Sampath', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(24, 'BW003', 'Kasun Kalhara', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(25, 'BW004', 'Sugath Silwa', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(26, 'BW005', 'Saman Kumara', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(27, 'BW006', 'Gamini Fonseka', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(28, 'BW007', 'Supun Chinthaka', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(30, 'BW009', 'Kumara Sangakkara', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(31, 'BW010', 'Kanishka Dhananjaya', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(32, 'BW011', 'Avishka Kavinda', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(33, 'BW012', 'Nuwan Kulasekara', '2025', 'T', 'Bandarawela', '2024-07-20', '', 0),
(34, 'BW001', 'Nuwan Kulasekara', '2025', 'T', 'Bandarawela', '2024-07-21', '', 0),
(35, 'BW002', 'Sajith Premadhasa', '2025', 'T', 'Bandarawela', '2024-07-21', '', 0),
(36, 'BW005', 'Saman Kumara', '2025', 'T', 'Bandarawela', '2024-07-21', '', 0),
(37, 'BW008', 'Chamara Sampath', '2025', 'T', 'Bandarawela', '2024-07-21', '', 0),
(38, 'BW004', 'Sugath Silwa', '2025', 'T', 'Bandarawela', '2024-07-21', '', 0),
(39, 'BW012', 'Nuwan Kulasekara', '2025', 'T', 'Bandarawela', '2024-07-21', '', 0),
(40, 'BW013', 'Pawan Kumara', '2025', 'T', 'Bandarawela', '2024-07-21', '', 0),
(41, 'BW003', 'Kasun Kalhara', '2025', 'T', 'Bandarawela', '2024-07-21', '', 0);

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
(1, 2025),
(4, 2026);

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
(2, '2025', 'Bandarawela', 'T', '2024-07-08'),
(3, '2025', 'Bandarawela', 'T', '2024-07-09'),
(4, '2025', 'Bandarawela', 'T', '2024-07-17'),
(5, '2025', 'Bandarawela', 'R', '2024-07-18'),
(6, '2025', 'Bandarawela', 'T', '2024-07-20'),
(7, '2025', 'Bandarawela', 'T', '2024-07-21');

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
(1, 1, 'BW001', '2025', ' 2024 July ', '', '2024-07-08'),
(2, 2, 'BW002', '2025', ' 2024 July ', '', '2024-07-08'),
(3, 3, 'BW003', '2025', ' 2024 July ', '', '2024-07-08'),
(4, 4, 'BW004', '2025', ' 2024 July ', '', '2024-07-08'),
(5, 5, 'BW005', '2025', ' 2024 July ', '', '2024-07-08'),
(6, 6, 'BW006', '2025', ' 2024 July ', '', '2024-07-08'),
(7, 7, 'BW007', '2025', ' 2024 July ', '', '2024-07-08'),
(8, 10, 'BW010', '2025', ' 2024 July ', '', '2024-07-08'),
(9, 8, 'BW008', '2025', ' 2024 July ', '', '2024-07-17'),
(10, 12, 'BW011', '2025', ' 2024 July ', '', '2024-07-17'),
(11, 9, 'BW009', '2025', ' 2024 July ', '', '2024-07-20'),
(12, 13, 'BW012', '2025', ' 2024 July ', '', '2024-07-20');

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
(1, 1, 1, 'BW001', '2025', 'Nuwan Kulasekara', '2024-07-08'),
(2, 1, 2, 'BW002', '2025', 'Sajith Premadhasa', '2024-07-08'),
(3, 1, 3, 'BW003', '2025', 'Kasun Kalhara', '2024-07-08'),
(4, 1, 4, 'BW004', '2025', 'Sugath Silwa', '2024-07-08'),
(5, 1, 8, 'BW008', '2025', 'Chamara Sampath', '2024-07-08'),
(6, 1, 9, 'BW009', '2025', 'Kumara Sangakkara', '2024-07-08'),
(7, 1, 10, 'BW010', '2025', 'Kanishka Dhananjaya', '2024-07-08'),
(8, 1, 12, 'BW011', '2025', 'Avishka Kavinda', '2024-07-17'),
(9, 1, 5, 'BW005', '2025', 'Saman Kumara', '2024-07-20'),
(10, 1, 6, 'BW006', '2025', 'Gamini Fonseka', '2024-07-20'),
(11, 1, 7, 'BW007', '2025', 'Supun Chinthaka', '2024-07-20'),
(12, 1, 13, 'BW012', '2025', 'Nuwan Kulasekara', '2024-07-20'),
(13, 2, 1, 'BW001', '2025', 'Nuwan Kulasekara', '2024-07-21'),
(14, 2, 2, 'BW002', '2025', 'Sajith Premadhasa', '2024-07-21'),
(15, 2, 5, 'BW005', '2025', 'Saman Kumara', '2024-07-21'),
(16, 2, 8, 'BW008', '2025', 'Chamara Sampath', '2024-07-21'),
(17, 2, 4, 'BW004', '2025', 'Sugath Silwa', '2024-07-21'),
(18, 2, 13, 'BW012', '2025', 'Nuwan Kulasekara', '2024-07-21'),
(19, 2, 14, 'BW013', '2025', 'Pawan Kumara', '2024-07-21'),
(20, 1, 3, 'BW003', '2025', 'Kasun Kalhara', '2024-07-21');

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
(1, 'Badulla', 'BD'),
(2, 'Bandarawela', 'BW');

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
  `Card` varchar(255) NOT NULL,
  `Phone_number` varchar(20) DEFAULT NULL,
  `Register_date` varchar(20) NOT NULL,
  `Pro-pic` varchar(255) DEFAULT NULL,
  `Status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `Student_ID`, `First_name`, `Last_name`, `Class`, `Card`, `Phone_number`, `Register_date`, `Pro-pic`, `Status`) VALUES
(1, 'BW001', 'Nuwan', 'Kulasekara', '2025', 'Full', '', '2024-06-15', NULL, 1),
(2, 'BW002', 'Sajith', 'Premadhasa', '2025', 'Full', '', '2024-06-15', NULL, 1),
(3, 'BW003', 'Kasun', 'Kalhara', '2025', 'Half', '', '2024-06-15', NULL, 1),
(4, 'BW004', 'Sugath', 'Silwa', '2025', 'Free', '', '2024-06-15', NULL, 1),
(5, 'BW005', 'Saman', 'Kumara', '2025', 'Full', '', '2024-06-15', NULL, 1),
(6, 'BW006', 'Gamini', 'Fonseka', '2025', 'Free', '', '2024-06-15', NULL, 1),
(7, 'BW007', 'Supun', 'Chinthaka', '2025', 'Free', '', '2024-06-15', NULL, 1),
(8, 'BW008', 'Chamara', 'Sampath', '2025', 'Full', '', '2024-06-15', NULL, 1),
(9, 'BW009', 'Kumara', 'Sangakkara', '2025', 'Half', '', '2024-06-15', NULL, 1),
(11, 'BW010', 'Kanishka', 'Dhananjaya', '2025', 'Half', '', '2024-07-08', NULL, 1),
(12, 'BW011', 'Avishka', 'Kavinda', '2025', 'Half', '', '2024-07-09', NULL, 1),
(13, 'BW012', 'Nuwan', 'Kulasekara', '2025', 'Full', '', '2024-07-09', NULL, 1),
(14, 'BW013', 'Pawan', 'Kumara', '2025', 'Free', '', '2024-07-09', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tutes`
--

CREATE TABLE `tutes` (
  `ID` int(100) NOT NULL,
  `Tute_name` varchar(100) NOT NULL,
  `Class` varchar(20) NOT NULL,
  `Start_date` varchar(100) NOT NULL,
  `Counte` int(50) NOT NULL,
  `Delivered` int(50) NOT NULL,
  `Action` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutes`
--

INSERT INTO `tutes` (`ID`, `Tute_name`, `Class`, `Start_date`, `Counte`, `Delivered`, `Action`) VALUES
(1, 'Organic', '2025', '2024-07-08', 100, 13, 1),
(2, 'Inorganic', '2025', '2024-07-09', 20, 6, 1);

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
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `class_date`
--
ALTER TABLE `class_date`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `class_fees`
--
ALTER TABLE `class_fees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `deliverd_tute`
--
ALTER TABLE `deliverd_tute`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_date`
--
ALTER TABLE `class_date`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_fees`
--
ALTER TABLE `class_fees`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `deliverd_tute`
--
ALTER TABLE `deliverd_tute`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tutes`
--
ALTER TABLE `tutes`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
