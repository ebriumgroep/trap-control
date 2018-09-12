-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2018 at 08:22 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erbium`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `full_name`, `username`, `password`, `latitude`, `longitude`) VALUES
(1, 'A', 'abc', '123', 12, '33'),
(2, 'Hulisani Mudimeli', 'hulisani', 'huli', 0, '23.02123'),
(3, 'Anrich Moulder', 'm_anrich', 'anrich', 34.545, '12.34345'),
(4, 'Theané van Rensburg', 'R_theane', 'theane', 23.343, '12.213'),
(5, 's', 'd', '1', NULL, NULL),
(6, 'asd', 'asddfg', 'dfgdfg', NULL, NULL),
(7, 'fullname', 'username', 'password', NULL, NULL),
(8, 'Joy Mudix', 'joy', '123456', NULL, NULL),
(9, 'Mulamuleli', 'mula', '123456', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `device_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `hardware_id` int(11) NOT NULL,
  `token` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `Upload_Interval` varchar(30) NOT NULL DEFAULT 'Once a day'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `client_id`, `hardware_id`, `token`, `type`, `Upload_Interval`) VALUES
(1, 1, 8, '64', 'Moths', 'Once a day'),
(3, 4, 2, '54', 'Moths', 'Once a day'),
(5, 4, 15, '46', 'Moths', 'Once a day'),
(6, 1, 655, '12', 'Moths', 'Once a day'),
(8, 1, 0, '0', 'Moths', 'Five times per day'),
(9, 1, 5677, '0', 'Moths', 'Every hour'),
(10, 1, 56772323, '0', 'Moths', 'Once per day'),
(11, 1, 989890, '0', 'Moths', 'Five times per day'),
(12, 1, 0, '0', '', ''),
(13, 1, 1231231, '0', 'Moths', 'fiveperday'),
(14, 4, 5677, '0', 'Moths', 'onceperday'),
(15, 4, 0, '0', '', 'Everyhour');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `device_id` int(10) UNSIGNED NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_humid`
--

CREATE TABLE `temp_humid` (
  `th_id` int(10) UNSIGNED NOT NULL,
  `temperature` int(11) NOT NULL,
  `humidity` int(11) NOT NULL,
  `time_stamp` datetime NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_humid`
--

INSERT INTO `temp_humid` (`th_id`, `temperature`, `humidity`, `time_stamp`, `device_id`) VALUES
(1, 24, 26, '2018-08-22 00:00:00', 1),
(2, 2, 4, '2018-08-28 16:47:06', 6);

-- --------------------------------------------------------

--
-- Table structure for table `trap_count`
--

CREATE TABLE `trap_count` (
  `time_stamp` datetime NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `temp_humid`
--
ALTER TABLE `temp_humid`
  ADD PRIMARY KEY (`th_id`),
  ADD KEY `device_id_idx` (`device_id`);

--
-- Indexes for table `trap_count`
--
ALTER TABLE `trap_count`
  ADD KEY `device_id` (`device_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `device_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `temp_humid`
--
ALTER TABLE `temp_humid`
  MODIFY `th_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `device_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`);

--
-- Constraints for table `temp_humid`
--
ALTER TABLE `temp_humid`
  ADD CONSTRAINT `temp_humid_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`);

--
-- Constraints for table `trap_count`
--
ALTER TABLE `trap_count`
  ADD CONSTRAINT `trap_count_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
