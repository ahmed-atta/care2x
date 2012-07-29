-- phpMyAdmin SQL Dump
-- version 3.4.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2012 at 12:59 PM
-- Server version: 5.1.63
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leskoweb_c2xelct`
--

-- --------------------------------------------------------

--
-- Table structure for table `care_test_findings_chemlabor_sub`
--

DROP TABLE IF EXISTS `care_test_findings_chemlabor_sub`;
CREATE TABLE IF NOT EXISTS `care_test_findings_chemlabor_sub` (
  `sub_id` int(40) NOT NULL AUTO_INCREMENT,
  `batch_nr` int(11) NOT NULL DEFAULT '0',
  `job_id` varchar(25) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `paramater_name` varchar(255) DEFAULT '0',
  `parameter_value` varchar(255) DEFAULT '0',
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `history` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `test_date` date NOT NULL DEFAULT '0000-00-00',
  `test_time` time DEFAULT NULL,
  `create_id` varchar(35) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modify_id` varchar(10) DEFAULT NULL,
  `modify_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
