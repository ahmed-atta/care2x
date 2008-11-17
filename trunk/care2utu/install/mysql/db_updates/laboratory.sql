/*

update `care_tz_laboratory_param` set add_type='radio' where add_type='checkbox'
*/

CREATE TABLE IF NOT EXISTS `care_test_findings_laboratory` (
  `findings_nr` int(11) NOT NULL auto_increment,
  `parent` int(11) default NULL COMMENT 'Point to the HEAD finding_nr for follow up findings',
  `task_nr` int(11) NOT NULL default '-1',
  `timestamp` bigint(20) NOT NULL,
  `finding` text NOT NULL,
  `status` varchar(20) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `history` text NOT NULL COMMENT 'Should be empty for follow ups, just for HEAD findings',
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`findings_nr`,`task_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_laboratory`
--

CREATE TABLE IF NOT EXISTS `care_test_request_laboratory` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `room_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `doctor_sign` varchar(255) NOT NULL default '',
  `highrisk` smallint(1) NOT NULL default '0',
  `notes` varchar(255) NOT NULL default '',
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `sample_time` time NOT NULL default '00:00:00',
  `sample_weekday` smallint(1) NOT NULL default '0',
  `status` varchar(15) NOT NULL default '',
  `history` varchar(255) NOT NULL default '',
  `is_disabled` varchar(255) default NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_laboratory_tasks`
--

CREATE TABLE IF NOT EXISTS `care_test_request_laboratory_tasks` (
  `task_nr` int(11) NOT NULL auto_increment,
  `batch_nr` int(11) NOT NULL,
  `test_nr` int(11) NOT NULL,
  `bill_number` bigint(20) NOT NULL default '0',
  `bill_status` varchar(10) NOT NULL default '',
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(15) NOT NULL default '',
  `is_disabled` tinyint(4) default '0',
  PRIMARY KEY  (`task_nr`),
  KEY `batch_nr` (`batch_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;