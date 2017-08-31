-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2017 at 06:20 PM
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
-- Table structure for table `tbl_taxmanagement_master`
--

CREATE TABLE IF NOT EXISTS `tbl_taxmanagement_master` (
  `tax_id` int(10) NOT NULL COMMENT 'Primary key in this table',
  `tax_name` varchar(100) NOT NULL,
  `tax_status` int(5) NOT NULL COMMENT 'Active = 1 and Inactive = 0',
  `tax_created_by` int(5) NOT NULL,
  `tax_created` datetime NOT NULL,
  `tax_modified_by` int(5) NOT NULL,
  `tax_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`tax_id`),
  KEY `spec_id` (`tax_id`),
  KEY `spec_name` (`tax_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
