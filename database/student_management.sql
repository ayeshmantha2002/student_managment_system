-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 10:21 AM
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
(1, 'Pasindu Madhushan ', 'Soyza', 'pasindu2001', 'OWNER', 'Bandarawela', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', '2024-09-06 10:33:41.074672', '2024-09-06 13:19:38');

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
(4, 'BW043', 'H.P. kalidu Pansilu', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(5, 'BW001', 'Ranidn Lakshan', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(7, 'BW029', 'Keshan Maduhara', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(8, 'BW052', 'Chamalya mishel', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(9, 'BW022', 'Hasith Samudhitha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(10, 'BW007', 'A.J.M Kavindi', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(11, 'BW003', 'Pawan Maduka', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(12, 'BW004', 'Punsisi Maleesha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(13, 'BW005', 'Dhanushi Padmashali', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(14, 'BW006', 'Nalini Priyangika', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(15, 'BW008', 'Thilini Theeksha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(16, 'BW009', 'Kaveesha Nethmi', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(17, 'BW010', 'Kavishka Imesh', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(18, 'BW011', 'Sandali Rathnayake', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(19, 'BW012', 'Sarani Navodya', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(20, 'BW013', 'Chathumini Nirasha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(21, 'BW014', 'Kavya Sandamini', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(22, 'BW015', 'Subodha Madhuwanthi', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(23, 'BW016', 'Eshan Devinda', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(24, 'BW017', 'Manulja Sasmitha silva', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(25, 'BW018', 'Chamika Madhuranga', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(26, 'BW019', 'Ishara Dilruk liyanage', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(27, 'BW020', 'Lakshan Kanchana herath', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(28, 'BW021', 'Chamath Nimsara', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(29, 'BW023', 'Hirusha Sandamina', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(30, 'BW024', 'S.H. Raveesha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(31, 'BW025', 'Sahan Viduranga', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(32, 'BW026', 'Ravindu Shamal', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(33, 'BW027', 'Chanula Pansilu', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(34, 'BW028', 'Ramith Kanishka', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(35, 'BW030', 'Pasindu Jayantha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(36, 'BW031', 'Ashan Sathsara', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(37, 'BW032', 'Gihan Kavshalya', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(38, 'BW033', 'Ishara Oshada', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(39, 'BW034', 'Dineth Anuhas', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(40, 'BW035', 'Deneth Sasiru', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(41, 'BW036', 'Uvindu Pasan', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(42, 'BW037', 'Wagisha Anjula', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(43, 'BW038', 'Pavan Sasanka', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(44, 'BW039', 'Nimesh Umayanga', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(45, 'BW040', 'Mathisha Pravin saranga', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(46, 'BW041', 'Sanidu Thivanka', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(47, 'BW042', 'Himalsha Chinthaka', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(48, 'BW044', 'Sadisha Kaushalya', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(49, 'BW045', 'Pasindu Dilshan', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(50, 'BW046', 'H.M Vidura', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(51, 'BW047', 'Anushka Shalinda', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(52, 'BW048', 'Tharani Buthmali', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(53, 'BW049', 'Binura Nayananga', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(54, 'BW050', 'Sandhali Pahasara', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(55, 'BW051', 'Chathushki Thamasha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(56, 'BW053', 'Yashodha Raveesha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(57, 'BW054', 'Amila Induranga', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(58, 'BW055', 'Anjana Parinda', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(59, 'BW056', 'Hasintha Udayanga', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(60, 'BW057', 'Malinda Priyantha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(61, 'BW058', 'Theekshana Sahan', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(62, 'BW059', 'Rawana Lakshitha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(63, 'BW060', 'Thushan Jeevantha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(64, 'BW061', 'Tharusha Nethmina', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(65, 'BW062', 'Nalinda madhupa Bandara', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(66, 'BW063', 'Kavindu Madhugeeth', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(67, 'BW064', 'Hiruni Wasana', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(68, 'BW065', 'Avishka Sithmal', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(69, 'BW066', 'Manuga Waragoda', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(70, 'BW067', 'Pabodha Matheesha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(71, 'BW068', 'Jasith Fonseka', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(72, 'BW069', 'Apoorwa Chandupa', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(73, 'BW070', 'Danidu Dhananjaya', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(74, 'BW071', 'Rison Nethmira', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(75, 'BW072', 'Cloude desmond Mutil', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(76, 'BW073', 'Dilshadi Sandeepani', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(77, 'BW074', 'Akila kavinda Weerathunga', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(78, 'BW075', 'Ranupa Sathwin', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(79, 'BW076', 'Sachintha Randeepa', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(80, 'BW077', 'Danidu Navodya', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(81, 'BW078', 'Gevidu Kavishka', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(82, 'BW079', 'Visith laksara Rathnayake', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(83, 'BW080', 'Isuru gayan Udayanga', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(84, 'BW081', 'Shenali Theekshana', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(85, 'BW082', 'Adhithaya Prabhath', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(86, 'BW083', 'Dheemantha Prabhashitha', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(87, 'BW084', 'Sahan Pramod', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(88, 'BW085', 'Praneeth Praneeth', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(89, 'BW086', 'Saratha Sanjeewa', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0),
(90, 'BW002', 'Sadeesha Dilshan', '2024', 'T', 'Bandarawela', '2024-09-06', '', 0);

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
(1, 2024),
(2, 2025);

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
(1, '2024', 'Bandarawela', 'T', '2024-09-06');

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
(4, 43, 'BW043', '2024', ' 2024 September ', 'Full', '2024-09-06'),
(6, 29, 'BW029', '2024', ' 2024 September ', 'Full', '2024-09-06'),
(7, 52, 'BW052', '2024', ' 2024 September ', 'Full', '2024-09-06'),
(8, 22, 'BW022', '2024', ' 2024 September ', 'Full', '2024-09-06'),
(9, 7, 'BW007', '2024', ' 2024 September ', 'Full', '2024-09-06');

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
(4, 1, 43, 'BW043', '2024', 'H.P. kalidu Pansilu', '2024-09-06'),
(5, 1, 1, 'BW001', '2024', 'Ranidn Lakshan', '2024-09-06'),
(7, 1, 29, 'BW029', '2024', 'Keshan Maduhara', '2024-09-06'),
(8, 1, 52, 'BW052', '2024', 'Chamalya mishel', '2024-09-06'),
(9, 1, 22, 'BW022', '2024', 'Hasith Samudhitha', '2024-09-06'),
(10, 1, 7, 'BW007', '2024', 'A.J.M Kavindi', '2024-09-06'),
(11, 1, 3, 'BW003', '2024', 'Pawan Maduka', '2024-09-06'),
(12, 1, 4, 'BW004', '2024', 'Punsisi Maleesha', '2024-09-06'),
(13, 1, 5, 'BW005', '2024', 'Dhanushi Padmashali', '2024-09-06'),
(14, 1, 6, 'BW006', '2024', 'Nalini Priyangika', '2024-09-06'),
(15, 1, 8, 'BW008', '2024', 'Thilini Theeksha', '2024-09-06'),
(16, 1, 9, 'BW009', '2024', 'Kaveesha Nethmi', '2024-09-06'),
(17, 1, 10, 'BW010', '2024', 'Kavishka Imesh', '2024-09-06'),
(18, 1, 11, 'BW011', '2024', 'Sandali Rathnayake', '2024-09-06'),
(19, 1, 12, 'BW012', '2024', 'Sarani Navodya', '2024-09-06'),
(20, 1, 13, 'BW013', '2024', 'Chathumini Nirasha', '2024-09-06'),
(21, 1, 14, 'BW014', '2024', 'Kavya Sandamini', '2024-09-06'),
(22, 1, 15, 'BW015', '2024', 'Subodha Madhuwanthi', '2024-09-06'),
(23, 1, 16, 'BW016', '2024', 'Eshan Devinda', '2024-09-06'),
(24, 1, 17, 'BW017', '2024', 'Manulja Sasmitha silva', '2024-09-06'),
(25, 1, 18, 'BW018', '2024', 'Chamika Madhuranga', '2024-09-06'),
(26, 1, 19, 'BW019', '2024', 'Ishara Dilruk liyanage', '2024-09-06'),
(27, 1, 20, 'BW020', '2024', 'Lakshan Kanchana herath', '2024-09-06'),
(28, 1, 21, 'BW021', '2024', 'Chamath Nimsara', '2024-09-06'),
(29, 1, 23, 'BW023', '2024', 'Hirusha Sandamina', '2024-09-06'),
(30, 1, 24, 'BW024', '2024', 'S.H. Raveesha', '2024-09-06'),
(31, 1, 25, 'BW025', '2024', 'Sahan Viduranga', '2024-09-06'),
(32, 1, 26, 'BW026', '2024', 'Ravindu Shamal', '2024-09-06'),
(33, 1, 27, 'BW027', '2024', 'Chanula Pansilu', '2024-09-06'),
(34, 1, 28, 'BW028', '2024', 'Ramith Kanishka', '2024-09-06'),
(35, 1, 30, 'BW030', '2024', 'Pasindu Jayantha', '2024-09-06'),
(36, 1, 31, 'BW031', '2024', 'Ashan Sathsara', '2024-09-06'),
(37, 1, 32, 'BW032', '2024', 'Gihan Kavshalya', '2024-09-06'),
(38, 1, 33, 'BW033', '2024', 'Ishara Oshada', '2024-09-06'),
(39, 1, 34, 'BW034', '2024', 'Dineth Anuhas', '2024-09-06'),
(40, 1, 35, 'BW035', '2024', 'Deneth Sasiru', '2024-09-06'),
(41, 1, 36, 'BW036', '2024', 'Uvindu Pasan', '2024-09-06'),
(42, 1, 37, 'BW037', '2024', 'Wagisha Anjula', '2024-09-06'),
(43, 1, 38, 'BW038', '2024', 'Pavan Sasanka', '2024-09-06'),
(44, 1, 39, 'BW039', '2024', 'Nimesh Umayanga', '2024-09-06'),
(45, 1, 40, 'BW040', '2024', 'Mathisha Pravin saranga', '2024-09-06'),
(46, 1, 41, 'BW041', '2024', 'Sanidu Thivanka', '2024-09-06'),
(47, 1, 42, 'BW042', '2024', 'Himalsha Chinthaka', '2024-09-06'),
(48, 1, 44, 'BW044', '2024', 'Sadisha Kaushalya', '2024-09-06'),
(49, 1, 45, 'BW045', '2024', 'Pasindu Dilshan', '2024-09-06'),
(50, 1, 46, 'BW046', '2024', 'H.M Vidura', '2024-09-06'),
(51, 1, 47, 'BW047', '2024', 'Anushka Shalinda', '2024-09-06'),
(52, 1, 48, 'BW048', '2024', 'Tharani Buthmali', '2024-09-06'),
(53, 1, 49, 'BW049', '2024', 'Binura Nayananga', '2024-09-06'),
(54, 1, 50, 'BW050', '2024', 'Sandhali Pahasara', '2024-09-06'),
(55, 1, 51, 'BW051', '2024', 'Chathushki Thamasha', '2024-09-06'),
(56, 1, 53, 'BW053', '2024', 'Yashodha Raveesha', '2024-09-06'),
(57, 1, 54, 'BW054', '2024', 'Amila Induranga', '2024-09-06'),
(58, 1, 55, 'BW055', '2024', 'Anjana Parinda', '2024-09-06'),
(59, 1, 56, 'BW056', '2024', 'Hasintha Udayanga', '2024-09-06'),
(60, 1, 57, 'BW057', '2024', 'Malinda Priyantha', '2024-09-06'),
(61, 1, 58, 'BW058', '2024', 'Theekshana Sahan', '2024-09-06'),
(62, 1, 59, 'BW059', '2024', 'Rawana Lakshitha', '2024-09-06'),
(63, 1, 60, 'BW060', '2024', 'Thushan Jeevantha', '2024-09-06'),
(64, 1, 61, 'BW061', '2024', 'Tharusha Nethmina', '2024-09-06'),
(65, 1, 62, 'BW062', '2024', 'Nalinda madhupa Bandara', '2024-09-06'),
(66, 1, 63, 'BW063', '2024', 'Kavindu Madhugeeth', '2024-09-06'),
(67, 1, 64, 'BW064', '2024', 'Hiruni Wasana', '2024-09-06'),
(68, 1, 65, 'BW065', '2024', 'Avishka Sithmal', '2024-09-06'),
(69, 1, 66, 'BW066', '2024', 'Manuga Waragoda', '2024-09-06'),
(70, 1, 67, 'BW067', '2024', 'Pabodha Matheesha', '2024-09-06'),
(71, 1, 68, 'BW068', '2024', 'Jasith Fonseka', '2024-09-06'),
(72, 1, 69, 'BW069', '2024', 'Apoorwa Chandupa', '2024-09-06'),
(73, 1, 70, 'BW070', '2024', 'Danidu Dhananjaya', '2024-09-06'),
(74, 1, 71, 'BW071', '2024', 'Rison Nethmira', '2024-09-06'),
(75, 1, 72, 'BW072', '2024', 'Cloude desmond Mutil', '2024-09-06'),
(76, 1, 73, 'BW073', '2024', 'Dilshadi Sandeepani', '2024-09-06'),
(77, 1, 74, 'BW074', '2024', 'Akila kavinda Weerathunga', '2024-09-06'),
(78, 1, 75, 'BW075', '2024', 'Ranupa Sathwin', '2024-09-06'),
(79, 1, 76, 'BW076', '2024', 'Sachintha Randeepa', '2024-09-06'),
(80, 1, 77, 'BW077', '2024', 'Danidu Navodya', '2024-09-06'),
(81, 1, 78, 'BW078', '2024', 'Gevidu Kavishka', '2024-09-06'),
(82, 1, 79, 'BW079', '2024', 'Visith laksara Rathnayake', '2024-09-06'),
(83, 1, 80, 'BW080', '2024', 'Isuru gayan Udayanga', '2024-09-06'),
(84, 1, 81, 'BW081', '2024', 'Shenali Theekshana', '2024-09-06'),
(85, 1, 82, 'BW082', '2024', 'Adhithaya Prabhath', '2024-09-06'),
(86, 1, 83, 'BW083', '2024', 'Dheemantha Prabhashitha', '2024-09-06'),
(87, 1, 84, 'BW084', '2024', 'Sahan Pramod', '2024-09-06'),
(88, 1, 85, 'BW085', '2024', 'Praneeth Praneeth', '2024-09-06'),
(89, 1, 86, 'BW086', '2024', 'Saratha Sanjeewa', '2024-09-06'),
(90, 1, 2, 'BW002', '2024', 'Sadeesha Dilshan', '2024-09-06');

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
(1, 'Bandarawela', 'BW');

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
  `ID_number` varchar(255) DEFAULT NULL,
  `Register_date` varchar(20) NOT NULL,
  `Pro-pic` varchar(255) DEFAULT NULL,
  `Status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `Student_ID`, `First_name`, `Last_name`, `Class`, `Card`, `Phone_number`, `ID_number`, `Register_date`, `Pro-pic`, `Status`) VALUES
(1, 'BW001', 'Ranidu', 'Lakshan', '2024', 'Full', '', '200522803529', '2024-09-06', NULL, 1),
(2, 'BW002', 'Sadeesha', 'Dilshan', '2024', 'Full', '', '200512601572', '2024-09-06', NULL, 1),
(3, 'BW003', 'Pawan', 'Maduka', '2024', 'Full', '', '200509300861', '2024-09-06', NULL, 1),
(4, 'BW004', 'Punsisi', 'Maleesha', '2024', 'Full', '', '200521703707', '2024-09-06', NULL, 1),
(5, 'BW005', 'Dhanushi', 'Padmashali', '2024', 'Full', '', '200465701440', '2024-09-06', NULL, 1),
(6, 'BW006', 'Nalini', 'Priyangika', '2024', 'Full', '', '200369200985', '2024-09-06', NULL, 1),
(7, 'BW007', 'A.J.M', 'Kavindi', '2024', 'Full', '', '200586301910', '2024-09-06', NULL, 1),
(8, 'BW008', 'Thilini', 'Theeksha', '2024', 'Full', '', '200586301910', '2024-09-06', NULL, 1),
(9, 'BW009', 'Kaveesha', 'Nethmi', '2024', 'Full', '', '200555900996', '2024-09-06', NULL, 1),
(10, 'BW010', 'Kavishka', 'Imesh', '2024', 'Full', '', '200513301406', '2024-09-06', NULL, 1),
(11, 'BW011', 'Sandali', 'Rathnayake', '2024', 'Full', '', '200578801866', '2024-09-06', NULL, 1),
(12, 'BW012', 'Sarani', 'Navodya', '2024', 'Full', '', '200477100370', '2024-09-06', NULL, 1),
(13, 'BW013', 'Chathumini', 'Nirasha', '2024', 'Full', '', '200474703999', '2024-09-06', NULL, 1),
(14, 'BW014', 'Kavya', 'Sandamini', '2024', 'Full', '', '200466704214', '2024-09-06', NULL, 1),
(15, 'BW015', 'Subodha', 'Madhuwanthi', '2024', 'Full', '', '200265902777', '2024-09-06', NULL, 1),
(16, 'BW016', 'Eshan', 'Devinda', '2024', 'Full', '', '200435903965', '2024-09-06', NULL, 1),
(17, 'BW017', 'Manulja', 'Sasmitha silva', '2024', 'Full', '', '200500703802', '2024-09-06', NULL, 1),
(18, 'BW018', 'Chamika', 'Madhuranga', '2024', 'Full', '', '200331900919', '2024-09-06', NULL, 1),
(19, 'BW019', 'Ishara', 'Dilruk liyanage', '2024', 'Full', '', '200314713398', '2024-09-06', NULL, 1),
(20, 'BW020', 'Lakshan', 'Kanchana herath', '2024', 'Full', '', '200406511797', '2024-09-06', NULL, 1),
(21, 'BW021', 'Chamath', 'Nimsara', '2024', 'Full', '', '200419201310', '2024-09-06', NULL, 1),
(22, 'BW022', 'Hasith', 'Samudhitha', '2024', 'Full', '', '200407513379', '2024-09-06', NULL, 1),
(23, 'BW023', 'Hirusha', 'Sandamina', '2024', 'Full', '', '200423603486', '2024-09-06', NULL, 1),
(24, 'BW024', 'S.H.', 'Raveesha', '2024', 'Full', '', '200234410340', '2024-09-06', NULL, 1),
(25, 'BW025', 'Sahan', 'Viduranga', '2024', 'Full', '', '200500403776', '2024-09-06', NULL, 1),
(26, 'BW026', 'Ravindu', 'Shamal', '2024', 'Full', '', '2004100703093', '2024-09-06', NULL, 1),
(27, 'BW027', 'Chanula', 'Pansilu', '2024', 'Full', '', '200420500364', '2024-09-06', NULL, 1),
(28, 'BW028', 'Ramith', 'Kanishka', '2024', 'Full', '', '200500703926', '2024-09-06', NULL, 1),
(29, 'BW029', 'Keshan', 'Maduhara', '2024', 'Full', '', '200435602270', '2024-09-06', NULL, 1),
(30, 'BW030', 'Pasindu', 'Jayantha', '2024', 'Full', '', '200418502084', '2024-09-06', NULL, 1),
(31, 'BW031', 'Ashan', 'Sathsara', '2024', 'Full', '', '200435101098', '2024-09-06', NULL, 1),
(32, 'BW032', 'Gihan', 'Kavshalya', '2024', 'Full', '', '200414601573', '2024-09-06', NULL, 1),
(33, 'BW033', 'Ishara', 'Oshada', '2024', 'Full', '', '200429100711', '2024-09-06', NULL, 1),
(34, 'BW034', 'Dineth', 'Anuhas', '2024', 'Full', '', '200408011446', '2024-09-06', NULL, 1),
(35, 'BW035', 'Deneth', 'Sasiru', '2024', 'Full', '', '200500600964', '2024-09-06', NULL, 1),
(36, 'BW036', 'Uvindu', 'Pasan', '2024', 'Full', '', '200409402322', '2024-09-06', NULL, 1),
(37, 'BW037', 'Wagisha', 'Anjula', '2024', 'Full', '', '2005004700321', '2024-09-06', NULL, 1),
(38, 'BW038', 'Pavan', 'Sasanka', '2024', 'Full', '', '200428401264', '2024-09-06', NULL, 1),
(39, 'BW039', 'Nimesh', 'Umayanga', '2024', 'Full', '', '200502003340', '2024-09-06', NULL, 1),
(40, 'BW040', 'Mathisha', 'Pravin saranga', '2024', 'Full', '', '200410114065', '2024-09-06', NULL, 1),
(41, 'BW041', 'Sanidu', 'Thivanka', '2024', 'Full', '', '', '2024-09-06', NULL, 1),
(42, 'BW042', 'Himalsha', 'Chinthaka', '2024', 'Full', '', '', '2024-09-06', NULL, 1),
(43, 'BW043', 'Kalidu', 'Pansilu', '2024', 'Full', '', '', '2024-09-06', NULL, 1),
(44, 'BW044', 'Sadisha', 'Kaushalya', '2024', 'Full', '', '200406211871', '2024-09-06', NULL, 1),
(45, 'BW045', 'Pasindu', 'Dilshan', '2024', 'Full', '', '200410401477', '2024-09-06', NULL, 1),
(46, 'BW046', 'H.M', 'Vidura', '2024', 'Full', '', '220432700430', '2024-09-06', NULL, 1),
(47, 'BW047', 'Anushka', 'Shalinda', '2024', 'Full', '', '200407912161', '2024-09-06', NULL, 1),
(48, 'BW048', 'Tharani', 'Buthmali', '2024', 'Full', '', '200471104018', '2024-09-06', NULL, 1),
(49, 'BW049', 'Binura', 'Nayananga', '2024', 'Full', '', '200429402443', '2024-09-06', NULL, 1),
(50, 'BW050', 'Sandhali', 'Pahasara', '2024', 'Full', '', '200474700663', '2024-09-06', NULL, 1),
(51, 'BW051', 'Chathushki', 'Thamasha', '2024', 'Full', '', '200467001467', '2024-09-06', NULL, 1),
(52, 'BW052', 'Chamalya', 'mishel', '2024', 'Full', '', '200579203763', '2024-09-06', NULL, 1),
(53, 'BW053', 'Yashodha', 'Raveesha', '2024', 'Full', '', '200602602760', '2024-09-06', NULL, 1),
(54, 'BW054', 'Amila', 'Induranga', '2024', 'Full', '', '200504602728', '2024-09-06', NULL, 1),
(55, 'BW055', 'Anjana', 'Parinda', '2024', 'Full', '', '200522400765', '2024-09-06', NULL, 1),
(56, 'BW056', 'Hasintha', 'Udayanga', '2024', 'Full', '', '200603000343', '2024-09-06', NULL, 1),
(57, 'BW057', 'Malinda', 'Priyantha', '2024', 'Full', '', '200503300570', '2024-09-06', NULL, 1),
(58, 'BW058', 'Theekshana', 'Sahan', '2024', 'Full', '', '200600300850', '2024-09-06', NULL, 1),
(59, 'BW059', 'Rawana', 'Lakshitha', '2024', 'Full', '', '200520701092', '2024-09-06', NULL, 1),
(60, 'BW060', 'Thushan', 'Jeevantha', '2024', 'Full', '', '200507201014', '2024-09-06', NULL, 1),
(61, 'BW061', 'Tharusha', 'Nethmina', '2024', 'Full', '', '200524503769', '2024-09-06', NULL, 1),
(62, 'BW062', 'Nalinda madhupa', 'Bandara', '2024', 'Full', '', '200519800846', '2024-09-06', NULL, 1),
(63, 'BW063', 'Kavindu', 'Madhugeeth', '2024', 'Full', '', '200506103017', '2024-09-06', NULL, 1),
(64, 'BW064', 'Hiruni', 'Wasana', '2024', 'Full', '', '', '2024-09-06', NULL, 1),
(65, 'BW065', 'Avishka', 'Sithmal', '2024', 'Full', '', '200412402570', '2024-09-06', NULL, 1),
(66, 'BW066', 'Manuga', 'Waragoda', '2024', 'Full', '', '200508104152', '2024-09-06', NULL, 1),
(67, 'BW067', 'Pabodha', 'Matheesha', '2024', 'Full', '', '200430801808', '2024-09-06', NULL, 1),
(68, 'BW068', 'Jasith', 'Fonseka', '2024', 'Full', '', '200601502700', '2024-09-06', NULL, 1),
(69, 'BW069', 'Apoorwa', 'Chandupa', '2024', 'Full', '', '200506403153', '2024-09-06', NULL, 1),
(70, 'BW070', 'Danidu', 'Dhananjaya', '2024', 'Full', '', '200519600268', '2024-09-06', NULL, 1),
(71, 'BW071', 'Rison', 'Nethmira', '2024', 'Full', '', '200529803407', '2024-09-06', NULL, 1),
(72, 'BW072', 'Cloude desmond', 'Mutil', '2024', 'Full', '', '2005284003583', '2024-09-06', NULL, 1),
(73, 'BW073', 'Dilshadi', 'Sandeepani', '2024', 'Full', '', '200557003880', '2024-09-06', NULL, 1),
(74, 'BW074', 'Akila kavinda', 'Weerathunga', '2024', 'Full', '', '200506403137', '2024-09-06', NULL, 1),
(75, 'BW075', 'Ranupa', 'Sathwin', '2024', 'Full', '', '200505902923', '2024-09-06', NULL, 1),
(76, 'BW076', 'Sachintha', 'Randeepa', '2024', 'Full', '', '200510204384', '2024-09-06', NULL, 1),
(77, 'BW077', 'Danidu', 'Navodya', '2024', 'Full', '', '200518110811', '2024-09-06', NULL, 1),
(78, 'BW078', 'Gevidu', 'Kavishka', '2024', 'Full', '', '200413202670', '2024-09-06', NULL, 1),
(79, 'BW079', 'Visith laksara', 'Rathnayake', '2024', 'Full', '', '200413803653', '2024-09-06', NULL, 1),
(80, 'BW080', 'Isuru gayan', 'Udayanga', '2024', 'Full', '', '200417902960', '2024-09-06', NULL, 1),
(81, 'BW081', 'Shenali', 'Theekshana', '2024', 'Full', '', '200328211489', '2024-09-06', NULL, 1),
(82, 'BW082', 'Adhithaya', 'Prabhath', '2024', 'Full', '', '200327200736', '2024-09-06', NULL, 1),
(83, 'BW083', 'Dheemantha', 'Prabhashitha', '2024', 'Full', '', '200528201213', '2024-09-06', NULL, 1),
(84, 'BW084', 'Sahan', 'Pramod', '2024', 'Full', '', '200504601314', '2024-09-06', NULL, 1),
(85, 'BW085', 'Praneeth', 'Praneeth', '2024', 'Full', '', '', '2024-09-06', NULL, 1),
(86, 'BW086', 'Saratha', 'Sanjeewa', '2024', 'Full', '', '200132202237', '2024-09-06', NULL, 1);

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
(1, 'ගනිත අභ්‍යූන්‍ය', '2024', '2024-09-06', 100, 90, 1);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_date`
--
ALTER TABLE `class_date`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_fees`
--
ALTER TABLE `class_fees`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `deliverd_tute`
--
ALTER TABLE `deliverd_tute`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tutes`
--
ALTER TABLE `tutes`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
