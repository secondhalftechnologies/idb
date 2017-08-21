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
-- Table structure for table `tbl_vendor`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(50) NOT NULL,
  `vendor_email` varchar(150) NOT NULL,
  `vendor_emailstatus` varchar(10) NOT NULL,
  `vendor_mobile` varchar(10) NOT NULL,
  `vendor_mobilestatus` varchar(10) NOT NULL,
  `vendor_address` int(11) NOT NULL,
  `vendor_pan` varchar(20) NOT NULL,
  `vendor_type` varchar(100) NOT NULL COMMENT 'e.g MD/CEO/Proprietor',
  `vendor_document` varchar(150) NOT NULL,
  `vendor_password` varchar(150) NOT NULL,
  `vendor_salt` varchar(5) NOT NULL,
  `vendor_status` int(11) NOT NULL DEFAULT '1',
  `vendor_star` int(11) NOT NULL,
  `vendor_usergroup` varchar(50) NOT NULL,
  `vendor_comment` varchar(255) NOT NULL,
  `vendor_gst` varchar(255) NOT NULL,
  `vendor_license` varchar(100) NOT NULL,
  `vendor_created` datetime NOT NULL,
  `vendor_created_by` varchar(50) NOT NULL,
  `vendor_modified` datetime NOT NULL,
  `vendor_modified_by` varchar(50) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_vendor`
--

INSERT INTO `tbl_vendor` (`vendor_id`, `vendor_name`, `vendor_email`, `vendor_emailstatus`, `vendor_mobile`, `vendor_mobilestatus`, `vendor_address`, `vendor_pan`, `vendor_type`, `vendor_document`, `vendor_password`, `vendor_salt`, `vendor_status`, `vendor_star`, `vendor_usergroup`, `vendor_comment`, `vendor_gst`, `vendor_license`, `vendor_created`, `vendor_created_by`, `vendor_modified`, `vendor_modified_by`) VALUES
(1, 'test', 'test@gmail.com', '', '9899999999', '', 0, '', '', '', '', '', 1, 0, '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(2, 'test1', 'test1@gmail.com', '', '9989994944', '', 0, '', '', '', '', '', 1, 0, '', '', '', '', '2017-08-11 16:45:22', '', '0000-00-00 00:00:00', ''),
(3, 'satish', 'satishdhere007@gmail.com', '', '9405487216', '', 0, '', '', '110517050510.pdf', '', '', 1, 0, '', '', '', '', '2017-08-11 17:05:10', '', '0000-00-00 00:00:00', ''),
(4, 'wf', 'erwr@gmail.com', '', '3264657452', '', 0, '', '', '110517052117.pdf', '', '', 1, 0, '', '', '', '', '2017-08-11 17:21:17', '', '0000-00-00 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
