-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2017 at 04:27 AM
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
-- Table structure for table `tbl_products_master`
--

CREATE TABLE IF NOT EXISTS `tbl_products_master` (
  `prod_id` int(10) NOT NULL COMMENT 'Primary key in this table and foreign key in table ''tbl_products_specifications'' product_id',
  `prod_model_number` varchar(100) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_slug` text NOT NULL,
  `prod_title` longtext NOT NULL,
  `prod_star_status` int(11) NOT NULL DEFAULT '0',
  `prod_payment_mode` int(11) DEFAULT '3',
  `prod_cod_status` int(1) NOT NULL DEFAULT '1',
  `prod_description` longtext NOT NULL,
  `prod_google_product_category` longtext NOT NULL,
  `prod_orgid` int(10) NOT NULL COMMENT 'foreign key from table ''tbl_oraganisation_master'' org_id',
  `prod_brandid` int(10) NOT NULL COMMENT 'foreign key from table ''tbl_brands_master'' brand_id',
  `prod_catid` int(10) NOT NULL COMMENT 'foreign key from table ''tbl_category'' cat_id',
  `prod_subcatid` int(10) NOT NULL COMMENT 'foreign key from table ''tbl_category'' cat_id',
  `prod_returnable` int(1) NOT NULL DEFAULT '1' COMMENT '1=Can be Return ,0= can not return',
  `prod_content` longtext NOT NULL,
  `prod_quantity` int(50) NOT NULL,
  `prod_quantity_status` int(5) NOT NULL DEFAULT '1',
  `prod_min_quantity` int(11) NOT NULL,
  `prod_max_quantity` int(11) NOT NULL,
  `prod_list_price` int(11) NOT NULL,
  `prod_recommended_price` int(50) NOT NULL,
  `prod_org_price` int(11) NOT NULL,
  `prod_images` varchar(200) NOT NULL,
  `prod_meta_tags` varchar(500) NOT NULL,
  `prod_meta_description` varchar(500) NOT NULL,
  `prod_meta_title` varchar(500) NOT NULL,
  `prod_created_by` int(10) NOT NULL,
  `prod_created` datetime NOT NULL,
  `prod_modified_by` int(10) NOT NULL,
  `prod_modified` datetime DEFAULT NULL,
  `prod_status` int(5) NOT NULL COMMENT 'Active = 1 and Inactive = 0',
  PRIMARY KEY (`prod_id`),
  KEY `prod_model_number` (`prod_model_number`),
  KEY `prod_name` (`prod_name`),
  KEY `prod_star_status` (`prod_star_status`),
  KEY `prod_orgid` (`prod_orgid`),
  KEY `prod_brandid` (`prod_brandid`),
  KEY `prod_catid` (`prod_catid`),
  KEY `prod_subcatid` (`prod_subcatid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
