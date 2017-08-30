-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2017 at 09:20 PM
-- Server version: 5.5.57-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystudyc_adapt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_owner_details`
--

CREATE TABLE `tbl_sms_owner_details` (
  `sod_id` int(11) NOT NULL,
  `sod_tracking_order_id` varchar(100) NOT NULL,
  `sod_user_owner_id` int(11) NOT NULL,
  `sod_package_id` int(11) NOT NULL,
  `sod_startdt` date NOT NULL,
  `sod_enddt` date NOT NULL,
  `sod_num_of_sms` int(11) NOT NULL,
  `sod_expiry_days` int(11) NOT NULL,
  `sod_activity_flag` tinyint(4) NOT NULL,
  `sod_comment` varchar(255) NOT NULL,
  `sod_createddt` datetime NOT NULL,
  `sod_createdby` varchar(50) NOT NULL,
  `sod_modifieddt` datetime NOT NULL,
  `sod_modifiedby` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sms_owner_details`
--

INSERT INTO `tbl_sms_owner_details` (`sod_id`, `sod_tracking_order_id`, `sod_user_owner_id`, `sod_package_id`, `sod_startdt`, `sod_enddt`, `sod_num_of_sms`, `sod_expiry_days`, `sod_activity_flag`, `sod_comment`, `sod_createddt`, `sod_createdby`, `sod_modifieddt`, `sod_modifiedby`) VALUES
(2, 'offline', 37, 1, '2015-01-31', '2015-02-14', 1000, 30, 0, '', '2015-01-15 16:35:36', 'Ashima', '0000-00-00 00:00:00', ''),
(18, 'offline', 5, 1, '2015-01-16', '2015-02-15', 1000, 30, 0, '', '2015-01-16 14:23:29', 'Ashima', '0000-00-00 00:00:00', ''),
(19, 'offline', 5, 1, '2015-02-15', '2015-03-17', 2000, 60, 0, '', '2015-01-16 14:24:47', 'Ashima', '0000-00-00 00:00:00', ''),
(20, 'offline', 8, 1, '2015-01-16', '2015-02-15', 1000, 30, 0, '', '2015-01-16 14:30:05', 'Ashima', '0000-00-00 00:00:00', ''),
(21, 'offline', 1, 1, '2015-01-16', '2015-02-15', 1000, 30, 0, '', '2015-01-16 14:33:26', 'Ashima', '0000-00-00 00:00:00', ''),
(22, 'offline', 6, 1, '2015-01-23', '2015-02-22', 1000, 30, 0, '', '2015-01-23 14:44:30', 'Ashima', '0000-00-00 00:00:00', ''),
(23, 'offline', 6, 1, '2015-02-22', '2015-03-24', 2000, 60, 0, '', '2015-01-23 15:02:13', 'Ashima', '0000-00-00 00:00:00', ''),
(24, 'offline', 7, 1, '2015-01-23', '2015-02-22', 1000, 30, 0, '', '2015-01-23 15:52:57', 'Ashima', '0000-00-00 00:00:00', ''),
(25, 'offline', 8, 1, '2015-01-23', '2015-02-22', 1000, 30, 0, '', '2015-01-23 15:56:19', 'Ashima', '0000-00-00 00:00:00', ''),
(26, 'offline', 9, 1, '2015-01-23', '2015-02-22', 1000, 30, 0, '', '2015-01-23 16:08:01', 'Ashima', '0000-00-00 00:00:00', ''),
(27, 'offline', 3, 1, '2015-01-24', '2015-02-23', 1000, 30, 0, '', '2015-01-24 10:09:30', 'Ashima', '0000-00-00 00:00:00', ''),
(28, 'offline', 41, 9, '2015-02-19', '2015-04-20', 2000, 60, 0, '', '2015-02-18 17:46:43', 'Ashima', '0000-00-00 00:00:00', ''),
(29, 'offline', 2, 12, '2015-07-20', '2016-05-09', 239, 365, 0, '', '2015-07-20 15:55:20', 'Ashima', '2016-04-09 00:15:56', ''),
(30, 'offline', 21, 11, '2015-07-20', '2016-07-19', 1500, 365, 0, '', '2015-07-20 15:56:36', 'Ashima', '0000-00-00 00:00:00', ''),
(31, 'offline', 1, 11, '2015-07-30', '2016-07-29', 1992, 365, 0, '', '2015-07-30 12:13:00', 'Ashima', '0000-00-00 00:00:00', ''),
(32, 'offline', 37, 11, '2015-08-05', '2016-08-04', 2000, 365, 0, '', '2015-08-05 10:12:42', 'Ashima', '0000-00-00 00:00:00', ''),
(33, 'offline', 42, 13, '2015-09-14', '2015-10-14', 5000, 30, 0, '', '2015-09-12 01:45:32', 'Ashima', '0000-00-00 00:00:00', ''),
(34, 'offline', 43, 11, '2015-09-23', '2016-09-22', 1000, 365, 0, '', '2015-09-16 02:35:38', 'Super Admin Test', '0000-00-00 00:00:00', ''),
(35, 'offline', 44, 12, '2015-09-21', '2016-09-20', 8999, 365, 0, '', '2015-09-21 00:02:25', 'Super Admin Test', '2015-09-21 04:56:20', ''),
(36, 'offline', 39, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:30:21', 'Ashima', '0000-00-00 00:00:00', ''),
(37, 'offline', 36, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:35:04', 'Ashima', '0000-00-00 00:00:00', ''),
(38, 'offline', 34, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:37:16', 'Ashima', '0000-00-00 00:00:00', ''),
(39, 'offline', 33, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:38:49', 'Ashima', '0000-00-00 00:00:00', ''),
(40, 'offline', 32, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:39:38', 'Ashima', '0000-00-00 00:00:00', ''),
(41, 'offline', 31, 15, '2015-10-16', '2016-10-15', 1474, 365, 0, '', '2015-10-16 00:40:33', 'Ashima', '2015-12-21 01:59:15', ''),
(42, 'offline', 30, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:41:14', 'Ashima', '0000-00-00 00:00:00', ''),
(43, 'offline', 29, 15, '2015-10-16', '2016-10-15', 1451, 365, 0, '', '2015-10-16 00:42:06', 'Ashima', '2015-12-18 05:43:00', ''),
(44, 'offline', 28, 15, '2015-10-16', '2016-10-15', 1498, 365, 0, '', '2015-10-16 00:46:19', 'Ashima', '0000-00-00 00:00:00', ''),
(45, 'offline', 23, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:47:03', 'Ashima', '0000-00-00 00:00:00', ''),
(46, 'offline', 22, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:47:43', 'Ashima', '0000-00-00 00:00:00', ''),
(47, 'offline', 18, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:49:14', 'Ashima', '0000-00-00 00:00:00', ''),
(48, 'offline', 47, 15, '2015-10-16', '2016-10-15', 1500, 365, 0, '', '2015-10-16 00:50:05', 'Ashima', '0000-00-00 00:00:00', ''),
(49, 'offline', 2, 16, '2016-05-09', '2017-08-31', 815, 281, 0, 'please delete 38 sms for mmo', '2016-04-09 09:02:09', 'Ashima', '2017-06-10 17:58:59', ''),
(50, 'offline', 51, 16, '2016-07-28', '2017-01-24', 15000, 180, 0, '', '2016-07-28 02:03:19', 'Super Admin Test', '0000-00-00 00:00:00', ''),
(51, 'offline', 2, 13, '2017-01-10', '2017-02-16', 1205, 35, 0, '', '2017-01-10 16:53:37', 'Super Admin Test', '2017-02-15 16:09:19', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_sms_owner_details`
--
ALTER TABLE `tbl_sms_owner_details`
  ADD PRIMARY KEY (`sod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_sms_owner_details`
--
ALTER TABLE `tbl_sms_owner_details`
  MODIFY `sod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
