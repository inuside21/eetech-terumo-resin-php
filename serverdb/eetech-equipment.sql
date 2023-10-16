-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 09:02 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eetech-equipment`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_tbl`
--

CREATE TABLE `area_tbl` (
  `id` int(11) NOT NULL,
  `area_name` varchar(500) NOT NULL,
  `area_oic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area_tbl`
--

INSERT INTO `area_tbl` (`id`, `area_name`, `area_oic`) VALUES
(1, 'Plant 1', 'Plant 1'),
(2, 'Plant 2', 'Plant 2'),
(3, 'Plant 4', 'Plant 4');

-- --------------------------------------------------------

--
-- Table structure for table `device_tbl`
--

CREATE TABLE `device_tbl` (
  `id` int(11) NOT NULL,
  `dev_id` varchar(500) NOT NULL,
  `area_id` int(11) NOT NULL,
  `dev_name` varchar(500) NOT NULL,
  `dev_status` varchar(500) NOT NULL,
  `dev_lastupdate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device_tbl`
--

INSERT INTO `device_tbl` (`id`, `dev_id`, `area_id`, `dev_name`, `dev_status`, `dev_lastupdate`) VALUES
(1, '1', 1, '16 Line', '0', '0'),
(2, '2', 1, 'Barrel Line', '0', '0'),
(3, '3', 1, 'Plunger Line', '0', '0'),
(4, '4', 2, 'A Line', '1', '1664935247'),
(5, '5', 2, 'B Line', '1', '1664935247'),
(6, '6', 2, 'C Line', '1', '1664935247'),
(7, '7', 3, '700 Line', '0', '0'),
(8, '8', 3, '800 Line', '0', '0'),
(9, '9', 3, '1000 & 900 Line', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_tbl`
--
ALTER TABLE `area_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tbl`
--
ALTER TABLE `device_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_tbl`
--
ALTER TABLE `area_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `device_tbl`
--
ALTER TABLE `device_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
