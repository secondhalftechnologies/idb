-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2017 at 06:35 AM
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
-- Table structure for table `tbl_gst_master`
--

CREATE TABLE IF NOT EXISTS `tbl_gst_master` (
  `gst_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary key in this table',
  `gst_name` varchar(100) NOT NULL,
  `gst_status` int(5) NOT NULL COMMENT 'Active = 1 and Inactive = 0',
  `gst_created_by` int(5) NOT NULL,
  `gst_created` datetime NOT NULL,
  `gst_modified_by` int(5) NOT NULL,
  `gst_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`gst_id`),
  KEY `spec_id` (`gst_id`),
  KEY `spec_name` (`gst_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
