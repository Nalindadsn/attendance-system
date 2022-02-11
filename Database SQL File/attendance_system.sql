-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2022 at 11:11 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `mark` int(5) NOT NULL,
  `remark` varchar(400) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `subject_id`, `student_id`, `name`, `mark`, `remark`, `created_at`) VALUES
(1, 33, 2, 'test name', 77, 'rem', '2022-02-07 06:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(6) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `name`, `year`, `type`) VALUES
(1, 'ACC', 2020, 'P'),
(2, 'IT', 2022, 'F'),
(3, 't', 3333, 'f'),
(4, '4', 4444, 'p'),
(5, 'ii', 5555, 'Full Time'),
(6, 'AT', 2022, 'Full Time');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `reson` varchar(400) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `student_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_no`, `reson`, `amount`, `created_at`, `student_id`, `name`) VALUES
(6, '1', '3', 4, '2022-02-07 08:00:25', 2, ''),
(8, 'PMS Premasiri', '33', 3, '2022-02-07 08:01:25', 3, ''),
(9, '111', '333', 444, '2022-02-07 08:02:32', 2, ''),
(10, '2', '2', 2, '2022-02-07 15:16:01', 2, ''),
(12, 'nalinda', 'jhkjhk', 6, '2022-02-10 01:49:44', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `sas_attendance`
--

CREATE TABLE `sas_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` enum('present','absent','late','half_day') NOT NULL,
  `attendance_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sas_attendance`
--

INSERT INTO `sas_attendance` (`attendance_id`, `student_id`, `class_id`, `subject_id`, `status`, `attendance_date`) VALUES
(351, 11, 35, 0, 'present', '2022/02/11'),
(352, 10, 35, 0, 'present', '2022/02/11'),
(353, 9, 35, 0, 'present', '2022/02/11'),
(354, 8, 35, 0, 'absent', '2022/02/11'),
(355, 5, 35, 0, 'present', '2022/02/11'),
(356, 4, 35, 0, 'absent', '2022/02/11'),
(357, 3, 35, 0, 'present', '2022/02/11'),
(358, 2, 35, 0, 'absent', '2022/02/11'),
(359, 11, 38, 0, 'absent', '2022/02/11'),
(360, 10, 38, 0, 'absent', '2022/02/11'),
(361, 9, 38, 0, 'present', '2022/02/11'),
(362, 8, 38, 0, 'absent', '2022/02/11'),
(363, 5, 38, 0, 'present', '2022/02/11'),
(364, 4, 38, 0, 'absent', '2022/02/11'),
(365, 3, 38, 0, 'late', '2022/02/11'),
(366, 11, 43, 0, 'present', '2022/02/11'),
(367, 10, 43, 0, 'absent', '2022/02/11'),
(368, 9, 43, 0, 'late', '2022/02/11'),
(369, 8, 43, 0, 'half_day', '2022/02/11'),
(370, 5, 43, 0, 'late', '2022/02/11'),
(371, 4, 43, 0, 'absent', '2022/02/11'),
(372, 3, 43, 0, 'present', '2022/02/11');

-- --------------------------------------------------------

--
-- Table structure for table `sas_attendance_b`
--

CREATE TABLE `sas_attendance_b` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `attendance_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sas_classes`
--

CREATE TABLE `sas_classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sas_classes`
--

INSERT INTO `sas_classes` (`id`, `name`, `teacher_id`, `batch_id`) VALUES
(33, 'First', 1, 1),
(34, 'Second', 1, 1),
(35, 'Third', 1, 2),
(38, 'Fourth', 1, 2),
(39, 'test', 2, 1),
(40, 'y', 2, 1),
(41, 'oop', 1, 1),
(42, 'test', 1, 3),
(43, 'PCA', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sas_students`
--

CREATE TABLE `sas_students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `dob` date NOT NULL,
  `photo` varchar(40) DEFAULT NULL,
  `mobile` int(10) UNSIGNED NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `current_address` varchar(40) DEFAULT NULL,
  `permanent_address` varchar(40) DEFAULT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_mobile` int(10) UNSIGNED NOT NULL,
  `father_occupation` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `mother_mobile` int(10) UNSIGNED NOT NULL,
  `admission_no` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `stream` int(10) UNSIGNED DEFAULT NULL,
  `admission_date` datetime NOT NULL,
  `academic_year` int(10) UNSIGNED NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sas_students`
--

INSERT INTO `sas_students` (`id`, `name`, `gender`, `dob`, `photo`, `mobile`, `email`, `current_address`, `permanent_address`, `father_name`, `father_mobile`, `father_occupation`, `mother_name`, `mother_mobile`, `admission_no`, `roll_no`, `stream`, `admission_date`, `academic_year`, `class`) VALUES
(2, 'Jhon', 'male', '2001-11-13', '1582017489image12.jpg', 1234567890, 'Jhon@gmail.com', '133, A Block, New Street, London, UK', '133, A Block, New Street, London, UK', 'David', 1234567890, 'Farmer', 'Rose', 1234567890, 123456789, 1, NULL, '2020-03-15 00:00:00', 2020, 5),
(3, 'Smith', 'male', '2002-03-03', '1582091940bg.jpg', 4294967295, 'test@gmail.com', 'test blk tst tst tst', NULL, 'test', 0, '', 'testing', 0, 2, 2, NULL, '2020-03-15 00:00:00', 2020, 2),
(4, 'Foster', 'Male', '2003-03-10', NULL, 0, 'asd@phpzag.comm', NULL, NULL, '', 0, '', '', 0, 0, 3, NULL, '2020-03-15 00:00:00', 2020, 2),
(5, 'Damein', 'Male', '2001-03-03', NULL, 0, NULL, NULL, NULL, '', 0, '', '', 0, 0, 4, NULL, '2020-03-15 00:00:00', 2020, 2),
(8, 'Andy', 'male', '2021-11-14', NULL, 1234567890, 'asd@phpzag.com', 'dsdgsd', 'dsdgsd', 'dfsdf', 0, '', 'sdfsdf', 0, 0, 464634, NULL, '0000-00-00 00:00:00', 2022, 2),
(9, 'test', 'male', '2022-02-08', NULL, 4546446, 'admin@gmail.com', 'q', 'q', 'q', 0, '', 'q', 0, 0, 3, NULL, '0000-00-00 00:00:00', 2020, 2),
(10, 'test', 'male', '2022-02-10', NULL, 4546446, 'nalindadsn@gmail.com', 'cr', 'pr', '', 0, '', '', 0, 0, 44, NULL, '0000-00-00 00:00:00', 2020, 2),
(11, 'test1', 'female', '2022-02-09', NULL, 4546446, 'nalindadsnn@gmail.com', 'ccc', 'ddd', '', 0, '', '', 0, 0, 55, NULL, '0000-00-00 00:00:00', 2021, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sas_user`
--

CREATE TABLE `sas_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` enum('active','pending','deleted','') NOT NULL DEFAULT 'pending',
  `role` enum('administrator','teacher','student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sas_user`
--

INSERT INTO `sas_user` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `mobile`, `status`, `role`) VALUES
(1, 'Kane s', 'William', 'kw@coderszine.com', '202cb962ac59075b964b07152d234b70', '', '41242142', 'active', 'teacher'),
(2, 'Jhony', 'Rhodes', 'jhonty@coderszine.com', '202cb962ac59075b964b07152d234b70', 'male', '41242142', 'active', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sas_attendance`
--
ALTER TABLE `sas_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `sas_attendance_b`
--
ALTER TABLE `sas_attendance_b`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `sas_classes`
--
ALTER TABLE `sas_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sas_students`
--
ALTER TABLE `sas_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sas_user`
--
ALTER TABLE `sas_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sas_attendance`
--
ALTER TABLE `sas_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT for table `sas_attendance_b`
--
ALTER TABLE `sas_attendance_b`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sas_classes`
--
ALTER TABLE `sas_classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `sas_students`
--
ALTER TABLE `sas_students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sas_user`
--
ALTER TABLE `sas_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
