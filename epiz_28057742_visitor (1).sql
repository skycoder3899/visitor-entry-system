-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql108.epizy.com
-- Generation Time: Aug 16, 2021 at 03:12 AM
-- Server version: 5.7.34-37
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_28057742_visitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_basic_tbl`
--

CREATE TABLE `employee_basic_tbl` (
  `data_id` int(10) NOT NULL,
  `e_id` int(10) DEFAULT NULL,
  `employee_title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `working_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `address` longtext CHARACTER SET utf8,
  `id_link` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `photo_link` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `data_status` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `photo_status` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `data_timestamp` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_dept_tbl`
--

CREATE TABLE `employee_dept_tbl` (
  `department_id` int(10) NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `e_id` int(20) NOT NULL,
  `e_stats` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT 'available',
  `salutation` varchar(10) DEFAULT NULL,
  `f_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `l_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `email_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `department_id` int(10) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `email_status` varchar(4) DEFAULT 'void',
  `time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `joining_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_tbl`
--

CREATE TABLE `visitor_tbl` (
  `v_id` int(10) NOT NULL,
  `salutation` varchar(10) DEFAULT NULL,
  `vf_name` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `vl_name` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `vphone` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `vemail_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `purpose` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `host_department_id` int(10) DEFAULT NULL,
  `host_id` int(10) DEFAULT NULL,
  `qrcode` varchar(25) DEFAULT NULL,
  `check_in_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `check_out_time` varchar(50) DEFAULT NULL,
  `date` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_basic_tbl`
--
ALTER TABLE `employee_basic_tbl`
  ADD PRIMARY KEY (`data_id`);

--
-- Indexes for table `employee_dept_tbl`
--
ALTER TABLE `employee_dept_tbl`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`e_id`),
  ADD UNIQUE KEY `u_id_3` (`e_id`),
  ADD UNIQUE KEY `u_id_4` (`e_id`),
  ADD UNIQUE KEY `id` (`e_id`);

--
-- Indexes for table `visitor_tbl`
--
ALTER TABLE `visitor_tbl`
  ADD PRIMARY KEY (`v_id`),
  ADD UNIQUE KEY `u_id_3` (`v_id`),
  ADD UNIQUE KEY `u_id_4` (`v_id`),
  ADD UNIQUE KEY `id` (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_basic_tbl`
--
ALTER TABLE `employee_basic_tbl`
  MODIFY `data_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `e_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_tbl`
--
ALTER TABLE `visitor_tbl`
  MODIFY `v_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
