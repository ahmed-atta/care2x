-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 21, 2007 at 03:52 PM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_district`
-- 

CREATE TABLE `care_tz_district` (
  `district_id` int(11) NOT NULL auto_increment,
  `district_code` int(10) NOT NULL,
  `district_name` varchar(100) collate latin1_general_ci NOT NULL,
  `is_additional` tinyint(4) NOT NULL,
  PRIMARY KEY  (`district_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `care_tz_district`
-- 

INSERT INTO `care_tz_district` VALUES (1, 1, 'Monduli', 1);
INSERT INTO `care_tz_district` VALUES (2, 2, 'Arumeru', 1);
INSERT INTO `care_tz_district` VALUES (3, 3, 'Arusha', 1);
INSERT INTO `care_tz_district` VALUES (4, 4, 'Karatu', 1);
INSERT INTO `care_tz_district` VALUES (5, 5, 'Ngorongoro', 1);
