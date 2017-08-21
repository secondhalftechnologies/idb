-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2017 at 06:18 AM
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
-- Table structure for table `tbl_licenses`
--

CREATE TABLE IF NOT EXISTS `tbl_licenses` (
  `license_id` int(11) NOT NULL AUTO_INCREMENT,
  `lic_custid` int(11) NOT NULL,
  `lic_number` varchar(100) NOT NULL,
  `lic_exipiry_date` date NOT NULL,
  `lic_document` varchar(50) NOT NULL,
  `lic_cust_type` varchar(50) NOT NULL COMMENT 'eg vendor or buyer',
  `lic_created` datetime NOT NULL,
  `lic_created_by` varchar(50) NOT NULL,
  `lic_modified` datetime NOT NULL,
  `lic_modified_by` varchar(50) NOT NULL,
  PRIMARY KEY (`license_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
