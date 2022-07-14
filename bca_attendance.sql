-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2020 at 12:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bca_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(20) NOT NULL,
  `admin_user_name` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_user_name`, `admin_password`) VALUES
(5, 'admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `attendance_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` enum('Present','Absent') CHARACTER SET latin1 NOT NULL,
  `teacher_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`attendance_id`, `student_id`, `attendance_date`, `attendance_status`, `teacher_id`) VALUES
(11, 5, '2020-05-04', 'Present', 1),
(12, 6, '2020-05-04', 'Present', 1),
(13, 5, '2020-07-21', 'Absent', 3),
(14, 6, '2020-07-21', 'Absent', 3),
(15, 7, '2020-07-21', 'Absent', 3),
(16, 8, '2020-07-21', 'Absent', 3),
(17, 9, '2020-07-21', 'Absent', 3),
(18, 10, '2020-07-21', 'Absent', 3),
(19, 11, '2020-07-21', 'Absent', 3),
(20, 12, '2020-07-21', 'Absent', 3),
(21, 13, '2020-07-21', 'Absent', 3),
(22, 14, '2020-07-21', 'Absent', 3),
(23, 5, '2020-07-20', 'Present', 3),
(24, 6, '2020-07-20', 'Present', 3),
(25, 7, '2020-07-20', 'Present', 3),
(26, 8, '2020-07-20', 'Present', 3),
(27, 9, '2020-07-20', 'Absent', 3),
(28, 10, '2020-07-20', 'Absent', 3),
(29, 11, '2020-07-20', 'Present', 3),
(30, 12, '2020-07-20', 'Present', 3),
(31, 13, '2020-07-20', 'Present', 3),
(32, 14, '2020-07-20', 'Absent', 3);

-- --------------------------------------------------------

--
-- Table structure for table `class_tbl`
--

CREATE TABLE `class_tbl` (
  `class_id` int(20) NOT NULL,
  `class_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_tbl`
--

INSERT INTO `class_tbl` (`class_id`, `class_name`) VALUES
(1, '1 st'),
(2, '2 nd'),
(3, '3 rd'),
(4, '4 th'),
(5, '5 th'),
(6, '6 th');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_roll_no` varchar(100) NOT NULL,
  `student_dob` date NOT NULL,
  `student_class_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `student_name`, `student_roll_no`, `student_dob`, `student_class_id`) VALUES
(5, 'Debajit Das', '1702', '1999-01-15', 6),
(6, 'Riyaj Alam', '1701', '1998-11-18', 6),
(7, 'KAUSHIK KUMAR DEKA', '1703', '1998-05-19', 6),
(8, 'HAFIJUL HOQUE', '1704', '1998-11-17', 6),
(9, 'GOLENUR ISLAM', '1705', '1998-11-15', 6),
(10, 'RAKESH SARMA', '1706', '1998-08-20', 6),
(11, 'HIRAK JYOTI NATH', '1707', '1999-04-07', 6),
(12, 'MD INJAMAMUL HOQUE', '1708', '1998-12-18', 6),
(13, 'MAHARUDDIN', '1709', '1998-06-16', 6),
(14, 'HIRAKJYOTI DEKA', '1710', '1999-04-15', 6),
(15, 'RITUPARNA SARMA', '1801', '1999-05-25', 4),
(16, 'PRAJNAN BARUAH', '1802', '1998-05-19', 4),
(17, 'KAKALI NATH', '1803', '1999-05-13', 4),
(18, 'KAUSHIK MEDHI', '1804', '1998-11-18', 4),
(19, 'PIARUL SAHI ZAMAN', '1805', '1998-11-17', 4),
(20, 'HIRAK JYOTI BANIA', '1806', '1998-11-08', 4),
(21, 'ATIK IKBAL CHAUDHARY', '1807', '1998-11-18', 4),
(22, 'DENISH AZAD CHOUDHORI', '1808', '1998-11-07', 4),
(23, 'NEELAM NIHAR SANDILYA', '1809', '1999-10-15', 4),
(24, 'MIRJANUR RAHMAN', '1810', '1998-05-19', 4),
(25, 'SOHIDUL HUSSAIN KHANDAKAR', '1902', '2000-06-25', 2),
(26, 'ANUBHAV PAL', '1901', '2000-05-22', 2),
(27, 'DHANASRI BORA', '1903', '1999-04-05', 2),
(28, 'NAJMUS SAKIB', '1904', '1998-11-08', 2),
(29, 'MUZAMMIL HOQUE', '1905', '1999-05-25', 2),
(30, 'RUPALIM BHARALI', '1906', '1999-04-28', 2),
(31, 'PRIYAM SAHARIA', '1907', '1998-11-06', 2),
(32, 'PUNAMJIT BRAHMA', '1908', '1998-08-10', 2),
(33, 'SHUVAM SAHA', '1909', '1999-04-15', 2),
(34, 'LAMI AKHTARA KHANAM', '1910', '1999-03-11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tbl`
--

CREATE TABLE `teacher_tbl` (
  `teacher_id` int(20) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `teacher_address` varchar(250) NOT NULL,
  `teacher_qualification` varchar(100) NOT NULL,
  `teacher_doj` date NOT NULL,
  `teacher_emailid` varchar(200) NOT NULL,
  `teacher_password` varchar(250) NOT NULL,
  `teacher_image` varchar(1000) NOT NULL,
  `teacher_class_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_tbl`
--

INSERT INTO `teacher_tbl` (`teacher_id`, `teacher_name`, `teacher_address`, `teacher_qualification`, `teacher_doj`, `teacher_emailid`, `teacher_password`, `teacher_image`, `teacher_class_id`) VALUES
(1, 'Dr. Dipen Nath', 'Sipajhar, DARRANG, ASSAM', 'Phd', '2020-05-03', 'nathdipen@gmail.com', '$2y$10$U0pUFqHGUaAxKA4eFDyhAuy1dXvnYnQfNJjFnaKORkZP4D.OgTEvq', '5eaeaa2826271.jpg', 6),
(2, 'Hiren Deka', 'Mangaldai', 'MCA', '2020-05-04', 'hiren@gmail.com', '$2y$10$xoI4yvk1WIA2h0G7/qa94uTK66gjxRdLTsrtrBWiCiBx42WpeczE6', '5eafe353b74ba.jpg', 4),
(3, 'Deepjyoti Kalita', 'Nagarbera, Kamrup', 'Msc(Computer Science', '2020-05-06', 'deep@gmail.com', '$2y$10$koIXsZW5Vh.gcGjgVPmOc.EsOVH5AKY6N9PJHv35HPFApebbJPlc.', '5eb2753244c60.jpg', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `class_tbl`
--
ALTER TABLE `class_tbl`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `attendance_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `class_tbl`
--
ALTER TABLE `class_tbl`
  MODIFY `class_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  MODIFY `teacher_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
