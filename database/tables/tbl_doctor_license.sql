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
-- Table structure for table `tbl_doctor_license`
--

CREATE TABLE IF NOT EXISTS `tbl_doctor_license` (
  `dlic_id` int(11) NOT NULL AUTO_INCREMENT,
  `lic_userid` int(11) NOT NULL,
  `lic_number` varchar(50) NOT NULL,
  `lic_image` varchar(50) NOT NULL,
  `lic_status` varchar(50) NOT NULL DEFAULT '0',
  `lic_created` datetime NOT NULL,
  `lic_created_by` varchar(50) NOT NULL,
  `lic_modified` datetime NOT NULL,
  `lic_modified_by` varchar(50) NOT NULL,
  PRIMARY KEY (`dlic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_doctor_license`
--

INSERT INTO `tbl_doctor_license` (`dlic_id`, `lic_userid`, `lic_number`, `lic_image`, `lic_status`, `lic_created`, `lic_created_by`, `lic_modified`, `lic_modified_by`) VALUES
(1, 3, 'dfsfsfsssd', '070317034746_3.png', '0', '2017-09-07 15:38:47', '', '2017-09-07 15:47:46', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
