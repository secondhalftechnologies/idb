-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2017 at 11:45 PM
-- Server version: 5.5.57-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystudyc_adapt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `id` int(11) NOT NULL,
  `country_id` char(2) NOT NULL,
  `country_name` varchar(64) DEFAULT NULL,
  `tag` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`id`, `country_id`, `country_name`, `tag`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
(1, 'US', 'United States', 10, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'CA', 'Canada', 5, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 'AF', 'Afghanistan', 0, 1, '0000-00-00 00:00:00', 0, '2017-04-25 12:36:08', 2),
(4, 'AL', 'Albania', 0, 1, '0000-00-00 00:00:00', 0, '2017-04-24 11:51:48', 2),
(5, 'DZ', 'Algeria', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(6, 'AS', 'American Samoa', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(7, 'AD', 'Andorra', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(8, 'AO', 'Angola', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(9, 'AI', 'Anguilla', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(10, 'AQ', 'Antarctica', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(11, 'AG', 'Antigua and Barbuda', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(12, 'AR', 'Argentina', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(13, 'AM', 'Armenia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, 'AW', 'Aruba', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, 'AU', 'Australia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 'AT', 'Austria', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 'AZ', 'Azerbaijan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, 'BS', 'Bahamas', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, 'BH', 'Bahrain', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, 'BD', 'Bangladesh', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 'BB', 'Barbados', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, 'BY', 'Belarus', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(23, 'BE', 'Belgium', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(24, 'BZ', 'Belize', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, 'BJ', 'Benin', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(26, 'BM', 'Bermuda', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(27, 'BT', 'Bhutan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(28, 'BO', 'Bolivia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(29, 'BA', 'Bosnia and Herzegovina', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(30, 'BW', 'Botswana', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, 'BV', 'Bouvet Island', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(32, 'BR', 'Brazil', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, 'IO', 'British Indian Ocean Territory', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 'BN', 'Brunei', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(35, 'BG', 'Bulgaria', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(36, 'BF', 'Burkina Faso', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(37, 'BI', 'Burundi', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(38, 'KH', 'Cambodia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(39, 'CM', 'Cameroon', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(40, 'CV', 'Cape Verde', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(41, 'KY', 'Cayman Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(42, 'CF', 'Central African Republic', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(43, 'TD', 'Chad', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(44, 'CL', 'Chile', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(45, 'CN', 'China', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(46, 'CX', 'Christmas Island', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(47, 'CC', 'Cocos (Keeling) Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(48, 'CO', 'Colombia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(49, 'KM', 'Comoros', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(50, 'CG', 'Congo', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(51, 'CK', 'Cook Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(52, 'CR', 'Costa Rica', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(53, 'CI', 'Cote d\'Ivoire', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(54, 'HR', 'Croatia (Hrvatska)', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(55, 'CU', 'Cuba', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(56, 'CY', 'Cyprus', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(57, 'CZ', 'Czech Republic', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(58, 'CD', 'Congo (DRC)', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(59, 'DK', 'Denmark', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(60, 'DJ', 'Djibouti', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(61, 'DM', 'Dominica', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(62, 'DO', 'Dominican Republic', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(63, 'TP', 'East Timor', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(64, 'EC', 'Ecuador', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(65, 'EG', 'Egypt', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(66, 'SV', 'El Salvador', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(67, 'GQ', 'Equatorial Guinea', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(68, 'ER', 'Eritrea', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(69, 'EE', 'Estonia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(70, 'ET', 'Ethiopia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(71, 'FK', 'Falkland Islands (Islas Malvinas)', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(72, 'FO', 'Faroe Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(73, 'FJ', 'Fiji Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(74, 'FI', 'Finland', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(75, 'FR', 'France', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(76, 'GF', 'French Guiana', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(77, 'PF', 'French Polynesia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(78, 'TF', 'French Southern and Antarctic Lands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(79, 'GA', 'Gabon', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(80, 'GM', 'Gambia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(81, 'GE', 'Georgia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(82, 'DE', 'Germany', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(83, 'GH', 'Ghana', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(84, 'GI', 'Gibraltar', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(85, 'GR', 'Greece', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(86, 'GL', 'Greenland', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(87, 'GD', 'Grenada', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(88, 'GP', 'Guadeloupe', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(89, 'GU', 'Guam', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(90, 'GT', 'Guatemala', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(91, 'GN', 'Guinea', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(92, 'GW', 'Guinea-Bissau', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(93, 'GY', 'Guyana', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(94, 'HT', 'Haiti', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(95, 'HM', 'Heard Island and McDonald Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(96, 'HN', 'Honduras', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(97, 'HK', 'Hong Kong SAR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(98, 'HU', 'Hungary', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(99, 'IS', 'Iceland', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(100, 'IN', 'India', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(101, 'ID', 'Indonesia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(102, 'IR', 'Iran', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(103, 'IQ', 'Iraq', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(104, 'IE', 'Ireland', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(105, 'IL', 'Israel', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(106, 'IT', 'Italy', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(107, 'JM', 'Jamaica', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(108, 'JP', 'Japan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(109, 'JO', 'Jordan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(110, 'KZ', 'Kazakhstan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(111, 'KE', 'Kenya', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(112, 'KI', 'Kiribati', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(113, 'KR', 'Korea', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(114, 'KW', 'Kuwait', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(115, 'KG', 'Kyrgyzstan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(116, 'LA', 'Laos', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(117, 'LV', 'Latvia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(118, 'LB', 'Lebanon', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(119, 'LS', 'Lesotho', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(120, 'LR', 'Liberia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(121, 'LY', 'Libya', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(122, 'LI', 'Liechtenstein', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(123, 'LT', 'Lithuania', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(124, 'LU', 'Luxembourg', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(125, 'MO', 'Macao SAR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(126, 'MK', 'Macedonia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(127, 'MG', 'Madagascar', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(128, 'MW', 'Malawi', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(129, 'MY', 'Malaysia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(130, 'MV', 'Maldives', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(131, 'ML', 'Mali', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(132, 'MT', 'Malta', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(133, 'MH', 'Marshall Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(134, 'MQ', 'Martinique', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(135, 'MR', 'Mauritania', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(136, 'MU', 'Mauritius', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(137, 'YT', 'Mayotte', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(138, 'MX', 'Mexico', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(139, 'FM', 'Micronesia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(140, 'MD', 'Moldova', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(141, 'MC', 'Monaco', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(142, 'MN', 'Mongolia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(143, 'MS', 'Montserrat', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(144, 'MA', 'Morocco', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(145, 'MZ', 'Mozambique', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(146, 'MM', 'Myanmar', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(147, 'NA', 'Namibia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(148, 'NR', 'Nauru', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(149, 'NP', 'Nepal', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(150, 'NL', 'Netherlands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(151, 'AN', 'Netherlands Antilles', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(152, 'NC', 'New Caledonia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(153, 'NZ', 'New Zealand', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(154, 'NI', 'Nicaragua', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(155, 'NE', 'Niger', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(156, 'NG', 'Nigeria', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(157, 'NU', 'Niue', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(158, 'NF', 'Norfolk Island', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(159, 'KP', 'North Korea', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(160, 'MP', 'Northern Mariana Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(161, 'NO', 'Norway', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(162, 'OM', 'Oman', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(163, 'PK', 'Pakistan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(164, 'PW', 'Palau', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(165, 'PA', 'Panama', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(166, 'PG', 'Papua New Guinea', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(167, 'PY', 'Paraguay', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(168, 'PE', 'Peru', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(169, 'PH', 'Philippines', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(170, 'PN', 'Pitcairn Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(171, 'PL', 'Poland', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(172, 'PT', 'Portugal', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(173, 'PR', 'Puerto Rico', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(174, 'QA', 'Qatar', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(175, 'RE', 'Reunion', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(176, 'RO', 'Romania', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(177, 'RU', 'Russia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(178, 'RW', 'Rwanda', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(179, 'WS', 'Samoa', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(180, 'SM', 'San Marino', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(181, 'ST', 'Sao Tome and Principe', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(182, 'SA', 'Saudi Arabia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(183, 'SN', 'Senegal', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(184, 'YU', 'Serbia and Montenegro', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(185, 'SC', 'Seychelles', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(186, 'SL', 'Sierra Leone', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(187, 'SG', 'Singapore', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(188, 'SK', 'Slovakia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(189, 'SI', 'Slovenia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(190, 'SB', 'Solomon Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(191, 'SO', 'Somalia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(192, 'ZA', 'South Africa', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(193, 'GS', 'South Georgia and the South Sandwich Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(194, 'ES', 'Spain', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(195, 'LK', 'Sri Lanka', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(196, 'SH', 'St. Helena', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(197, 'KN', 'St. Kitts and Nevis', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(198, 'LC', 'St. Lucia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(199, 'PM', 'St. Pierre and Miquelon', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(200, 'VC', 'St. Vincent and the Grenadines', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(201, 'SD', 'Sudan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(202, 'SR', 'Suriname', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(203, 'SJ', 'Svalbard and Jan Mayen', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(204, 'SZ', 'Swaziland', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(205, 'SE', 'Sweden', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(206, 'CH', 'Switzerland', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(207, 'SY', 'Syria', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(208, 'TW', 'Taiwan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(209, 'TJ', 'Tajikistan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(210, 'TZ', 'Tanzania', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(211, 'TH', 'Thailand', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(212, 'TG', 'Togo', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(213, 'TK', 'Tokelau', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(214, 'TO', 'Tonga', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(215, 'TT', 'Trinidad and Tobago', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(216, 'TN', 'Tunisia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(217, 'TR', 'Turkey', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(218, 'TM', 'Turkmenistan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(219, 'TC', 'Turks and Caicos Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(220, 'TV', 'Tuvalu', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(221, 'UG', 'Uganda', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(222, 'UA', 'Ukraine', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(223, 'AE', 'United Arab Emirates', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(224, 'GB', 'United Kingdom', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(225, 'UM', 'United States Minor Outlying Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(226, 'UY', 'Uruguay', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(227, 'UZ', 'Uzbekistan', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(228, 'VU', 'Vanuatu', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(229, 'VA', 'Vatican City', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(230, 'VE', 'Venezuela', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(231, 'VN', 'Viet Nam', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(232, 'VG', 'Virgin Islands (British)', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(233, 'VI', 'Virgin Islands', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(234, 'WF', 'Wallis and Futuna', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(235, 'YE', 'Yemen', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(236, 'ZM', 'Zambia', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(237, 'ZW', 'Zimbabwe', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
