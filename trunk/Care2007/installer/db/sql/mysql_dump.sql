-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
-- Claudio Torbinio
-- Host: localhost
-- Generato il: 30 Nov, 2007 at 05:40 AM
-- Versione MySQL: 5.0.45
-- Versione PHP: 4.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `care2x`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `care_address_citytown`
--

CREATE TABLE `care_address_citytown` (
  `nr` mediumint(8) unsigned NOT NULL auto_increment,
  `unece_modifier` char(2) collate latin1_general_ci default NULL,
  `unece_locode` varchar(15) collate latin1_general_ci default NULL,
  `name` varchar(100) collate latin1_general_ci NOT NULL default '',
  `zip_code` varchar(25) collate latin1_general_ci default NULL,
  `iso_country_id` char(3) collate latin1_general_ci NOT NULL default '',
  `unece_locode_type` tinyint(3) unsigned default NULL,
  `unece_coordinates` varchar(25) collate latin1_general_ci default NULL,
  `info_url` varchar(255) collate latin1_general_ci default NULL,
  `use_frequency` bigint(20) unsigned NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci default NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL default '',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 4096 kB' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_appointment`
--

CREATE TABLE `care_appointment` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `to_dept_id` varchar(25) collate latin1_general_ci NOT NULL,
  `to_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `to_personell_nr` int(11) NOT NULL default '0',
  `to_personell_name` varchar(60) collate latin1_general_ci default NULL,
  `purpose` text collate latin1_general_ci NOT NULL,
  `urgency` tinyint(2) unsigned NOT NULL default '0',
  `remind` tinyint(1) unsigned NOT NULL default '0',
  `remind_email` tinyint(1) unsigned NOT NULL default '0',
  `remind_mail` tinyint(1) unsigned NOT NULL default '0',
  `remind_phone` tinyint(1) unsigned NOT NULL default '0',
  `appt_status` varchar(35) collate latin1_general_ci NOT NULL default 'pending',
  `cancel_by` varchar(255) collate latin1_general_ci NOT NULL,
  `cancel_date` date default NULL,
  `cancel_reason` varchar(255) collate latin1_general_ci default NULL,
  `encounter_class_nr` int(1) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 4096 kB' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_billing_archive`
--

CREATE TABLE `care_billing_archive` (
  `bill_no` bigint(20) NOT NULL default '0',
  `encounter_nr` int(10) NOT NULL default '0',
  `patient_name` tinytext collate latin1_general_ci NOT NULL,
  `vorname` varchar(35) collate latin1_general_ci NOT NULL default '0',
  `bill_date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `bill_amt` double(16,4) NOT NULL default '0.0000',
  `payment_date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `payment_mode` text collate latin1_general_ci NOT NULL,
  `cheque_no` varchar(10) collate latin1_general_ci NOT NULL default '0',
  `creditcard_no` varchar(10) collate latin1_general_ci NOT NULL default '0',
  `paid_by` varchar(15) collate latin1_general_ci NOT NULL default '0',
  PRIMARY KEY  (`bill_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_billing_bill`
--

CREATE TABLE `care_billing_bill` (
  `bill_bill_no` bigint(20) NOT NULL default '0',
  `bill_encounter_nr` int(10) unsigned NOT NULL default '0',
  `bill_date_time` date default NULL,
  `bill_amount` float(10,2) default NULL,
  `bill_outstanding` float(10,2) default NULL,
  PRIMARY KEY  (`bill_bill_no`),
  KEY `index_bill_patnum` (`bill_encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_billing_bill_item`
--

CREATE TABLE `care_billing_bill_item` (
  `bill_item_id` int(11) NOT NULL auto_increment,
  `bill_item_encounter_nr` int(10) unsigned NOT NULL default '0',
  `bill_item_code` varchar(5) collate latin1_general_ci default NULL,
  `bill_item_unit_cost` float(10,2) default '0.00',
  `bill_item_units` tinyint(4) default NULL,
  `bill_item_amount` float(10,2) default NULL,
  `bill_item_date` datetime default NULL,
  `bill_item_status` enum('0','1') collate latin1_general_ci default '0',
  `bill_item_bill_no` int(11) NOT NULL default '0',
  PRIMARY KEY  (`bill_item_id`),
  KEY `index_bill_item_patnum` (`bill_item_encounter_nr`),
  KEY `index_bill_item_bill_no` (`bill_item_bill_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_billing_final`
--

CREATE TABLE `care_billing_final` (
  `final_id` tinyint(3) NOT NULL auto_increment,
  `final_encounter_nr` int(10) unsigned NOT NULL default '0',
  `final_bill_no` int(11) default NULL,
  `final_date` date default NULL,
  `final_total_bill_amount` float(10,2) default NULL,
  `final_discount` tinyint(4) default NULL,
  `final_total_receipt_amount` float(10,2) default NULL,
  `final_amount_due` float(10,2) default NULL,
  `final_amount_recieved` float(10,2) default NULL,
  PRIMARY KEY  (`final_id`),
  KEY `index_final_patnum` (`final_encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 6144 kB' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_billing_item`
--

CREATE TABLE `care_billing_item` (
  `item_code` varchar(5) collate latin1_general_ci NOT NULL,
  `item_description` varchar(100) collate latin1_general_ci default NULL,
  `item_unit_cost` float(10,2) default '0.00',
  `item_type` tinytext collate latin1_general_ci,
  `item_discount_max_allowed` tinyint(4) unsigned default '0',
  PRIMARY KEY  (`item_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_billing_payment`
--

CREATE TABLE `care_billing_payment` (
  `payment_id` tinyint(5) NOT NULL auto_increment,
  `payment_encounter_nr` int(10) unsigned NOT NULL default '0',
  `payment_receipt_no` int(11) NOT NULL default '0',
  `payment_date` datetime default '0000-00-00 00:00:00',
  `payment_cash_amount` float(10,2) default '0.00',
  `payment_cheque_no` int(11) default '0',
  `payment_cheque_amount` float(10,2) default '0.00',
  `payment_creditcard_no` int(25) default '0',
  `payment_creditcard_amount` float(10,2) default '0.00',
  `payment_amount_total` float(10,2) default '0.00',
  PRIMARY KEY  (`payment_id`),
  KEY `index_payment_patnum` (`payment_encounter_nr`),
  KEY `index_payment_receipt_no` (`payment_receipt_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_cache`
--

CREATE TABLE `care_cache` (
  `id` varchar(125) collate latin1_general_ci NOT NULL,
  `ctext` text collate latin1_general_ci,
  `cbinary` blob,
  `tstamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_cafe_menu`
--

CREATE TABLE `care_cafe_menu` (
  `item` int(11) NOT NULL auto_increment,
  `lang` varchar(10) collate latin1_general_ci NOT NULL default 'en',
  `cdate` date NOT NULL default '0000-00-00',
  `menu` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  UNIQUE KEY `item_2` (`item`),
  KEY `item` (`item`,`lang`),
  KEY `cdate` (`cdate`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_cafe_prices`
--

CREATE TABLE `care_cafe_prices` (
  `item` int(11) NOT NULL auto_increment,
  `lang` varchar(10) collate latin1_general_ci NOT NULL default 'en',
  `productgroup` tinytext collate latin1_general_ci NOT NULL,
  `article` tinytext collate latin1_general_ci NOT NULL,
  `description` tinytext collate latin1_general_ci NOT NULL,
  `price` varchar(10) collate latin1_general_ci NOT NULL,
  `unit` tinytext collate latin1_general_ci NOT NULL,
  `pic_filename` tinytext collate latin1_general_ci NOT NULL,
  `modify_id` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  KEY `item` (`item`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_category_diagnosis`
--

CREATE TABLE `care_category_diagnosis` (
  `nr` tinyint(3) unsigned NOT NULL default '0',
  `category` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `short_code` char(1) collate latin1_general_ci NOT NULL,
  `LD_var_short_code` varchar(25) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `hide_from` varchar(255) collate latin1_general_ci NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_category_disease`
--

CREATE TABLE `care_category_disease` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `category` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_category_procedure`
--

CREATE TABLE `care_category_procedure` (
  `nr` tinyint(3) unsigned NOT NULL default '0',
  `category` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `short_code` char(1) collate latin1_general_ci NOT NULL,
  `LD_var_short_code` varchar(25) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `hide_from` varchar(255) collate latin1_general_ci NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_classif_neonatal`
--

CREATE TABLE `care_classif_neonatal` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `id` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_class_encounter`
--

CREATE TABLE `care_class_encounter` (
  `class_nr` smallint(6) unsigned NOT NULL default '0',
  `class_id` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(25) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `hide_from` tinyint(4) NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`class_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_class_ethnic_orig`
--

CREATE TABLE `care_class_ethnic_orig` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_class_financial`
--

CREATE TABLE `care_class_financial` (
  `class_nr` smallint(5) unsigned NOT NULL auto_increment,
  `class_id` varchar(15) collate latin1_general_ci NOT NULL default '0',
  `type` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `code` varchar(5) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(25) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `policy` text collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`class_nr`),
  KEY `class_2` (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_class_insurance`
--

CREATE TABLE `care_class_insurance` (
  `class_nr` smallint(5) unsigned NOT NULL auto_increment,
  `class_id` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(25) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`class_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_class_therapy`
--

CREATE TABLE `care_class_therapy` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `class` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(25) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_complication`
--

CREATE TABLE `care_complication` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `group_nr` int(11) unsigned NOT NULL default '0',
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `code` varchar(25) collate latin1_general_ci default NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_config_global`
--

CREATE TABLE `care_config_global` (
  `type` varchar(60) collate latin1_general_ci NOT NULL,
  `value` varchar(255) collate latin1_general_ci default NULL,
  `notes` varchar(255) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_config_user`
--

CREATE TABLE `care_config_user` (
  `user_id` varchar(100) collate latin1_general_ci NOT NULL,
  `serial_config_data` text collate latin1_general_ci NOT NULL,
  `notes` varchar(255) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_currency`
--

CREATE TABLE `care_currency` (
  `item_no` smallint(5) unsigned NOT NULL auto_increment,
  `short_name` varchar(5) collate latin1_general_ci NOT NULL,
  `long_name` varchar(20) collate latin1_general_ci NOT NULL,
  `info` varchar(50) collate latin1_general_ci NOT NULL,
  `status` varchar(5) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(20) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(20) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  KEY `item_no` (`item_no`),
  KEY `short_name` (`short_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_department`
--

CREATE TABLE `care_department` (
  `nr` mediumint(8) unsigned NOT NULL auto_increment,
  `id` varchar(60) collate latin1_general_ci NOT NULL,
  `type` varchar(25) collate latin1_general_ci NOT NULL,
  `name_formal` varchar(60) collate latin1_general_ci NOT NULL,
  `name_short` varchar(35) collate latin1_general_ci NOT NULL,
  `name_alternate` varchar(225) collate latin1_general_ci default NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `admit_inpatient` tinyint(1) NOT NULL default '0',
  `admit_outpatient` tinyint(1) NOT NULL default '0',
  `has_oncall_doc` tinyint(1) NOT NULL default '1',
  `has_oncall_nurse` tinyint(1) NOT NULL default '1',
  `does_surgery` tinyint(1) NOT NULL default '0',
  `this_institution` tinyint(1) NOT NULL default '1',
  `is_sub_dept` tinyint(1) NOT NULL default '0',
  `parent_dept_nr` tinyint(3) unsigned default NULL,
  `work_hours` varchar(100) collate latin1_general_ci default NULL,
  `consult_hours` varchar(100) collate latin1_general_ci default NULL,
  `is_inactive` tinyint(1) NOT NULL default '0',
  `sort_order` tinyint(3) unsigned NOT NULL default '0',
  `address` text collate latin1_general_ci,
  `sig_line` varchar(60) collate latin1_general_ci default NULL,
  `sig_stamp` text collate latin1_general_ci,
  `logo_mime_type` varchar(5) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `is_pharmacy` tinyint(4) NOT NULL COMMENT 'is a pharmacy, or a normal dept ?',
  `pharma_dept_nr` tinyint(3) unsigned default '0' COMMENT 'to wich pharmacy i take medicaments ?',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_diagnosis_localcode`
--

CREATE TABLE `care_diagnosis_localcode` (
  `localcode` varchar(12) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `class_sub` varchar(5) collate latin1_general_ci NOT NULL,
  `type` varchar(10) collate latin1_general_ci NOT NULL,
  `inclusive` text collate latin1_general_ci NOT NULL,
  `exclusive` text collate latin1_general_ci NOT NULL,
  `notes` text collate latin1_general_ci NOT NULL,
  `std_code` char(1) collate latin1_general_ci NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text collate latin1_general_ci NOT NULL,
  `extra_codes` text collate latin1_general_ci NOT NULL,
  `extra_subclass` text collate latin1_general_ci NOT NULL,
  `search_keys` varchar(255) collate latin1_general_ci NOT NULL,
  `use_frequency` int(11) NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`localcode`),
  KEY `diagnosis_code` (`localcode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_drg_intern`
--

CREATE TABLE `care_drg_intern` (
  `nr` int(11) NOT NULL auto_increment,
  `code` varchar(12) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `synonyms` text collate latin1_general_ci NOT NULL,
  `notes` text collate latin1_general_ci,
  `std_code` char(1) collate latin1_general_ci NOT NULL,
  `sub_level` tinyint(1) NOT NULL default '0',
  `parent_code` varchar(12) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `nr` (`nr`),
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_drg_quicklist`
--

CREATE TABLE `care_drg_quicklist` (
  `nr` int(11) NOT NULL auto_increment,
  `code` varchar(25) collate latin1_general_ci NOT NULL,
  `code_parent` varchar(25) collate latin1_general_ci NOT NULL,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `qlist_type` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `rank` int(11) NOT NULL default '0',
  `status` varchar(15) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_drg_related_codes`
--

CREATE TABLE `care_drg_related_codes` (
  `nr` int(11) NOT NULL auto_increment,
  `group_nr` int(11) unsigned NOT NULL default '0',
  `code` varchar(15) collate latin1_general_ci NOT NULL,
  `code_parent` varchar(15) collate latin1_general_ci NOT NULL,
  `code_type` varchar(15) collate latin1_general_ci NOT NULL,
  `rank` int(11) NOT NULL default '0',
  `status` varchar(15) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=165 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_dutyplan_oncall`
--

CREATE TABLE `care_dutyplan_oncall` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `dept_nr` int(10) unsigned NOT NULL default '0',
  `role_nr` tinyint(3) unsigned NOT NULL default '0',
  `year` year(4) NOT NULL default '0000',
  `month` char(2) collate latin1_general_ci NOT NULL,
  `duty_1_txt` text collate latin1_general_ci NOT NULL,
  `duty_2_txt` text collate latin1_general_ci NOT NULL,
  `duty_1_pnr` text collate latin1_general_ci NOT NULL,
  `duty_2_pnr` text collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `dept_nr` (`dept_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_effective_day`
--

CREATE TABLE `care_effective_day` (
  `eff_day_nr` tinyint(4) NOT NULL auto_increment,
  `name` varchar(25) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`eff_day_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter`
--

CREATE TABLE `care_encounter` (
  `encounter_nr` bigint(11) unsigned NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `encounter_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `encounter_class_nr` smallint(5) unsigned NOT NULL default '0',
  `encounter_type` varchar(35) collate latin1_general_ci NOT NULL,
  `encounter_status` varchar(35) collate latin1_general_ci NOT NULL,
  `referrer_diagnosis` varchar(255) collate latin1_general_ci NOT NULL,
  `referrer_recom_therapy` varchar(255) collate latin1_general_ci default NULL,
  `referrer_dr` varchar(60) collate latin1_general_ci NOT NULL,
  `referrer_dept` varchar(255) collate latin1_general_ci NOT NULL,
  `referrer_institution` varchar(255) collate latin1_general_ci NOT NULL,
  `referrer_notes` text collate latin1_general_ci NOT NULL,
  `regional_code` varchar(60) collate latin1_general_ci default NULL,
  `triage` varchar(20) collate latin1_general_ci NOT NULL default 'white',
  `admit_type` int(10) NOT NULL default '0',
  `financial_class_nr` tinyint(3) unsigned NOT NULL default '0',
  `insurance_nr` varchar(25) collate latin1_general_ci default '0',
  `insurance_firm_id` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `insurance_class_nr` tinyint(3) unsigned NOT NULL default '0',
  `insurance_2_nr` varchar(25) collate latin1_general_ci default '0',
  `insurance_2_firm_id` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `guarantor_pid` int(11) NOT NULL default '0',
  `contact_pid` int(11) NOT NULL default '0',
  `contact_relation` varchar(35) collate latin1_general_ci NOT NULL,
  `current_ward_nr` smallint(3) unsigned NOT NULL default '0',
  `current_room_nr` smallint(5) unsigned NOT NULL default '0',
  `in_ward` tinyint(1) NOT NULL default '0',
  `current_dept_nr` smallint(3) unsigned NOT NULL default '0',
  `in_dept` tinyint(1) NOT NULL default '0',
  `current_firm_nr` smallint(5) unsigned NOT NULL default '0',
  `current_att_dr_nr` int(10) NOT NULL default '0',
  `consulting_dr` varchar(60) collate latin1_general_ci NOT NULL,
  `extra_service` varchar(25) collate latin1_general_ci NOT NULL,
  `is_discharged` tinyint(1) unsigned NOT NULL default '0',
  `discharge_date` date default NULL,
  `discharge_time` time default NULL,
  `followup_date` date NOT NULL default '0000-00-00',
  `followup_responsibility` varchar(255) collate latin1_general_ci default NULL,
  `post_encounter_notes` text collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`encounter_nr`),
  KEY `pid` (`pid`),
  KEY `encounter_date` (`encounter_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 11264 kB' AUTO_INCREMENT=2007500004 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_custom_ddc`
--

CREATE TABLE `care_encounter_custom_ddc` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL,
  `indatetime` datetime NOT NULL,
  `urinesugar` varchar(35) collate latin1_general_ci NOT NULL,
  `acetone` varchar(35) collate latin1_general_ci NOT NULL,
  `bloodsugar` decimal(10,2) NOT NULL,
  `tablets` varchar(35) collate latin1_general_ci NOT NULL,
  `insulin` decimal(10,2) NOT NULL,
  `createid` varchar(64) collate latin1_general_ci NOT NULL,
  `createtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_custom_inout`
--

CREATE TABLE `care_encounter_custom_inout` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL,
  `indatetime` datetime NOT NULL,
  `pint` decimal(10,2) NOT NULL,
  `solution` varchar(32) collate latin1_general_ci NOT NULL,
  `solutionamount` decimal(10,2) NOT NULL,
  `initial` varchar(6) collate latin1_general_ci NOT NULL,
  `oralfluid` varchar(32) collate latin1_general_ci NOT NULL,
  `oralfluidamount` decimal(10,2) NOT NULL,
  `urinetime` time NOT NULL,
  `urineamount` decimal(10,2) NOT NULL,
  `rta` decimal(10,2) NOT NULL,
  `drain` decimal(10,2) NOT NULL,
  `createid` varchar(64) collate latin1_general_ci NOT NULL,
  `createtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_custom_noc`
--

CREATE TABLE `care_encounter_custom_noc` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL,
  `indatetime` datetime NOT NULL,
  `verbal` tinyint(1) NOT NULL,
  `moton` tinyint(1) NOT NULL,
  `eyes` tinyint(1) NOT NULL,
  `createid` varchar(64) collate latin1_general_ci NOT NULL,
  `createtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_custom_tc`
--

CREATE TABLE `care_encounter_custom_tc` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL,
  `createid` varchar(64) collate latin1_general_ci NOT NULL,
  `createtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `indatetime` datetime NOT NULL,
  `time` time NOT NULL,
  `position` varchar(32) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_diagnosis`
--

CREATE TABLE `care_encounter_diagnosis` (
  `diagnosis_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `op_nr` int(10) unsigned NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `code` varchar(25) collate latin1_general_ci NOT NULL,
  `code_parent` varchar(25) collate latin1_general_ci NOT NULL,
  `group_nr` mediumint(8) unsigned NOT NULL default '0',
  `code_version` tinyint(4) NOT NULL default '0',
  `localcode` varchar(35) collate latin1_general_ci NOT NULL,
  `category_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `localization` varchar(35) collate latin1_general_ci NOT NULL,
  `diagnosing_clinician` varchar(60) collate latin1_general_ci NOT NULL,
  `diagnosing_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`diagnosis_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=165 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_diagnostics_report`
--

CREATE TABLE `care_encounter_diagnostics_report` (
  `item_nr` int(11) NOT NULL auto_increment,
  `report_nr` int(11) NOT NULL default '0',
  `reporting_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `reporting_dept` varchar(100) collate latin1_general_ci NOT NULL,
  `report_date` date NOT NULL default '0000-00-00',
  `report_time` time NOT NULL default '00:00:00',
  `encounter_nr` int(10) NOT NULL default '0',
  `script_call` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`item_nr`,`report_nr`),
  KEY `report_nr` (`report_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_drg_intern`
--

CREATE TABLE `care_encounter_drg_intern` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `group_nr` mediumint(8) unsigned NOT NULL default '0',
  `clinician` varchar(60) collate latin1_general_ci NOT NULL,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_event_signaller`
--

CREATE TABLE `care_encounter_event_signaller` (
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `yellow` tinyint(1) NOT NULL default '0',
  `black` tinyint(1) NOT NULL default '0',
  `blue_pale` tinyint(1) NOT NULL default '0',
  `brown` tinyint(1) NOT NULL default '0',
  `pink` tinyint(1) NOT NULL default '0',
  `yellow_pale` tinyint(1) NOT NULL default '0',
  `red` tinyint(1) NOT NULL default '0',
  `green_pale` tinyint(1) NOT NULL default '0',
  `violet` tinyint(1) NOT NULL default '0',
  `blue` tinyint(1) NOT NULL default '0',
  `biege` tinyint(1) NOT NULL default '0',
  `orange` tinyint(1) NOT NULL default '0',
  `green_1` tinyint(1) NOT NULL default '0',
  `green_2` tinyint(1) NOT NULL default '0',
  `green_3` tinyint(1) NOT NULL default '0',
  `green_4` tinyint(1) NOT NULL default '0',
  `green_5` tinyint(1) NOT NULL default '0',
  `green_6` tinyint(1) NOT NULL default '0',
  `green_7` tinyint(1) NOT NULL default '0',
  `rose_1` tinyint(1) NOT NULL default '0',
  `rose_2` tinyint(1) NOT NULL default '0',
  `rose_3` tinyint(1) NOT NULL default '0',
  `rose_4` tinyint(1) NOT NULL default '0',
  `rose_5` tinyint(1) NOT NULL default '0',
  `rose_6` tinyint(1) NOT NULL default '0',
  `rose_7` tinyint(1) NOT NULL default '0',
  `rose_8` tinyint(1) NOT NULL default '0',
  `rose_9` tinyint(1) NOT NULL default '0',
  `rose_10` tinyint(1) NOT NULL default '0',
  `rose_11` tinyint(1) NOT NULL default '0',
  `rose_12` tinyint(1) NOT NULL default '0',
  `rose_13` tinyint(1) NOT NULL default '0',
  `rose_14` tinyint(1) NOT NULL default '0',
  `rose_15` tinyint(1) NOT NULL default '0',
  `rose_16` tinyint(1) NOT NULL default '0',
  `rose_17` tinyint(1) NOT NULL default '0',
  `rose_18` tinyint(1) NOT NULL default '0',
  `rose_19` tinyint(1) NOT NULL default '0',
  `rose_20` tinyint(1) NOT NULL default '0',
  `rose_21` tinyint(1) NOT NULL default '0',
  `rose_22` tinyint(1) NOT NULL default '0',
  `rose_23` tinyint(1) NOT NULL default '0',
  `rose_24` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_financial_class`
--

CREATE TABLE `care_encounter_financial_class` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `class_nr` smallint(3) unsigned NOT NULL default '0',
  `date_start` date default NULL,
  `date_end` date default NULL,
  `date_create` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_image`
--

CREATE TABLE `care_encounter_image` (
  `nr` bigint(20) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `shot_date` date NOT NULL default '0000-00-00',
  `shot_nr` smallint(6) NOT NULL default '0',
  `mime_type` varchar(10) collate latin1_general_ci NOT NULL,
  `upload_date` date NOT NULL default '0000-00-00',
  `notes` text collate latin1_general_ci NOT NULL,
  `graphic_script` text collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_immunization`
--

CREATE TABLE `care_encounter_immunization` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  `type` varchar(60) collate latin1_general_ci NOT NULL,
  `medicine` varchar(60) collate latin1_general_ci NOT NULL,
  `dosage` varchar(60) collate latin1_general_ci default NULL,
  `application_type_nr` smallint(5) unsigned NOT NULL default '0',
  `application_by` varchar(60) collate latin1_general_ci default NULL,
  `titer` varchar(15) collate latin1_general_ci default NULL,
  `refresh_date` date default NULL,
  `notes` text collate latin1_general_ci,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_location`
--

CREATE TABLE `care_encounter_location` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `type_nr` smallint(5) unsigned NOT NULL default '0',
  `location_nr` smallint(5) unsigned NOT NULL default '0',
  `group_nr` smallint(5) unsigned NOT NULL default '0',
  `date_from` date NOT NULL default '0000-00-00',
  `date_to` date NOT NULL default '0000-00-00',
  `time_from` time default '00:00:00',
  `time_to` time default NULL,
  `discharge_type_nr` tinyint(3) unsigned NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`location_nr`),
  KEY `type` (`type_nr`),
  KEY `location_id` (`location_nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `location_nr` (`location_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1356 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_measurement`
--

CREATE TABLE `care_encounter_measurement` (
  `nr` int(11) unsigned NOT NULL auto_increment,
  `msr_date` date NOT NULL default '0000-00-00',
  `msr_time` float(4,2) NOT NULL default '0.00',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `msr_type_nr` tinyint(3) unsigned NOT NULL default '0',
  `value` varchar(255) collate latin1_general_ci default NULL,
  `unit_nr` smallint(5) unsigned default NULL,
  `unit_type_nr` tinyint(2) unsigned NOT NULL default '0',
  `notes` varchar(255) collate latin1_general_ci default NULL,
  `measured_by` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`msr_type_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_notes`
--

CREATE TABLE `care_encounter_notes` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `type_nr` smallint(5) unsigned NOT NULL default '0',
  `notes` text collate latin1_general_ci NOT NULL,
  `short_notes` varchar(25) collate latin1_general_ci default NULL,
  `aux_notes` varchar(255) collate latin1_general_ci default NULL,
  `ref_notes_nr` int(10) unsigned NOT NULL default '0',
  `personell_nr` int(10) unsigned NOT NULL default '0',
  `personell_name` varchar(60) collate latin1_general_ci NOT NULL,
  `send_to_pid` int(11) NOT NULL default '0',
  `send_to_name` varchar(60) collate latin1_general_ci default NULL,
  `date` date default NULL,
  `time` time default NULL,
  `location_type` varchar(35) collate latin1_general_ci default NULL,
  `location_type_nr` tinyint(3) NOT NULL default '0',
  `location_nr` mediumint(8) unsigned NOT NULL default '0',
  `location_id` varchar(60) collate latin1_general_ci default NULL,
  `ack_short_id` varchar(10) collate latin1_general_ci NOT NULL,
  `date_ack` datetime default NULL,
  `date_checked` datetime default NULL,
  `date_printed` datetime default NULL,
  `send_by_mail` tinyint(1) default NULL,
  `send_by_email` tinyint(1) default NULL,
  `send_by_fax` tinyint(1) default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `type_nr` (`type_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1029 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_obstetric`
--

CREATE TABLE `care_encounter_obstetric` (
  `encounter_nr` int(11) unsigned NOT NULL auto_increment,
  `pregnancy_nr` int(11) unsigned NOT NULL default '0',
  `hospital_adm_nr` int(11) unsigned NOT NULL default '0',
  `patient_class` varchar(60) collate latin1_general_ci NOT NULL,
  `is_discharged_not_in_labour` tinyint(1) default NULL,
  `is_re_admission` tinyint(1) default NULL,
  `referral_status` varchar(60) collate latin1_general_ci default NULL,
  `referral_reason` text collate latin1_general_ci,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`encounter_nr`),
  KEY `encounter_nr` (`pregnancy_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_op`
--

CREATE TABLE `care_encounter_op` (
  `nr` int(11) NOT NULL auto_increment,
  `year` varchar(4) collate latin1_general_ci NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `op_room` varchar(10) collate latin1_general_ci NOT NULL default '0',
  `op_nr` mediumint(9) NOT NULL default '0',
  `op_date` date NOT NULL default '0000-00-00',
  `op_src_date` varchar(8) collate latin1_general_ci NOT NULL,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `diagnosis` text collate latin1_general_ci NOT NULL,
  `operator` text collate latin1_general_ci NOT NULL,
  `assistant` text collate latin1_general_ci NOT NULL,
  `scrub_nurse` text collate latin1_general_ci NOT NULL,
  `rotating_nurse` text collate latin1_general_ci NOT NULL,
  `anesthesia` varchar(30) collate latin1_general_ci NOT NULL,
  `an_doctor` text collate latin1_general_ci NOT NULL,
  `op_therapy` text collate latin1_general_ci NOT NULL,
  `result_info` text collate latin1_general_ci NOT NULL,
  `entry_time` varchar(5) collate latin1_general_ci NOT NULL,
  `cut_time` varchar(5) collate latin1_general_ci NOT NULL,
  `close_time` varchar(5) collate latin1_general_ci NOT NULL,
  `exit_time` varchar(5) collate latin1_general_ci NOT NULL,
  `entry_out` text collate latin1_general_ci NOT NULL,
  `cut_close` text collate latin1_general_ci NOT NULL,
  `wait_time` text collate latin1_general_ci NOT NULL,
  `bandage_time` text collate latin1_general_ci NOT NULL,
  `repos_time` text collate latin1_general_ci NOT NULL,
  `encoding` longtext collate latin1_general_ci NOT NULL,
  `doc_date` varchar(10) collate latin1_general_ci NOT NULL,
  `doc_time` varchar(5) collate latin1_general_ci NOT NULL,
  `duty_type` varchar(15) collate latin1_general_ci NOT NULL,
  `material_codedlist` text collate latin1_general_ci NOT NULL,
  `container_codedlist` text collate latin1_general_ci NOT NULL,
  `icd_code` text collate latin1_general_ci NOT NULL,
  `ops_code` text collate latin1_general_ci NOT NULL,
  `ops_intern_code` text collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `dept` (`dept_nr`),
  KEY `op_room` (`op_room`),
  KEY `op_date` (`op_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_prescription`
--

CREATE TABLE `care_encounter_prescription` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `prescribe_date` date default NULL,
  `notes` text collate latin1_general_ci,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `prescriber` varchar(60) collate latin1_general_ci NOT NULL,
  `dept_nr` int(11) NOT NULL default '0' COMMENT 'the dept from wich the prescriprion is being made',
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=85 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_prescription_notes`
--

CREATE TABLE `care_encounter_prescription_notes` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `prescription_nr` int(10) unsigned NOT NULL default '0',
  `notes` varchar(35) collate latin1_general_ci default NULL,
  `short_notes` varchar(25) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_prescription_sub`
--

CREATE TABLE `care_encounter_prescription_sub` (
  `nr` int(11) NOT NULL auto_increment,
  `prescription_nr` int(11) NOT NULL default '0',
  `prescription_type_nr` smallint(5) NOT NULL default '0',
  `bestellnum` varchar(20) collate latin1_general_ci NOT NULL default '0',
  `article` varchar(100) collate latin1_general_ci NOT NULL,
  `drug_class` varchar(60) collate latin1_general_ci NOT NULL,
  `dosage` varchar(255) collate latin1_general_ci NOT NULL,
  `admin_time` varchar(50) collate latin1_general_ci NOT NULL default '00',
  `quantity` varchar(10) collate latin1_general_ci NOT NULL default '0',
  `application_type_nr` smallint(5) NOT NULL default '0',
  `sub_speed` double(5,3) default NULL,
  `notes_sub` text collate latin1_general_ci,
  `color_marker` varchar(10) collate latin1_general_ci NOT NULL,
  `is_stopped` tinyint(1) NOT NULL default '0',
  `stop_date` date default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `companion` varchar(50) collate latin1_general_ci NOT NULL default '-1',
  `price` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`nr`),
  KEY `prescription_nr` (`prescription_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_procedure`
--

CREATE TABLE `care_encounter_procedure` (
  `procedure_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `op_nr` int(11) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `code` varchar(25) collate latin1_general_ci NOT NULL,
  `code_parent` varchar(25) collate latin1_general_ci NOT NULL,
  `group_nr` mediumint(8) unsigned NOT NULL default '0',
  `code_version` tinyint(4) NOT NULL default '0',
  `localcode` varchar(35) collate latin1_general_ci NOT NULL,
  `category_nr` tinyint(3) unsigned NOT NULL default '0',
  `localization` varchar(35) collate latin1_general_ci NOT NULL,
  `responsible_clinician` varchar(60) collate latin1_general_ci NOT NULL,
  `responsible_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`procedure_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_encounter_sickconfirm`
--

CREATE TABLE `care_encounter_sickconfirm` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `date_confirm` date NOT NULL default '0000-00-00',
  `date_start` date NOT NULL default '0000-00-00',
  `date_end` date NOT NULL default '0000-00-00',
  `date_create` date NOT NULL default '0000-00-00',
  `diagnosis` text collate latin1_general_ci NOT NULL,
  `dept_nr` smallint(6) NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_group`
--

CREATE TABLE `care_group` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `id` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_icd10_it`
--

CREATE TABLE `care_icd10_it` (
  `diagnosis_code` varchar(12) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `class_sub` varchar(5) collate latin1_general_ci NOT NULL,
  `type` varchar(10) collate latin1_general_ci NOT NULL,
  `inclusive` text collate latin1_general_ci NOT NULL,
  `exclusive` text collate latin1_general_ci NOT NULL,
  `notes` text collate latin1_general_ci NOT NULL,
  `std_code` char(1) collate latin1_general_ci NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text collate latin1_general_ci NOT NULL,
  `extra_codes` text collate latin1_general_ci NOT NULL,
  `extra_subclass` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_img_diagnostic`
--

CREATE TABLE `care_img_diagnostic` (
  `nr` bigint(20) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `doc_ref_ids` varchar(255) collate latin1_general_ci default NULL,
  `img_type` varchar(10) collate latin1_general_ci NOT NULL,
  `max_nr` tinyint(2) default '0',
  `upload_date` date NOT NULL default '0000-00-00',
  `cancel_date` date NOT NULL default '0000-00-00',
  `cancel_by` varchar(35) collate latin1_general_ci default NULL,
  `notes` text collate latin1_general_ci,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_insurance_firm`
--

CREATE TABLE `care_insurance_firm` (
  `firm_id` varchar(40) collate latin1_general_ci NOT NULL,
  `name` varchar(60) collate latin1_general_ci NOT NULL,
  `iso_country_id` char(3) collate latin1_general_ci NOT NULL,
  `sub_area` varchar(60) collate latin1_general_ci NOT NULL,
  `type_nr` smallint(5) unsigned NOT NULL default '0',
  `addr` varchar(255) collate latin1_general_ci default NULL,
  `addr_mail` varchar(200) collate latin1_general_ci default NULL,
  `addr_billing` varchar(200) collate latin1_general_ci default NULL,
  `addr_email` varchar(60) collate latin1_general_ci default NULL,
  `phone_main` varchar(35) collate latin1_general_ci default NULL,
  `phone_aux` varchar(35) collate latin1_general_ci default NULL,
  `fax_main` varchar(35) collate latin1_general_ci default NULL,
  `fax_aux` varchar(35) collate latin1_general_ci default NULL,
  `contact_person` varchar(60) collate latin1_general_ci default NULL,
  `contact_phone` varchar(35) collate latin1_general_ci default NULL,
  `contact_fax` varchar(35) collate latin1_general_ci default NULL,
  `contact_email` varchar(60) collate latin1_general_ci default NULL,
  `use_frequency` bigint(20) unsigned NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`firm_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_mail_private`
--

CREATE TABLE `care_mail_private` (
  `recipient` varchar(60) collate latin1_general_ci NOT NULL,
  `sender` varchar(60) collate latin1_general_ci NOT NULL,
  `sender_ip` varchar(60) collate latin1_general_ci NOT NULL,
  `cc` varchar(255) collate latin1_general_ci NOT NULL,
  `bcc` varchar(255) collate latin1_general_ci NOT NULL,
  `subject` varchar(255) collate latin1_general_ci NOT NULL,
  `body` text collate latin1_general_ci NOT NULL,
  `sign` varchar(255) collate latin1_general_ci NOT NULL,
  `ask4ack` tinyint(4) NOT NULL default '0',
  `reply2` varchar(255) collate latin1_general_ci NOT NULL,
  `attachment` varchar(255) collate latin1_general_ci NOT NULL,
  `attach_type` varchar(30) collate latin1_general_ci NOT NULL,
  `read_flag` tinyint(4) NOT NULL default '0',
  `mailgroup` varchar(60) collate latin1_general_ci NOT NULL,
  `maildir` varchar(60) collate latin1_general_ci NOT NULL,
  `exec_level` tinyint(4) NOT NULL default '0',
  `exclude_addr` text collate latin1_general_ci NOT NULL,
  `send_dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `send_stamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `uid` varchar(255) collate latin1_general_ci NOT NULL,
  KEY `recipient` (`recipient`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_mail_private_users`
--

CREATE TABLE `care_mail_private_users` (
  `user_name` varchar(60) collate latin1_general_ci NOT NULL,
  `email` varchar(60) collate latin1_general_ci NOT NULL,
  `alias` varchar(60) collate latin1_general_ci NOT NULL,
  `pw` varchar(255) collate latin1_general_ci NOT NULL,
  `inbox` longtext collate latin1_general_ci NOT NULL,
  `sent` longtext collate latin1_general_ci NOT NULL,
  `drafts` longtext collate latin1_general_ci NOT NULL,
  `trash` longtext collate latin1_general_ci NOT NULL,
  `lastcheck` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `lock_flag` tinyint(4) NOT NULL default '0',
  `addr_book` text collate latin1_general_ci NOT NULL,
  `addr_quick` tinytext collate latin1_general_ci NOT NULL,
  `secret_q` tinytext collate latin1_general_ci NOT NULL,
  `secret_q_ans` tinytext collate latin1_general_ci NOT NULL,
  `public` tinyint(4) NOT NULL default '0',
  `sig` tinytext collate latin1_general_ci NOT NULL,
  `append_sig` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_med_ordercatalog`
--

CREATE TABLE `care_med_ordercatalog` (
  `item_no` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `hit` int(11) NOT NULL default '0',
  `artikelname` tinytext collate latin1_general_ci NOT NULL,
  `bestellnum` varchar(20) collate latin1_general_ci NOT NULL,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext collate latin1_general_ci NOT NULL,
  `doza` tinytext collate latin1_general_ci,
  `packing` tinytext collate latin1_general_ci,
  PRIMARY KEY  (`item_no`),
  KEY `item_no` (`item_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_med_orderlist`
--

CREATE TABLE `care_med_orderlist` (
  `order_nr` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `order_date` date NOT NULL default '0000-00-00',
  `order_time` time NOT NULL default '00:00:00',
  `articles` text collate latin1_general_ci NOT NULL,
  `extra1` tinytext collate latin1_general_ci NOT NULL,
  `extra2` text collate latin1_general_ci NOT NULL,
  `validator` tinytext collate latin1_general_ci NOT NULL,
  `ip_addr` tinytext collate latin1_general_ci NOT NULL,
  `priority` tinytext collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `sent_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `process_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`order_nr`),
  KEY `item_nr` (`order_nr`),
  KEY `dept` (`dept_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=102 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_med_orderlist_sub`
--

CREATE TABLE `care_med_orderlist_sub` (
  `sub_order` int(20) NOT NULL auto_increment,
  `order_nr_sub` int(20) NOT NULL,
  `bestellnum` varchar(25) collate latin1_general_ci default '0',
  `idsub` varchar(20) collate latin1_general_ci NOT NULL default '0' COMMENT 'id te care_pharma_products_main_sub',
  `artikelname` varchar(25) collate latin1_general_ci default NULL,
  `pcs` decimal(11,2) default NULL,
  `maxorder` int(11) default NULL,
  `minorder` int(11) default NULL,
  `proorder` int(11) default NULL,
  `njesia` varchar(20) collate latin1_general_ci default NULL,
  `skadenca` date default NULL,
  `cmimi` decimal(11,2) default NULL,
  `doza` decimal(11,2) default NULL,
  `vlera` decimal(11,2) NOT NULL default '0.00',
  PRIMARY KEY  (`sub_order`),
  UNIQUE KEY `sub_order` (`sub_order`),
  KEY `order_nr_sub` (`order_nr_sub`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_med_products_main`
--

CREATE TABLE `care_med_products_main` (
  `bestellnum` varchar(25) collate latin1_general_ci NOT NULL,
  `artikelnum` tinytext collate latin1_general_ci NOT NULL,
  `industrynum` tinytext collate latin1_general_ci NOT NULL,
  `artikelname` tinytext collate latin1_general_ci NOT NULL,
  `generic` tinytext collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `packing` tinytext collate latin1_general_ci NOT NULL,
  `doza` tinytext collate latin1_general_ci,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext collate latin1_general_ci NOT NULL,
  `picfile` tinytext collate latin1_general_ci NOT NULL,
  `encoder` tinytext collate latin1_general_ci NOT NULL,
  `enc_date` tinytext collate latin1_general_ci NOT NULL,
  `enc_time` tinytext collate latin1_general_ci NOT NULL,
  `lock_flag` tinyint(1) NOT NULL default '0',
  `medgroup` text collate latin1_general_ci NOT NULL,
  `cave` tinytext collate latin1_general_ci NOT NULL,
  `status` varchar(20) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `magazina` tinytext collate latin1_general_ci,
  `minpcs` int(99) unsigned NOT NULL default '0',
  PRIMARY KEY  (`bestellnum`),
  KEY `bestellnum` (`bestellnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci MIN_ROWS=134 MAX_ROWS=10000000 AVG_ROW_LENGTH=135 PACK_KEYS=0 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_menu_main`
--

CREATE TABLE `care_menu_main` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `sort_nr` tinyint(2) NOT NULL default '0',
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `url` varchar(255) collate latin1_general_ci NOT NULL,
  `is_visible` tinyint(1) unsigned NOT NULL default '1',
  `hide_by` text collate latin1_general_ci,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(60) collate latin1_general_ci default NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_menu_sub`
--

CREATE TABLE `care_menu_sub` (
  `s_nr` int(11) NOT NULL default '0',
  `s_sort_nr` int(11) NOT NULL default '0',
  `s_main_nr` int(11) NOT NULL default '0',
  `s_ebene` int(11) NOT NULL default '0',
  `s_name` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_LD_var` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_url` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_url_ext` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_image` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_open_image` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_is_visible` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_hide_by` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_status` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_modify_id` varchar(100) collate latin1_general_ci NOT NULL default '',
  `s_modify_time` datetime NOT NULL default '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_method_induction`
--

CREATE TABLE `care_method_induction` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `method` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_mode_delivery`
--

CREATE TABLE `care_mode_delivery` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `mode` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_neonatal`
--

CREATE TABLE `care_neonatal` (
  `nr` int(11) unsigned NOT NULL auto_increment,
  `pid` int(11) unsigned NOT NULL default '0',
  `delivery_date` date NOT NULL default '0000-00-00',
  `parent_encounter_nr` int(11) unsigned NOT NULL default '0',
  `delivery_nr` tinyint(4) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `delivery_place` varchar(60) collate latin1_general_ci NOT NULL,
  `delivery_mode` tinyint(2) NOT NULL default '0',
  `c_s_reason` text collate latin1_general_ci,
  `born_before_arrival` tinyint(1) default '0',
  `face_presentation` tinyint(1) NOT NULL default '0',
  `posterio_occipital_position` tinyint(1) NOT NULL default '0',
  `delivery_rank` tinyint(2) unsigned NOT NULL default '1',
  `apgar_1_min` tinyint(4) NOT NULL default '0',
  `apgar_5_min` tinyint(4) NOT NULL default '0',
  `apgar_10_min` tinyint(4) NOT NULL default '0',
  `time_to_spont_resp` tinyint(2) default NULL,
  `condition` varchar(60) collate latin1_general_ci default '0',
  `weight` float(8,2) unsigned default NULL,
  `length` float(8,2) unsigned default NULL,
  `head_circumference` float(8,2) unsigned default NULL,
  `scored_gestational_age` float(4,2) unsigned default NULL,
  `feeding` tinyint(4) NOT NULL default '0',
  `congenital_abnormality` varchar(125) collate latin1_general_ci NOT NULL,
  `classification` varchar(255) collate latin1_general_ci NOT NULL default '0',
  `disease_category` tinyint(2) NOT NULL default '0',
  `outcome` tinyint(2) NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `pid` (`pid`),
  KEY `pregnancy_nr` (`parent_encounter_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_news_article`
--

CREATE TABLE `care_news_article` (
  `nr` int(11) NOT NULL auto_increment,
  `lang` varchar(10) collate latin1_general_ci NOT NULL default 'en',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `category` tinytext collate latin1_general_ci NOT NULL,
  `status` varchar(10) collate latin1_general_ci NOT NULL default 'pending',
  `title` varchar(255) collate latin1_general_ci NOT NULL,
  `preface` text collate latin1_general_ci NOT NULL,
  `body` text collate latin1_general_ci NOT NULL,
  `pic` blob,
  `pic_mime` varchar(4) collate latin1_general_ci default NULL,
  `art_num` tinyint(1) NOT NULL default '0',
  `head_file` tinytext collate latin1_general_ci NOT NULL,
  `main_file` tinytext collate latin1_general_ci NOT NULL,
  `pic_file` tinytext collate latin1_general_ci NOT NULL,
  `author` varchar(30) collate latin1_general_ci NOT NULL,
  `submit_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `encode_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_date` date NOT NULL default '0000-00-00',
  `modify_id` varchar(30) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(30) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `item_no` (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_ops301_it`
--

CREATE TABLE `care_ops301_it` (
  `code` varchar(12) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `inclusive` text collate latin1_general_ci NOT NULL,
  `exclusive` text collate latin1_general_ci NOT NULL,
  `notes` text collate latin1_general_ci NOT NULL,
  `std_code` char(1) collate latin1_general_ci NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text collate latin1_general_ci NOT NULL,
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_op_med_doc`
--

CREATE TABLE `care_op_med_doc` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `op_date` varchar(12) collate latin1_general_ci NOT NULL,
  `operator` tinytext collate latin1_general_ci NOT NULL,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `diagnosis` text collate latin1_general_ci NOT NULL,
  `localize` text collate latin1_general_ci NOT NULL,
  `therapy` text collate latin1_general_ci NOT NULL,
  `special` text collate latin1_general_ci NOT NULL,
  `class_s` tinyint(4) NOT NULL default '0',
  `class_m` tinyint(4) NOT NULL default '0',
  `class_l` tinyint(4) NOT NULL default '0',
  `op_start` varchar(8) collate latin1_general_ci NOT NULL,
  `op_end` varchar(8) collate latin1_general_ci NOT NULL,
  `scrub_nurse` varchar(70) collate latin1_general_ci NOT NULL,
  `op_room` varchar(10) collate latin1_general_ci NOT NULL,
  `status` varchar(15) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_person`
--

CREATE TABLE `care_person` (
  `pid` int(11) unsigned NOT NULL auto_increment,
  `date_reg` datetime NOT NULL default '0000-00-00 00:00:00',
  `name_first` varchar(60) collate latin1_general_ci NOT NULL,
  `name_2` varchar(60) collate latin1_general_ci default NULL,
  `name_3` varchar(60) collate latin1_general_ci default NULL,
  `name_middle` varchar(60) collate latin1_general_ci default NULL,
  `name_last` varchar(60) collate latin1_general_ci NOT NULL,
  `name_maiden` varchar(60) collate latin1_general_ci default NULL,
  `name_others` text collate latin1_general_ci NOT NULL,
  `date_birth` date NOT NULL default '0000-00-00',
  `blood_group` char(2) collate latin1_general_ci NOT NULL,
  `addr_str` varchar(60) collate latin1_general_ci NOT NULL,
  `addr_str_nr` varchar(10) collate latin1_general_ci NOT NULL,
  `addr_zip` varchar(15) collate latin1_general_ci NOT NULL,
  `addr_citytown_nr` mediumint(8) unsigned NOT NULL default '0',
  `addr_is_valid` tinyint(1) NOT NULL default '0',
  `citizenship` varchar(35) collate latin1_general_ci default NULL,
  `phone_1_code` varchar(15) collate latin1_general_ci default '0',
  `phone_1_nr` varchar(35) collate latin1_general_ci default NULL,
  `phone_2_code` varchar(15) collate latin1_general_ci default '0',
  `phone_2_nr` varchar(35) collate latin1_general_ci default NULL,
  `cellphone_1_nr` varchar(35) collate latin1_general_ci default NULL,
  `cellphone_2_nr` varchar(35) collate latin1_general_ci default NULL,
  `fax` varchar(35) collate latin1_general_ci default NULL,
  `email` varchar(60) collate latin1_general_ci default NULL,
  `civil_status` varchar(35) collate latin1_general_ci NOT NULL,
  `sex` char(1) collate latin1_general_ci NOT NULL,
  `title` varchar(25) collate latin1_general_ci default NULL,
  `photo` blob,
  `photo_filename` varchar(60) collate latin1_general_ci NOT NULL,
  `ethnic_orig` mediumint(8) unsigned default NULL,
  `org_id` varchar(60) collate latin1_general_ci default NULL,
  `sss_nr` varchar(60) collate latin1_general_ci default NULL,
  `nat_id_nr` varchar(60) collate latin1_general_ci default NULL,
  `religion` varchar(125) collate latin1_general_ci default NULL,
  `mother_pid` int(11) unsigned NOT NULL default '0',
  `father_pid` int(11) unsigned NOT NULL default '0',
  `contact_person` varchar(255) collate latin1_general_ci default NULL,
  `contact_pid` int(11) unsigned NOT NULL default '0',
  `contact_relation` varchar(25) collate latin1_general_ci default '0',
  `death_date` date NOT NULL default '0000-00-00',
  `death_encounter_nr` int(10) unsigned NOT NULL default '0',
  `death_cause` varchar(255) collate latin1_general_ci default NULL,
  `death_cause_code` varchar(15) collate latin1_general_ci default NULL,
  `date_update` datetime default NULL,
  `status` varchar(20) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `relative_name_first` varchar(60) collate latin1_general_ci default NULL,
  `relative_name_last` varchar(60) collate latin1_general_ci default NULL,
  `relative_phone` varchar(35) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`pid`),
  KEY `name_last` (`name_last`),
  KEY `name_first` (`name_first`),
  KEY `date_reg` (`date_reg`),
  KEY `date_birth` (`date_birth`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 11264 kB' AUTO_INCREMENT=10000538 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_personell`
--

CREATE TABLE `care_personell` (
  `nr` int(11) NOT NULL auto_increment,
  `short_id` varchar(10) collate latin1_general_ci default NULL,
  `pid` int(11) NOT NULL default '0',
  `job_type_nr` int(11) NOT NULL default '0',
  `job_function_title` varchar(60) collate latin1_general_ci default NULL,
  `date_join` date default NULL,
  `date_exit` date default NULL,
  `contract_class` varchar(35) collate latin1_general_ci NOT NULL default '0',
  `contract_start` date default NULL,
  `contract_end` date default NULL,
  `is_discharged` tinyint(1) NOT NULL default '0',
  `pay_class` varchar(25) collate latin1_general_ci NOT NULL,
  `pay_class_sub` varchar(25) collate latin1_general_ci NOT NULL,
  `local_premium_id` varchar(5) collate latin1_general_ci NOT NULL,
  `tax_account_nr` varchar(60) collate latin1_general_ci NOT NULL,
  `ir_code` varchar(25) collate latin1_general_ci NOT NULL,
  `nr_workday` tinyint(1) NOT NULL default '0',
  `nr_weekhour` float(10,2) NOT NULL default '0.00',
  `nr_vacation_day` tinyint(2) NOT NULL default '0',
  `multiple_employer` tinyint(1) NOT NULL default '0',
  `nr_dependent` tinyint(2) unsigned NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`pid`,`job_type_nr`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=100029 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_personell_assignment`
--

CREATE TABLE `care_personell_assignment` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `personell_nr` int(11) unsigned NOT NULL default '0',
  `role_nr` smallint(5) unsigned NOT NULL default '0',
  `location_type_nr` smallint(5) unsigned NOT NULL default '0',
  `location_nr` smallint(5) unsigned NOT NULL default '0',
  `date_start` date NOT NULL default '0000-00-00',
  `date_end` date NOT NULL default '0000-00-00',
  `is_temporary` tinyint(1) unsigned default NULL,
  `list_frequency` int(11) unsigned NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`personell_nr`,`role_nr`,`location_type_nr`,`location_nr`),
  KEY `personell_nr` (`personell_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_person_insurance`
--

CREATE TABLE `care_person_insurance` (
  `item_nr` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `type` varchar(60) collate latin1_general_ci NOT NULL,
  `insurance_nr` varchar(50) collate latin1_general_ci NOT NULL default '0',
  `firm_id` varchar(60) collate latin1_general_ci NOT NULL,
  `class_nr` tinyint(2) unsigned NOT NULL default '0',
  `is_void` tinyint(1) unsigned NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`item_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_person_other_number`
--

CREATE TABLE `care_person_other_number` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `pid` int(11) unsigned NOT NULL default '0',
  `other_nr` varchar(30) collate latin1_general_ci NOT NULL,
  `org` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `pid` (`pid`),
  KEY `other_nr` (`other_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_pharma_ordercatalog`
--

CREATE TABLE `care_pharma_ordercatalog` (
  `item_no` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `hit` int(11) NOT NULL default '0',
  `artikelname` tinytext collate latin1_general_ci NOT NULL,
  `bestellnum` varchar(20) collate latin1_general_ci NOT NULL,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext collate latin1_general_ci NOT NULL,
  `doza` tinytext collate latin1_general_ci,
  `packing` tinytext collate latin1_general_ci,
  `quantity` int(11) NOT NULL default '0',
  KEY `item_no` (`item_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_pharma_orderlist`
--

CREATE TABLE `care_pharma_orderlist` (
  `order_nr` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `order_date` date NOT NULL default '0000-00-00',
  `order_time` time NOT NULL default '00:00:00',
  `articles` text collate latin1_general_ci NOT NULL,
  `extra1` tinytext collate latin1_general_ci NOT NULL,
  `extra2` text collate latin1_general_ci NOT NULL,
  `validator` tinytext collate latin1_general_ci NOT NULL,
  `ip_addr` tinytext collate latin1_general_ci NOT NULL,
  `priority` tinytext collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `sent_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `process_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`order_nr`,`dept_nr`),
  KEY `dept` (`dept_nr`),
  KEY `order_nr` (`order_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_pharma_orderlist_sub`
--

CREATE TABLE `care_pharma_orderlist_sub` (
  `sub_order` int(20) NOT NULL auto_increment,
  `order_nr_sub` int(20) NOT NULL,
  `bestellnum` varchar(25) collate latin1_general_ci default '0',
  `idsub` varchar(20) collate latin1_general_ci NOT NULL default '0' COMMENT 'id te care_pharma_products_main_sub',
  `artikelname` varchar(25) collate latin1_general_ci default NULL,
  `pcs` decimal(11,2) default NULL,
  `maxorder` int(11) default NULL,
  `minorder` int(11) default NULL,
  `proorder` int(11) default NULL,
  `njesia` varchar(20) collate latin1_general_ci default NULL,
  `skadenca` date default NULL,
  `cmimi` decimal(11,2) default NULL,
  `doza` decimal(11,2) default NULL,
  `vlera` decimal(11,2) NOT NULL default '0.00',
  PRIMARY KEY  (`sub_order`),
  UNIQUE KEY `sub_order` (`sub_order`),
  KEY `order_nr_sub` (`order_nr_sub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_pharma_products_main`
--

CREATE TABLE `care_pharma_products_main` (
  `bestellnum` varchar(25) collate latin1_general_ci NOT NULL,
  `id_sub` int(11) NOT NULL COMMENT 'lidhja me nenkartelen e produktit',
  `artikelnum` tinytext collate latin1_general_ci NOT NULL,
  `industrynum` tinytext collate latin1_general_ci NOT NULL,
  `artikelname` tinytext collate latin1_general_ci NOT NULL,
  `generic` tinytext collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `packing` tinytext collate latin1_general_ci NOT NULL,
  `doza` tinytext collate latin1_general_ci NOT NULL,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext collate latin1_general_ci NOT NULL,
  `picfile` tinytext collate latin1_general_ci NOT NULL,
  `encoder` tinytext collate latin1_general_ci NOT NULL,
  `enc_date` tinytext collate latin1_general_ci NOT NULL,
  `enc_time` tinytext collate latin1_general_ci NOT NULL,
  `lock_flag` tinyint(1) NOT NULL default '0',
  `medgroup` text collate latin1_general_ci NOT NULL,
  `cave` tinytext collate latin1_general_ci NOT NULL,
  `status` varchar(20) collate latin1_general_ci NOT NULL,
  `minpcs` int(99) unsigned NOT NULL default '0',
  `magazina` tinytext collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`bestellnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci MIN_ROWS=186 MAX_ROWS=10000000 AVG_ROW_LENGTH=186 PACK_KEYS=0 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_pharma_products_main_sub`
--

CREATE TABLE `care_pharma_products_main_sub` (
  `id` int(10) NOT NULL auto_increment,
  `bestellnum` varchar(25) collate latin1_general_ci default NULL COMMENT 'lidhja me care_pharma_products_main',
  `pcs` int(4) default NULL,
  `skadenca` date default NULL,
  `cmimi` double default NULL,
  `idcare_pharma` int(10) default NULL,
  `create_time` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_phone`
--

CREATE TABLE `care_phone` (
  `item_nr` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(25) collate latin1_general_ci default NULL,
  `name` varchar(45) collate latin1_general_ci NOT NULL,
  `vorname` varchar(45) collate latin1_general_ci NOT NULL,
  `pid` int(11) unsigned NOT NULL default '0',
  `personell_nr` int(10) unsigned NOT NULL default '0',
  `dept_nr` smallint(3) unsigned NOT NULL default '0',
  `beruf` varchar(25) collate latin1_general_ci default NULL,
  `bereich1` varchar(25) collate latin1_general_ci default NULL,
  `bereich2` varchar(25) collate latin1_general_ci default NULL,
  `inphone1` varchar(15) collate latin1_general_ci default NULL,
  `inphone2` varchar(15) collate latin1_general_ci default NULL,
  `inphone3` varchar(15) collate latin1_general_ci default NULL,
  `exphone1` varchar(25) collate latin1_general_ci default NULL,
  `exphone2` varchar(25) collate latin1_general_ci default NULL,
  `funk1` varchar(15) collate latin1_general_ci default NULL,
  `funk2` varchar(15) collate latin1_general_ci default NULL,
  `roomnr` varchar(10) collate latin1_general_ci default NULL,
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `status` varchar(15) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`item_nr`,`pid`,`personell_nr`,`dept_nr`),
  KEY `name` (`name`),
  KEY `vorname` (`vorname`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_pregnancy`
--

CREATE TABLE `care_pregnancy` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `this_pregnancy_nr` int(11) unsigned NOT NULL default '0',
  `delivery_date` date NOT NULL default '0000-00-00',
  `delivery_time` time NOT NULL default '00:00:00',
  `gravida` tinyint(2) unsigned default NULL,
  `para` tinyint(2) unsigned default NULL,
  `pregnancy_gestational_age` tinyint(2) unsigned default NULL,
  `nr_of_fetuses` tinyint(2) unsigned default NULL,
  `child_encounter_nr` varchar(255) collate latin1_general_ci NOT NULL,
  `is_booked` tinyint(1) NOT NULL default '0',
  `vdrl` char(1) collate latin1_general_ci default NULL,
  `rh` tinyint(1) default NULL,
  `delivery_mode` tinyint(2) NOT NULL default '0',
  `delivery_by` varchar(60) collate latin1_general_ci default NULL,
  `bp_systolic_high` smallint(4) unsigned default NULL,
  `bp_diastolic_high` smallint(4) unsigned default NULL,
  `proteinuria` tinyint(1) default NULL,
  `labour_duration` smallint(3) unsigned default NULL,
  `induction_method` tinyint(2) NOT NULL default '0',
  `induction_indication` varchar(125) collate latin1_general_ci default NULL,
  `anaesth_type_nr` tinyint(2) NOT NULL default '0',
  `is_epidural` char(1) collate latin1_general_ci default NULL,
  `complications` varchar(255) collate latin1_general_ci default NULL,
  `perineum` tinyint(2) NOT NULL default '0',
  `blood_loss` float(8,2) unsigned default NULL,
  `blood_loss_unit` varchar(10) collate latin1_general_ci default NULL,
  `is_retained_placenta` char(1) collate latin1_general_ci NOT NULL,
  `post_labour_condition` varchar(35) collate latin1_general_ci default NULL,
  `outcome` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`encounter_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_registry`
--

CREATE TABLE `care_registry` (
  `registry_id` varchar(35) collate latin1_general_ci NOT NULL,
  `module_start_script` varchar(60) collate latin1_general_ci NOT NULL,
  `news_start_script` varchar(60) collate latin1_general_ci NOT NULL,
  `news_editor_script` varchar(255) collate latin1_general_ci NOT NULL,
  `news_reader_script` varchar(255) collate latin1_general_ci NOT NULL,
  `passcheck_script` varchar(255) collate latin1_general_ci NOT NULL,
  `composite` text collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`registry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_role_person`
--

CREATE TABLE `care_role_person` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `role` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`group_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_room`
--

CREATE TABLE `care_room` (
  `nr` int(8) unsigned NOT NULL auto_increment,
  `type_nr` tinyint(3) unsigned NOT NULL default '0',
  `date_create` date NOT NULL default '0000-00-00',
  `date_close` date NOT NULL default '0000-00-00',
  `is_temp_closed` tinyint(1) default '0',
  `room_nr` smallint(5) unsigned NOT NULL default '0',
  `ward_nr` smallint(5) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `nr_of_beds` tinyint(3) unsigned NOT NULL default '1',
  `closed_beds` varchar(255) collate latin1_general_ci NOT NULL,
  `info` varchar(60) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`type_nr`,`ward_nr`,`dept_nr`),
  KEY `room_nr` (`room_nr`),
  KEY `ward_nr` (`ward_nr`),
  KEY `dept_nr` (`dept_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_sessions`
--

CREATE TABLE `care_sessions` (
  `SESSKEY` varchar(32) collate latin1_general_ci NOT NULL,
  `EXPIRY` int(11) unsigned NOT NULL default '0',
  `expireref` varchar(64) collate latin1_general_ci NOT NULL,
  `DATA` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`SESSKEY`),
  KEY `EXPIRY` (`EXPIRY`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_standby_duty_report`
--

CREATE TABLE `care_standby_duty_report` (
  `report_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(15) collate latin1_general_ci NOT NULL,
  `date` date NOT NULL default '0000-00-00',
  `standby_name` varchar(35) collate latin1_general_ci NOT NULL,
  `standby_start` time NOT NULL default '00:00:00',
  `standby_end` time NOT NULL default '00:00:00',
  `oncall_name` varchar(35) collate latin1_general_ci NOT NULL,
  `oncall_start` time NOT NULL default '00:00:00',
  `oncall_end` time NOT NULL default '00:00:00',
  `op_room` char(2) collate latin1_general_ci NOT NULL,
  `diagnosis_therapy` text collate latin1_general_ci NOT NULL,
  `encoding` text collate latin1_general_ci NOT NULL,
  `status` varchar(20) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`report_nr`),
  KEY `report_nr` (`report_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_steri_products_main`
--

CREATE TABLE `care_steri_products_main` (
  `bestellnum` int(15) unsigned NOT NULL default '0',
  `containernum` varchar(15) collate latin1_general_ci NOT NULL,
  `industrynum` tinytext collate latin1_general_ci NOT NULL,
  `containername` varchar(40) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `packing` tinytext collate latin1_general_ci NOT NULL,
  `minorder` int(4) unsigned NOT NULL default '0',
  `maxorder` int(4) unsigned NOT NULL default '0',
  `proorder` tinytext collate latin1_general_ci NOT NULL,
  `picfile` tinytext collate latin1_general_ci NOT NULL,
  `encoder` tinytext collate latin1_general_ci NOT NULL,
  `enc_date` tinytext collate latin1_general_ci NOT NULL,
  `enc_time` tinytext collate latin1_general_ci NOT NULL,
  `lock_flag` tinyint(1) NOT NULL default '0',
  `medgroup` text collate latin1_general_ci NOT NULL,
  `cave` tinytext collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_target_test`
--

CREATE TABLE `care_target_test` (
  `nr` varchar(20) collate latin1_general_ci NOT NULL,
  `encounter_nr` varchar(20) collate latin1_general_ci NOT NULL,
  `personell_nr` varchar(20) collate latin1_general_ci NOT NULL,
  `personell_name` varchar(255) collate latin1_general_ci default NULL,
  `location_id` varchar(20) collate latin1_general_ci NOT NULL,
  `history` varchar(255) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(255) collate latin1_general_ci NOT NULL,
  `modify_time` varchar(255) collate latin1_general_ci NOT NULL,
  `create_id` varchar(255) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `costitution_type` varchar(255) collate latin1_general_ci default NULL,
  `condizioni_generali` varchar(255) collate latin1_general_ci default NULL,
  `stato_nutrizione` varchar(255) collate latin1_general_ci default NULL,
  `decubito` varchar(255) collate latin1_general_ci default NULL,
  `psiche` varchar(255) collate latin1_general_ci default NULL,
  `cute` varchar(255) collate latin1_general_ci default NULL,
  `descrizione_mucose` varchar(255) collate latin1_general_ci default NULL,
  `annessi_cutanei` varchar(255) collate latin1_general_ci default NULL,
  `edemi` varchar(255) collate latin1_general_ci default NULL,
  `sottocutaneo_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `temperatura` varchar(255) collate latin1_general_ci default NULL,
  `polso_battiti` varchar(255) collate latin1_general_ci default NULL,
  `polso` varchar(255) collate latin1_general_ci default NULL,
  `pressione_max` varchar(255) collate latin1_general_ci default NULL,
  `pressione_min` varchar(255) collate latin1_general_ci default NULL,
  `linfoghiandolare_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `capo_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `globi_oculari` varchar(255) collate latin1_general_ci default NULL,
  `sclere_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `pupille` varchar(255) collate latin1_general_ci default NULL,
  `riflesso_corneale` varchar(255) collate latin1_general_ci default NULL,
  `orecchie` varchar(255) collate latin1_general_ci default NULL,
  `naso` varchar(255) collate latin1_general_ci default NULL,
  `cavo_orofaringeo` varchar(255) collate latin1_general_ci default NULL,
  `lingua` varchar(255) collate latin1_general_ci default NULL,
  `dentatura` varchar(255) collate latin1_general_ci default NULL,
  `tonsille` varchar(255) collate latin1_general_ci default NULL,
  `collo_forma` varchar(255) collate latin1_general_ci default NULL,
  `mobilita` varchar(255) collate latin1_general_ci default NULL,
  `atteggiamento` varchar(255) collate latin1_general_ci default NULL,
  `giugulari_turgide` varchar(255) collate latin1_general_ci default NULL,
  `tiroide_normale` varchar(255) collate latin1_general_ci default NULL,
  `collo_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `mammelle` varchar(255) collate latin1_general_ci default NULL,
  `torace_forma` varchar(255) collate latin1_general_ci default NULL,
  `reperti_torace` varchar(255) collate latin1_general_ci default NULL,
  `ispezione_respiratoria` varchar(255) collate latin1_general_ci default NULL,
  `palpazione_respiratoria` varchar(255) collate latin1_general_ci default NULL,
  `percussione_respiratoria` varchar(255) collate latin1_general_ci default NULL,
  `ascoltazione_respiratoria` varchar(255) collate latin1_general_ci default NULL,
  `reperti_respiratoria` varchar(255) collate latin1_general_ci default NULL,
  `fegato_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `epatomegalia` varchar(255) collate latin1_general_ci default NULL,
  `murphy` varchar(255) collate latin1_general_ci default NULL,
  `colecisti_palpabile` varchar(255) collate latin1_general_ci default NULL,
  `reperti_fegato` varchar(255) collate latin1_general_ci default NULL,
  `milza_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `reperti_milza` varchar(255) collate latin1_general_ci default NULL,
  `urogenitale_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `esplorazione_vaginale` varchar(255) collate latin1_general_ci default NULL,
  `reperti_genitale` varchar(255) collate latin1_general_ci default NULL,
  `osteoarticolare_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `muscolare_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `reperti_muscolare` varchar(255) collate latin1_general_ci default NULL,
  `nervoso_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `nervi_cranici` varchar(255) collate latin1_general_ci default NULL,
  `riflessi_superficiali` varchar(255) collate latin1_general_ci default NULL,
  `reperti_nervoso` varchar(255) collate latin1_general_ci default NULL,
  `ispezione_cuore` varchar(255) collate latin1_general_ci default NULL,
  `palpazione_cuore` varchar(255) collate latin1_general_ci default NULL,
  `percussione_cuore` varchar(255) collate latin1_general_ci default NULL,
  `ascoltazione_cuore` varchar(255) collate latin1_general_ci default NULL,
  `reperti_cuore` varchar(255) collate latin1_general_ci default NULL,
  `vasi_periferici_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `arterie` varchar(255) collate latin1_general_ci default NULL,
  `vene` varchar(255) collate latin1_general_ci default NULL,
  `reperti_vasi` varchar(255) collate latin1_general_ci default NULL,
  `addome_descrizione` varchar(255) collate latin1_general_ci default NULL,
  `addome_ispezione` varchar(255) collate latin1_general_ci default NULL,
  `addome_palpazione` varchar(255) collate latin1_general_ci default NULL,
  `addome_percussione` varchar(255) collate latin1_general_ci default NULL,
  `addome_ascoltazione` varchar(255) collate latin1_general_ci default NULL,
  `rettale` varchar(255) collate latin1_general_ci default NULL,
  `reperti_addome` varchar(255) collate latin1_general_ci default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_tech_questions`
--

CREATE TABLE `care_tech_questions` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(60) collate latin1_general_ci NOT NULL,
  `query` text collate latin1_general_ci NOT NULL,
  `inquirer` varchar(25) collate latin1_general_ci NOT NULL,
  `tphone` varchar(30) collate latin1_general_ci NOT NULL,
  `tdate` date NOT NULL default '0000-00-00',
  `ttime` time NOT NULL default '00:00:00',
  `tid` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `reply` text collate latin1_general_ci NOT NULL,
  `answered` tinyint(1) NOT NULL default '0',
  `ansby` varchar(25) collate latin1_general_ci NOT NULL,
  `astamp` varchar(16) collate latin1_general_ci NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `status` varchar(15) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `batch_nr` (`batch_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_tech_repair_done`
--

CREATE TABLE `care_tech_repair_done` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(15) collate latin1_general_ci default NULL,
  `dept_nr` tinyint(3) unsigned NOT NULL default '0',
  `job_id` varchar(15) collate latin1_general_ci NOT NULL default '0',
  `job` text collate latin1_general_ci NOT NULL,
  `reporter` varchar(25) collate latin1_general_ci NOT NULL,
  `id` varchar(15) collate latin1_general_ci NOT NULL,
  `tdate` date NOT NULL default '0000-00-00',
  `ttime` time NOT NULL default '00:00:00',
  `tid` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `seen` tinyint(1) NOT NULL default '0',
  `d_idx` varchar(8) collate latin1_general_ci NOT NULL,
  `status` varchar(15) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`dept_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_tech_repair_job`
--

CREATE TABLE `care_tech_repair_job` (
  `batch_nr` tinyint(4) NOT NULL auto_increment,
  `dept` varchar(15) collate latin1_general_ci NOT NULL,
  `job` text collate latin1_general_ci NOT NULL,
  `reporter` varchar(25) collate latin1_general_ci NOT NULL,
  `id` varchar(15) collate latin1_general_ci NOT NULL,
  `tphone` varchar(30) collate latin1_general_ci NOT NULL,
  `tdate` date NOT NULL default '0000-00-00',
  `ttime` time NOT NULL default '00:00:00',
  `tid` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `done` tinyint(1) NOT NULL default '0',
  `seen` tinyint(1) NOT NULL default '0',
  `seenby` varchar(25) collate latin1_general_ci NOT NULL,
  `sstamp` varchar(16) collate latin1_general_ci NOT NULL,
  `doneby` varchar(25) collate latin1_general_ci NOT NULL,
  `dstamp` varchar(16) collate latin1_general_ci NOT NULL,
  `d_idx` varchar(8) collate latin1_general_ci NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `status` varchar(20) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `batch_nr` (`batch_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_findings_baclabor`
--

CREATE TABLE `care_test_findings_baclabor` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` varchar(10) collate latin1_general_ci NOT NULL,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `notes` varchar(255) collate latin1_general_ci NOT NULL,
  `findings_init` tinyint(1) NOT NULL default '0',
  `findings_current` tinyint(1) NOT NULL default '0',
  `findings_final` tinyint(1) NOT NULL default '0',
  `entry_nr` varchar(10) collate latin1_general_ci NOT NULL,
  `rec_date` date NOT NULL default '0000-00-00',
  `type_general` text collate latin1_general_ci NOT NULL,
  `resist_anaerob` text collate latin1_general_ci NOT NULL,
  `resist_aerob` text collate latin1_general_ci NOT NULL,
  `findings` text collate latin1_general_ci NOT NULL,
  `doctor_id` varchar(35) collate latin1_general_ci NOT NULL,
  `findings_date` date NOT NULL default '0000-00-00',
  `findings_time` time NOT NULL default '00:00:00',
  `status` varchar(10) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
  KEY `findings_date` (`findings_date`),
  KEY `rec_date` (`rec_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_findings_chemlab`
--

CREATE TABLE `care_test_findings_chemlab` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `job_id` varchar(25) collate latin1_general_ci NOT NULL,
  `test_date` date NOT NULL default '0000-00-00',
  `test_time` time NOT NULL default '00:00:00',
  `group_id` varchar(30) collate latin1_general_ci NOT NULL,
  `serial_value` text collate latin1_general_ci NOT NULL,
  `validator` varchar(15) collate latin1_general_ci NOT NULL,
  `validate_dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(20) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`job_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_findings_patho`
--

CREATE TABLE `care_test_findings_patho` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` varchar(10) collate latin1_general_ci NOT NULL,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `material` text collate latin1_general_ci NOT NULL,
  `macro` text collate latin1_general_ci NOT NULL,
  `micro` text collate latin1_general_ci NOT NULL,
  `findings` text collate latin1_general_ci NOT NULL,
  `diagnosis` text collate latin1_general_ci NOT NULL,
  `doctor_id` varchar(35) collate latin1_general_ci NOT NULL,
  `findings_date` date NOT NULL default '0000-00-00',
  `findings_time` time NOT NULL default '00:00:00',
  `status` varchar(10) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
  KEY `send_date` (`findings_date`),
  KEY `findings_date` (`findings_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_findings_radio`
--

CREATE TABLE `care_test_findings_radio` (
  `batch_nr` int(11) unsigned NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` smallint(5) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `findings` text collate latin1_general_ci NOT NULL,
  `diagnosis` text collate latin1_general_ci NOT NULL,
  `doctor_id` varchar(35) collate latin1_general_ci NOT NULL,
  `findings_date` date NOT NULL default '0000-00-00',
  `findings_time` time NOT NULL default '00:00:00',
  `status` varchar(10) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`findings_date`),
  KEY `findings_date` (`findings_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_param`
--

CREATE TABLE `care_test_param` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_id` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `id` varchar(50) collate latin1_general_ci NOT NULL,
  `sort_nr` tinyint(4) NOT NULL default '0',
  `msr_unit` varchar(15) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `median` varchar(20) collate latin1_general_ci default ' ' COMMENT 'for males',
  `hi_bound` varchar(20) collate latin1_general_ci default ' ',
  `lo_bound` varchar(20) collate latin1_general_ci default ' ',
  `hi_critical` varchar(20) collate latin1_general_ci default ' ',
  `lo_critical` varchar(20) collate latin1_general_ci default ' ',
  `hi_toxic` varchar(20) collate latin1_general_ci default ' ',
  `lo_toxic` varchar(20) collate latin1_general_ci default ' ',
  `median_f` varchar(20) collate latin1_general_ci default ' ' COMMENT '_ f for females',
  `hi_bound_f` varchar(20) collate latin1_general_ci default ' ',
  `lo_bound_f` varchar(20) collate latin1_general_ci default ' ',
  `hi_critical_f` varchar(20) collate latin1_general_ci default ' ',
  `lo_critical_f` varchar(20) collate latin1_general_ci default ' ',
  `hi_toxic_f` varchar(20) collate latin1_general_ci default ' ',
  `lo_toxic_f` varchar(20) collate latin1_general_ci default ' ',
  `median_n` varchar(20) collate latin1_general_ci default ' ' COMMENT '_n for neonatal from 0 to 1 month',
  `hi_bound_n` varchar(20) collate latin1_general_ci default ' ',
  `lo_bound_n` varchar(20) collate latin1_general_ci default ' ',
  `hi_critical_n` varchar(20) collate latin1_general_ci default ' ',
  `lo_critical_n` varchar(20) collate latin1_general_ci default ' ',
  `hi_toxic_n` varchar(20) collate latin1_general_ci default ' ',
  `lo_toxic_n` varchar(20) collate latin1_general_ci default ' ',
  `median_y` varchar(20) collate latin1_general_ci default ' ' COMMENT '_y for children form 1 month to 12 months',
  `hi_bound_y` varchar(20) collate latin1_general_ci default ' ',
  `lo_bound_y` varchar(20) collate latin1_general_ci default ' ',
  `hi_critical_y` varchar(20) collate latin1_general_ci default ' ',
  `lo_critical_y` varchar(20) collate latin1_general_ci default ' ',
  `hi_toxic_y` varchar(20) collate latin1_general_ci default ' ',
  `lo_toxic_y` varchar(20) collate latin1_general_ci default ' ',
  `median_c` varchar(20) collate latin1_general_ci default ' ' COMMENT '_c for children form 1 to 14 years',
  `hi_bound_c` varchar(20) collate latin1_general_ci default ' ',
  `lo_bound_c` varchar(20) collate latin1_general_ci default ' ',
  `hi_critical_c` varchar(20) collate latin1_general_ci default ' ',
  `lo_critical_c` varchar(20) collate latin1_general_ci default ' ',
  `hi_toxic_c` varchar(20) collate latin1_general_ci default ' ',
  `lo_toxic_c` varchar(20) collate latin1_general_ci default ' ',
  `method` varchar(255) collate latin1_general_ci default ' ',
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=664 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_request_baclabor`
--

CREATE TABLE `care_test_request_baclabor` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `material` text collate latin1_general_ci NOT NULL,
  `test_type` text collate latin1_general_ci NOT NULL,
  `material_note` tinytext collate latin1_general_ci NOT NULL,
  `diagnosis_note` tinytext collate latin1_general_ci NOT NULL,
  `immune_supp` tinyint(4) NOT NULL default '0',
  `send_date` date NOT NULL default '0000-00-00',
  `sample_date` date NOT NULL default '0000-00-00',
  `status` varchar(10) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=30000004 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_request_blood`
--

CREATE TABLE `care_test_request_blood` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `blood_group` varchar(10) collate latin1_general_ci NOT NULL,
  `rh_factor` varchar(10) collate latin1_general_ci NOT NULL,
  `kell` varchar(10) collate latin1_general_ci NOT NULL,
  `date_protoc_nr` varchar(45) collate latin1_general_ci NOT NULL,
  `pure_blood` varchar(15) collate latin1_general_ci NOT NULL,
  `red_blood` varchar(15) collate latin1_general_ci NOT NULL,
  `leukoless_blood` varchar(15) collate latin1_general_ci NOT NULL,
  `washed_blood` varchar(15) collate latin1_general_ci NOT NULL,
  `prp_blood` varchar(15) collate latin1_general_ci NOT NULL,
  `thrombo_con` varchar(15) collate latin1_general_ci NOT NULL,
  `ffp_plasma` varchar(15) collate latin1_general_ci NOT NULL,
  `transfusion_dev` varchar(15) collate latin1_general_ci NOT NULL,
  `match_sample` tinyint(4) NOT NULL default '0',
  `transfusion_date` date NOT NULL default '0000-00-00',
  `diagnosis` tinytext collate latin1_general_ci NOT NULL,
  `notes` tinytext collate latin1_general_ci NOT NULL,
  `send_date` date NOT NULL default '0000-00-00',
  `doctor` varchar(35) collate latin1_general_ci NOT NULL,
  `phone_nr` varchar(40) collate latin1_general_ci NOT NULL,
  `status` varchar(10) collate latin1_general_ci NOT NULL,
  `blood_pb` tinytext collate latin1_general_ci NOT NULL,
  `blood_rb` tinytext collate latin1_general_ci NOT NULL,
  `blood_llrb` tinytext collate latin1_general_ci NOT NULL,
  `blood_wrb` tinytext collate latin1_general_ci NOT NULL,
  `blood_prp` tinyblob NOT NULL,
  `blood_tc` tinytext collate latin1_general_ci NOT NULL,
  `blood_ffp` tinytext collate latin1_general_ci NOT NULL,
  `b_group_count` mediumint(9) NOT NULL default '0',
  `b_group_price` float(10,2) NOT NULL default '0.00',
  `a_subgroup_count` mediumint(9) NOT NULL default '0',
  `a_subgroup_price` float(10,2) NOT NULL default '0.00',
  `extra_factors_count` mediumint(9) NOT NULL default '0',
  `extra_factors_price` float(10,2) NOT NULL default '0.00',
  `coombs_count` mediumint(9) NOT NULL default '0',
  `coombs_price` float(10,2) NOT NULL default '0.00',
  `ab_test_count` mediumint(9) NOT NULL default '0',
  `ab_test_price` float(10,2) NOT NULL default '0.00',
  `crosstest_count` mediumint(9) NOT NULL default '0',
  `crosstest_price` float(10,2) NOT NULL default '0.00',
  `ab_diff_count` mediumint(9) NOT NULL default '0',
  `ab_diff_price` float(10,2) NOT NULL default '0.00',
  `x_test_1_code` mediumint(9) NOT NULL default '0',
  `x_test_1_name` varchar(35) collate latin1_general_ci NOT NULL,
  `x_test_1_count` mediumint(9) NOT NULL default '0',
  `x_test_1_price` float(10,2) NOT NULL default '0.00',
  `x_test_2_code` mediumint(9) NOT NULL default '0',
  `x_test_2_name` varchar(35) collate latin1_general_ci NOT NULL,
  `x_test_2_count` mediumint(9) NOT NULL default '0',
  `x_test_2_price` float(10,2) NOT NULL default '0.00',
  `x_test_3_code` mediumint(9) NOT NULL default '0',
  `x_test_3_name` varchar(35) collate latin1_general_ci NOT NULL,
  `x_test_3_count` mediumint(9) NOT NULL default '0',
  `x_test_3_price` float(10,2) NOT NULL default '0.00',
  `lab_stamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `release_via` varchar(20) collate latin1_general_ci NOT NULL,
  `receipt_ack` varchar(20) collate latin1_general_ci NOT NULL,
  `mainlog_nr` varchar(7) collate latin1_general_ci NOT NULL,
  `lab_nr` varchar(7) collate latin1_general_ci NOT NULL,
  `mainlog_date` date NOT NULL default '0000-00-00',
  `lab_date` date NOT NULL default '0000-00-00',
  `mainlog_sign` varchar(20) collate latin1_general_ci NOT NULL,
  `lab_sign` varchar(20) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=40000012 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_request_chemlabor`
--

CREATE TABLE `care_test_request_chemlabor` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` varchar(10) collate latin1_general_ci NOT NULL,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `parameters` text collate latin1_general_ci NOT NULL,
  `doctor_sign` varchar(35) collate latin1_general_ci NOT NULL,
  `highrisk` smallint(1) NOT NULL default '0',
  `notes` tinytext collate latin1_general_ci NOT NULL,
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `sample_time` time NOT NULL default '00:00:00',
  `urgent` tinyint(4) NOT NULL default '0',
  `sample_weekday` smallint(1) NOT NULL default '0',
  `status` varchar(15) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10000022 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_request_generic`
--

CREATE TABLE `care_test_request_generic` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `testing_dept` varchar(35) collate latin1_general_ci NOT NULL,
  `visit` tinyint(1) NOT NULL default '0',
  `order_patient` tinyint(1) NOT NULL default '0',
  `diagnosis_quiry` text collate latin1_general_ci NOT NULL,
  `send_date` date NOT NULL default '0000-00-00',
  `send_doctor` varchar(35) collate latin1_general_ci NOT NULL,
  `result` text collate latin1_general_ci NOT NULL,
  `result_date` date NOT NULL default '0000-00-00',
  `result_doctor` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(10) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `batch_nr` (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_request_patho`
--

CREATE TABLE `care_test_request_patho` (
  `batch_nr` int(11) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `quick_cut` tinyint(4) NOT NULL default '0',
  `qc_phone` varchar(40) collate latin1_general_ci NOT NULL,
  `quick_diagnosis` tinyint(4) NOT NULL default '0',
  `qd_phone` varchar(40) collate latin1_general_ci NOT NULL,
  `material_type` varchar(25) collate latin1_general_ci NOT NULL,
  `material_desc` text collate latin1_general_ci NOT NULL,
  `localization` tinytext collate latin1_general_ci NOT NULL,
  `clinical_note` tinytext collate latin1_general_ci NOT NULL,
  `extra_note` tinytext collate latin1_general_ci NOT NULL,
  `repeat_note` tinytext collate latin1_general_ci NOT NULL,
  `gyn_last_period` varchar(25) collate latin1_general_ci NOT NULL,
  `gyn_period_type` varchar(25) collate latin1_general_ci NOT NULL,
  `gyn_gravida` varchar(25) collate latin1_general_ci NOT NULL,
  `gyn_menopause_since` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `gyn_hysterectomy` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `gyn_contraceptive` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `gyn_iud` varchar(25) collate latin1_general_ci NOT NULL,
  `gyn_hormone_therapy` varchar(25) collate latin1_general_ci NOT NULL,
  `doctor_sign` varchar(35) collate latin1_general_ci NOT NULL,
  `op_date` date NOT NULL default '0000-00-00',
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(10) collate latin1_general_ci NOT NULL,
  `entry_date` date NOT NULL default '0000-00-00',
  `journal_nr` varchar(15) collate latin1_general_ci NOT NULL,
  `blocks_nr` int(11) NOT NULL default '0',
  `deep_cuts` int(11) NOT NULL default '0',
  `special_dye` varchar(35) collate latin1_general_ci NOT NULL,
  `immune_histochem` varchar(35) collate latin1_general_ci NOT NULL,
  `hormone_receptors` varchar(35) collate latin1_general_ci NOT NULL,
  `specials` varchar(35) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `process_id` varchar(35) collate latin1_general_ci NOT NULL,
  `process_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=20000004 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_test_request_radio`
--

CREATE TABLE `care_test_request_radio` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `xray` tinyint(1) NOT NULL default '0',
  `ct` tinyint(1) NOT NULL default '0',
  `sono` tinyint(1) NOT NULL default '0',
  `mammograph` tinyint(1) NOT NULL default '0',
  `mrt` tinyint(1) NOT NULL default '0',
  `nuclear` tinyint(1) NOT NULL default '0',
  `if_patmobile` tinyint(1) NOT NULL default '0',
  `if_allergy` tinyint(1) NOT NULL default '0',
  `if_hyperten` tinyint(1) NOT NULL default '0',
  `if_pregnant` tinyint(1) NOT NULL default '0',
  `clinical_info` text collate latin1_general_ci NOT NULL,
  `test_request` text collate latin1_general_ci NOT NULL,
  `send_date` date NOT NULL default '0000-00-00',
  `send_doctor` varchar(35) collate latin1_general_ci NOT NULL default '0',
  `xray_nr` varchar(9) collate latin1_general_ci NOT NULL default '0',
  `r_cm_2` varchar(15) collate latin1_general_ci NOT NULL,
  `mtr` varchar(35) collate latin1_general_ci NOT NULL,
  `xray_date` date NOT NULL default '0000-00-00',
  `xray_time` time NOT NULL default '00:00:00',
  `results` text collate latin1_general_ci NOT NULL,
  `results_date` date NOT NULL default '0000-00-00',
  `results_doctor` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(10) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `process_id` varchar(35) collate latin1_general_ci NOT NULL,
  `process_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  UNIQUE KEY `batch_nr_2` (`batch_nr`),
  KEY `batch_nr` (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`xray_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_anaesthesia`
--

CREATE TABLE `care_type_anaesthesia` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `id` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_application`
--

CREATE TABLE `care_type_application` (
  `nr` int(11) NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_assignment`
--

CREATE TABLE `care_type_assignment` (
  `type_nr` int(10) unsigned NOT NULL default '0',
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_cause_opdelay`
--

CREATE TABLE `care_type_cause_opdelay` (
  `type_nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `cause` varchar(255) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_color`
--

CREATE TABLE `care_type_color` (
  `color_id` varchar(25) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`color_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_department`
--

CREATE TABLE `care_type_department` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_discharge`
--

CREATE TABLE `care_type_discharge` (
  `nr` smallint(3) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_duty`
--

CREATE TABLE `care_type_duty` (
  `type_nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_encounter`
--

CREATE TABLE `care_type_encounter` (
  `type_nr` int(10) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `hide_from` tinyint(4) NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_ethnic_orig`
--

CREATE TABLE `care_type_ethnic_orig` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `class_nr` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`class_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_feeding`
--

CREATE TABLE `care_type_feeding` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_immunization`
--

CREATE TABLE `care_type_immunization` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(20) collate latin1_general_ci NOT NULL default '' COMMENT 'Immunization type',
  `name` varchar(20) collate latin1_general_ci NOT NULL default '',
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL default '',
  `period` smallint(6) default '0' COMMENT 'period..in days ?',
  `tolerance` smallint(3) default '0',
  `dosage` text collate latin1_general_ci,
  `medicine` text collate latin1_general_ci NOT NULL,
  `titer` text collate latin1_general_ci,
  `note` text collate latin1_general_ci,
  `application` tinyint(3) default '0' COMMENT 'from care_type_application...application type',
  `status` varchar(25) collate latin1_general_ci NOT NULL default 'normal',
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci default NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_insurance`
--

CREATE TABLE `care_type_insurance` (
  `type_nr` int(11) NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(60) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_localization`
--

CREATE TABLE `care_type_localization` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `category` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `short_code` char(1) collate latin1_general_ci NOT NULL,
  `LD_var_short_code` varchar(25) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `hide_from` varchar(255) collate latin1_general_ci NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_location`
--

CREATE TABLE `care_type_location` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_measurement`
--

CREATE TABLE `care_type_measurement` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_notes`
--

CREATE TABLE `care_type_notes` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `sort_nr` smallint(6) NOT NULL default '0',
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=100 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_outcome`
--

CREATE TABLE `care_type_outcome` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_perineum`
--

CREATE TABLE `care_type_perineum` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `id` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_prescription`
--

CREATE TABLE `care_type_prescription` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_room`
--

CREATE TABLE `care_type_room` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_test`
--

CREATE TABLE `care_type_test` (
  `type_nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_time`
--

CREATE TABLE `care_type_time` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_type_unit_measurement`
--

CREATE TABLE `care_type_unit_measurement` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_unit_measurement`
--

CREATE TABLE `care_unit_measurement` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `unit_type_nr` smallint(2) unsigned NOT NULL default '0',
  `id` varchar(15) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL,
  `sytem` varchar(35) collate latin1_general_ci NOT NULL,
  `use_frequency` bigint(20) default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_users`
--

CREATE TABLE `care_users` (
  `name` varchar(60) collate latin1_general_ci NOT NULL,
  `login_id` varchar(35) collate latin1_general_ci NOT NULL,
  `password` varchar(255) collate latin1_general_ci default NULL,
  `personell_nr` int(10) unsigned NOT NULL default '0',
  `lockflag` tinyint(3) unsigned default '0',
  `permission` text collate latin1_general_ci NOT NULL,
  `exc` tinyint(1) NOT NULL default '0',
  `s_date` date NOT NULL default '0000-00-00',
  `s_time` time NOT NULL default '00:00:00',
  `expire_date` date NOT NULL default '0000-00-00',
  `expire_time` time NOT NULL default '00:00:00',
  `dept_nr` text collate latin1_general_ci NOT NULL COMMENT 'the department in wich the user is allowed to enter / view',
  `user_role` tinyint(4) NOT NULL default '0',
  `status` varchar(15) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`login_id`),
  KEY `login_id` (`login_id`),
  KEY `user_role` (`user_role`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_user_roles`
--

CREATE TABLE `care_user_roles` (
  `id` int(11) NOT NULL auto_increment,
  `role_name` varchar(50) collate latin1_general_ci NOT NULL default 'no_name',
  `permission` text collate latin1_general_ci,
  `history` text collate latin1_general_ci,
  `modify_id` varchar(35) collate latin1_general_ci NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) collate latin1_general_ci NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_version`
--

CREATE TABLE `care_version` (
  `name` varchar(20) collate latin1_general_ci NOT NULL,
  `type` varchar(20) collate latin1_general_ci NOT NULL,
  `number` varchar(10) collate latin1_general_ci NOT NULL,
  `build` varchar(5) collate latin1_general_ci NOT NULL,
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `releaser` varchar(30) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_ward`
--

CREATE TABLE `care_ward` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `ward_id` varchar(35) collate latin1_general_ci NOT NULL,
  `name` varchar(35) collate latin1_general_ci NOT NULL,
  `is_temp_closed` tinyint(1) NOT NULL default '0',
  `date_create` date NOT NULL default '0000-00-00',
  `date_close` date NOT NULL default '0000-00-00',
  `description` text collate latin1_general_ci,
  `info` tinytext collate latin1_general_ci,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `room_nr_start` smallint(6) NOT NULL default '0',
  `room_nr_end` smallint(6) NOT NULL default '0',
  `roomprefix` varchar(4) collate latin1_general_ci default NULL,
  `status` varchar(25) collate latin1_general_ci NOT NULL,
  `history` text collate latin1_general_ci NOT NULL,
  `modify_id` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) collate latin1_general_ci NOT NULL default '0',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `ward_id` (`ward_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `care_yellow_paper`
--

CREATE TABLE `care_yellow_paper` (
  `encounter_nr` bigint(20) NOT NULL,
  `personell_name` varchar(20) collate latin1_general_ci default NULL,
  `location_id` varchar(20) collate latin1_general_ci default NULL,
  `history` text collate latin1_general_ci,
  `create_id` varchar(20) collate latin1_general_ci default NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `sunto_anamnestico` text collate latin1_general_ci,
  `stato_presente` text collate latin1_general_ci,
  `altezza` double(15,3) default NULL,
  `peso` double(15,3) default NULL,
  `norm` varchar(20) collate latin1_general_ci default NULL,
  `dati_urine` varchar(20) collate latin1_general_ci default NULL,
  `dati_sangue` varchar(20) collate latin1_general_ci default NULL,
  `dati_altro` varchar(20) collate latin1_general_ci default NULL,
  `diagnosi` text collate latin1_general_ci,
  `terapia` text collate latin1_general_ci,
  `padre` text collate latin1_general_ci,
  `madre` text collate latin1_general_ci,
  `fratelli` text collate latin1_general_ci,
  `coniuge` text collate latin1_general_ci,
  `figli` text collate latin1_general_ci,
  `paesi_esteri` text collate latin1_general_ci,
  `abitazione` text collate latin1_general_ci,
  `lavoro_pregresso` text collate latin1_general_ci,
  `lavoro_presente` text collate latin1_general_ci,
  `lavoro_attuale` text collate latin1_general_ci,
  `ambiente_lavoro` text collate latin1_general_ci,
  `gas_lavoro` text collate latin1_general_ci,
  `tossiche_lavoro` text collate latin1_general_ci,
  `conviventi` text collate latin1_general_ci,
  `prematuro` varchar(4) collate latin1_general_ci default NULL,
  `eutocico` varchar(4) collate latin1_general_ci default NULL,
  `fisiologici_normali` varchar(4) collate latin1_general_ci default NULL,
  `fisiologici_tardivi` varchar(4) collate latin1_general_ci default NULL,
  `mestruazione` text collate latin1_general_ci,
  `gravidanze` text collate latin1_general_ci,
  `militare` text collate latin1_general_ci,
  `alcolici` varchar(20) collate latin1_general_ci default NULL,
  `caffe` varchar(20) collate latin1_general_ci default NULL,
  `fumo` varchar(20) collate latin1_general_ci default NULL,
  `droghe` varchar(20) collate latin1_general_ci default NULL,
  `sete` varchar(20) collate latin1_general_ci default NULL,
  `alvo` varchar(20) collate latin1_general_ci default NULL,
  `diuresi` varchar(20) collate latin1_general_ci default NULL,
  `anamnesi_remota` text collate latin1_general_ci,
  `anamnesi_prossima` text collate latin1_general_ci,
  `nr` bigint(20) NOT NULL auto_increment,
  `modify_id` text collate latin1_general_ci,
  `modify_time` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `nr` (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;
