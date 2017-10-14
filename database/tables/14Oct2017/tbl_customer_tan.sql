-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2017 at 10:36 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idb2017`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_tan`
--

CREATE TABLE `tbl_customer_tan` (
  `tan_id` int(11) NOT NULL,
  `tan_userid` int(11) NOT NULL,
  `tan_no` varchar(50) NOT NULL,
  `tan_image` varchar(50) NOT NULL,
  `tan_status` varchar(10) NOT NULL DEFAULT '0',
  `tan_created` datetime NOT NULL,
  `tan_created_by` varchar(50) NOT NULL,
  `tan_modified` datetime NOT NULL,
  `tan_modified_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer_tan`
--

INSERT INTO `tbl_customer_tan` (`tan_id`, `tan_userid`, `tan_no`, `tan_image`, `tan_status`, `tan_created`, `tan_created_by`, `tan_modified`, `tan_modified_by`) VALUES
(1, 19, 'gdgdgdgfgf', '141217121744_19.jpg', '0', '2017-10-14 12:16:08', '', '2017-10-14 13:00:07', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer_tan`
--
ALTER TABLE `tbl_customer_tan`
  ADD PRIMARY KEY (`tan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer_tan`
--
ALTER TABLE `tbl_customer_tan`
  MODIFY `tan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
