
-- 
-- created by Dennis M Mollel
-- dennis.mollel@yahoo.com
-- July 07-2010
--


--
-- Table structure for table `care_encounter`
--

ALTER TABLE `care_encounter` ADD `room` VARCHAR( 20 ) NOT NULL DEFAULT 'GENERAL',ADD `room_history` TEXT NOT NULL ,ADD `current_dept_history` TEXT NOT NULL; 

--
-- Table structure for table `care_tz_hospital_rooms`
--

CREATE TABLE IF NOT EXISTS `care_tz_hospital_rooms` (
  `name` varchar(20) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `active` int(1) unsigned NOT NULL,
  `dpt` int(11) NOT NULL DEFAULT '0' COMMENT 'department',
  `createdby` varchar(45) NOT NULL,
  `createdate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`name`,`dpt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='holds doctors rooms';

--
-- Dumping data for table `care_tz_hospital_rooms`
--

-- --------------------------------------------------------

--
-- Table structure for table `care_tz_hospital_rooms_conf`
--

CREATE TABLE IF NOT EXISTS `care_tz_hospital_rooms_conf` (
  `name` varchar(45) NOT NULL,
  `dpt` varchar(45) NOT NULL,
  `users` text NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`name`,`dpt`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `care_users`
-- create list of valid doctors only
--

UPDATE `care_users` SET personell_nr=1 WHERE name like '%dr%' or  login_id like '%dr%';


--
-- Table structure for table `care_tz_hospital_doctor_history`
-- Holds information about doctors attendencies
--

CREATE TABLE IF NOT EXISTS `care_tz_hospital_doctor_history` (
  `date` date NOT NULL DEFAULT '0000-00-00',
  `doctor` varchar(45) NOT NULL DEFAULT ' ',
  `dept` int(11) unsigned NOT NULL DEFAULT '0',
  `room` varchar(450) NOT NULL,
  `attend` int(11) unsigned NOT NULL DEFAULT '0',
  `patients` text NOT NULL,
  PRIMARY KEY (`date`,`doctor`,`dept`,`room`),
  KEY `date` (`date`),
  KEY `doctor` (`doctor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

