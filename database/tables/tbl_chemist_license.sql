-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2017 at 10:22 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `idb2017`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chemist_license`
--

CREATE TABLE IF NOT EXISTS `tbl_chemist_license` (
  `clic_id` int(11) NOT NULL AUTO_INCREMENT,
  `lic_userid` int(11) NOT NULL,
  `lic_20B_number` varchar(50) NOT NULL,
  `lic_20B_image` varchar(50) NOT NULL,
  `lic_21B_number` varchar(50) NOT NULL,
  `lic_21B_image` varchar(50) NOT NULL,
  `lic_21C_number` varchar(50) NOT NULL,
  `lic_21C_image` varchar(50) NOT NULL,
  `lic_status` varchar(12) NOT NULL DEFAULT '',
  `lic_created` datetime NOT NULL,
  `lic_created_by` varchar(50) NOT NULL,
  `lic_modified` datetime NOT NULL,
  `lic_modified_by` varchar(50) NOT NULL,
  PRIMARY KEY (`clic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_chemist_license`
--

INSERT INTO `tbl_chemist_license` (`clic_id`, `lic_userid`, `lic_20B_number`, `lic_20B_image`, `lic_21B_number`, `lic_21B_image`, `lic_21C_number`, `lic_21C_image`, `lic_status`, `lic_created`, `lic_created_by`, `lic_modified`, `lic_modified_by`) VALUES
(2, 3, 'fdsfdfdddd', '081117115608_20B_3.png', 'sdfddddddd', '081217122050_21B_3.png', '', '', '', '2017-09-08 12:21:11', '', '0000-00-00 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
