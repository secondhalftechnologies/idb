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
-- Table structure for table `tbl_customer_sign`
--

CREATE TABLE `tbl_customer_sign` (
  `sign_id` int(11) NOT NULL,
  `sign_userid` int(11) NOT NULL,
  `sign_doc` varchar(100) NOT NULL,
  `sign_created` datetime NOT NULL,
  `sign_created_by` varchar(100) NOT NULL,
  `sign_modified` datetime NOT NULL,
  `sign_modified_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer_sign`
--

INSERT INTO `tbl_customer_sign` (`sign_id`, `sign_userid`, `sign_doc`, `sign_created`, `sign_created_by`, `sign_modified`, `sign_modified_by`) VALUES
(1, 19, '140117015316_19.jpg', '2017-10-14 13:51:14', '', '0000-00-00 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer_sign`
--
ALTER TABLE `tbl_customer_sign`
  ADD PRIMARY KEY (`sign_id`),
  ADD UNIQUE KEY `sign_doc` (`sign_doc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer_sign`
--
ALTER TABLE `tbl_customer_sign`
  MODIFY `sign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
