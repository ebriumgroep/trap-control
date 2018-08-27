-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 14, 2018 at 07:04 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

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

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `device_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(10) UNSIGNED NOT NULL,
  `hardware_id` int(11) NOT NULL,
  `token` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`device_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `client_id`, `hardware_id`, `token`, `type`) VALUES
(1, 1, 8, '64', 'Moths'),
(3, 4, 2, '54', 'Moths'),
(5, 4, 15, '46', 'Moths');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `device_id` int(10) UNSIGNED NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  KEY `device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_humid`
--

DROP TABLE IF EXISTS `temp_humid`;
CREATE TABLE IF NOT EXISTS `temp_humid` (
  `th_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `temperature` int(11) NOT NULL,
  `humidity` int(11) NOT NULL,
  `time_stamp` datetime NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`th_id`),
  KEY `device_id_idx` (`device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_humid`
--

INSERT INTO `temp_humid` (`th_id`, `temperature`, `humidity`, `time_stamp`, `device_id`) VALUES
(1, 24, 26, '2018-08-22 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trap_count`
--

DROP TABLE IF EXISTS `trap_count`;
CREATE TABLE IF NOT EXISTS `trap_count` (
  `time_stamp` datetime NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL,
  KEY `device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
