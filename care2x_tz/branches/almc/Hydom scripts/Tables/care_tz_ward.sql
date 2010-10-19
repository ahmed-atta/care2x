-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 21, 2007 at 03:49 PM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_ward`
-- 

CREATE TABLE `care_tz_ward` (
  `ward_id` int(11) NOT NULL auto_increment,
  `ward_code` int(10) NOT NULL,
  `ward_name` varchar(100) collate latin1_general_ci NOT NULL,
  `is_additional` tinyint(4) NOT NULL,
  PRIMARY KEY  (`ward_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=102 ;

-- 
-- Dumping data for table `care_tz_ward`
-- 

INSERT INTO `care_tz_ward` VALUES (1, 12, 'Monduli Mjini - Urban Ward', 1);
INSERT INTO `care_tz_ward` VALUES (2, 23, 'Engutoto - Mixed Ward', 1);
INSERT INTO `care_tz_ward` VALUES (3, 31, 'Monduli Juu - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (4, 41, 'Sepeko - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (5, 51, 'Lolkisale - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (6, 61, 'Moita - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (7, 71, 'Makuyuni - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (8, 81, 'Elisalei - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (9, 93, 'Mto wa Mbu - Mixed Ward', 1);
INSERT INTO `care_tz_ward` VALUES (10, 101, 'Selela - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (11, 111, 'Engaruka - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (12, 121, 'Kitumbeine - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (13, 131, 'Gelai Meirugoi - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (14, 141, 'Gelai Lumbwa - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (15, 151, 'Engarenaibor - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (16, 161, 'Matale - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (17, 173, 'Namanga - Mixed Ward', 1);
INSERT INTO `care_tz_ward` VALUES (18, 183, 'Longido - Mixed Ward', 1);
INSERT INTO `care_tz_ward` VALUES (19, 191, 'Tingatinga - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (20, 201, 'Olmolog - Rural Ward', 1);
INSERT INTO `care_tz_ward` VALUES (21, 11, 'Oldonyosambu - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (22, 21, 'Ngarenanyuki - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (23, 31, 'Leguruki - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (24, 43, 'King ori - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (25, 53, 'Kikatiti - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (26, 61, 'Maroroni - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (27, 73, 'Makiba - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (28, 83, 'Mbuguni - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (29, 91, 'Bwawani - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (30, 101, 'Kikwe - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (31, 113, 'Maji ya Chai - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (32, 123, 'USA River - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (33, 133, 'Nkoaranga - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (34, 141, 'Songoro - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (35, 153, 'Poli - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (36, 161, 'Singisi - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (37, 173, 'Akheri - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (38, 181, 'Nkoarisambu - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (39, 191, 'Nkanrua - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (40, 201, 'Moshono - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (41, 211, 'Mlangarini - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (42, 221, 'Nduruma - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (43, 231, 'Oljoro - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (44, 243, 'Murieti - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (45, 253, 'Mateves - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (46, 261, 'Kisongo - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (47, 273, 'Kiranyi - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (48, 283, 'Kimnyaki - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (49, 293, 'Moivo - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (50, 301, 'Oltroto - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (51, 313, 'Sokoni II - Mixed Ward', 2);
INSERT INTO `care_tz_ward` VALUES (52, 321, 'Oltrumet - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (53, 331, 'Musa - Rual Ward', 2);
INSERT INTO `care_tz_ward` VALUES (54, 341, 'Mwandeti - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (55, 351, 'Olkokola - Rual Ward', 2);
INSERT INTO `care_tz_ward` VALUES (56, 361, 'Ilkiding a - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (57, 371, 'Bangata - Rural Ward', 2);
INSERT INTO `care_tz_ward` VALUES (58, 12, 'Kati - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (59, 22, 'Kaloleni - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (60, 32, 'Sekei ‘A’ - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (61, 42, 'Kimandolu - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (62, 52, 'Baraa  - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (63, 62, 'Oloirien - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (64, 72, 'Themi  - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (65, 82, 'Lemara - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (66, 91, 'Terrat - Rural Ward', 3);
INSERT INTO `care_tz_ward` VALUES (67, 103, 'Sokoni - Mixed Ward', 3);
INSERT INTO `care_tz_ward` VALUES (68, 112, 'Daraja Mbili - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (69, 122, 'Unga Ltd - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (70, 132, 'Sombetini - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (71, 142, 'Ngarenaro - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (72, 152, 'Levolosi - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (73, 162, 'Engutoto - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (74, 172, 'Elerae - Urban Ward', 3);
INSERT INTO `care_tz_ward` VALUES (75, 13, 'Karatu - Mixed Ward', 4);
INSERT INTO `care_tz_ward` VALUES (76, 21, 'Endamarariek - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (77, 31, 'Buger - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (78, 41, 'Endabash - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (79, 51, 'Kansay - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (80, 61, 'Baray - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (81, 71, 'Mang ola - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (82, 81, 'Daa - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (83, 91, 'Oldeani - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (84, 101, 'Qurus - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (85, 111, 'Ganako - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (86, 121, 'Rhotia - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (87, 131, 'Mbulumbulu - Rural Ward', 4);
INSERT INTO `care_tz_ward` VALUES (88, 13, 'Orgosorok - Mixed Ward', 5);
INSERT INTO `care_tz_ward` VALUES (89, 21, 'Digodigo - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (90, 31, 'Oldonyo - Sambu - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (91, 41, 'Pinyinyi - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (92, 51, 'Sale - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (93, 61, 'Malambo - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (94, 71, 'Naiyobi - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (95, 81, 'Nainokanoka - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (96, 91, 'Olbalbal - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (97, 103, 'Ngorongoro - Mixed Ward', 5);
INSERT INTO `care_tz_ward` VALUES (98, 111, 'Enduleni - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (99, 121, 'Kakesio - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (100, 131, 'Arash - Rural Ward', 5);
INSERT INTO `care_tz_ward` VALUES (101, 141, 'Soitisambu - Rural Ward', 5);
