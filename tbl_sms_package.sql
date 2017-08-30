-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2017 at 09:12 PM
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
-- Table structure for table `tbl_sms_package`
--

CREATE TABLE `tbl_sms_package` (
  `sp_id` int(10) NOT NULL,
  `sp_package_name` varchar(50) NOT NULL,
  `sp_num_sms` int(50) NOT NULL,
  `sp_mrp` varchar(50) NOT NULL,
  `sp_validity` varchar(50) NOT NULL,
  `sp_sms_per_rupee` varchar(50) NOT NULL,
  `createdby` varchar(50) NOT NULL,
  `createddt` date NOT NULL,
  `modifiedby` varchar(50) NOT NULL,
  `modifieddt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sms_package`
--

INSERT INTO `tbl_sms_package` (`sp_id`, `sp_package_name`, `sp_num_sms`, `sp_mrp`, `sp_validity`, `sp_sms_per_rupee`, `createdby`, `createddt`, `modifiedby`, `modifieddt`) VALUES
(11, 'Pack of 1000', 1000, '334', '365', '0.334', 'Ashima', '2015-03-13', 'Ashima', '2015-07-20'),
(12, 'Pack of 9000', 9000, '3000', '365', '0.33333333333333', 'Ashima', '2015-07-20', '', '0000-00-00'),
(13, 'pack 5000', 5000, '400', '30', '0.25', 'Ashima', '2015-09-11', '0.08', '0000-00-00'),
(14, 'test', 200, '4500', '30', '22.5', 'Super Admin Test', '2015-09-16', '', '0000-00-00'),
(15, 'Pack of 1500', 1500, '500', '365', '0.33333333333333', 'Ashima', '2015-10-16', '', '0000-00-00'),
(16, 'Pack of 15000', 15000, '5000', '180', '0.33333333333333', 'Ashima', '2016-04-09', 'Ashima', '2016-04-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_sms_package`
--
ALTER TABLE `tbl_sms_package`
  ADD PRIMARY KEY (`sp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_sms_package`
--
ALTER TABLE `tbl_sms_package`
  MODIFY `sp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
