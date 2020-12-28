-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 06:01 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employ`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `cat` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `cat`, `email`, `phone`) VALUES
(1, 'vb', 'HR', 'prateekkesharwani1@gmail.com', '07890 471954'),
(5, 'Prateek', 'CEO', 'prateekkesharwani1@gmail.com', '7890471954'),
(6, 'zhong', 'HR', 'prateekkesharwani1@gmail.com', '8017448318');

-- --------------------------------------------------------

--
-- Table structure for table `entery`
--

CREATE TABLE `entery` (
  `enteryid` int(20) NOT NULL,
  `vname` varchar(45) NOT NULL,
  `vgender` varchar(10) NOT NULL,
  `vphone` varchar(13) NOT NULL,
  `vemail` varchar(45) NOT NULL,
  `cat` varchar(25) NOT NULL,
  `intime` varchar(30) NOT NULL,
  `vpurpose` varchar(120) NOT NULL,
  `host` varchar(35) NOT NULL,
  `outtime` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entery`
--

INSERT INTO `entery` (`enteryid`, `vname`, `vgender`, `vphone`, `vemail`, `cat`, `intime`, `vpurpose`, `host`, `outtime`) VALUES
(21, 'Prateek Kesharwani', 'male', '7890471954', 'prateekkesharwani1@gmail.com', 'HR', '20:58', 'ijiojin nini', 'zhong', ''),
(22, 'Prateek Kesharwani', 'male', '07890471954', 'prateekkesharwani1@gmail.com', '5', '15:00', 'p[k[k', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entery`
--
ALTER TABLE `entery`
  ADD PRIMARY KEY (`enteryid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `entery`
--
ALTER TABLE `entery`
  MODIFY `enteryid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
