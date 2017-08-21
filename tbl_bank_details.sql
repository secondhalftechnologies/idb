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
-- Table structure for table `tbl_bank_details`
--

CREATE TABLE IF NOT EXISTS `tbl_bank_details` (
  `bdetail_id` int(11) NOT NULL AUTO_INCREMENT,
  `bcust_id` int(11) NOT NULL,
  `bbank_name` varchar(255) NOT NULL,
  `bacc_number` varchar(20) NOT NULL,
  `bifsc` varchar(20) NOT NULL,
  `bmicr` varchar(20) NOT NULL,
  `bank_custid` varchar(20) NOT NULL,
  `bbranch_name` varchar(255) NOT NULL,
  `bank_created` datetime NOT NULL,
  `bank_created_by` varchar(50) NOT NULL,
  `bank_modified` datetime NOT NULL,
  `bank_modified_by` varchar(50) NOT NULL,
  PRIMARY KEY (`bdetail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
