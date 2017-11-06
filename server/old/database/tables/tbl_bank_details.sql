-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2017 at 01:41 PM
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
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_userid` int(11) NOT NULL,
  `bank_username` varchar(50) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch` varchar(255) NOT NULL,
  `bank_acc_no` varchar(50) NOT NULL,
  `bank_ifsc` varchar(50) NOT NULL,
  `bank_image` varchar(50) NOT NULL,
  `bank_status` varchar(10) NOT NULL DEFAULT '0',
  `bank_created` datetime NOT NULL,
  `bank_created_by` varchar(50) NOT NULL,
  `bank_modified` datetime NOT NULL,
  `bank_modified_by` varchar(50) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_bank_details`
--

INSERT INTO `tbl_bank_details` (`bank_id`, `bank_userid`, `bank_username`, `bank_name`, `bank_branch`, `bank_acc_no`, `bank_ifsc`, `bank_image`, `bank_status`, `bank_created`, `bank_created_by`, `bank_modified`, `bank_modified_by`) VALUES
(1, 3, 'Satish ', 'BOI', 'Ratnagiri', '146310110010197', 'BOI00001463', '060517050424_3.jpg', '0', '2017-09-06 17:09:33', '', '0000-00-00 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
