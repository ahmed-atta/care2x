CREATE TABLE `care2xdb`.`care_diagnosis` (
`diagnosis_nr` int( 11 ) NOT NULL AUTO_INCREMENT ,
`encounter_nr` int( 11 ) NOT NULL default '0',
`op_nr` int( 10 ) unsigned NOT NULL default '0',
`date` datetime NOT NULL default '0000-00-00 00:00:00',
`code` varchar( 25 ) NOT NULL default '',
`code_parent` varchar( 25 ) NOT NULL default '',
`group_nr` mediumint( 8 ) unsigned NOT NULL default '0',
`code_version` tinyint( 4 ) NOT NULL default '0',
`localcode` varchar( 35 ) NOT NULL default '',
`category_nr` tinyint( 3 ) unsigned NOT NULL default '0',
`type` varchar( 35 ) NOT NULL default '',
`localization` varchar( 35 ) NOT NULL default '',
`diagnosing_clinician` varchar( 60 ) NOT NULL default '',
`diagnosing_dept_nr` smallint( 5 ) unsigned NOT NULL default '0',
`status` varchar( 25 ) NOT NULL default '',
`history` text NOT NULL ,
`modify_id` varchar( 35 ) NOT NULL default '',
`modify_time` timestamp( 14 ) NOT NULL ,
`create_id` varchar( 35 ) NOT NULL default '',
`create_time` timestamp( 14 ) NOT NULL ,
PRIMARY KEY ( `diagnosis_nr` ) ,
KEY `encounter_nr` ( `encounter_nr` )
) TYPE = MYISAM ;