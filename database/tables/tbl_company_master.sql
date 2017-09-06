-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2017 at 10:02 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

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
-- Table structure for table `tbl_company_master`
--

CREATE TABLE IF NOT EXISTS `tbl_company_master` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_name` varchar(50) DEFAULT NULL,
  `comp_type` varchar(50) DEFAULT NULL,
  `comp_pri_email` varchar(50) DEFAULT NULL,
  `comp_sec_email` varchar(50) DEFAULT NULL,
  `comp_pri_phone` varchar(15) DEFAULT NULL,
  `comp_sec_phone` varchar(15) DEFAULT NULL,
  `comp_website` varchar(100) DEFAULT NULL,
  `comp_bill_address` longtext,
  `comp_bill_state` varchar(10) DEFAULT NULL,
  `comp_bill_city` int(11) DEFAULT NULL,
  `comp_bill_pincode` varchar(10) DEFAULT NULL,
  `comp_ship_address` longtext,
  `comp_ship_state` varchar(10) DEFAULT NULL,
  `comp_ship_city` int(11) DEFAULT NULL,
  `comp_ship_pincode` varchar(10) DEFAULT NULL,
  `comp_descp` longtext,
  `comp_status` int(11) DEFAULT NULL,
  `comp_created_date` datetime DEFAULT NULL,
  `comp_created_by` int(11) DEFAULT NULL,
  `comp_modified_date` datetime DEFAULT NULL,
  `comp_modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
