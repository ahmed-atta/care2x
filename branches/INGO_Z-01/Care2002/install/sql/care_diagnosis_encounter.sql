CREATE TABLE `care_diagnosis_encounter` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) default '0',
  `diagnosis_nr` int(11) default '0',
  `op_nr` int(10) unsigned default '0',
  `type` smallint(5) unsigned default '0',
  `localization` varchar(35) default NULL,
  `date` datetime default '0000-00-00 00:00:00',
  `category_nr` tinyint(3) unsigned default '0',
  `diagnosing_clinician` varchar(60) default NULL,
  `diagnosing_dept_nr` smallint(5) unsigned default '0',
  `status` varchar(25) default NULL,
  `history` text,
  `modify_id` varchar(35) default NULL,
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) default NULL,
  `create_time` timestamp(14) NOT NULL,
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM;
