-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2017 at 06:17 AM
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
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_vendorid` int(11) DEFAULT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_email` varchar(150) NOT NULL,
  `cust_emailstatus` varchar(10) NOT NULL,
  `cust_mobile` varchar(10) NOT NULL,
  `cust_mobilestatus` varchar(10) NOT NULL,
  `cust_address` varchar(255) NOT NULL,
  `cust_type` varchar(25) NOT NULL COMMENT 'Eg docot , hospital',
  `cust_pan` varchar(20) NOT NULL,
  `cust_document` varchar(150) NOT NULL,
  `cust_password` varchar(150) NOT NULL,
  `cust_salt` varchar(5) NOT NULL,
  `cust_status` int(11) NOT NULL DEFAULT '1',
  `cust_star` int(11) NOT NULL,
  `cust_usergroup` varchar(50) NOT NULL,
  `cust_comment` varchar(255) NOT NULL,
  `cust_gst` varchar(255) NOT NULL,
  `cust_license` varchar(100) NOT NULL,
  `cust_created` datetime NOT NULL,
  `cust_created_by` varchar(50) NOT NULL,
  `cust_modified` datetime NOT NULL,
  `cust_modified_by` varchar(50) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cust_id`, `cust_vendorid`, `cust_name`, `cust_email`, `cust_emailstatus`, `cust_mobile`, `cust_mobilestatus`, `cust_address`, `cust_type`, `cust_pan`, `cust_document`, `cust_password`, `cust_salt`, `cust_status`, `cust_star`, `cust_usergroup`, `cust_comment`, `cust_gst`, `cust_license`, `cust_created`, `cust_created_by`, `cust_modified`, `cust_modified_by`) VALUES
(1, NULL, 'test', 'test@gmail.com', '', '9899999999', '', '', '', '', '', '', '', 1, 0, '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(2, NULL, 'test1', 'test1@gmail.com', '', '9989994944', '', '', '', '', '', '', '', 1, 0, '', '', '', '', '2017-08-11 16:45:22', '', '0000-00-00 00:00:00', ''),
(3, NULL, 'satish', 'satishdhere007@gmail.com', '', '9405487216', '', '', '', '', '110517050510.pdf', '', '', 1, 0, '', '', '', '', '2017-08-11 17:05:10', '', '0000-00-00 00:00:00', ''),
(4, NULL, 'wf', 'erwr@gmail.com', '', '3264657452', '', '', '', '', '110517052117.pdf', '', '', 1, 0, '', '', '', '', '2017-08-11 17:21:17', '', '0000-00-00 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
