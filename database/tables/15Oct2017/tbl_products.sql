-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2017 at 03:07 PM
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
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `prod_id` varchar(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_slug` varchar(255) NOT NULL,
  `prod_type` varchar(100) NOT NULL,
  `prod_cat` varchar(255) NOT NULL,
  `prod_effective_pack` varchar(255) NOT NULL,
  `prod_standard_pack` varchar(255) NOT NULL,
  `prod_shipper` varchar(255) NOT NULL,
  `prod_comp_cat` varchar(255) NOT NULL COMMENT 'Composition Category',
  `prod_comp` varchar(255) NOT NULL COMMENT 'Composition ',
  `prod_pharmacopia` varchar(255) NOT NULL,
  `prod_factor` varchar(255) NOT NULL,
  `prod_tax` varchar(255) NOT NULL,
  `prod_attribute` varchar(255) NOT NULL,
  `prod_dimension_l` varchar(255) NOT NULL COMMENT 'prod dimension length',
  `prod_dimension_h` varchar(255) NOT NULL COMMENT 'prod dimension height',
  `prod_dimension_w` varchar(255) NOT NULL COMMENT 'prod dimension width',
  `prod_nett_weight` varchar(255) NOT NULL,
  `prod_gross_weight` varchar(255) NOT NULL,
  `prod_unit_weight` varchar(255) NOT NULL,
  `prod_packing` varchar(255) NOT NULL,
  `prod_manufactured` varchar(255) NOT NULL,
  `prod_manufactured_number` varchar(255) NOT NULL,
  `prod_dmf` varchar(255) NOT NULL,
  `prod_meta_tags` varchar(255) NOT NULL,
  `prod_ean` varchar(255) NOT NULL,
  `prod_hsn` varchar(255) NOT NULL,
  `prod_insurance` varchar(255) NOT NULL,
  `prod_status` varchar(255) NOT NULL,
  `prod_desc` varchar(255) NOT NULL,
  `prod_created_by` varchar(255) NOT NULL,
  `prod_created` datetime NOT NULL,
  `prod_modified_by` varchar(255) NOT NULL,
  `prod_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `prod_id`, `prod_name`, `prod_slug`, `prod_type`, `prod_cat`, `prod_effective_pack`, `prod_standard_pack`, `prod_shipper`, `prod_comp_cat`, `prod_comp`, `prod_pharmacopia`, `prod_factor`, `prod_tax`, `prod_attribute`, `prod_dimension_l`, `prod_dimension_h`, `prod_dimension_w`, `prod_nett_weight`, `prod_gross_weight`, `prod_unit_weight`, `prod_packing`, `prod_manufactured`, `prod_manufactured_number`, `prod_dmf`, `prod_meta_tags`, `prod_ean`, `prod_hsn`, `prod_insurance`, `prod_status`, `prod_desc`, `prod_created_by`, `prod_created`, `prod_modified_by`, `prod_modified`) VALUES
(2, 'SKU200000', 'Crocin', 'Crocin', 'raw', '13', '', '', '', 'Combination', '', '1', '2', '4', 'dfg', 'dgdfg', 'dfgd', 'dfg', 'Kg', '', '', '6', 'dfg', 'dfg', '150117013958.png', 'cxxg', '', '', '1', '1', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prod_id` (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
