-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2017 at 09:53 AM
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
-- Table structure for table `tbl_gst`
--

CREATE TABLE IF NOT EXISTS `tbl_gst` (
  `gst_id` int(11) NOT NULL AUTO_INCREMENT,
  `gst_userid` int(11) NOT NULL,
  `gst_no` varchar(50) NOT NULL,
  `gst_image` varchar(50) NOT NULL,
  `gst_status` varchar(10) NOT NULL DEFAULT '0',
  `gst_created` datetime NOT NULL,
  `gst_created_by` varchar(50) NOT NULL,
  `gst_modified` datetime NOT NULL,
  `gst_modified_by` varchar(50) NOT NULL,
  PRIMARY KEY (`gst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
