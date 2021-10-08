-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 14, 2018 at 07:54 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payone_b2c`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint_data`
--

DROP TABLE IF EXISTS `complaint_data`;
CREATE TABLE IF NOT EXISTS `complaint_data` (
  `complaint_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `complaint_date_time` datetime DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `comp_type` varchar(100) DEFAULT NULL,
  `txn_id` bigint(20) DEFAULT NULL,
  `user_remarks` varchar(200) DEFAULT NULL,
  `office_reply` varchar(200) DEFAULT NULL,
  `office_remarks` varchar(200) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `comp_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_data`
--

DROP TABLE IF EXISTS `emp_data`;
CREATE TABLE IF NOT EXISTS `emp_data` (
  `emp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `pass_code` varchar(200) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` bigint(20) NOT NULL,
  `reg_date` datetime NOT NULL,
  `user_status` int(11) NOT NULL,
  `invalid_attempt` int(11) NOT NULL,
  `e_verify` int(11) NOT NULL,
  `m_verify` int(11) NOT NULL,
  `reg_ip` varchar(200) NOT NULL,
  `reg_browser` varchar(200) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operator_data`
--

DROP TABLE IF EXISTS `operator_data`;
CREATE TABLE IF NOT EXISTS `operator_data` (
  `operator_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) DEFAULT NULL,
  `operator_name` varchar(100) DEFAULT NULL,
  `operator_code` varchar(10) DEFAULT NULL,
  `operator_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`operator_id`),
  UNIQUE KEY `operator_code` (`operator_code`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator_data`
--

INSERT INTO `operator_data` (`operator_id`, `service_id`, `operator_name`, `operator_code`, `operator_status`) VALUES
(1, 1, 'aircel', '1', 1),
(2, 1, 'airtel', '2', 1),
(3, 1, 'bsnl', '3', 1),
(4, 1, 'idea', '4', 1),
(5, 1, 'Jio', '5', 1),
(6, 1, 'loop', '6', 1),
(7, 1, 'mtnl', '7', 1),
(8, 1, 'mts', '8', 1),
(9, 1, 'reliance cdma', '9', 1),
(10, 1, 'reliance gsm', '10', 1),
(11, 1, 's tel', '11', 1),
(12, 1, 'spice', '12', 1),
(13, 1, 't24', '13', 1),
(14, 1, 'tata docomo', '14', 1),
(15, 1, 'tata indicom', '15', 1),
(16, 1, 'uninor', '16', 1),
(17, 1, 'videocon', '17', 1),
(18, 1, 'vodafone', '18', 1),
(19, 2, 'airtel', 'airtel', 1),
(20, 2, 'bigtv', 'bigtv', 1),
(21, 2, 'dishtv', 'dishtv', 1),
(22, 2, 'sun direct', 'sun direct', 1),
(23, 2, 'tata sky', 'tata sky', 1),
(24, 2, 'videocon', 'videocon', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_data`
--

DROP TABLE IF EXISTS `service_data`;
CREATE TABLE IF NOT EXISTS `service_data` (
  `service_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) DEFAULT NULL,
  `service_code` varchar(10) DEFAULT NULL,
  `service_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`service_id`),
  UNIQUE KEY `service_code` (`service_code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_data`
--

INSERT INTO `service_data` (`service_id`, `service_name`, `service_code`, `service_status`) VALUES
(1, 'prepaid', 'prepaid', 1),
(2, 'dth', 'dth', 1);

-- --------------------------------------------------------

--
-- Table structure for table `txn_data`
--

DROP TABLE IF EXISTS `txn_data`;
CREATE TABLE IF NOT EXISTS `txn_data` (
  `txn_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `txn_date_time` datetime DEFAULT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `operator_id` bigint(20) DEFAULT NULL,
  `user_ip` varchar(200) DEFAULT NULL,
  `user_browser` varchar(200) DEFAULT NULL,
  `pre_bal` decimal(15,2) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `charges` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `post_bal` decimal(15,2) DEFAULT NULL,
  `payment_from` int(11) DEFAULT NULL,
  `pg_name` int(11) DEFAULT NULL,
  `pg_ref_no` varchar(50) DEFAULT NULL,
  `pg_txn_date` datetime DEFAULT NULL,
  `pg_bank_date` datetime DEFAULT NULL,
  `pg_chargeback_date` datetime DEFAULT NULL,
  `txn_status` int(11) DEFAULT NULL,
  `other_remarks` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`txn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_reg`
--

DROP TABLE IF EXISTS `user_reg`;
CREATE TABLE IF NOT EXISTS `user_reg` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `pass_code` varchar(200) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` bigint(20) NOT NULL,
  `reg_date` datetime NOT NULL,
  `user_status` int(11) NOT NULL,
  `invalid_attempt` int(11) NOT NULL,
  `e_verify` int(11) NOT NULL,
  `m_verify` int(11) NOT NULL,
  `reg_ip` varchar(200) NOT NULL,
  `reg_browser` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `e_mail` (`e_mail`),
  UNIQUE KEY `mobile_no` (`contact_no`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_data`
--

DROP TABLE IF EXISTS `wallet_data`;
CREATE TABLE IF NOT EXISTS `wallet_data` (
  `wallet_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `w_date` date DEFAULT NULL,
  `w_time` time DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `cr_amt` decimal(15,2) DEFAULT NULL,
  `dr_amt` decimal(15,2) DEFAULT NULL,
  `bal_amt` decimal(15,2) DEFAULT NULL,
  `supp_remarks` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`wallet_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
