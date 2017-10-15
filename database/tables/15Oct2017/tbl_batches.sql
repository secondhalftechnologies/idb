-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2017 at 03:03 PM
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
-- Table structure for table `tbl_batches`
--

CREATE TABLE `tbl_batches` (
  `batch_id` int(11) NOT NULL,
  `prod_id` varchar(100) NOT NULL,
  `prod_type` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_mrp` varchar(100) NOT NULL,
  `prod_price` varchar(100) NOT NULL,
  `prod_quantity` varchar(100) NOT NULL,
  `prod_batch_no` varchar(100) NOT NULL,
  `prod_manu_date` date NOT NULL,
  `prod_exp_date` date NOT NULL,
  `prod_coa` varchar(255) NOT NULL,
  `prod_origin` varchar(255) NOT NULL,
  `prod_handling` varchar(255) NOT NULL,
  `prod_commission` varchar(100) NOT NULL,
  `prod_sample` varchar(100) NOT NULL,
  `batch_status` varchar(100) NOT NULL DEFAULT '2',
  `batch_created` datetime NOT NULL,
  `batch_created_by` varchar(100) NOT NULL,
  `batch_modified` datetime NOT NULL,
  `batch_modified_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_batches`
--

INSERT INTO `tbl_batches` (`batch_id`, `prod_id`, `prod_type`, `user_id`, `prod_mrp`, `prod_price`, `prod_quantity`, `prod_batch_no`, `prod_manu_date`, `prod_exp_date`, `prod_coa`, `prod_origin`, `prod_handling`, `prod_commission`, `prod_sample`, `batch_status`, `batch_created`, `batch_created_by`, `batch_modified`, `batch_modified_by`) VALUES
(1, '2', 'raw', 1, 'zxcz', 'zxc', '1', '0000-00-00', '0000-00-00', '0000-00-00', '150417041853.png', 'India', 'zxc', '', '', '1', '2017-10-15 16:18:53', '1', '0000-00-00 00:00:00', ''),
(2, '2', 'raw', 0, 'zxcz', 'zxc', '1', 'dasdadadad', '0000-00-00', '0000-00-00', '', 'India', 'zxc', '', '', '1', '0000-00-00 00:00:00', '', '2017-10-15 17:09:36', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_batches`
--
ALTER TABLE `tbl_batches`
  ADD PRIMARY KEY (`batch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_batches`
--
ALTER TABLE `tbl_batches`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
