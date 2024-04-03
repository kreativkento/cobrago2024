-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql8002.site4now.net
-- Generation Time: Dec 10, 2023 at 04:00 PM
-- Server version: 8.0.29
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aa0151_cobrago`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `admin_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `admin_pass` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `admin_firstname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `admin_lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`admin_id`, `admin_pass`, `admin_firstname`, `admin_lastname`, `admin_email`) VALUES
('admin', 'admin', 'TEST', 'ACCOUNT', 'testaccount'),
('admin-00', 'admin', 'KENT', 'VELOSO', 'kebe.veloso.swu@phinmaed.com');

-- --------------------------------------------------------

--
-- Table structure for table `college_course`
--

CREATE TABLE `college_course` (
  `course_code` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `dept_code` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `college_course`
--

INSERT INTO `college_course` (`course_code`, `course`, `dept_code`) VALUES
('ads', 'ads', 'CN'),
('BA Comm', 'Communication', 'SDC'),
('BArch', 'Architecture', 'SDC'),
('BBA', 'Business Administration', 'SB'),
('BFA', 'Fine Arts', 'SDC'),
('BSA', 'Accountancy', 'SB'),
('BSHM', 'Hospitality Management', 'SB'),
('BSIT', 'Information Technology', 'CIT'),
('BSMT', 'Medical Technology', 'CMT'),
('BSN', 'Nursing', 'CN'),
('BSOT', 'Occupational Therapy', 'CRS'),
('BSP', 'Psychology', 'CPM'),
('BSPT', 'Physical Therapy', 'CRS'),
('BSRT', 'Radiologic Technology', 'CRT'),
('DMD', 'Dentistry', 'CD'),
('DVM', 'Veterinary Medicine', 'CVM'),
('MD', 'Medicine', 'CM'),
('OD', 'Optometry', 'CO');

-- --------------------------------------------------------

--
-- Table structure for table `college_department`
--

CREATE TABLE `college_department` (
  `dept_code` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `dept_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `dean_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `college_department`
--

INSERT INTO `college_department` (`dept_code`, `dept_name`, `dean_id`) VALUES
('123', '123', 'dean-03'),
('CD', 'College of Dentistry', 'dean-01'),
('CIT', 'College of Information Technology', 'dean-02'),
('cite', 'Infotech', 'cite'),
('CM', 'College of Medicine', 'dean-03'),
('CMT', 'College of Medical Technology', 'dean-04'),
('CN', 'College of Nursing', 'dean-05'),
('CO', 'College of Optometry', 'dean-06'),
('CPM', 'College of Pre-Medicine', 'dean-07'),
('CRS', 'College of Rehabilitation Science', 'dean-08'),
('CRT', 'College of Radiologic Technology', 'dean-09'),
('CVM', 'College of Veterinary Medicine', 'dean-10'),
('edited', 'edited', 'dean-05'),
('sample', 'sample', 'cite'),
('SB', 'School of Business', 'dean-11'),
('SDC', 'School of Design and Communication', 'dean-12');

-- --------------------------------------------------------

--
-- Table structure for table `dean_account`
--

CREATE TABLE `dean_account` (
  `dean_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `dean_pass` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `dean_firstname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `dean_lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `dean_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dean_account`
--

INSERT INTO `dean_account` (`dean_id`, `dean_pass`, `dean_firstname`, `dean_lastname`, `dean_email`) VALUES
('cite', '1234', 'Desiree', 'Perreras', '123@gmail.com'),
('dean-01', 'dean01', 'CD', 'MANGO', 'swu.cd.mango@phinmaed.com'),
('dean-02', 'dean02', 'CIT', 'COCONUT', 'swu.cit.coconut@phinmaed.com'),
('dean-03', 'dean03', 'CM', 'MANGO', 'swu.cm.mango@phinmaed.com'),
('dean-04', 'dean04', 'CMT', 'SUGARCANE', 'swu.cmt.sugarcane@phinmaed.com'),
('dean-05', 'dean05', 'CN', 'CASHEW', 'swu.cn.cashew@phinmaed.com'),
('dean-06', 'dean06', 'CO', 'PAPAYA', 'swu.co.papaya@phinmaed.com'),
('dean-07', 'dean07', 'CPM', 'BANANAS', 'swu.cpm.bananas@phinmaed.com'),
('dean-08', 'dean08', 'CRS', 'PILI', 'swu.crs.pili@phinmaed.com'),
('dean-09', 'dean09', 'CRT', 'STRAWBERRY', 'swu.crt.strawberry@phinmaed.com'),
('dean-10', 'dean10', 'CVM', 'CAMOTE', 'swu.cvm.camote@phinmaed.com'),
('dean-11', 'dean11', 'SB', 'LANSONES', 'swu.sb.lansones@phinmaed.com'),
('dean-12', 'dean12', 'SDC', 'TAMARIND', 'swu.sdc.tamarind@phinmaed.com'),
('dean-13', 'dean13', 'SOE', 'DRAGONFRUIT', 'swu.soe.dragonfruit@phinmaed.com');

-- --------------------------------------------------------

--
-- Table structure for table `doc_request`
--

CREATE TABLE `doc_request` (
  `id` int NOT NULL,
  `track_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `student_id` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `file_orf` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `file_id` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `copies` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `purpose` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int NOT NULL,
  `dt_request` datetime NOT NULL,
  `file_pay` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `status_pay` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_finance` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_payment` datetime DEFAULT NULL,
  `auth_dean` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_dean` datetime DEFAULT NULL,
  `auth_go` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_go` datetime DEFAULT NULL,
  `auth_sl` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_sl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doc_request`
--

INSERT INTO `doc_request` (`id`, `track_id`, `student_id`, `file_orf`, `file_id`, `copies`, `purpose`, `status_id`, `dt_request`, `file_pay`, `status_pay`, `auth_finance`, `dt_payment`, `auth_dean`, `dt_dean`, `auth_go`, `dt_go`, `auth_sl`, `dt_sl`) VALUES
(13, 'GM_13', '05-2324-008370', 'temp_path', 'temp_path', '2', '0', 4, '2023-12-06 17:11:23', NULL, 'NP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'GM_14', '05-2324-008370', 'temp_path', 'temp_path', '1', '123', 4, '2023-12-06 17:27:37', NULL, 'NP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'GM_15', '05-1819-000127', 'temp_path', 'temp_path', '2', '0', 2, '2023-12-06 23:52:29', NULL, 'NP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `finance_account`
--

CREATE TABLE `finance_account` (
  `fin_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `fin_pass` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `fin_firstname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `fin_lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `fin_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finance_account`
--

INSERT INTO `finance_account` (`fin_id`, `fin_pass`, `fin_firstname`, `fin_lastname`, `fin_email`) VALUES
('fin00', 'fin', 'KENT', 'VELOSO', 'kebe.veloso.swu@phinmaed.com');

-- --------------------------------------------------------

--
-- Table structure for table `guidance_account`
--

CREATE TABLE `guidance_account` (
  `go_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `go_pass` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `go_firstname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `go_lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `go_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guidance_account`
--

INSERT INTO `guidance_account` (`go_id`, `go_pass`, `go_firstname`, `go_lastname`, `go_email`) VALUES
('GO-00', 'GO', 'KENT', 'VELOSO', 'kebe.veloso.swu@phinmaed.com');

-- --------------------------------------------------------

--
-- Table structure for table `payment_request`
--

CREATE TABLE `payment_request` (
  `id` int NOT NULL,
  `track_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `receipt` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_submit` datetime NOT NULL,
  `valid` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_request`
--

INSERT INTO `payment_request` (`id`, `track_id`, `student_id`, `receipt`, `date_submit`, `valid`) VALUES
(1, 'GM_1', '05-2324-008370', 'image path', '2023-12-06 12:52:23', 'YES'),
(2, '', '05-2324-008370', 'image path', '2023-12-06 12:52:35', 'NO'),
(3, 'GM_2', '05-2324-008370', 'image path', '2023-12-06 12:58:59', 'YES'),
(4, 'gm_2', '05-2324-008370', 'image path', '2023-12-06 13:03:26', 'YES'),
(5, 'asd', '05-2324-008370', 'image path', '2023-12-06 13:12:35', '--'),
(6, 'GM_15', '05-1819-000127', 'image path', '2023-12-06 23:56:30', '--');

-- --------------------------------------------------------

--
-- Table structure for table `sl_account`
--

CREATE TABLE `sl_account` (
  `sl_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `sl_pass` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `sl_firstname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `sl_lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `sl_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sl_account`
--

INSERT INTO `sl_account` (`sl_id`, `sl_pass`, `sl_firstname`, `sl_lastname`, `sl_email`) VALUES
('SL-00', 'SL', 'KENT', 'VELOSO', 'kebe.veloso.swu@phinmaed.com');

-- --------------------------------------------------------

--
-- Table structure for table `status_payment`
--

CREATE TABLE `status_payment` (
  `status_id` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `status_name` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status_payment`
--

INSERT INTO `status_payment` (`status_id`, `status_name`) VALUES
('FV', 'For Validation'),
('NP', 'Not Paid'),
('PD', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `status_update`
--

CREATE TABLE `status_update` (
  `status_id` int NOT NULL,
  `status_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `status_color` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status_update`
--

INSERT INTO `status_update` (`status_id`, `status_name`, `status_color`) VALUES
(1, 'Pending', '#4856FF'),
(2, 'College Department', '#FF9F23'),
(3, 'Talk to Dean', '#FF2323'),
(4, 'Payment', '#FCFF23'),
(5, 'Payment Error', '#FF2323'),
(6, 'Guidance Office', '#F822FF'),
(7, 'Talk to Guidance', '#FF2323'),
(8, 'For Releasing', '#48FF23'),
(9, 'Completed', '#B6B6B6');

-- --------------------------------------------------------

--
-- Table structure for table `student_account`
--

CREATE TABLE `student_account` (
  `student_id` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `course_code` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `year_level` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `verification` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_account`
--

INSERT INTO `student_account` (`student_id`, `password`, `last_name`, `first_name`, `middle_name`, `email`, `phone_no`, `course_code`, `year_level`, `verification`) VALUES
('05-0000-123456', '1234', 'lastname', 'firstname', 'middlename', 'asd@email.com', '1234', 'OD', '2nd', 'VALID'),
('05-1111-111111', '1234', 'last', 'first', 'mid', 'email@email.comm', '1234', 'BFA', '1st', 'VALID'),
('05-1819-000127', '1234', 'DESTURA', 'JIMUEL', 'LUMACANG', 'jimdestura08@gmail.com', '1234', 'OD', '6th', 'VALID'),
('05-2324-008370', 'password', 'VELOSO', 'KENT', 'BELTRAN', 'kentveloso11@gmail.com', '09254526262', 'BSRT', '2nd', 'VALID'),
('22-2222-222222', '1234', 'NAME', 'NAME', 'NAME', 'email@email.com', '1234', 'OD', '2nd', 'VALID'),
('33-3333-333333', '1234', 'NAME', 'NAME', 'NAME', 'emailad@gmail.com', '1234', 'OD', '2nd', 'VALID'),
('44-4444-444444', '1234', 'NAME', 'NAME', 'NAME', 'name', '1234', 'BSIT', '2nd', 'DENIED'),
('88-8888-888888', 'asd', 'ASD', 'ASD', 'ASD', 'asd', 'asd', 'BSN', '5th', 'DENIED'),
('99-7777-888888', '123', 'ASD', 'ASD', 'ASD', 'asd', '123', 'BSN', '1st', 'DENIED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `college_course`
--
ALTER TABLE `college_course`
  ADD PRIMARY KEY (`course_code`),
  ADD KEY `dept_code` (`dept_code`);

--
-- Indexes for table `college_department`
--
ALTER TABLE `college_department`
  ADD PRIMARY KEY (`dept_code`),
  ADD KEY `dean1_id_fk` (`dean_id`);

--
-- Indexes for table `dean_account`
--
ALTER TABLE `dean_account`
  ADD PRIMARY KEY (`dean_id`);

--
-- Indexes for table `doc_request`
--
ALTER TABLE `doc_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `auth_finance` (`auth_finance`,`auth_dean`,`auth_go`,`auth_sl`),
  ADD KEY `status_pay` (`status_pay`),
  ADD KEY `auth_dean` (`auth_dean`),
  ADD KEY `auth_go` (`auth_go`),
  ADD KEY `auth_sl` (`auth_sl`);

--
-- Indexes for table `finance_account`
--
ALTER TABLE `finance_account`
  ADD PRIMARY KEY (`fin_id`);

--
-- Indexes for table `guidance_account`
--
ALTER TABLE `guidance_account`
  ADD PRIMARY KEY (`go_id`);

--
-- Indexes for table `payment_request`
--
ALTER TABLE `payment_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sl_account`
--
ALTER TABLE `sl_account`
  ADD PRIMARY KEY (`sl_id`);

--
-- Indexes for table `status_payment`
--
ALTER TABLE `status_payment`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `status_update`
--
ALTER TABLE `status_update`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `student_account`
--
ALTER TABLE `student_account`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `course_code_fk` (`course_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc_request`
--
ALTER TABLE `doc_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `college_course`
--
ALTER TABLE `college_course`
  ADD CONSTRAINT `fk_dept_code` FOREIGN KEY (`dept_code`) REFERENCES `college_department` (`dept_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `college_department`
--
ALTER TABLE `college_department`
  ADD CONSTRAINT `college_department_ibfk_1` FOREIGN KEY (`dean_id`) REFERENCES `dean_account` (`dean_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doc_request`
--
ALTER TABLE `doc_request`
  ADD CONSTRAINT `doc_request_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status_update` (`status_id`),
  ADD CONSTRAINT `doc_request_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_account` (`student_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `doc_request_ibfk_3` FOREIGN KEY (`auth_dean`) REFERENCES `dean_account` (`dean_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `doc_request_ibfk_4` FOREIGN KEY (`auth_go`) REFERENCES `guidance_account` (`go_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `doc_request_ibfk_5` FOREIGN KEY (`auth_sl`) REFERENCES `sl_account` (`sl_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `doc_request_ibfk_6` FOREIGN KEY (`status_pay`) REFERENCES `status_payment` (`status_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `doc_request_ibfk_7` FOREIGN KEY (`auth_finance`) REFERENCES `finance_account` (`fin_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `student_account`
--
ALTER TABLE `student_account`
  ADD CONSTRAINT `student_account_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `college_course` (`course_code`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
