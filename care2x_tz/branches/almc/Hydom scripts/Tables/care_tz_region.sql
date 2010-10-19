-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 21, 2007 at 03:54 PM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_region`
-- 

CREATE TABLE `care_tz_region` (
  `region_id` int(11) NOT NULL auto_increment,
  `region_code` int(10) NOT NULL,
  `region_name` varchar(100) collate latin1_general_ci NOT NULL,
  `is_additional` tinyint(4) NOT NULL,
  PRIMARY KEY  (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `care_tz_region`
-- 

INSERT INTO `care_tz_region` VALUES (1, 1, 'Arusha', 0);
