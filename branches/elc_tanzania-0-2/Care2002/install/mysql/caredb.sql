-- phpMyAdmin SQL Dump
-- version 2.6.0-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 13. September 2005 um 14:05
-- Server Version: 4.0.21
-- PHP-Version: 5.0.2
-- 
-- Datenbank: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_address_citytown`
-- 

CREATE TABLE `care_address_citytown` (
  `nr` mediumint(8) unsigned NOT NULL auto_increment,
  `unece_modifier` char(2) default NULL,
  `unece_locode` varchar(15) default NULL,
  `name` varchar(100) NOT NULL default '',
  `zip_code` varchar(25) default NULL,
  `iso_country_id` char(3) NOT NULL default '',
  `unece_locode_type` tinyint(3) unsigned default NULL,
  `unece_coordinates` varchar(25) default NULL,
  `info_url` varchar(255) default NULL,
  `use_frequency` bigint(20) unsigned NOT NULL default '0',
  `status` varchar(25) default NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `name` (`name`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_address_citytown`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_appointment`
-- 

CREATE TABLE `care_appointment` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `to_dept_id` varchar(25) NOT NULL default '',
  `to_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `to_personell_nr` int(11) NOT NULL default '0',
  `to_personell_name` varchar(60) default NULL,
  `purpose` text NOT NULL,
  `urgency` tinyint(2) unsigned NOT NULL default '0',
  `remind` tinyint(1) unsigned NOT NULL default '0',
  `remind_email` tinyint(1) unsigned NOT NULL default '0',
  `remind_mail` tinyint(1) unsigned NOT NULL default '0',
  `remind_phone` tinyint(1) unsigned NOT NULL default '0',
  `appt_status` varchar(35) NOT NULL default 'pending',
  `cancel_by` varchar(255) NOT NULL default '',
  `cancel_date` date default NULL,
  `cancel_reason` varchar(255) default NULL,
  `encounter_class_nr` int(1) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `pid` (`pid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_appointment`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_billing_archive`
-- 

CREATE TABLE `care_billing_archive` (
  `bill_no` bigint(20) NOT NULL default '0',
  `encounter_nr` int(10) NOT NULL default '0',
  `patient_name` tinytext NOT NULL,
  `vorname` varchar(35) NOT NULL default '0',
  `bill_date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `bill_amt` double(16,4) NOT NULL default '0.0000',
  `payment_date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `payment_mode` text NOT NULL,
  `cheque_no` varchar(10) NOT NULL default '0',
  `creditcard_no` varchar(10) NOT NULL default '0',
  `paid_by` varchar(15) NOT NULL default '0',
  PRIMARY KEY  (`bill_no`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_billing_archive`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_billing_bill`
-- 

CREATE TABLE `care_billing_bill` (
  `bill_bill_no` bigint(20) NOT NULL default '0',
  `bill_encounter_nr` int(10) unsigned NOT NULL default '0',
  `bill_date_time` date default NULL,
  `bill_amount` float(10,2) default NULL,
  `bill_outstanding` float(10,2) default NULL,
  PRIMARY KEY  (`bill_bill_no`),
  KEY `index_bill_patnum` (`bill_encounter_nr`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_billing_bill`
-- 

INSERT INTO `care_billing_bill` VALUES (55000000, 2005000000, '2005-05-06', 90.00, 0.00);
INSERT INTO `care_billing_bill` VALUES (55000001, 2005000000, '2005-05-06', 0.00, 0.00);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_billing_bill_item`
-- 

CREATE TABLE `care_billing_bill_item` (
  `bill_item_id` int(11) NOT NULL auto_increment,
  `bill_item_encounter_nr` int(10) unsigned NOT NULL default '0',
  `bill_item_code` varchar(5) default NULL,
  `bill_item_unit_cost` float(10,2) default '0.00',
  `bill_item_units` tinyint(4) default NULL,
  `bill_item_amount` float(10,2) default NULL,
  `bill_item_date` datetime default NULL,
  `bill_item_status` enum('0','1') default '0',
  `bill_item_bill_no` int(11) NOT NULL default '0',
  PRIMARY KEY  (`bill_item_id`),
  KEY `index_bill_item_patnum` (`bill_item_encounter_nr`),
  KEY `index_bill_item_bill_no` (`bill_item_bill_no`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Daten für Tabelle `care_billing_bill_item`
-- 

INSERT INTO `care_billing_bill_item` VALUES (1, 2005000000, 'aaa', 90.00, 1, 90.00, '2005-05-06 15:13:46', '1', 55000000);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_billing_final`
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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_billing_final`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_billing_item`
-- 

CREATE TABLE `care_billing_item` (
  `item_code` varchar(5) NOT NULL default '',
  `item_description` varchar(100) default NULL,
  `item_unit_cost` float(10,2) default '0.00',
  `item_type` tinytext,
  `item_discount_max_allowed` tinyint(4) unsigned default '0',
  PRIMARY KEY  (`item_code`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_billing_item`
-- 

INSERT INTO `care_billing_item` VALUES ('aaa', 'aaa', 100.00, 'LT', 10);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_billing_payment`
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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_billing_payment`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_cache`
-- 

CREATE TABLE `care_cache` (
  `id` varchar(125) NOT NULL default '',
  `ctext` text,
  `cbinary` blob,
  `tstamp` timestamp(14) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_cache`
-- 

INSERT INTO `care_cache` VALUES ('DOCS_2005-01-10', '<tr class="wardlistrow1"><td ><font size="1" >&nbsp;Anesthesiology&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=39&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=39&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Bacteriological Laboratory&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=25&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=25&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Blood Bank&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=41&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=41&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Central Laboratory&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=22&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=22&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Chemical Laboratory&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=24&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=24&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Ear-Nose-Throath&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=6&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=6&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Emergency Ambulatory&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=14&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=14&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Emergency Surgery&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=4&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=4&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;General Ambulatory&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=15&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=15&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;General Outpatient Clinic&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=40&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=40&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;General Surgery&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=3&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=3&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Intensive Care Unit&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=13&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=13&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Intermediate Care Unit&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=12&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=12&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Internal Medicine&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=11&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=11&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Internal Medicine Ambulatory&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=16&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=16&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Neonatal&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=21&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=21&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Nuclear Diagnostics&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=18&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=18&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Ob-Gynecology&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=9&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=9&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Oncology&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=20&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=20&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Opthalmology&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=7&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=7&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Pathology&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=8&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=8&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Physical Therapy&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=10&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=10&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Plastic Surgery&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=5&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=5&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Radiology&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=19&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=19&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow1"><td ><font size="1" >&nbsp;Serological Laboratory&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=23&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=23&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr><tr class="wardlistrow2"><td ><font size="1" >&nbsp;Sonography&nbsp;</td><td >&nbsp;\n	<img src="../../gui/img/common/default/mans-gr.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;</td><td >\n	<img src="../../gui/img/common/default/mans-red.gif" border=0 width="12" height="15">&nbsp;</td>\n	<td>&nbsp;\n	</td><td >&nbsp; <a href="doctors-dienstplan.phpURLAPPEND&dept_nr=17&retpath=qview">\n	<button onClick="javascript:window.location.href=''doctors-dienstplan.phpURLREDIRECTAPPEND&dept_nr=17&retpath=qview''"><img src="../../gui/img/common/default/new_address.gif" border=0 align="absmiddle" width="20" height="20" alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr>', NULL, '20050110114452');
INSERT INTO `care_cache` VALUES ('chemlabs_result_2005500000_20050304121741', '\r\n		<tr bgcolor="#dd0000" >\r\n		<td class="va12_n"><font color="#ffffff"> &nbsp;<b>Parameter</b>\r\n		</td>\r\n		<td  class="j"><font color="#ffffff">&nbsp;<b>Normal range</b>&nbsp;</td>\r\n		<td  class="j"><font color="#ffffff">&nbsp;<b>Msr. Unit</b>&nbsp;</td>\r\n		\r\n		<td class="a12_b"><font color="#ffffff">&nbsp;<b>04/03/2005<br>10000006</b>&nbsp;</td>\r\n		<td>&nbsp;<a href="javascript:prep2submit()"><img src="../../gui/img/common/default/chart.gif" border=0 align="absmiddle" width="16" height="17" alt="Click to show the graphical display"></td></a></td></tr>\r\n		<tr bgcolor="#ffddee" >\r\n		<td class="va12_n"><font color="#ffffff"> &nbsp;\r\n		</td>\r\n		<td class="va12_n"><font color="#ffffff"> &nbsp;\r\n		</td>\r\n		<td  class="j"><font color="#ffffff">&nbsp;</td>\r\n		<td class="a12_b"><font color="#0000cc">&nbsp;<b>12:17</b> Hour&nbsp;</td>\r\n		<td>&nbsp;<a href="javascript:selectall()"><img src="../../gui/img/common/default/dwnarrowgrnlrg.gif" border=0 align="absmiddle" width="16" height="16" alt="Click to select or deselect all for graphical display"></a>\r\n		</tr><tr class="wardlistrow2">\r\n				<td class="va12_n"> &nbsp;<nobr><a href="#">Calcium</a></nobr>\r\n				</td>\r\n				<td class="a10_b" >&nbsp;</td>\r\n				<td class="a10_b" >&nbsp;mEq/ml</td>\r\n				<td class="j">&nbsp;222&nbsp;</td><td>\r\n				<input type="checkbox" name="tk" value="7">\r\n				</td></tr><tr class="wardlistrow1">\r\n				<td class="va12_n"> &nbsp;<nobr><a href="#">Blood sugar</a></nobr>\r\n				</td>\r\n				<td class="a10_b" >&nbsp;</td>\r\n				<td class="a10_b" >&nbsp;mg/dL</td>\r\n				<td class="j">&nbsp;<img src="../../gui/img/common/default/arrow_red_up_sm.gif" border=0 width="15" height="15"> <font color="red">222</font>&nbsp;</td><td>\r\n				<input type="checkbox" name="tk" value="10">\r\n				</td></tr>\r\n		<input type="hidden" name="colsize" value="1">\r\n		<input type="hidden" name="params" value="">\r\n		<input type="hidden" name="ptk" value="2">\r\n		', NULL, '20050304121745');
INSERT INTO `care_cache` VALUES ('chemlabs_result_2005000005_20050304153119', '\r\n		<tr bgcolor="#dd0000" >\r\n		<td class="va12_n"><font color="#ffffff"> &nbsp;<b>Parameter</b>\r\n		</td>\r\n		<td  class="j"><font color="#ffffff">&nbsp;<b>Normal range</b>&nbsp;</td>\r\n		<td  class="j"><font color="#ffffff">&nbsp;<b>Msr. Unit</b>&nbsp;</td>\r\n		\r\n		<td class="a12_b"><font color="#ffffff">&nbsp;<b>04/03/2005<br>10000005</b>&nbsp;</td>\r\n		<td>&nbsp;<a href="javascript:prep2submit()"><img src="../../gui/img/common/default/chart.gif" border=0 align="absmiddle" width="16" height="17" alt="Click to show the graphical display"></td></a></td></tr>\r\n		<tr bgcolor="#ffddee" >\r\n		<td class="va12_n"><font color="#ffffff"> &nbsp;\r\n		</td>\r\n		<td class="va12_n"><font color="#ffffff"> &nbsp;\r\n		</td>\r\n		<td  class="j"><font color="#ffffff">&nbsp;</td>\r\n		<td class="a12_b"><font color="#0000cc">&nbsp;<b>15:31</b> Hour&nbsp;</td>\r\n		<td>&nbsp;<a href="javascript:selectall()"><img src="../../gui/img/common/default/dwnarrowgrnlrg.gif" border=0 align="absmiddle" width="16" height="16" alt="Click to select or deselect all for graphical display"></a>\r\n		</tr>\r\n		<input type="hidden" name="colsize" value="1">\r\n		<input type="hidden" name="params" value="">\r\n		<input type="hidden" name="ptk" value="0">\r\n		', NULL, '20050304153122');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_cafe_menu`
-- 

CREATE TABLE `care_cafe_menu` (
  `item` int(11) NOT NULL auto_increment,
  `lang` varchar(10) NOT NULL default 'en',
  `cdate` date NOT NULL default '0000-00-00',
  `menu` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  UNIQUE KEY `item_2` (`item`),
  KEY `item` (`item`,`lang`),
  KEY `cdate` (`cdate`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_cafe_menu`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_cafe_prices`
-- 

CREATE TABLE `care_cafe_prices` (
  `item` int(11) NOT NULL auto_increment,
  `lang` varchar(10) NOT NULL default 'en',
  `productgroup` tinytext NOT NULL,
  `article` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `price` varchar(10) NOT NULL default '',
  `unit` tinytext NOT NULL,
  `pic_filename` tinytext NOT NULL,
  `modify_id` varchar(25) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(25) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  KEY `item` (`item`),
  KEY `lang` (`lang`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_cafe_prices`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_category_diagnosis`
-- 

CREATE TABLE `care_category_diagnosis` (
  `nr` tinyint(3) unsigned NOT NULL default '0',
  `category` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `short_code` char(1) NOT NULL default '',
  `LD_var_short_code` varchar(25) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `hide_from` varchar(255) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_category_diagnosis`
-- 

INSERT INTO `care_category_diagnosis` VALUES (1, 'most_responsible', 'Most responsible', 'LDMostResponsible', 'M', 'LDMostResp_s', 'Most responsible diagnosis, must be only one per admission or visit', '0', '', '', '', '20030525130956', '', '00000000000000');
INSERT INTO `care_category_diagnosis` VALUES (2, 'associated', 'Associated', 'LDAssociated', 'A', 'LDAssociated_s', 'Associated diagnosis, can be several per  admission or visit', '0', '', '', '', '20030525131005', '', '00000000000000');
INSERT INTO `care_category_diagnosis` VALUES (3, 'nosocomial', 'Hospital acquired', 'LDNosocomial', 'N', 'LDNosocomial_s', 'Hospital acquired problem, can be several per admission or visit', '0', '', '', '', '20030525131015', '', '00000000000000');
INSERT INTO `care_category_diagnosis` VALUES (4, 'iatrogenic', 'Iatrogenic', 'LDIatrogenic', 'I', 'LDIatrogenic_s', 'Problem resulting from a procedural/surgical complication or medication mistake', '0', '', '', '', '20030525131025', '', '00000000000000');
INSERT INTO `care_category_diagnosis` VALUES (5, 'other', 'Other', 'LDOther', 'O', 'LDOther_s', 'Other  diagnosis', '0', '', '', '', '20030525131033', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_category_disease`
-- 

CREATE TABLE `care_category_disease` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `category` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- Daten für Tabelle `care_category_disease`
-- 

INSERT INTO `care_category_disease` VALUES (1, 2, 'asphyxia', 'Asphyxia', 'LDAsphyxia', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_category_disease` VALUES (2, 2, 'infection', 'Infection', 'LDInfection', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_category_disease` VALUES (3, 2, 'congenital_abnomality', 'Congenital abnormality', 'LDCongenitalAbnormality', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_category_disease` VALUES (4, 2, 'trauma', 'Trauma', 'LDTrauma', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_category_procedure`
-- 

CREATE TABLE `care_category_procedure` (
  `nr` tinyint(3) unsigned NOT NULL default '0',
  `category` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `short_code` char(1) NOT NULL default '',
  `LD_var_short_code` varchar(25) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `hide_from` varchar(255) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_category_procedure`
-- 

INSERT INTO `care_category_procedure` VALUES (1, 'main', 'Main', 'LDMain', 'M', 'LDMain_s', 'Main procedure, must be only one per op or intervention visit', '0', '', '', '', '20030614023508', '', '00000000000000');
INSERT INTO `care_category_procedure` VALUES (2, 'supplemental', 'Supplemental', 'LDSupplemental', 'S', 'LDSupp_s', 'Supplemental procedure, can be several per  encounter op or intervention or visit', '0', '', '', '', '20030614025324', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_class_encounter`
-- 

CREATE TABLE `care_class_encounter` (
  `class_nr` smallint(6) unsigned NOT NULL default '0',
  `class_id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(25) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `hide_from` tinyint(4) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`class_nr`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_class_encounter`
-- 

INSERT INTO `care_class_encounter` VALUES (1, 'inpatient', 'Inpatient', 'LDStationary', 'Inpatient admission - stays at least in a ward and assigned a bed', 0, '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_encounter` VALUES (2, 'outpatient', 'Outpatient', 'LDAmbulant', 'Outpatient visit - does not stay in a ward nor assigned a bed', 0, '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_class_ethnic_orig`
-- 

CREATE TABLE `care_class_ethnic_orig` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Daten für Tabelle `care_class_ethnic_orig`
-- 

INSERT INTO `care_class_ethnic_orig` VALUES (1, 'race', 'LDRace', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_ethnic_orig` VALUES (2, 'country', 'LDCountry', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_class_financial`
-- 

CREATE TABLE `care_class_financial` (
  `class_nr` smallint(5) unsigned NOT NULL auto_increment,
  `class_id` varchar(15) NOT NULL default '0',
  `type` varchar(25) NOT NULL default '0',
  `code` varchar(5) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(25) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `policy` text NOT NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`class_nr`),
  KEY `class_2` (`class_id`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- Daten für Tabelle `care_class_financial`
-- 

INSERT INTO `care_class_financial` VALUES (1, 'care_c', 'care', 'c', 'common', 'LDcommon', 'Common nursing care services. (Non-private)', 'Patient with common health fund insurance policy.', '', '', '', '20021229134050', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (2, 'care_pc', 'care', 'p/c', 'private + common', 'LDprivatecommon', 'Private services added to common services', 'Patient with common health fund insurance\r\npolicy with additional private insurance policy\r\nOR self paying components.', '', '', '', '20021229134451', '', '20021229134451');
INSERT INTO `care_class_financial` VALUES (3, 'care_p', 'care', 'p', 'private', 'LDprivate', 'Private nursing care services', 'Patient with private insurance policy\r\nOR self paying.', 'LDprivate', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (4, 'care_pp', 'care', 'pp', 'private plus', 'LDprivateplus', '"Very private" nursing care services', 'Patient with private health insurance policy\r\nAND self paying components.', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (5, 'room_c', 'room', 'c', 'common', 'LDcommon', 'Common room services (non-private)', 'Patient with common health fund insurance policy. ', 'LDcommon', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (6, 'room_pc', 'room', 'p/c', 'private + common', '', 'Private services added to common services', 'Patient with common health fund insurance policy with additional private insurance policy OR self paying components.', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (7, 'room_p', 'room', 'p', 'private', '', 'Private room services', 'Patient with private insurance policy OR self paying. ', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (8, 'room_pp', 'room', 'pp', 'private plus', '', '"Very private" room services', 'Patient with private health insurance policy AND self paying components.', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (9, 'att_dr_c', 'att_dr', 'c', 'common', '', 'Common clinician services', 'Patient with common health fund insurance policy. ', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (10, 'att_dr_pc', 'att_dr', 'p/c', 'private + common', '', 'Private services added to common clinician services', 'Patient with common health fund insurance policy with additional private insurance policy OR self paying components.', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (11, 'att_dr_p', 'att_dr', 'p', 'private', '', 'Private clinician services', 'Patient with private insurance policy OR self paying.', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_financial` VALUES (12, 'att_dr_pp', 'att_dr', 'pp', 'private plus', '', '"Very private" clinician services', 'Patient with private health insurance policy AND self paying components.', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_class_insurance`
-- 

CREATE TABLE `care_class_insurance` (
  `class_nr` smallint(5) unsigned NOT NULL auto_increment,
  `class_id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(25) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`class_nr`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Daten für Tabelle `care_class_insurance`
-- 

INSERT INTO `care_class_insurance` VALUES (1, 'private', 'Private', 'LDPrivate', 'Private insurance plan (paid by insured alone)', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_insurance` VALUES (2, 'common', 'Health Fund', 'LDInsurance', 'Public (common) health fund - usually paid both by the insured and his employer, eventually paid by the state', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_insurance` VALUES (3, 'self_pay', 'Self pay', 'LDSelfPay', '', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_class_therapy`
-- 

CREATE TABLE `care_class_therapy` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `class` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(25) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=9 ;

-- 
-- Daten für Tabelle `care_class_therapy`
-- 

INSERT INTO `care_class_therapy` VALUES (1, 2, 'photo', 'Phototherapy', 'LDPhototherapy', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_therapy` VALUES (2, 2, 'iv', 'IV Fluids', 'LDIVFluids', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_therapy` VALUES (3, 2, 'oxygen', 'Oxygen therapy', 'LDOxygenTherapy', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_therapy` VALUES (4, 2, 'cpap', 'CPAP', 'LDCPAP', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_therapy` VALUES (5, 2, 'ippv', 'IPPV', 'LDIPPV', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_therapy` VALUES (6, 2, 'nec', 'NEC', 'LDNEC', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_therapy` VALUES (7, 2, 'tpn', 'TPN', 'LDTPN', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_class_therapy` VALUES (8, 2, 'hie', 'HIE', 'LDHIE', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_classif_neonatal`
-- 

CREATE TABLE `care_classif_neonatal` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) default NULL,
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=17 ;

-- 
-- Daten für Tabelle `care_classif_neonatal`
-- 

INSERT INTO `care_classif_neonatal` VALUES (1, 'jaundice', 'Neonatal jaundice', 'LDNeonatalJaundice', NULL, '', '', '20030807135731', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (2, 'x_transfusion', 'Exchange transfusion', 'LDExchangeTransfusion', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (3, 'photo_therapy', 'Photo therapy', 'LDPhotoTherapy', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (4, 'h_i_encep', 'Hypoxic ischaemic encephalopathy', 'LDH_I_Encephalopathy', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (5, 'parenteral', 'Parenteral nutrition', 'LDParenteralNutrition', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (6, 'vent_support', 'Ventilatory support', 'LDVentilatorySupport', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (7, 'oxygen_therapy', 'Oxygen therapy', 'LDOxygenTherapy', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (8, 'cpap', 'CPAP', 'LDCPAP', 'Continuous positive airway pressure', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (9, 'congenital_abnormality', 'Congenital abnormality', 'LDCongenitalAbnormality', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (10, 'congenital_infection', 'Congenital infection', 'LDCongenitalInfection', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (11, 'acquired_infection', 'Acquired infection', 'LDAcquiredInfection', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (12, 'gbs_infection', 'GBS infection', 'LDGBSInfection', 'Group B Strep Infection', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (13, 'rds', 'Resp Distress Syndrome', 'LDRespDistressSyndrome', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (14, 'blood_transfusion', 'Blood transfusion', 'LDBloodTransfusion', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (15, 'antibiotic_therapy', 'Antibiotic therapy', 'LDAntibioticTherapy', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_classif_neonatal` VALUES (16, 'necrotising_enterocolitis', 'Necrotising enterocolitis', 'LDNecrotisingEnterocolitis', NULL, '', '', '20030807201727', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_complication`
-- 

CREATE TABLE `care_complication` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `group_nr` int(11) unsigned NOT NULL default '0',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `code` varchar(25) default NULL,
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=17 ;

-- 
-- Daten für Tabelle `care_complication`
-- 

INSERT INTO `care_complication` VALUES (1, 1, 'Previous C/S', 'LDPreviousCS', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (2, 1, 'Pre-eclampsia', 'LDPreEclampsia', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (3, 1, 'Eclampsia', 'LDEclampsia', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (4, 1, 'Other hypertension', 'LDOtherHypertension', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (5, 1, 'Other proteinuria', 'LDProteinuria', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (6, 1, 'Cardiac', 'LDCardiac', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (7, 1, 'Anaemia < 8.5g', 'LDAnaemia', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (8, 1, 'Asthma', 'LDAsthma', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (9, 1, 'Epilepsy', 'LDEpilepsy', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (10, 1, 'Placenta praevia', 'LDPlacentaPraevia', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (11, 1, 'Abruptio placentae', 'LDAbruptioPlacentae', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (12, 1, 'Other APH', 'LDOtherAPH', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (13, 1, 'Diabetes', 'LDDiabetes', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (14, 1, 'Cord prolapse', 'LDCordProlapse', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (15, 1, 'Ruptured uterus', 'LDRupturedUterus', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_complication` VALUES (16, 1, 'Extrauterine pregnancy', 'LDExtraUterinePregnancy', '', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_config_global`
-- 

CREATE TABLE `care_config_global` (
  `type` varchar(60) NOT NULL default '',
  `value` varchar(255) default NULL,
  `notes` varchar(255) default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`type`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_config_global`
-- 

INSERT INTO `care_config_global` VALUES ('date_format', 'dd/MM/yyyy', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('time_format', 'HH.MM', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_reg_nr_adder', '10000000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('main_info_police_nr', '11?', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('main_info_fire_dept_nr', '12?', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('main_info_emgcy_nr', '13?', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('main_info_phone', '1234567', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('main_info_fax', '567890', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('main_info_address', 'Virtualstr. 89AA\r\nCyberia 89300\r\nLas Vegas County', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('main_info_email', 'contact@care2x.com', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_id_nr_adder', '10000000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_outpatient_nr_adder', '500000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_inpatient_nr_adder', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_2_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_3_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_middle_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_maiden_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_ethnic_orig_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_others_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_nat_id_nr_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_religion_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_cellphone_2_nr_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_phone_2_nr_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_citizenship_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_sss_nr_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('language_default', 'en', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('language_single', '1', '', '', '', '', '20050204093737', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('mascot_hide', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('mascot_style', 'default', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('gui_frame_left_nav_width', '150', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('gui_frame_left_nav_border', '1', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_fotos_path', 'fotos/news/', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_title_font_size', '5', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_title_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_title_font_color', '#CC3333', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_preface_font_size', '2', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_preface_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_preface_font_color', '#336666', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_body_font_size', '2', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_body_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_body_font_color', '#000033', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_normal_preview_maxlen', '600', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_title_font_bold', '1', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_headline_preface_font_bold', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('news_normal_display_width', '100%', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_fax_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_email_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_phone_1_nr_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_cellphone_1_nr_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_foto_path', 'fotos/registration/', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_service_care_hide', '1', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_service_room_hide', '1', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_service_att_dr_hide', '1', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_financial_class_single_result', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_name_2_show', '1', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_name_3_show', '1', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_name_middle_show', '1', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('theme_control_buttons', 'default', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('gui_frame_left_nav_bdcolor', '#990000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('theme_control_theme_list', 'default,blue_aqua', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('medocs_text_preview_maxlen', '100', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('personell_nr_adder', '100000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('notes_preview_maxlen', '120', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_id_nr_init', '10000000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('personell_nr_init', '100000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('encounter_nr_init', '000000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('encounter_nr_fullyear_prepend', '1', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('theme_mascot', 'default', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('pagin_address_list_max_block_rows', '20', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('pagin_address_search_max_block_rows', '25', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('pagin_insurance_list_max_block_rows', '30', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('pagin_insurance_search_max_block_rows', '25', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('pagin_personell_search_max_block_rows', '20', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('pagin_person_search_max_block_rows', '20', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('pagin_personell_list_max_block_rows', '20', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('pagin_patient_search_max_block_rows', '20', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('pagin_or_patient_search_max_block_rows', '5', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('timeout_inactive', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('timeout_time', '004500', '', '', '', '', '20050218170106', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_title_hide', '0', NULL, 'normal', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_bloodgroup_hide', '0', NULL, 'normal', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_civilstatus_hide', '0', NULL, 'normal', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_insurance_hide', '0', NULL, 'normal', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_other_his_nr_hide', '0', NULL, 'normal', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_config_user`
-- 

CREATE TABLE `care_config_user` (
  `user_id` varchar(100) NOT NULL default '',
  `serial_config_data` text NOT NULL,
  `notes` varchar(255) default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`user_id`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_config_user`
-- 

INSERT INTO `care_config_user` VALUES ('default', 'a:19:{s:4:"mask";s:1:"1";s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:0:"";s:8:"bversion";s:0:"";s:2:"ip";s:0:"";s:3:"cid";s:0:"";s:5:"dhtml";s:1:"1";s:4:"lang";s:0:"";}', '', '', '', '', '20030210161831', '', '00000000000000');
INSERT INTO `care_config_user` VALUES ('CFG41a61798940490.60628800 1101404056.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:14:"80.145.145.128";s:3:"cid";s:13:"41a6179894049";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041125183416', '', '20041125183416');
INSERT INTO `care_config_user` VALUES ('CFG41b01c6a373e80.22629500 1102060650.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41b01c6a373e8";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041203085730', '', '20041203085730');
INSERT INTO `care_config_user` VALUES ('CFG41b099f1720420.46703200 1102092785.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41b099f172042";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041203175305', '', '20041203175305');
INSERT INTO `care_config_user` VALUES ('CFG41b0d3992145f0.13632900 1102107545.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"Unknown";s:8:"bversion";i:0;s:2:"ip";s:13:"65.54.188.108";s:3:"cid";s:13:"41b0d3992145f";s:5:"dhtml";s:1:"1";s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041203215905', '', '20041203215905');
INSERT INTO `care_config_user` VALUES ('CFG41b48d7add42a0.90629100 1102351738.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:15:"194.201.253.222";s:3:"cid";s:13:"41b48d7add42a";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041206174858', '', '20041206174858');
INSERT INTO `care_config_user` VALUES ('CFG41b69e5798e690.62628800 1102487127.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"64.86.238.10";s:3:"cid";s:13:"41b69e5798e69";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041208072527', '', '20041208072527');
INSERT INTO `care_config_user` VALUES ('CFG41b938c9596c90.36628800 1102657737.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41b938c9596c9";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041210064857', '', '20041210064857');
INSERT INTO `care_config_user` VALUES ('CFG41bea45d3e9190.25628900 1103012957.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"64.86.238.10";s:3:"cid";s:13:"41bea45d3e919";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041214092917', '', '20041214092917');
INSERT INTO `care_config_user` VALUES ('CFG41bef1aa178190.09628700 1103032746.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41bef1aa17819";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041214145906', '', '20041214145906');
INSERT INTO `care_config_user` VALUES ('CFG41bffd50bd8580.77628800 1103101264.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:14:"196.201.129.65";s:3:"cid";s:13:"41bffd50bd858";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041215100104', '', '20041215100104');
INSERT INTO `care_config_user` VALUES ('CFG41c1ac596a8390.43628800 1103211609.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"12.27.12.103";s:3:"cid";s:13:"41c1ac596a839";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041216164009', '', '20041216164009');
INSERT INTO `care_config_user` VALUES ('CFG41c52dc7ce9c80.84628700 1103441351.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"Unknown";s:8:"bversion";i:0;s:2:"ip";s:12:"207.46.98.32";s:3:"cid";s:13:"41c52dc7ce9c8";s:5:"dhtml";s:1:"1";s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041219082911', '', '20041219082911');
INSERT INTO `care_config_user` VALUES ('CFG41ca02430b4c80.04628900 1103757891.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"205.177.65.128";s:3:"cid";s:13:"41ca02430b4c8";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041223002451', '', '20041223002451');
INSERT INTO `care_config_user` VALUES ('CFG41d4cc4f940490.60628800 1104464975.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"Unknown";s:8:"bversion";i:0;s:2:"ip";s:12:"207.46.98.35";s:3:"cid";s:13:"41d4cc4f94049";s:5:"dhtml";s:1:"1";s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20041231044935', '', '20041231044935');
INSERT INTO `care_config_user` VALUES ('CFG41d8793fc26790.79628900 1104705855.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:14:"217.133.174.14";s:3:"cid";s:13:"41d8793fc2679";s:5:"dhtml";i:1;s:4:"lang";s:2:"it";}', NULL, '', NULL, '', '20050102234415', '', '20050102234415');
INSERT INTO `care_config_user` VALUES ('CFG41d9ad46596d80.36630600 1104784710.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"137.53.219.193";s:3:"cid";s:13:"41d9ad46596d8";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050103213830', '', '20050103213830');
INSERT INTO `care_config_user` VALUES ('CFG41da3444dd4410.90634300 1104819268.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41da3444dd441";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050104071428', '', '20050104071428');
INSERT INTO `care_config_user` VALUES ('CFG41de38ece6c090.94520200 1105082604.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41de38ece6c09";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050107082324', '', '20050107082324');
INSERT INTO `care_config_user` VALUES ('CFG41de703e856250.54636500 1105096766.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41de703e85625";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050107121926', '', '20050107121926');
INSERT INTO `care_config_user` VALUES ('CFG41de76bc45e490.28629000 1105098428.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41de76bc45e49";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050107124708', '', '20050107124708');
INSERT INTO `care_config_user` VALUES ('CFG41de79d4cc2b90.83628800 1105099220.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41de79d4cc2b9";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050107130020', '', '20050107130020');
INSERT INTO `care_config_user` VALUES ('CFG41de8d4aa51b80.67628900 1105104202.cfg', 'a:19:{s:4:"mask";s:0:"";s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"80.145.147.12";s:3:"cid";s:13:"41de8d4aa51b8";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, 'system', '20050126103009', '', '20050107142322');
INSERT INTO `care_config_user` VALUES ('CFG41dfcf13db9a80.89950500 1105186579.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41dfcf13db9a8";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050108131619', '', '20050108131619');
INSERT INTO `care_config_user` VALUES ('CFG41e25c6526f080.15950500 1105353829.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:14:"198.54.202.242";s:3:"cid";s:13:"41e25c6526f08";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050110114349', '', '20050110114349');
INSERT INTO `care_config_user` VALUES ('CFG41e2a988b219a0.72951000 1105373576.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:5:"opera";s:8:"bversion";s:4:"7.54";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41e2a988b219a";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050110171256', '', '20050110171256');
INSERT INTO `care_config_user` VALUES ('CFG41e382bdb96c80.75950400 1105429181.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:4:"5.01";s:2:"ip";s:14:"217.24.203.130";s:3:"cid";s:13:"41e382bdb96c8";s:5:"dhtml";i:1;s:4:"lang";s:2:"de";}', NULL, '', NULL, '', '20050111083941', '', '20050111083941');
INSERT INTO `care_config_user` VALUES ('CFG41e3b02bd6b890.87950800 1105440811.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41e3b02bd6b89";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050111115331', '', '20050111115331');
INSERT INTO `care_config_user` VALUES ('CFG41e519c13ce9b0.24952100 1105533377.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"63.109.249.89";s:3:"cid";s:13:"41e519c13ce9b";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050112133617', '', '20050112133617');
INSERT INTO `care_config_user` VALUES ('CFG41e5330b83b6c0.53951100 1105539851.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:13:"217.30.18.138";s:3:"cid";s:13:"41e5330b83b6c";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050112152411', '', '20050112152411');
INSERT INTO `care_config_user` VALUES ('CFG41e67fa0c33080.79950500 1105624992.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:13:"145.250.209.1";s:3:"cid";s:13:"41e67fa0c3308";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050113150312', '', '20050113150312');
INSERT INTO `care_config_user` VALUES ('CFG41e69569f40480.99950500 1105630569.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"193.191.6.53";s:3:"cid";s:13:"41e69569f4048";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050113163610', '', '20050113163610');
INSERT INTO `care_config_user` VALUES ('CFG41e69cfb30b480.19950400 1105632507.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"Unknown";s:8:"bversion";i:0;s:2:"ip";s:12:"207.46.98.33";s:3:"cid";s:13:"41e69cfb30b48";s:5:"dhtml";s:1:"1";s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050113170827', '', '20050113170827');
INSERT INTO `care_config_user` VALUES ('CFG41ea0b9cd1d690.85950700 1105857436.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"64.86.238.10";s:3:"cid";s:13:"41ea0b9cd1d69";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050116073716', '', '20050116073716');
INSERT INTO `care_config_user` VALUES ('CFG41f5f63c278520.16188300 1106638396.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41f5f63c27852";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050125083316', '', '20050125083316');
INSERT INTO `care_config_user` VALUES ('CFG41f60f95bb3b10.76690800 1106644885.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41f60f95bb3b1";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050125102125', '', '20050125102125');
INSERT INTO `care_config_user` VALUES ('CFG41f67bcc6b8aa0.44051600 1106672588.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"64.86.238.10";s:3:"cid";s:13:"41f67bcc6b8aa";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050125180308', '', '20050125180308');
INSERT INTO `care_config_user` VALUES ('CFG41f773ad3f7eb0.26008400 1106736045.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:13:"80.145.147.12";s:3:"cid";s:13:"41f773ad3f7eb";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050126114045', '', '20050126114045');
INSERT INTO `care_config_user` VALUES ('CFG41f7adaaf10900.98729300 1106750890.cfg', 'a:19:{s:4:"mask";s:0:"";s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"41f7adaaf1090";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, 'system', '20050126161004', '', '20050126154810');
INSERT INTO `care_config_user` VALUES ('CFG41f7b23b179770.09663900 1106752059.cfg', 'a:19:{s:4:"mask";s:0:"";s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"41f7b23b17977";s:5:"dhtml";i:1;s:4:"lang";s:2:"de";}', NULL, '', NULL, 'system', '20050126170143', '', '20050126160739');
INSERT INTO `care_config_user` VALUES ('CFG41f805d72e3100.18921400 1106773463.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"41f805d72e310";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050126220423', '', '20050126220423');
INSERT INTO `care_config_user` VALUES ('CFG41f8070aef1560.97929500 1106773770.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"41f8070aef156";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050126220930', '', '20050126220930');
INSERT INTO `care_config_user` VALUES ('CFG4200f66e4266e0.27199100 1107359342.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4200f66e4266e";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050202164902', '', '20050202164902');
INSERT INTO `care_config_user` VALUES ('CFG420b5ea2d48e80.87064400 1108041378.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"420b5ea2d48e8";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050210141618', '', '20050210141618');
INSERT INTO `care_config_user` VALUES ('CFG420f7f6358da20.36395200 1108311907.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"420f7f6358da2";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050213172507', '', '20050213172507');
INSERT INTO `care_config_user` VALUES ('CFG421473bd725200.46826500 1108636605.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"421473bd72520";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050217113645', '', '20050217113645');
INSERT INTO `care_config_user` VALUES ('CFG4214a863a9cd00.69551300 1108650083.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4214a863a9cd0";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050217152123', '', '20050217152123');
INSERT INTO `care_config_user` VALUES ('CFG4215d402c3bd20.80175700 1108726786.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4215d402c3bd2";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050218123946', '', '20050218123946');
INSERT INTO `care_config_user` VALUES ('CFG4215dd791face0.12975300 1108729209.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4215dd791face";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050218132009', '', '20050218132009');
INSERT INTO `care_config_user` VALUES ('CFG4219b679254750.15270300 1108981369.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4219b67925475";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050221112249', '', '20050221112249');
INSERT INTO `care_config_user` VALUES ('CFG4219ff96ec39e0.96759000 1109000086.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4219ff96ec39e";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050221163446', '', '20050221163446');
INSERT INTO `care_config_user` VALUES ('CFG421b0363aade00.69988600 1109066595.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"421b0363aade0";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050222110315', '', '20050222110315');
INSERT INTO `care_config_user` VALUES ('CFG42230a3d4b5080.30849700 1109592637.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"42230a3d4b508";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050228131037', '', '20050228131037');
INSERT INTO `care_config_user` VALUES ('CFG422842995ab440.37153500 1109934745.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"422842995ab44";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050304121225', '', '20050304121225');
INSERT INTO `care_config_user` VALUES ('CFG422c44b8565e60.35377900 1110197432.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"422c44b8565e6";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050307131032', '', '20050307131032');
INSERT INTO `care_config_user` VALUES ('CFG4230266ace8a10.84600100 1110451818.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4230266ace8a1";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050310115018', '', '20050310115018');
INSERT INTO `care_config_user` VALUES ('CFG42318db7a418d0.67215200 1110543799.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"42318db7a418d";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050311132319', '', '20050311132319');
INSERT INTO `care_config_user` VALUES ('CFG423558f32b7820.17806400 1110792435.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"423558f32b782";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050314102715', '', '20050314102715');
INSERT INTO `care_config_user` VALUES ('CFG423ab9958ace70.56856500 1111144853.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"423ab9958ace7";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050318122053', '', '20050318122053');
INSERT INTO `care_config_user` VALUES ('CFG4253dd30660690.41791100 1112792368.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4253dd3066069";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050406145928', '', '20050406145928');
INSERT INTO `care_config_user` VALUES ('CFG42553b31565090.35355900 1112881969.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"42553b3156509";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050407155249', '', '20050407155249');
INSERT INTO `care_config_user` VALUES ('CFG425643fd704310.45983900 1112949757.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"425643fd70431";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050408104237', '', '20050408104237');
INSERT INTO `care_config_user` VALUES ('CFG425a38d3e3f680.93374900 1113209043.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"425a38d3e3f68";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050411104403', '', '20050411104403');
INSERT INTO `care_config_user` VALUES ('CFG427f8b23585930.36188800 1115654947.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"427f8b2358593";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050509180907', '', '20050509180907');
INSERT INTO `care_config_user` VALUES ('CFG4280cc06e7d800.94964600 1115737094.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4280cc06e7d80";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050510165814', '', '20050510165814');
INSERT INTO `care_config_user` VALUES ('CFG4288739438e9e0.23312700 1116238740.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:9:"127.0.0.1";s:3:"cid";s:13:"4288739438e9e";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050516121900', '', '20050516121900');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_currency`
-- 

CREATE TABLE `care_currency` (
  `item_no` smallint(5) unsigned NOT NULL auto_increment,
  `short_name` varchar(10) NOT NULL default '',
  `long_name` varchar(20) NOT NULL default '',
  `info` varchar(50) NOT NULL default '',
  `status` varchar(5) NOT NULL default '',
  `modify_id` varchar(20) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(20) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  KEY `item_no` (`item_no`),
  KEY `short_name` (`short_name`)
) TYPE=MyISAM AUTO_INCREMENT=14 ;

-- 
-- Daten für Tabelle `care_currency`
-- 

INSERT INTO `care_currency` VALUES (13, '€', 'Euro', 'European currency', 'main', 'Elpidio Latorilla', '20030802200637', '', '20021126200534');
INSERT INTO `care_currency` VALUES (3, 'L', 'Pound', 'GB British Pound (ISO = GBP)', '', '', '20030213173107', '', '20020817000349');
INSERT INTO `care_currency` VALUES (10, 'R', 'Rand', 'South African Rand (ISO = ZAR)', '', '', '20030802200637', 'Elpidio Latorilla', '20020817181805');
INSERT INTO `care_currency` VALUES (8, 'R', 'Rupees', 'Indian Rupees (ISO = INR)', '', '', '20030213173059', 'Elpidio Latorilla', '20020921004306');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_department`
-- 

CREATE TABLE `care_department` (
  `nr` mediumint(8) unsigned NOT NULL auto_increment,
  `id` varchar(60) NOT NULL default '',
  `type` varchar(25) NOT NULL default '',
  `name_formal` varchar(60) NOT NULL default '',
  `name_short` varchar(35) NOT NULL default '',
  `name_alternate` varchar(225) default NULL,
  `LD_var` varchar(35) NOT NULL default '',
  `description` text NOT NULL,
  `admit_inpatient` tinyint(1) NOT NULL default '0',
  `admit_outpatient` tinyint(1) NOT NULL default '0',
  `has_oncall_doc` tinyint(1) NOT NULL default '1',
  `has_oncall_nurse` tinyint(1) NOT NULL default '1',
  `does_surgery` tinyint(1) NOT NULL default '0',
  `this_institution` tinyint(1) NOT NULL default '1',
  `is_sub_dept` tinyint(1) NOT NULL default '0',
  `parent_dept_nr` tinyint(3) unsigned default NULL,
  `work_hours` varchar(100) default NULL,
  `consult_hours` varchar(100) default NULL,
  `is_inactive` tinyint(1) NOT NULL default '0',
  `sort_order` tinyint(3) unsigned NOT NULL default '0',
  `address` text,
  `sig_line` varchar(60) default NULL,
  `sig_stamp` text,
  `logo_mime_type` varchar(5) default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=42 ;

-- 
-- Daten für Tabelle `care_department`
-- 

INSERT INTO `care_department` VALUES (1, 'pr', '2', 'Public Relations', 'PR', 'Press Relations', 'LDPressRelations', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (2, 'cafe', '2', 'Cafeteria', 'Cafe', 'Canteen', 'LDCafeteria', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (3, 'general_surgery', '1', 'General Surgery', 'General', 'General', 'LDGeneralSurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '8.30 - 21.00', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '20030828124327', '', '00000000000000');
INSERT INTO `care_department` VALUES (4, 'emergency_surgery', '1', 'Emergency Surgery', 'Emergency', '', 'LDEmergencySurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (5, 'plastic_surgery', '1', 'Plastic Surgery', 'Plastic', 'Aesthetic Surgery', 'LDPlasticSurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (6, 'ent', '1', 'Ear-Nose-Throath', 'ENT', 'HNO', 'LDEarNoseThroath', 'Ear-Nose-Throath, in german Hals-Nasen-Ohren. The department with  very old traditions that date back to the early beginnings of premodern medicine.', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', 'kope akjdielj asdlkasdf', '', '', 'Update: 2003-08-13 23:24:16 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:25:27 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:29:05 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:30:21 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:31:52 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:34:08 Elpidio Latorilla\r\n', 'Elpidio Latorilla', '20031019165346', '', '00000000000000');
INSERT INTO `care_department` VALUES (7, 'opthalmology', '1', 'Opthalmology', 'Opthalmology', 'Eye Department', 'LDOpthalmology', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (8, 'pathology', '1', 'Pathology', 'Pathology', 'Patho', 'LDPathology', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (9, 'ob_gyn', '1', 'Ob-Gynecology', 'Ob-Gyne', 'Gyn', 'LDObGynecology', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (10, 'physical_therapy', '1', 'Physical Therapy', 'Physical', 'PT', 'LDPhysicalTherapy', 'Physical therapy department with on-call therapists. Day care clinics, training, rehab.', 1, 0, 1, 1, 0, 1, 1, 16, '8:00 - 15:00', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '20030828124351', '', '00000000000000');
INSERT INTO `care_department` VALUES (11, 'internal_med', '1', 'Internal Medicine', 'Internal Med', 'InMed', 'LDInternalMedicine', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (12, 'imc', '1', 'Intermediate Care Unit', 'IMC', 'Intermediate', 'LDIntermediateCareUnit', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (13, 'icu', '1', 'Intensive Care Unit', 'ICU', 'Intensive', 'LDIntensiveCareUnit', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (14, 'emergency_ambulatory', '1', 'Emergency Ambulatory', 'Emergency', 'Emergency Amb', 'LDEmergencyAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 4, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', 'Update: 2003-09-23 00:06:27 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030923010627', '', '00000000000000');
INSERT INTO `care_department` VALUES (15, 'general_ambulatory', '1', 'General Ambulatory', 'Ambulatory', 'General Amb', 'LDGeneralAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 3, 'round the clock', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '20030828124254', '', '00000000000000');
INSERT INTO `care_department` VALUES (16, 'inmed_ambulatory', '1', 'Internal Medicine Ambulatory', 'InMed Ambulatory', 'InMed Amb', 'LDInternalMedicineAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (17, 'sonography', '1', 'Sonography', 'Sono', 'Ultrasound diagnostics', 'LDSonography', '', 0, 1, 1, 1, 0, 1, 1, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (18, 'nuclear_diagnostics', '1', 'Nuclear Diagnostics', 'Nuclear', 'Nuclear Testing', 'LDNuclearDiagnostics', '', 0, 1, 1, 1, 0, 1, 1, 19, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (19, 'radiology', '1', 'Radiology', 'Radiology', 'Xray', 'LDRadiology', '', 0, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (20, 'oncology', '1', 'Oncology', 'Oncology', 'Cancer Department', 'LDOncology', '', 1, 1, 1, 1, 1, 1, 0, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (21, 'neonatal', '1', 'Neonatal', 'Neonatal', 'Newborn Department', 'LDNeonatal', '', 1, 1, 1, 1, 1, 1, 1, 9, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '343', '', '', '', 'Update: 2003-08-13 22:32:07 Elpidio Latorilla\nUpdate: 2003-08-13 22:33:10 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:39 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:59 Elpidio Latorilla\nUpdate: 2003-08-13 22:44:19 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030813234419', '', '00000000000000');
INSERT INTO `care_department` VALUES (22, 'central_lab', '1', 'Central Laboratory', 'Central Lab', 'General Lab', 'LDCentralLaboratory', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', 'kdkdododospdfjdasljfda\r\nasdflasdjf\r\nasdfklasdjflasdjf', '', '', 'Update: 2003-08-13 23:12:30 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:14:59 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:15:28 Elpidio Latorilla\r\n', 'Elpidio Latorilla', '20030828124243', '', '00000000000000');
INSERT INTO `care_department` VALUES (23, 'serological_lab', '1', 'Serological Laboratory', 'Serological Lab', 'Serum Lab', 'LDSerologicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (24, 'chemical_lab', '1', 'Chemical Laboratory', 'Chemical Lab', 'Chem Lab', 'LDChemicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (25, 'bacteriological_lab', '1', 'Bacteriological Laboratory', 'Bacteriological Lab', 'Bacteria Lab', 'LDBacteriologicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (26, 'tech', '2', 'Technical Maintenance', 'Tech', 'Technical Support', 'LDTechnicalMaintenance', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', 'jpg', '', 'Update: 2003-08-10 23:42:30 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030811004230', '', '00000000000000');
INSERT INTO `care_department` VALUES (27, 'it', '2', 'IT Department', 'IT', 'EDP', 'LDITDepartment', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (28, 'management', '2', 'Management', 'Management', 'Busines Administration', 'LDManagement', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (29, 'exhibition', '3', 'Exhibitions', 'Exhibit', 'Showcases', 'LDExhibitions', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (30, 'edu', '3', 'Education', 'Edu', 'Training', 'LDEducation', 'Education news bulletin of the hospital.', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', 'Update: 2003-08-13 22:44:45 Elpidio Latorilla\nUpdate: 2003-08-13 23:00:37 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030814000037', '', '00000000000000');
INSERT INTO `care_department` VALUES (31, 'study', '3', 'Studies', 'Studies', 'Advance studies or on-the-job training', 'LDStudies', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (32, 'health_tip', '3', 'Health Tips', 'Tips', 'Health Information', 'LDHealthTips', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (33, 'admission', '2', 'Admission', 'Admit', 'Admission information', 'LDAdmission', '', 0, 0, 1, 1, 1, 0, 1, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (34, 'news_headline', '3', 'Headline', 'News head', 'Major news', 'LDHeadline', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (35, 'cafenews', '3', 'Cafe News', 'Cafe news', 'Cafeteria news', 'LDCafeNews', '', 0, 0, 1, 1, 1, 0, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (36, 'nursing', '3', 'Nursing', 'Nursing', 'Nursing care', 'LDNursing', '', 1, 1, 1, 1, 1, 1, 1, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (37, 'doctors', '3', 'Doctors', 'Doctors', 'Medical personell', 'LDDoctors', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (38, 'pharmacy', '2', 'Pharmacy', 'Pharma', 'Drugstore', 'LDPharmacy', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (39, 'anaesthesiology', '1', 'Anesthesiology', 'ana', 'Anesthesia Department', 'LDAnesthesiology', 'Anesthesiology', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (40, 'general_ambulant', '1', 'General Outpatient Clinic', 'General Clinic', 'General Ambulatory Clinic', 'LDGeneralOutpatientClinic', 'Outpatient/Ambulant Clinic for general/internal medicine', 0, 1, 1, 1, 0, 0, 1, 16, 'round the clock', '8:30 AM - 11:30 AM , 2:00 PM - 5:30 PM', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (41, 'blood_bank', '1', 'Blood Bank', 'Blood Blank', 'Blood Lab', 'LDBloodBank', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_diagnosis_localcode`
-- 

CREATE TABLE `care_diagnosis_localcode` (
  `localcode` varchar(12) NOT NULL default '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL default '',
  `type` varchar(10) NOT NULL default '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL default '',
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  `search_keys` varchar(255) NOT NULL default '',
  `use_frequency` int(11) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`localcode`),
  KEY `diagnosis_code` (`localcode`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_diagnosis_localcode`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_drg_intern`
-- 

CREATE TABLE `care_drg_intern` (
  `nr` int(11) NOT NULL auto_increment,
  `code` varchar(12) NOT NULL default '',
  `description` text NOT NULL,
  `synonyms` text NOT NULL,
  `notes` text,
  `std_code` char(1) NOT NULL default '',
  `sub_level` tinyint(1) NOT NULL default '0',
  `parent_code` varchar(12) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(25) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `nr` (`nr`),
  KEY `code` (`code`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_drg_intern`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_drg_quicklist`
-- 

CREATE TABLE `care_drg_quicklist` (
  `nr` int(11) NOT NULL auto_increment,
  `code` varchar(25) NOT NULL default '',
  `code_parent` varchar(25) NOT NULL default '',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `qlist_type` varchar(25) NOT NULL default '0',
  `rank` int(11) NOT NULL default '0',
  `status` varchar(15) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(25) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_drg_quicklist`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_drg_related_codes`
-- 

CREATE TABLE `care_drg_related_codes` (
  `nr` int(11) NOT NULL auto_increment,
  `group_nr` int(11) unsigned NOT NULL default '0',
  `code` varchar(15) NOT NULL default '',
  `code_parent` varchar(15) NOT NULL default '',
  `code_type` varchar(15) NOT NULL default '',
  `rank` int(11) NOT NULL default '0',
  `status` varchar(15) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(25) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_drg_related_codes`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_dutyplan_oncall`
-- 

CREATE TABLE `care_dutyplan_oncall` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `dept_nr` int(10) unsigned NOT NULL default '0',
  `role_nr` tinyint(3) unsigned NOT NULL default '0',
  `year` year(4) NOT NULL default '0000',
  `month` char(2) NOT NULL default '',
  `duty_1_txt` text NOT NULL,
  `duty_2_txt` text NOT NULL,
  `duty_1_pnr` text NOT NULL,
  `duty_2_pnr` text NOT NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `dept_nr` (`dept_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_dutyplan_oncall`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_effective_day`
-- 

CREATE TABLE `care_effective_day` (
  `eff_day_nr` tinyint(4) NOT NULL auto_increment,
  `name` varchar(25) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`eff_day_nr`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Daten für Tabelle `care_effective_day`
-- 

INSERT INTO `care_effective_day` VALUES (1, 'entire stay', 'effective starting from admission date & ending on discharge date', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_effective_day` VALUES (2, 'admission day', 'Effective only on admission day', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_effective_day` VALUES (3, 'discharge day', 'Effective only on discharge day', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_effective_day` VALUES (4, 'op day', 'Effective only on operation day', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_effective_day` VALUES (5, 'transfer day', 'Effective only on transfer day', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_effective_day` VALUES (6, 'period', 'defined start and end dates', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter`
-- 

CREATE TABLE `care_encounter` (
  `encounter_nr` bigint(11) unsigned NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `encounter_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `encounter_class_nr` smallint(5) unsigned NOT NULL default '0',
  `encounter_type` varchar(35) NOT NULL default '',
  `encounter_status` varchar(35) NOT NULL default '',
  `referrer_diagnosis` varchar(255) NOT NULL default '',
  `referrer_recom_therapy` varchar(255) default NULL,
  `referrer_dr` varchar(60) NOT NULL default '',
  `referrer_dept` varchar(255) NOT NULL default '',
  `referrer_institution` varchar(255) NOT NULL default '',
  `referrer_notes` text NOT NULL,
  `financial_class_nr` tinyint(3) unsigned NOT NULL default '0',
  `insurance_nr` varchar(25) default '0',
  `insurance_firm_id` varchar(25) NOT NULL default '0',
  `insurance_class_nr` tinyint(3) unsigned NOT NULL default '0',
  `insurance_2_nr` varchar(25) default '0',
  `insurance_2_firm_id` varchar(25) NOT NULL default '0',
  `guarantor_pid` int(11) NOT NULL default '0',
  `contact_pid` int(11) NOT NULL default '0',
  `contact_relation` varchar(35) NOT NULL default '',
  `current_ward_nr` smallint(3) unsigned NOT NULL default '0',
  `current_room_nr` smallint(5) unsigned NOT NULL default '0',
  `in_ward` tinyint(1) NOT NULL default '0',
  `current_dept_nr` smallint(3) unsigned NOT NULL default '0',
  `in_dept` tinyint(1) NOT NULL default '0',
  `current_firm_nr` smallint(5) unsigned NOT NULL default '0',
  `current_att_dr_nr` int(10) NOT NULL default '0',
  `consulting_dr` varchar(60) NOT NULL default '',
  `extra_service` varchar(25) NOT NULL default '',
  `is_discharged` tinyint(1) unsigned NOT NULL default '0',
  `discharge_date` date default NULL,
  `discharge_time` time default NULL,
  `followup_date` date NOT NULL default '0000-00-00',
  `followup_responsibility` varchar(255) default NULL,
  `post_encounter_notes` text NOT NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`encounter_nr`),
  KEY `pid` (`pid`),
  KEY `encounter_date` (`encounter_date`)
) TYPE=MyISAM AUTO_INCREMENT=2005500007 ;

-- 
-- Daten für Tabelle `care_encounter`
-- 

INSERT INTO `care_encounter` VALUES (2005000000, 10000002, '2005-02-02 14:05:24', 1, '', 'disallow_cancel', 'test', 'test', 'test', '', '', 'test', 0, '0', '0', 1, '0', '0', 0, 0, '', 1, 1, 0, 4, 0, 0, 0, '', '', 1, '2005-02-18', '15:19:00', '0000-00-00', NULL, '', '', 'Create: 2005-02-02 14:05:24 = admin\nView 2005-02-02 14:06:46 = admin\nView 2005-02-02 15:24:51 = admin\nView 2005-02-02 15:25:59 = admin\nView 2005-02-02 15:34:40 = admin\nView 2005-02-02 15:35:23 = admin\nView 2005-02-02 15:40:11 = admin\nView 2005-02-02 15:41:36 = admin\nView 2005-02-02 15:42:03 = admin\nView 2005-02-02 15:42:26 = admin\nView 2005-02-02 15:43:03 = admin\nView 2005-02-02 15:50:11 = admin\nView 2005-02-02 16:40:21 = admin\nView 2005-02-02 16:49:34 = admin\nView 2005-02-02 16:55:29 = admin\nView 2005-02-02 16:57:56 = admin\nView 2005-02-02 16:58:54 = admin\nView 2005-02-02 16:59:16 = admin\nView 2005-02-02 16:59:52 = admin\nView 2005-02-02 17:00:23 = admin\nView 2005-02-02 17:01:29 = admin\nView 2005-02-02 17:03:30 = admin\nView 2005-02-02 17:10:02 = admin\nView 2005-02-02 17:12:17 = admin\nView 2005-02-02 17:12:36 = admin\nView 2005-02-02 17:12:59 = admin\nView 2005-02-02 17:13:31 = admin\nView 2005-02-02 17:14:39 = admin\nAdmitted in ward 2005-02- 17:17:17 admin\nView 2005-02-02 17:30:12 = admin\nView 2005-02-02 17:31:27 = admin', 'admin', '20050218151946', 'admin', '20050202140524');
INSERT INTO `care_encounter` VALUES (2005000001, 10000013, '2005-02-18 14:21:42', 1, '', 'disallow_cancel', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 1, 1, 1, 10, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-18 14:21:42 = admin\nAdmitted in ward 2005-02- 14:38:31 admin\nView 2005-02-18 14:39:55 = admin\nView 2005-02-18 14:42:32 = admin\nView 2005-02-24 12:14:43 = admin\nView 2005-02-24 17:00:11 = admin\nView 2005-02-25 14:58:02 = admin\n Update: 2005-02-25 14:58:14 = admin\nView 2005-02-25 16:03:41 = admin\nView 2005-02-25 16:04:20 = admin\nView 2005-02-25 16:05:19 = admin\nView 2005-02-25 16:16:41 = admin\nView 2005-02-25 16:20:16 = admin\nView 2005-02-25 17:00:36 = admin\nView 2005-03-01 16:35:10 = admin\nView 2005-03-01 16:35:20 = admin\nView 2005-03-01 16:35:36 = admin\nView 2005-03-01 16:36:40 = admin', 'admin', '20050301163640', 'admin', '20050218142142');
INSERT INTO `care_encounter` VALUES (2005000002, 10000013, '2005-02-18 14:39:48', 1, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 1, 0, 0, 6, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-18 14:39:48 = admin\r\nView 2005-02-18 14:41:10 = admin\r\nView 2005-02-24 17:00:29 = admin\r\n Update: 2005-02-24 17:00:39 = admin\r\n Update: 2005-02-24 17:00:53 = admin\r\n Update: 2005-02-24 17:01:01 = admin\r\n Update: 2005-02-24 17:02:13 = admin', 'admin', '20050518152612', 'admin', '20050218143948');
INSERT INTO `care_encounter` VALUES (2005000003, 10000014, '2005-02-18 15:16:49', 1, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 1, 0, 0, 9, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-18 15:16:49 = admin', 'admin', '20050218151649', 'admin', '20050218151649');
INSERT INTO `care_encounter` VALUES (2005500000, 10000004, '2005-02-18 15:20:34', 2, '', 'disallow_cancel', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 22, 1, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-18 15:20:34 = admin\nSet dept + in dept 2005-02- 15:21:00 admin\nView 2005-02-18 15:21:08 = admin\nView 2005-02-18 15:22:04 = admin\nView 2005-02-18 15:22:45 = admin\nReset current dept 2005-02- 15:23:49 admin\nSet dept 2005-02- 15:23:49 admin\nView 2005-02-18 15:24:55 = admin\nView 2005-02-18 15:44:28 = admin\nView 2005-02-18 15:45:30 = admin\nView 2005-02-18 15:46:24 = admin\nView 2005-02-18 15:54:24 = admin\nView 2005-02-28 17:25:13 = admin\nSet dept + in dept 2005-02- 17:25:23 admin\nView 2005-02-28 17:25:26 = admin\nView 2005-03-21 16:17:50 = admin\nView 2005-03-23 15:22:58 = admin\nView 2005-03-23 16:26:41 = admin\nView 2005-03-24 10:04:59 = admin\nView 2005-04-11 18:08:26 = admin\nView 2005-04-11 18:15:11 = admin\nView 2005-04-11 19:20:33 = admin\nView 2005-04-11 19:22:08 = admin\nView 2005-04-12 11:01:09 = admin\nView 2005-05-09 19:21:28 = admin', 'admin', '20050509192128', 'admin', '20050218152034');
INSERT INTO `care_encounter` VALUES (2005000004, 10000005, '2005-02-21 16:24:33', 1, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 1, 0, 0, 0, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-21 16:24:33 = admin', 'admin', '20050221162433', 'admin', '20050221162433');
INSERT INTO `care_encounter` VALUES (2005500001, 10000000, '2005-02-21 16:25:21', 2, '', 'disallow_cancel', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 41, 1, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-21 16:25:21 = admin\nView 2005-02-21 16:26:56 = admin\nView 2005-02-21 16:27:42 = admin\nView 2005-02-21 16:29:42 = admin\nView 2005-02-21 17:00:53 = admin\nView 2005-02-21 17:01:24 = admin\nView 2005-02-21 17:01:44 = admin\nView 2005-02-21 17:02:16 = admin\nView 2005-02-21 17:03:47 = admin\nView 2005-02-21 17:04:13 = admin\nView 2005-02-21 17:05:47 = admin\nView 2005-02-21 17:06:57 = admin\nView 2005-02-21 17:15:13 = admin\nView 2005-02-21 17:22:57 = admin\nView 2005-02-21 17:25:24 = admin\nView 2005-02-22 11:04:00 = admin\nView 2005-02-22 11:05:50 = admin\nView 2005-02-22 11:06:17 = admin\nView 2005-02-22 11:27:40 = admin\nView 2005-02-24 12:14:12 = admin\nView 2005-02-28 17:18:05 = admin\nView 2005-02-28 17:20:06 = admin\nView 2005-02-28 17:21:17 = admin\nView 2005-03-08 16:18:01 = admin\nSet dept + in dept 2005-03- 16:18:10 admin\nView 2005-03-21 13:44:21 = admin\nView 2005-03-21 14:54:51 = admin\nView 2005-03-21 15:16:09 = admin\nView 2005-03-21 15:16:20 = admin\nView 2005-03-21 15:33:59 = admin\nView 2005-03-23 11:33:32 = admin\nView 2005-04-14 15:02:57 = admin\nView 2005-04-14 15:07:09 = admin\nView 2005-05-09 15:15:24 = admin\nView 2005-08-18 11:22:40 = admin\nView 2005-08-18 11:22:48 = admin\nView 2005-08-23 15:57:56 = admin', 'admin', '20050823155756', 'admin', '20050221162521');
INSERT INTO `care_encounter` VALUES (2005000005, 10000020, '2005-02-21 17:19:47', 1, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 1, 0, 0, 41, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-21 17:19:47 = admin\nView 2005-02-24 17:57:28 = admin\n Update: 2005-02-24 18:00:23 = admin\n Update: 2005-02-24 18:00:30 = admin\n Update: 2005-02-24 18:00:36 = admin\n Update: 2005-02-24 18:00:59 = admin\nView 2005-03-02 17:09:50 = admin\nView 2005-03-08 16:16:40 = admin\nView 2005-03-21 15:33:38 = admin\nView 2005-04-11 18:24:57 = admin\nView 2005-04-20 12:10:03 = admin\nView 2005-04-20 12:10:23 = admin', 'admin', '20050420121023', 'admin', '20050221171947');
INSERT INTO `care_encounter` VALUES (2005500002, 10000021, '2005-02-21 17:20:45', 2, '', 'disallow_cancel', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 1, 0, 0, 41, 0, 0, 0, '', '', 1, '2005-05-24', '14:57:00', '0000-00-00', NULL, '', '', 'Create: 2005-02-21 17:20:45 = admin\nView 2005-02-21 17:20:56 = admin\nView 2005-02-21 17:21:19 = admin\nSet dept + in dept 2005-02- 17:20:36 admin\nView 2005-02-28 17:20:52 = admin\nView 2005-02-28 17:22:59 = admin\nView 2005-03-02 16:49:32 = admin\nView 2005-03-21 13:44:13 = admin\nView 2005-03-21 14:54:14 = admin\nView 2005-03-21 14:54:45 = admin\nView 2005-03-21 15:16:03 = admin\nView 2005-03-21 15:33:53 = admin\nView 2005-03-23 11:33:25 = admin\nView 2005-03-23 11:52:38 = admin\nView 2005-03-23 14:34:04 = admin\nView 2005-03-23 14:34:19 = admin\nView 2005-03-23 15:27:45 = admin\nView 2005-04-06 11:43:07 = admin\nView 2005-04-06 11:44:18 = admin\nView 2005-04-06 12:07:14 = admin\nView 2005-04-06 13:31:19 = admin\nView 2005-04-06 14:07:28 = admin\nView 2005-04-06 14:56:45 = admin\nView 2005-04-06 14:59:43 = admin\nView 2005-04-06 15:00:06 = admin\nView 2005-04-06 16:01:33 = admin\nView 2005-04-06 17:05:11 = admin\nView 2005-04-07 10:32:49 = admin\nView 2005-04-07 10:59:23 = admin\nView 2005-04-07 11:05:09 = admin\nView 2005-04-07 12:21:05 = admin\nView 2005-04-07 13:32:07 = admin\nView 2005-04-07 13:52:23 = admin\nView 2005-04-07 15:20:28 = admin\nView 2005-04-07 15:53:15 = admin\nView 2005-04-07 16:13:19 = admin\nView 2005-04-08 10:44:21 = admin\nView 2005-04-08 11:35:52 = admin\nView 2005-04-08 12:39:43 = admin\nView 2005-04-08 15:17:36 = admin\nView 2005-04-08 16:33:16 = admin\nView 2005-04-08 17:29:26 = admin\nView 2005-04-11 10:07:30 = admin\nView 2005-04-11 10:09:55 = admin\nView 2005-04-11 10:10:23 = admin\nView 2005-04-11 10:42:25 = admin\nView 2005-04-11 10:44:22 = admin\nView 2005-04-11 11:22:19 = admin\nView 2005-04-11 11:23:12 = admin\nView 2005-04-11 11:34:23 = admin\nView 2005-04-11 11:34:24 = admin\nView 2005-04-11 11:34:29 = admin\nView 2005-04-11 11:38:18 = admin\nView 2005-04-11 12:41:01 = admin\nView 2005-04-11 12:41:25 = admin\nView 2005-04-11 12:47:51 = admin\nView 2005-04-11 14:05:48 = admin\nView 2005-04-11 15:16:00 = admin\nView 2005-04-11 16:07:50 = admin\nView 2005-04-11 17:17:37 = admin\nView 2005-04-11 18:25:09 = admin\nView 2005-04-11 18:42:26 = admin\nView 2005-04-11 18:56:58 = admin\nView 2005-04-11 19:05:31 = admin\nView 2005-04-12 10:55:43 = admin\nView 2005-04-12 11:53:41 = admin\nView 2005-04-12 12:44:35 = admin\nView 2005-04-12 13:12:56 = admin\nView 2005-04-12 13:13:49 = admin\nView 2005-04-12 13:20:49 = admin\nView 2005-04-12 14:42:54 = admin\nView 2005-04-12 14:59:44 = admin\nView 2005-04-12 15:01:37 = admin\nView 2005-04-12 15:03:23 = admin\nView 2005-04-12 17:08:43 = admin\nView 2005-04-12 17:29:42 = admin\nView 2005-04-12 17:44:02 = admin\nView 2005-04-12 17:44:10 = admin\nView 2005-04-12 18:20:02 = admin\nView 2005-04-12 18:20:11 = admin\nView 2005-04-12 18:20:16 = admin\nView 2005-04-12 18:20:38 = admin\nView 2005-04-12 18:20:49 = admin\nView 2005-04-12 18:21:37 = admin\nView 2005-04-12 18:31:43 = admin\nView 2005-04-12 18:31:50 = admin\nView 2005-04-12 18:34:30 = admin\nView 2005-04-12 18:34:35 = admin\nView 2005-04-12 18:34:39 = admin\nView 2005-04-13 10:01:53 = admin\nView 2005-04-13 10:02:07 = admin\nView 2005-04-13 10:02:55 = admin\nView 2005-04-13 10:03:56 = admin\nView 2005-04-13 10:04:05 = admin\nView 2005-04-13 10:04:08 = admin\nView 2005-04-13 10:04:25 = admin\nView 2005-04-13 10:05:52 = admin\nView 2005-04-13 10:34:40 = admin\nView 2005-04-13 11:00:49 = admin\nView 2005-04-13 11:03:10 = admin\nView 2005-04-13 11:08:29 = admin\nView 2005-04-13 11:12:19 = admin\nView 2005-04-13 11:25:31 = admin\nView 2005-04-13 11:25:41 = admin\nView 2005-04-13 15:04:28 = admin\nView 2005-04-13 15:32:53 = admin\nView 2005-04-13 15:37:34 = admin\nView 2005-04-13 15:38:09 = admin\nView 2005-04-13 15:39:33 = admin\nView 2005-04-13 15:39:41 = admin\nView 2005-04-13 16:17:48 = admin\nView 2005-04-13 17:03:15 = admin\nView 2005-04-14 10:19:49 = admin\nView 2005-04-14 11:33:51 = admin\nView 2005-04-14 16:18:45 = admin\nView 2005-04-14 16:18:54 = admin\nView 2005-04-14 16:19:25 = admin\nView 2005-04-20 12:03:31 = admin\nView 2005-04-20 12:10:37 = admin\nView 2005-04-20 12:12:04 = admin\nView 2005-04-20 12:12:39 = admin\nView 2005-04-20 12:12:45 = admin\nView 2005-04-20 13:35:48 = admin\nView 2005-04-28 15:13:41 = admin\nView 2005-05-09 14:09:41 = admin\nView 2005-05-09 14:10:59 = admin\nView 2005-05-09 15:13:14 = admin\nView 2005-05-09 17:16:04 = admin\nView 2005-05-09 19:15:32 = admin\nView 2005-05-21 15:44:45 = admin\nView 2005-05-21 19:54:32 = admin\nView 2005-05-24 12:05:43 = admin', 'admin', '20050524145742', 'admin', '20050221172045');
INSERT INTO `care_encounter` VALUES (2005500003, 4, '2005-04-20 12:02:53', 2, '', 'disallow_cancel', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 41, 1, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-04-20 12:02:53 = admin\nSet dept + in dept 2005-04- 12:03:07 admin\nView 2005-04-20 14:58:13 = admin\nView 2005-05-09 15:12:10 = admin\nView 2005-08-23 15:58:02 = admin', 'admin', '20050823155802', 'admin', '20050420120253');
INSERT INTO `care_encounter` VALUES (2005500004, 10000021, '2005-05-24 15:01:45', 2, '', 'disallow_cancel', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 41, 1, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-05-24 15:01:45 = admin\nSet dept + in dept 2005-05- 15:01:58 admin\nView 2005-06-13 15:39:18 = admin\nView 2005-06-13 15:44:30 = admin\nView 2005-07-29 16:54:58 = admin\nView 2005-08-17 16:17:43 = admin', 'admin', '20050817161743', 'admin', '20050524150145');
INSERT INTO `care_encounter` VALUES (2005500005, 5, '2005-05-30 14:38:33', 2, '', 'disallow_cancel', '', NULL, '', '', '', '', 0, '0', '0', 1, '0', '0', 0, 0, '', 0, 0, 0, 41, 1, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-05-30 14:38:33 = admin\nSet dept + in dept 2005-05- 14:38:50 admin\nView 2005-05-30 18:10:49 = admin\nView 2005-08-17 16:13:57 = admin\nView 2005-08-17 16:14:52 = admin\nView 2005-08-18 11:22:29 = admin\nView 2005-08-18 11:22:36 = admin\nView 2005-08-23 16:04:21 = admin', 'admin', '20050823160421', 'admin', '20050530143833');
INSERT INTO `care_encounter` VALUES (2005500006, 6, '2005-08-13 22:18:49', 2, '', 'disallow_cancel', 'cautsch', 'Fernsehgucken', 'Robert', '', '', '', 0, '0', '0', 2, '0', '0', 0, 0, '', 0, 0, 0, 41, 1, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-08-13 22:18:49 = admin\nSet dept + in dept 2005-08- 22:19:03 admin\nView 2005-08-15 14:42:34 = admin\nView 2005-08-17 15:46:22 = admin\nView 2005-08-17 15:46:33 = admin\nView 2005-08-23 15:58:07 = admin\nView 2005-08-23 16:08:21 = admin\nView 2005-08-23 16:10:02 = admin\nView 2005-08-26 16:01:00 = admin\nView 2005-08-26 16:01:10 = admin', 'admin', '20050826160110', 'admin', '20050813221849');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_diagnosis`
-- 

CREATE TABLE `care_encounter_diagnosis` (
  `diagnosis_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `op_nr` int(10) unsigned NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `code` varchar(25) NOT NULL default '',
  `code_parent` varchar(25) NOT NULL default '',
  `group_nr` mediumint(8) unsigned NOT NULL default '0',
  `code_version` tinyint(4) NOT NULL default '0',
  `localcode` varchar(35) NOT NULL default '',
  `category_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL default '',
  `localization` varchar(35) NOT NULL default '',
  `diagnosing_clinician` varchar(60) NOT NULL default '',
  `diagnosing_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`diagnosis_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_diagnosis`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_diagnostics_report`
-- 

CREATE TABLE `care_encounter_diagnostics_report` (
  `item_nr` int(11) NOT NULL auto_increment,
  `report_nr` int(11) NOT NULL default '0',
  `reporting_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `reporting_dept` varchar(100) NOT NULL default '',
  `report_date` date NOT NULL default '0000-00-00',
  `report_time` time NOT NULL default '00:00:00',
  `encounter_nr` int(10) NOT NULL default '0',
  `script_call` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`item_nr`,`report_nr`),
  KEY `report_nr` (`report_nr`)
) TYPE=MyISAM AUTO_INCREMENT=11 ;

-- 
-- Daten für Tabelle `care_encounter_diagnostics_report`
-- 

INSERT INTO `care_encounter_diagnostics_report` VALUES (1, 10000006, 24, 'Chemical Laboratory', '2005-06-03', '17:00:38', 2005500000, 'labor_test_request_printpop.php?entry_date=&target=&subtarget=chemlabor&dept_nr=24&batch_nr=10000006&pn=2005500000', 'pending', 'Initial report: 2005-03-04 15:23:07 admin\n\rUpdate: 2005-06-03 17:00:38 admin\n', 'admin', '20050603170038', 'admin', '20050304152307');
INSERT INTO `care_encounter_diagnostics_report` VALUES (2, 10000005, 24, 'Chemical Laboratory', '2005-06-03', '16:59:28', 2005000005, 'labor_test_request_printpop.php?entry_date=&target=admin&subtarget=chemlabor&dept_nr=24&batch_nr=10000005&pn=2005000005', 'pending', 'Initial report: 2005-03-08 13:06:04 admin\n\rUpdate: 2005-06-03 16:59:28 admin\n', 'admin', '20050603165928', 'admin', '20050308130604');
INSERT INTO `care_encounter_diagnostics_report` VALUES (3, 10000004, 24, 'Chemical Laboratory', '2005-06-11', '22:17:30', 2005500004, 'labor_test_request_printpop.php?entry_date=&target=&subtarget=chemlabor&dept_nr=24&batch_nr=10000004&pn=2005500004', 'pending', 'Initial report: 2005-06-11 22:17:30 admin\n\r', '', '20050611221730', 'admin', '20050611221730');
INSERT INTO `care_encounter_diagnostics_report` VALUES (4, 10000007, 24, 'Chemical Laboratory', '2005-06-11', '22:17:36', 2005500005, 'labor_test_request_printpop.php?entry_date=&target=&subtarget=chemlabor&dept_nr=24&batch_nr=10000007&pn=2005500005', 'pending', 'Initial report: 2005-06-11 22:17:36 admin\n\r', '', '20050611221736', 'admin', '20050611221736');
INSERT INTO `care_encounter_diagnostics_report` VALUES (5, 10000003, 24, 'Chemical Laboratory', '2005-06-11', '22:17:42', 2005500004, 'labor_test_request_printpop.php?entry_date=&target=&subtarget=chemlabor&dept_nr=24&batch_nr=10000003&pn=2005500004', 'pending', 'Initial report: 2005-06-11 22:17:42 admin\n\r', '', '20050611221742', 'admin', '20050611221742');
INSERT INTO `care_encounter_diagnostics_report` VALUES (6, 10000002, 24, 'Chemical Laboratory', '2005-06-11', '22:17:47', 2005500004, 'labor_test_request_printpop.php?entry_date=&target=&subtarget=chemlabor&dept_nr=24&batch_nr=10000002&pn=2005500004', 'pending', 'Initial report: 2005-06-11 22:17:47 admin\n\r', '', '20050611221747', 'admin', '20050611221747');
INSERT INTO `care_encounter_diagnostics_report` VALUES (7, 10000001, 24, 'Chemical Laboratory', '2005-06-11', '22:17:49', 2005500004, 'labor_test_request_printpop.php?entry_date=&target=&subtarget=chemlabor&dept_nr=24&batch_nr=10000001&pn=2005500004', 'pending', 'Initial report: 2005-06-11 22:17:49 admin\n\r', '', '20050611221749', 'admin', '20050611221749');
INSERT INTO `care_encounter_diagnostics_report` VALUES (8, 10000000, 24, 'Chemical Laboratory', '2005-06-11', '22:21:11', 2005500004, 'labor_test_request_printpop.php?entry_date=&target=admin&subtarget=chemlabor&dept_nr=24&batch_nr=10000000&pn=2005500004', 'pending', 'Initial report: 2005-06-11 22:21:11 admin\n\r', '', '20050611222111', 'admin', '20050611222111');
INSERT INTO `care_encounter_diagnostics_report` VALUES (9, 10000008, 24, 'Chemical Laboratory', '2005-06-11', '22:27:02', 2005500005, 'labor_test_request_printpop.php?entry_date=&target=admin&subtarget=chemlabor&dept_nr=24&batch_nr=10000008&pn=2005500005', 'pending', 'Initial report: 2005-06-11 22:27:02 admin\n\r', '', '20050611222702', 'admin', '20050611222702');
INSERT INTO `care_encounter_diagnostics_report` VALUES (10, 10000009, 24, 'Chemical Laboratory', '2005-06-11', '22:29:18', 2005500003, 'labor_test_request_printpop.php?entry_date=&target=&subtarget=chemlabor&dept_nr=24&batch_nr=10000009&pn=2005500003', 'pending', 'Initial report: 2005-06-11 22:29:18 admin\n\r', '', '20050611222918', 'admin', '20050611222918');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_drg_intern`
-- 

CREATE TABLE `care_encounter_drg_intern` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `group_nr` mediumint(8) unsigned NOT NULL default '0',
  `clinician` varchar(60) NOT NULL default '',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_drg_intern`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_event_signaller`
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
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_encounter_event_signaller`
-- 

INSERT INTO `care_encounter_event_signaller` VALUES (2005000000, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005000001, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500001, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005000005, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500000, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500005, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500004, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500003, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_financial_class`
-- 

CREATE TABLE `care_encounter_financial_class` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `class_nr` smallint(3) unsigned NOT NULL default '0',
  `date_start` date default NULL,
  `date_end` date default NULL,
  `date_create` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_financial_class`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_image`
-- 

CREATE TABLE `care_encounter_image` (
  `nr` bigint(20) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `shot_date` date NOT NULL default '0000-00-00',
  `shot_nr` smallint(6) NOT NULL default '0',
  `mime_type` varchar(10) NOT NULL default '',
  `upload_date` date NOT NULL default '0000-00-00',
  `notes` text NOT NULL,
  `graphic_script` text NOT NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_image`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_immunization`
-- 

CREATE TABLE `care_encounter_immunization` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  `type` varchar(60) NOT NULL default '',
  `medicine` varchar(60) NOT NULL default '',
  `dosage` varchar(60) default NULL,
  `application_type_nr` smallint(5) unsigned NOT NULL default '0',
  `application_by` varchar(60) default NULL,
  `titer` varchar(15) default NULL,
  `refresh_date` date default NULL,
  `notes` text,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_immunization`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_location`
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
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`,`location_nr`),
  KEY `type` (`type_nr`),
  KEY `location_id` (`location_nr`)
) TYPE=MyISAM AUTO_INCREMENT=15 ;

-- 
-- Daten für Tabelle `care_encounter_location`
-- 

INSERT INTO `care_encounter_location` VALUES (1, 2005000000, 2, 1, 1, '2005-02-02', '2005-02-18', '17:17:17', '15:19:00', 1, 'discharged', 'Create: 2005-02-02 17:17:17 admin\nUpdate (discharged): 2005-02-18 15:19:46 admin\n', 'admin', '20050218151946', 'admin', '20050202171717');
INSERT INTO `care_encounter_location` VALUES (2, 2005000000, 4, 1, 1, '2005-02-02', '2005-02-18', '17:17:17', '15:19:00', 1, 'discharged', 'Create: 2005-02-02 17:17:17 admin\nUpdate (discharged): 2005-02-18 15:19:46 admin\n', 'admin', '20050218151946', 'admin', '20050202171717');
INSERT INTO `care_encounter_location` VALUES (3, 2005000000, 5, 1, 1, '2005-02-02', '2005-02-18', '17:17:17', '15:19:00', 1, 'discharged', 'Create: 2005-02-02 17:17:17 admin\nUpdate (discharged): 2005-02-18 15:19:46 admin\n', 'admin', '20050218151946', 'admin', '20050202171717');
INSERT INTO `care_encounter_location` VALUES (4, 2005000001, 2, 1, 1, '2005-02-18', '0000-00-00', '14:38:31', NULL, 0, '', 'Create: 2005-02-18 14:38:31 admin\n', '', '20050218143831', 'admin', '20050218143831');
INSERT INTO `care_encounter_location` VALUES (5, 2005000001, 4, 1, 1, '2005-02-18', '0000-00-00', '14:38:31', NULL, 0, '', 'Create: 2005-02-18 14:38:31 admin\n', '', '20050218143831', 'admin', '20050218143831');
INSERT INTO `care_encounter_location` VALUES (6, 2005000001, 5, 2, 1, '2005-02-18', '0000-00-00', '14:38:31', NULL, 0, '', 'Create: 2005-02-18 14:38:31 admin\n', '', '20050218143831', 'admin', '20050218143831');
INSERT INTO `care_encounter_location` VALUES (7, 2005500000, 1, 24, 24, '2005-02-18', '2005-02-18', '15:21:00', '15:23:49', 8, 'discharged', 'Create: 2005-02-18 15:21:00 admin\nUpdate (discharged): 2005-02-18 15:23:49 admin\n', 'admin', '20050218152349', 'admin', '20050218152100');
INSERT INTO `care_encounter_location` VALUES (8, 2005500002, 1, 41, 41, '2005-02-28', '2005-05-24', '17:20:36', '14:57:00', 1, 'discharged', 'Create: 2005-02-28 17:20:36 admin\nUpdate (discharged): 2005-05-24 14:57:42 admin\n', 'admin', '20050524145742', 'admin', '20050228172036');
INSERT INTO `care_encounter_location` VALUES (9, 2005500000, 1, 22, 22, '2005-02-28', '0000-00-00', '17:25:23', NULL, 0, '', 'Create: 2005-02-28 17:25:23 admin\n', '', '20050228172523', 'admin', '20050228172523');
INSERT INTO `care_encounter_location` VALUES (10, 2005500001, 1, 41, 41, '2005-03-08', '0000-00-00', '16:18:10', NULL, 0, '', 'Create: 2005-03-08 16:18:10 admin\n', '', '20050308161810', 'admin', '20050308161810');
INSERT INTO `care_encounter_location` VALUES (11, 2005500003, 1, 41, 41, '2005-04-20', '0000-00-00', '12:03:07', NULL, 0, '', 'Create: 2005-04-20 12:03:07 admin\n', '', '20050420120307', 'admin', '20050420120307');
INSERT INTO `care_encounter_location` VALUES (12, 2005500004, 1, 41, 41, '2005-05-24', '0000-00-00', '15:01:58', NULL, 0, '', 'Create: 2005-05-24 15:01:58 admin\n', '', '20050524150158', 'admin', '20050524150158');
INSERT INTO `care_encounter_location` VALUES (13, 2005500005, 1, 41, 41, '2005-05-30', '0000-00-00', '14:38:50', NULL, 0, '', 'Create: 2005-05-30 14:38:50 admin\n', '', '20050530143850', 'admin', '20050530143850');
INSERT INTO `care_encounter_location` VALUES (14, 2005500006, 1, 41, 41, '2005-08-13', '0000-00-00', '22:19:03', NULL, 0, '', 'Create: 2005-08-13 22:19:03 admin\n', '', '20050813221903', 'admin', '20050813221903');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_measurement`
-- 

CREATE TABLE `care_encounter_measurement` (
  `nr` int(11) unsigned NOT NULL auto_increment,
  `msr_date` date NOT NULL default '0000-00-00',
  `msr_time` float(4,2) NOT NULL default '0.00',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `msr_type_nr` tinyint(3) unsigned NOT NULL default '0',
  `value` varchar(255) default NULL,
  `unit_nr` smallint(5) unsigned default NULL,
  `unit_type_nr` tinyint(2) unsigned NOT NULL default '0',
  `notes` varchar(255) default NULL,
  `measured_by` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `type` (`msr_type_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_measurement`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_notes`
-- 

CREATE TABLE `care_encounter_notes` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `type_nr` smallint(5) unsigned NOT NULL default '0',
  `notes` text NOT NULL,
  `short_notes` varchar(25) default NULL,
  `aux_notes` varchar(255) default NULL,
  `ref_notes_nr` int(10) unsigned NOT NULL default '0',
  `personell_nr` int(10) unsigned NOT NULL default '0',
  `personell_name` varchar(60) NOT NULL default '',
  `send_to_pid` int(11) NOT NULL default '0',
  `send_to_name` varchar(60) default NULL,
  `date` date default NULL,
  `time` time default NULL,
  `location_type` varchar(35) default NULL,
  `location_type_nr` tinyint(3) NOT NULL default '0',
  `location_nr` mediumint(8) unsigned NOT NULL default '0',
  `location_id` varchar(60) default NULL,
  `ack_short_id` varchar(10) NOT NULL default '',
  `date_ack` datetime default NULL,
  `date_checked` datetime default NULL,
  `date_printed` datetime default NULL,
  `send_by_mail` tinyint(1) default NULL,
  `send_by_email` tinyint(1) default NULL,
  `send_by_fax` tinyint(1) default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `type_nr` (`type_nr`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Daten für Tabelle `care_encounter_notes`
-- 

INSERT INTO `care_encounter_notes` VALUES (1, 2005500001, 6, 'ttt', NULL, NULL, 0, 0, 'admin', 0, NULL, '2005-04-13', '15:40:27', NULL, 2, 41, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Create: 2005-04-13 15-40-27 admin\n\r', '', '20050413154027', 'admin', '20050413154027');
INSERT INTO `care_encounter_notes` VALUES (2, 2005500002, 3, 'as', NULL, NULL, 0, 0, 'admin', 0, NULL, '2005-05-24', '14:57:00', NULL, 0, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Create: 2005-05-24 14-57-42 admin\n\r', '', '20050524145742', 'admin', '20050524145742');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_obstetric`
-- 

CREATE TABLE `care_encounter_obstetric` (
  `encounter_nr` int(11) unsigned NOT NULL auto_increment,
  `pregnancy_nr` int(11) unsigned NOT NULL default '0',
  `hospital_adm_nr` int(11) unsigned NOT NULL default '0',
  `patient_class` varchar(60) NOT NULL default '',
  `is_discharged_not_in_labour` tinyint(1) default NULL,
  `is_re_admission` tinyint(1) default NULL,
  `referral_status` varchar(60) default NULL,
  `referral_reason` text,
  `status` varchar(25) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`encounter_nr`),
  KEY `encounter_nr` (`pregnancy_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_obstetric`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_op`
-- 

CREATE TABLE `care_encounter_op` (
  `nr` int(11) NOT NULL auto_increment,
  `year` varchar(4) NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `op_room` varchar(10) NOT NULL default '0',
  `op_nr` mediumint(9) NOT NULL default '0',
  `op_date` date NOT NULL default '0000-00-00',
  `op_src_date` varchar(8) NOT NULL default '',
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `diagnosis` text NOT NULL,
  `operator` text NOT NULL,
  `assistant` text NOT NULL,
  `scrub_nurse` text NOT NULL,
  `rotating_nurse` text NOT NULL,
  `anesthesia` varchar(30) NOT NULL default '',
  `an_doctor` text NOT NULL,
  `op_therapy` text NOT NULL,
  `result_info` text NOT NULL,
  `entry_time` varchar(5) NOT NULL default '',
  `cut_time` varchar(5) NOT NULL default '',
  `close_time` varchar(5) NOT NULL default '',
  `exit_time` varchar(5) NOT NULL default '',
  `entry_out` text NOT NULL,
  `cut_close` text NOT NULL,
  `wait_time` text NOT NULL,
  `bandage_time` text NOT NULL,
  `repos_time` text NOT NULL,
  `encoding` longtext NOT NULL,
  `doc_date` varchar(10) NOT NULL default '',
  `doc_time` varchar(5) NOT NULL default '',
  `duty_type` varchar(15) NOT NULL default '',
  `material_codedlist` text NOT NULL,
  `container_codedlist` text NOT NULL,
  `icd_code` text NOT NULL,
  `ops_code` text NOT NULL,
  `ops_intern_code` text NOT NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `dept` (`dept_nr`),
  KEY `op_room` (`op_room`),
  KEY `op_date` (`op_date`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_op`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_prescription`
-- 

CREATE TABLE `care_encounter_prescription` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `prescription_type_nr` smallint(5) unsigned NOT NULL default '0',
  `article` varchar(100) NOT NULL default '',
  `article_item_number` varchar(50) NOT NULL default '',
  `price` varchar(255) NOT NULL default '',
  `drug_class` varchar(60) NOT NULL default '',
  `order_nr` int(11) NOT NULL default '0',
  `dosage` varchar(255) NOT NULL default '',
  `application_type_nr` smallint(5) unsigned NOT NULL default '0',
  `notes` text NOT NULL,
  `prescribe_date` date default NULL,
  `prescriber` varchar(60) NOT NULL default '',
  `color_marker` varchar(10) NOT NULL default '',
  `is_stopped` tinyint(1) unsigned NOT NULL default '0',
  `is_outpatient_prescription` tinyint(11) unsigned NOT NULL default '0',
  `stop_date` date default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `bill_number` bigint(20) default NULL,
  `bill_status` varchar(10) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Daten für Tabelle `care_encounter_prescription`
-- 

INSERT INTO `care_encounter_prescription` VALUES (1, 2005500006, 0, 'Acetazolamide Tablet', '4', '500', '', 0, '10', 0, 'Acetazolamide Tablet', '2005-08-26', 'admin', '', 0, 1, NULL, '', 'Created: 2005-08-26 16:01:22 : admin<br>changed: 2005-08-26 16:02:54 previous dosage: >2x5< ;previous notes: >Acetazolamide Tablet', 1, 'pending', '', '20050826160254', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_prescription_notes`
-- 

CREATE TABLE `care_encounter_prescription_notes` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `prescription_nr` int(10) unsigned NOT NULL default '0',
  `notes` varchar(35) default NULL,
  `short_notes` varchar(25) default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_prescription_notes`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_procedure`
-- 

CREATE TABLE `care_encounter_procedure` (
  `procedure_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `op_nr` int(11) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `code` varchar(25) NOT NULL default '',
  `code_parent` varchar(25) NOT NULL default '',
  `group_nr` mediumint(8) unsigned NOT NULL default '0',
  `code_version` tinyint(4) NOT NULL default '0',
  `localcode` varchar(35) NOT NULL default '',
  `category_nr` tinyint(3) unsigned NOT NULL default '0',
  `localization` varchar(35) NOT NULL default '',
  `responsible_clinician` varchar(60) NOT NULL default '',
  `responsible_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`procedure_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_procedure`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_encounter_sickconfirm`
-- 

CREATE TABLE `care_encounter_sickconfirm` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `date_confirm` date NOT NULL default '0000-00-00',
  `date_start` date NOT NULL default '0000-00-00',
  `date_end` date NOT NULL default '0000-00-00',
  `date_create` date NOT NULL default '0000-00-00',
  `diagnosis` text NOT NULL,
  `dept_nr` smallint(6) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_sickconfirm`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_group`
-- 

CREATE TABLE `care_group` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Daten für Tabelle `care_group`
-- 

INSERT INTO `care_group` VALUES (1, 'pregnancy', 'Pregnancy', 'LDPregnancy', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_group` VALUES (2, 'neonatal', 'Neonatal', 'LDNeonatal', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_group` VALUES (3, 'encounter', 'Encounter', 'LDEncounter', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_group` VALUES (4, 'op', 'OP', 'LDOP', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_group` VALUES (5, 'anesthesia', 'Anesthesia', 'LDAnesthesia', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_group` VALUES (6, 'prescription', 'Prescription', 'LDPrescription', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_icd10_bs`
-- 

CREATE TABLE `care_icd10_bs` (
  `diagnosis_code` varchar(12) NOT NULL default '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL default '',
  `type` varchar(10) NOT NULL default '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL default '',
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_icd10_bs`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_icd10_de`
-- 

CREATE TABLE `care_icd10_de` (
  `diagnosis_code` varchar(12) NOT NULL default '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL default '',
  `type` varchar(10) NOT NULL default '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL default '',
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  KEY `diagnosis_code` (`diagnosis_code`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_icd10_de`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_icd10_en`
-- 

CREATE TABLE `care_icd10_en` (
  `diagnosis_code` varchar(12) NOT NULL default '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL default '',
  `type` varchar(10) NOT NULL default '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL default '',
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_icd10_en`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_icd10_es`
-- 

CREATE TABLE `care_icd10_es` (
  `diagnosis_code` varchar(12) NOT NULL default '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL default '',
  `type` varchar(10) NOT NULL default '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL default '',
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_icd10_es`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_icd10_pt_br`
-- 

CREATE TABLE `care_icd10_pt_br` (
  `diagnosis_code` varchar(12) NOT NULL default '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL default '',
  `type` varchar(10) NOT NULL default '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL default '',
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_icd10_pt_br`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_img_diagnostic`
-- 

CREATE TABLE `care_img_diagnostic` (
  `nr` bigint(20) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `doc_ref_ids` varchar(255) default NULL,
  `img_type` varchar(10) NOT NULL default '',
  `max_nr` tinyint(2) default '0',
  `upload_date` date NOT NULL default '0000-00-00',
  `cancel_date` date NOT NULL default '0000-00-00',
  `cancel_by` varchar(35) default NULL,
  `notes` text,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`pid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_img_diagnostic`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_insurance_firm`
-- 

CREATE TABLE `care_insurance_firm` (
  `firm_id` varchar(40) NOT NULL default '',
  `name` varchar(60) NOT NULL default '',
  `iso_country_id` char(3) NOT NULL default '',
  `sub_area` varchar(60) NOT NULL default '',
  `type_nr` smallint(5) unsigned NOT NULL default '0',
  `addr` varchar(255) default NULL,
  `addr_mail` varchar(200) default NULL,
  `addr_billing` varchar(200) default NULL,
  `addr_email` varchar(60) default NULL,
  `phone_main` varchar(35) default NULL,
  `phone_aux` varchar(35) default NULL,
  `fax_main` varchar(35) default NULL,
  `fax_aux` varchar(35) default NULL,
  `contact_person` varchar(60) default NULL,
  `contact_phone` varchar(35) default NULL,
  `contact_fax` varchar(35) default NULL,
  `contact_email` varchar(60) default NULL,
  `use_frequency` bigint(20) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`firm_id`),
  KEY `name` (`name`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_insurance_firm`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_mail_private`
-- 

CREATE TABLE `care_mail_private` (
  `recipient` varchar(60) NOT NULL default '',
  `sender` varchar(60) NOT NULL default '',
  `sender_ip` varchar(60) NOT NULL default '',
  `cc` varchar(255) NOT NULL default '',
  `bcc` varchar(255) NOT NULL default '',
  `subject` varchar(255) NOT NULL default '',
  `body` text NOT NULL,
  `sign` varchar(255) NOT NULL default '',
  `ask4ack` tinyint(4) NOT NULL default '0',
  `reply2` varchar(255) NOT NULL default '',
  `attachment` varchar(255) NOT NULL default '',
  `attach_type` varchar(30) NOT NULL default '',
  `read_flag` tinyint(4) NOT NULL default '0',
  `mailgroup` varchar(60) NOT NULL default '',
  `maildir` varchar(60) NOT NULL default '',
  `exec_level` tinyint(4) NOT NULL default '0',
  `exclude_addr` text NOT NULL,
  `send_dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `send_stamp` timestamp(14) NOT NULL,
  `uid` varchar(255) NOT NULL default '',
  KEY `recipient` (`recipient`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_mail_private`
-- 

INSERT INTO `care_mail_private` VALUES ('admin', 'admin@intranet', '196.201.129.65', '', '', 'test', 'test', '', 0, 'admin@intranet', '', '', 0, '', '', 1, '', '2004-12-15 10:26:14', '20041215102614', '41c003367e0e2');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_mail_private_users`
-- 

CREATE TABLE `care_mail_private_users` (
  `user_name` varchar(60) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `alias` varchar(60) NOT NULL default '',
  `pw` varchar(255) NOT NULL default '',
  `inbox` longtext NOT NULL,
  `sent` longtext NOT NULL,
  `drafts` longtext NOT NULL,
  `trash` longtext NOT NULL,
  `lastcheck` timestamp(14) NOT NULL,
  `lock_flag` tinyint(4) NOT NULL default '0',
  `addr_book` text NOT NULL,
  `addr_quick` tinytext NOT NULL,
  `secret_q` tinytext NOT NULL,
  `secret_q_ans` tinytext NOT NULL,
  `public` tinyint(4) NOT NULL default '0',
  `sig` tinytext NOT NULL,
  `append_sig` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`email`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_mail_private_users`
-- 

INSERT INTO `care_mail_private_users` VALUES ('admin', 'admin@intranet', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', 't=2004-12-15 10:26:14&r=1&f=admin&s=test&d=2004-12-15 10:26:14&z=4\r\n', '20041215102509', 0, '', '', '', '', 0, '', 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_med_ordercatalog`
-- 

CREATE TABLE `care_med_ordercatalog` (
  `item_no` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `hit` int(11) NOT NULL default '0',
  `artikelname` tinytext NOT NULL,
  `bestellnum` varchar(20) NOT NULL default '',
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  PRIMARY KEY  (`item_no`),
  KEY `item_no` (`item_no`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_med_ordercatalog`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_med_orderlist`
-- 

CREATE TABLE `care_med_orderlist` (
  `order_nr` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `order_date` date NOT NULL default '0000-00-00',
  `order_time` time NOT NULL default '00:00:00',
  `articles` text NOT NULL,
  `extra1` tinytext NOT NULL,
  `extra2` text NOT NULL,
  `validator` tinytext NOT NULL,
  `ip_addr` tinytext NOT NULL,
  `priority` tinytext NOT NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  `sent_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `process_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`order_nr`),
  KEY `item_nr` (`order_nr`),
  KEY `dept` (`dept_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_med_orderlist`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_med_products_main`
-- 

CREATE TABLE `care_med_products_main` (
  `bestellnum` varchar(25) NOT NULL default '',
  `artikelnum` tinytext NOT NULL,
  `industrynum` tinytext NOT NULL,
  `artikelname` tinytext NOT NULL,
  `generic` tinytext NOT NULL,
  `description` text NOT NULL,
  `packing` tinytext NOT NULL,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  `picfile` tinytext NOT NULL,
  `encoder` tinytext NOT NULL,
  `enc_date` tinytext NOT NULL,
  `enc_time` tinytext NOT NULL,
  `lock_flag` tinyint(1) NOT NULL default '0',
  `medgroup` text NOT NULL,
  `cave` tinytext NOT NULL,
  `status` varchar(20) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`bestellnum`),
  KEY `bestellnum` (`bestellnum`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_med_products_main`
-- 

INSERT INTO `care_med_products_main` VALUES ('1234', '', '', 'PenicillinG', '', '1g Pen', '', 0, 0, '1', '', 'admin', '2004.12.15', '10.23', 0, '', '', '', 'Created 2004-12-15 10:24:07 admin\n', '', '20041215102407', 'admin', '20041215102407');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_med_report`
-- 

CREATE TABLE `care_med_report` (
  `report_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(15) NOT NULL default '',
  `report` text NOT NULL,
  `reporter` varchar(25) NOT NULL default '',
  `id_nr` varchar(15) NOT NULL default '',
  `report_date` date NOT NULL default '0000-00-00',
  `report_time` time NOT NULL default '00:00:00',
  `status` varchar(20) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`report_nr`),
  KEY `report_nr` (`report_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_med_report`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_menu_main`
-- 

CREATE TABLE `care_menu_main` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `sort_nr` tinyint(2) NOT NULL default '0',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `is_visible` tinyint(1) unsigned NOT NULL default '1',
  `hide_by` text,
  `status` varchar(25) NOT NULL default '',
  `modify_id` timestamp(14) NOT NULL,
  `modify_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=26 ;

-- 
-- Daten für Tabelle `care_menu_main`
-- 

INSERT INTO `care_menu_main` VALUES (1, 1, 'Home', 'LDHome', 'main/startframe.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (2, 5, 'Patient', 'LDPatient', 'modules/registration_admission/patient_register_pass.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (3, 10, 'Admission', 'LDAdmission', 'modules/registration_admission/aufnahme_pass.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (4, 15, 'Ambulatory', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', 1, '', '', '20050225152509', '00000000000000');
INSERT INTO `care_menu_main` VALUES (5, 20, 'Medocs', 'LDMedocs', 'modules/medocs/medocs_pass.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (6, 25, 'Doctors', 'LDDoctors', 'modules/doctors/doctors.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (7, 35, 'Nursing', 'LDNursing', 'modules/nursing/nursing.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (8, 40, 'OR', 'LDOR', 'main/op-doku.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (9, 45, 'Laboratories', 'LDLabs', 'modules/laboratory/labor.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (10, 50, 'Radiology', 'LDRadiology', 'modules/radiology/radiolog.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (11, 55, 'Pharmacy', 'LDPharmacy', 'modules/pharmacy_tz/pharmacy_tz.php', 1, '', '', '20050506154519', '00000000000000');
INSERT INTO `care_menu_main` VALUES (12, 60, 'Medical Depot', 'LDMedDepot', 'modules/med_depot/medlager.php', 0, '', '', '20050202112256', '00000000000000');
INSERT INTO `care_menu_main` VALUES (13, 65, 'Directory', 'LDDirectory', 'modules/phone_directory/phone.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (14, 70, 'Tech Support', 'LDTechSupport', 'modules/tech/technik.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (15, 72, 'System Admin', 'LDEDP', 'modules/system_admin/edv.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (16, 75, 'Intranet Email', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (17, 80, 'Internet Email', 'LDInterEmail', 'modules/nocc/index.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (18, 85, 'Special Tools', 'LDSpecials', 'main/spediens.php', 1, '', '', '20030923002015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (23, 91, 'Logout', 'LDLogout', 'main/logout_confirm.php', 1, '', '', '20050314150726', '00000000000000');
INSERT INTO `care_menu_main` VALUES (20, 7, 'Appointments', 'LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', 1, '', '', '20030923002015', '20030405010145');
INSERT INTO `care_menu_main` VALUES (21, 16, 'Inpatient', 'LDInpatient', 'modules/inpatient/inpatient.php', 1, NULL, '', '20050225143927', '00000000000000');
INSERT INTO `care_menu_main` VALUES (22, 46, 'Laboratories TZ', 'LDLabs', 'modules/laboratory_tz/labor.php', 0, '', '', '20050308130545', '00000000000000');
INSERT INTO `care_menu_main` VALUES (24, 90, 'Login', 'LDLogin', 'main/login.php', 1, '', '', '20050314150912', '00000000000000');
INSERT INTO `care_menu_main` VALUES (25, 58, 'Billing', 'LDBilling', 'modules/billing_tz/billing_tz.php', 1, NULL, '', '20050516150807', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_menu_sub`
-- 

CREATE TABLE `care_menu_sub` (
  `s_nr` int(11) NOT NULL default '0',
  `s_sort_nr` int(11) NOT NULL default '0',
  `s_main_nr` int(11) NOT NULL default '0',
  `s_ebene` int(11) NOT NULL default '0',
  `s_name` varchar(100) NOT NULL default '',
  `s_LD_var` varchar(100) NOT NULL default '',
  `s_url` varchar(100) NOT NULL default '',
  `s_url_ext` varchar(100) NOT NULL default '',
  `s_image` varchar(100) NOT NULL default '',
  `s_open_image` varchar(100) NOT NULL default '',
  `s_is_visible` varchar(100) NOT NULL default '',
  `s_hide_by` varchar(100) NOT NULL default '',
  `s_status` varchar(100) NOT NULL default '',
  `s_modify_id` varchar(100) NOT NULL default '',
  `s_modify_time` datetime NOT NULL default '0000-00-00 00:00:00'
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_menu_sub`
-- 

INSERT INTO `care_menu_sub` VALUES (3, 0, 2, 0, '', '', '', '', '../gui/img/common/default/new_group.gif', '../gui/img/common/default/new_group.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (70, 0, 7, 0, '', '', '', '', '../gui/img/common/default/nurse.gif', '../gui/img/common/default/nurse.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (20, 0, 1, 0, '', '', '', '', '../gui/img/common/default/articles.gif', '../gui/img/common/default/home.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (30, 0, 20, 0, '', '', '', '', '../gui/img/common/default/calendar.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (5, 2, 2, 1, 'Admission', 'LDAdmission', '../modules/registration_admission/aufnahme_pass.php', '', '../gui/img/common/default/bn.gif', '../gui/img/common/default/bn.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (1, 1, 2, 1, 'Registration', '', '../modules/registration_admission/patient_register_pass.php', '&target=entry', '../gui/img/common/default/post_discussion.gif', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (130, 1, 2, 1, 'Search', 'LDSearch', '../modules/registration_admission/patient_register_pass.php', '&target=search', '../gui/img/common/default/findnew.gif', '../gui/img/common/default/findnew.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (135, 1, 2, 1, 'Archive', 'LDArchive', '../modules/registration_admission/patient_register_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (140, 5, 2, 2, 'Search', 'LDSearch', '../modules/registration_admission/aufnahme_pass.php', '&target=search', '../gui/img/common/default/findnew.gif', '../gui/img/common/default/findnew.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (145, 6, 2, 2, 'Archive', 'LDArchive', '../modules/registration_admission/aufnahme_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (71, 1, 7, 1, 'Wards', '', '../modules/nursing/nursing.php', '', '../gui/img/common/default/bul_arrowgrnsm.gif', '../gui/img/common/default/bul_arrowgrnsm.gif', '', '', '[station]', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (155, 1, 3, 1, 'Archive', 'LDArchive', '../modules/registration_admission/aufnahme_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (40, 0, 3, 0, '', '', '', '', '../gui/img/common/default/bn.gif', '../gui/img/common/default/bn.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (165, 0, 13, 0, '', '', '', '', '../gui/img/common/default/violet_phone.gif', '../gui/img/common/default/violet_phone.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (7, 3, 7, 1, 'Search', '', '../modules/nursing/nursing-patient-such-start.php', '', '../gui/img/common/default/findnew.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (72, 2, 7, 1, 'Quick view', '', '../modules/nursing/nursing-schnellsicht.php', '', '../gui/img/common/default/eye_s.gif', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (50, 0, 4, 0, '', '', '', '', '../gui/img/common/default/disc_unrd.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (120, 0, 6, 0, '', '', '', '', '../gui/img/common/default/forums.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (160, 0, 17, 0, '', '', '', '', '../gui/img/common/default/c-mail.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (190, 0, 16, 0, '', '', '', '', '../gui/img/common/default/bubble2.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (195, 0, 10, 0, '', '', '', '', '../gui/img/common/default/torso.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (200, 0, 18, 0, '', '', '', '', '../gui/img/common/default/settings_tree.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (205, 0, 11, 0, '', '', '', '', '../gui/img/common/default/add.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (160, 0, 19, 0, '', '', '', '', '../gui/img/common/default/padlock.gif', '../gui/img/common/default/bul_arrowgrnsm.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (215, 0, 15, 0, '', '', '', '', '../gui/img/common/default/sections.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (220, 0, 12, 0, '', '', '', '', '../gui/img/common/default/storage.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (225, 0, 8, 0, '', '', '', '', '../gui/img/common/default/people_search_online.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (230, 0, 9, 0, '', '', '', '', '../gui/img/common/default/chart.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES (235, 0, 14, 0, '', '', '', '', '../gui/img/common/default/settings_tree.gif', '', '', '', '', '', '0001-01-01 00:00:00');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_method_induction`
-- 

CREATE TABLE `care_method_induction` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `method` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Daten für Tabelle `care_method_induction`
-- 

INSERT INTO `care_method_induction` VALUES (3, 1, 'prostaglandin', 'Prostaglandin', 'LDProstaglandin', '', '', '', '20030805201247', '', '00000000000000');
INSERT INTO `care_method_induction` VALUES (4, 1, 'oxytocin', 'Oxytocin', 'LDOxytocin', '', '', '', '20030805201254', '', '00000000000000');
INSERT INTO `care_method_induction` VALUES (5, 1, 'arom', 'AROM', 'LDAROM', '', '', '', '20030805201302', '', '00000000000000');
INSERT INTO `care_method_induction` VALUES (2, 1, 'unknown', 'Unknown', 'LDUnknown', '', '', '', '20030805201240', '', '00000000000000');
INSERT INTO `care_method_induction` VALUES (1, 1, 'not_induced', 'Not induced', 'LDNotInduced', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_mode_delivery`
-- 

CREATE TABLE `care_mode_delivery` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `mode` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) default NULL,
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Daten für Tabelle `care_mode_delivery`
-- 

INSERT INTO `care_mode_delivery` VALUES (1, 2, 'normal', 'Normal', 'LDNormal', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_mode_delivery` VALUES (2, 2, 'breech', 'Breech', 'LDBreech', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_mode_delivery` VALUES (3, 2, 'caesarian', 'Caesarian', 'LDCaesarian', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_mode_delivery` VALUES (4, 2, 'forceps', 'Forceps', 'LDForceps', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_mode_delivery` VALUES (5, 2, 'vacuum', 'Vacuum', 'LDVacuum', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_neonatal`
-- 

CREATE TABLE `care_neonatal` (
  `nr` int(11) unsigned NOT NULL auto_increment,
  `pid` int(11) unsigned NOT NULL default '0',
  `delivery_date` date NOT NULL default '0000-00-00',
  `parent_encounter_nr` int(11) unsigned NOT NULL default '0',
  `delivery_nr` tinyint(4) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `delivery_place` varchar(60) NOT NULL default '',
  `delivery_mode` tinyint(2) NOT NULL default '0',
  `c_s_reason` text,
  `born_before_arrival` tinyint(1) default '0',
  `face_presentation` tinyint(1) NOT NULL default '0',
  `posterio_occipital_position` tinyint(1) NOT NULL default '0',
  `delivery_rank` tinyint(2) unsigned NOT NULL default '1',
  `apgar_1_min` tinyint(4) NOT NULL default '0',
  `apgar_5_min` tinyint(4) NOT NULL default '0',
  `apgar_10_min` tinyint(4) NOT NULL default '0',
  `time_to_spont_resp` tinyint(2) default NULL,
  `condition` varchar(60) default '0',
  `weight` float(8,2) unsigned default NULL,
  `length` float(8,2) unsigned default NULL,
  `head_circumference` float(8,2) unsigned default NULL,
  `scored_gestational_age` float(4,2) unsigned default NULL,
  `feeding` tinyint(4) NOT NULL default '0',
  `congenital_abnormality` varchar(125) NOT NULL default '',
  `classification` varchar(255) NOT NULL default '0',
  `disease_category` tinyint(2) NOT NULL default '0',
  `outcome` tinyint(2) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `pid` (`pid`),
  KEY `pregnancy_nr` (`parent_encounter_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_neonatal`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_news_article`
-- 

CREATE TABLE `care_news_article` (
  `nr` int(11) NOT NULL auto_increment,
  `lang` varchar(10) NOT NULL default 'en',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `category` tinytext NOT NULL,
  `status` varchar(10) NOT NULL default 'pending',
  `title` varchar(255) NOT NULL default '',
  `preface` text NOT NULL,
  `body` text NOT NULL,
  `pic` blob,
  `pic_mime` varchar(4) default NULL,
  `art_num` tinyint(1) NOT NULL default '0',
  `head_file` tinytext NOT NULL,
  `main_file` tinytext NOT NULL,
  `pic_file` tinytext NOT NULL,
  `author` varchar(30) NOT NULL default '',
  `submit_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `encode_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_date` date NOT NULL default '0000-00-00',
  `modify_id` varchar(30) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(30) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `item_no` (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=27 ;

-- 
-- Daten für Tabelle `care_news_article`
-- 

INSERT INTO `care_news_article` VALUES (1, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '\r\n\r\n\r\n\r\n<p class="MsoNormal">We have started to customize Care2x to East-African\r\nhospitals. The work was started last year in Tanzania in ELCT (Evangelical\r\nLutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital\r\nfrom Kenya joined to the project in November. <!--[endif]--><o:p /></p>\r\n\r\n\r\n\r\n<p class="MsoNormal"><!--[if !supportEmptyParas]-->The first step was to install the original Care2x to Selian\r\ntown clinic in June to see how well it would fit to our needs. The work was\r\ndone by local IT-company Arusha Node Marie, which also trained the staff to use\r\nthe program. In September Merotech IT-engineers from Germany made requirement\r\nanalysis with us and the programming was started in December. When Kijabe\r\njoined to the project they brought three more IT-engineers to our project. <!--[endif]--><o:p /></p>\r\n\r\n<p class="MsoNormal">We are making major changes in pharmacy, laboratory and\r\nbilling module and later this year build inventory/stock module. Also we are\r\nwaiting decision from PEPFAR for funding to make modules for ARV treatment\r\naccording to their requirements. But we are making small modification to most\r\nof the forms in Care2x that we are going to use.</p>\r\n\r\n\r\n\r\n\r\n\r\n<p class="MsoNormal"><!--[if !supportEmptyParas]-->Our goal is to make one East-African version and keep the\r\nhospital specific modifications as simple as possible and we hope that more\r\nhospitals from this area would join in. This is the way to create strong base\r\nand make the program sustainable. <!--[endif]--><o:p /></p>\r\n\r\n<p class="MsoNormal">Mauri Niemi, MD<br />Information Officer<span style="font-size: 12pt; font-family: "Times New Roman";">, ELCT</span></p>\r\n', NULL, '', 1, '', '', '2048418385', 'Mauri Niemi', '2005-01-04 10:26:06', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104102606', 'admin', '20050104102606');
INSERT INTO `care_news_article` VALUES (2, 'en', 1, '1', 'pending', 'Care 2x in East-Africa', '', '\r\n\r\n\r\n\r\n<p class="MsoNormal"><!--[if !supportEmptyParas]-->We have started to customize Care2x to East-African\r\nhospitals. The work was started last year in Tanzania in ELCT (Evangelical\r\nLutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital\r\nfrom Kenya joined to the project in November.<!--[endif]--><o:p /></p>\r\n\r\n\r\n\r\n<p class="MsoNormal"><!--[if !supportEmptyParas]-->The first step was to install the original Care2x to Selian\r\ntown clinic in June to see how well it would fit to our needs. The work was\r\ndone by local IT-company Arusha Node Marie, which also trained the staff to use\r\nthe program. In September Merotech IT-engineers from Germany made requirement\r\nanalysis with us and the programming was started in December. When Kijabe\r\njoined to the project they brought three more IT-engineers to our project.<!--[endif]--><o:p /></p>\r\n\r\n\r\n\r\n<p class="MsoNormal"><!--[if !supportEmptyParas]-->We are making major changes in pharmacy, laboratory and\r\nbilling module and later this year build inventory/stock module. Also we are\r\nwaiting decision from PEPFAR for funding to make modules for ARV treatment\r\naccording to their requirements. But we are making small modification to most\r\nof the forms in Care2x that we are going to use.<!--[endif]--><o:p /></p>\r\n\r\n\r\n\r\n\r\n\r\n<p class="MsoNormal"><!--[if !supportEmptyParas]-->Our goal is to make one East-African version and keep the\r\nhospital specific modifications as simple as possible and we hope that more\r\nhospitals from this area would join in. This is the way to create strong base\r\nand make the program sustainable.<br /><!--[endif]--><o:p /><br />Mauri Niemi, MD<br />Information Officer<span style="font-size: 12pt; font-family: "Times New Roman";">, ELCT</span></p>\r\n', NULL, '', 1, '', '', '1400805949', 'Mauri Niemi', '2005-01-04 10:28:53', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104102853', 'admin', '20050104102853');
INSERT INTO `care_news_article` VALUES (3, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<p class="MsoNormal"><!--[if !supportEmptyParas]-->We have started to customize Care2x to East-African\r\nhospitals. The work was started last year in Tanzania in ELCT (Evangelical\r\nLutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital\r\nfrom Kenya joined to the project in November.<!--[endif]--><o:p /><br />The first step was to install the original Care2x to Selian\r\ntown clinic in June to see how well it would fit to our needs. The work was\r\ndone by local IT-company Arusha Node Marie, which also trained the staff to use\r\nthe program. In September Merotech IT-engineers from Germany made requirement\r\nanalysis with us and the programming was started in December. When Kijabe\r\njoined to the project they brought three more IT-engineers to our project.<!--[endif]--><o:p /><br />We are making major changes in pharmacy, laboratory and\r\nbilling module and later this year build inventory/stock module. Also we are\r\nwaiting decision from PEPFAR for funding to make modules for ARV treatment\r\naccording to their requirements. But we are making small modification to most\r\nof the forms in Care2x that we are going to use.<br /> Our goal is to make one East-African version and keep the\r\nhospital specific modifications as simple as possible and we hope that more\r\nhospitals from this area would join in. This is the way to create strong base\r\nand make the program sustainable.<br />Mauri Niemi, MD<br />Information Officer<span style="font-size: 12pt; font-family: "Times New Roman";">, ELCT</span></p>\r\n', NULL, '', 1, '', '', '238111070', 'Mauri Niemi', '2005-01-04 10:31:02', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104103102', 'admin', '20050104103102');
INSERT INTO `care_news_article` VALUES (4, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '<font><font size="2" face="arial,verdana,helvetica,sans serif" color="#000033">We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical<br />\r\nLutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital from Kenya joined to the project in November.<!--[endif]--><o:p><br />The first step was to install the original Care2x to Selian<br />\r\ntown clinic in June to see how well it would fit to our needs. The work\r\nwas done by local IT-company Arusha Node Marie, which also trained the\r\nstaff to use the program. In September Merotech IT-engineers from\r\nGermany made requirement analysis with us and the programming was\r\nstarted in December. When Kijabe<br />\r\njoined to the project they brought three more IT-engineers to our project.<!--[endif]--><o:p><br />We are making major changes in pharmacy, laboratory and<br />\r\nbilling module and later this year build inventory/stock module. Also\r\nwe are waiting decision from PEPFAR for funding to make modules for ARV\r\ntreatment according to their requirements. But we are making small\r\nmodification to most of the for</o:p>ms in Care2x that we are going to use.<br /> Our goal is to make one East-African version and keep the<br />\r\nhospital specific modifications as simple as possible and we hope that\r\nmore hospitals from this area would join in. This is the way to create\r\nstrong base and make the program sustainable.<br />\r\n<br />Mauri Niemi, MD<br />Infor</o:p>mation Officer<span ;="" roman="" new="" times="" style="font-size: 12pt;">, ELCT</span></font></font>\r\n', NULL, '', 1, '', '', '1516283183', 'Mauri Niemi', '2005-01-04 10:51:32', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104105132', 'admin', '20050104105132');
INSERT INTO `care_news_article` VALUES (5, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '<font><font size="2" face="arial,verdana,helvetica,sans serif" color="#000033">We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical Lutheran Church of Tanzania), which has 20 hospitals. Kijabem ission hospital from Kenya joined to the project in November. <br /><br /><o:p>The first step was to install the original Care2x to Selian town clinic in June to see how well it would fit to our needs. The work\r\nwas done by local IT-company Arusha Node Marie, which also trained the\r\nstaff to use the program. In September Merotech IT-engineers from\r\nGermany made requirement analysis with us and the programming was\r\nstarted in December. When Kijabe joined to the project they brought three more IT-engineers to our project.<br /><!--[endif]--><o:p><br />We are making major changes in pharmacy, laboratory and<br />\r\nbilling module and later this year build inventory/stock module. Also\r\nwe are waiting decision from PEPFAR for funding to make modules for ARV\r\ntreatment according to their requirements. But we are making small\r\nmodification to most of the for</o:p>ms in Care2x that we are going to use.<br /><br /> Our goal is to make one East-African version and keep the<br />\r\nhospital specific modifications as simple as possible and we hope that\r\nmore hospitals from this area would join in. This is the way to create\r\nstrong base and make the program sustainable.<br />\r\n<br />Mauri Niemi, MD<br />Infor</o:p>mation Officer<span ;="" roman="" new="" times="" style="font-size: 12pt;">, ELCT</span></font></font>\r\n', NULL, '', 1, '', '', '1026515123', 'Mauri Niemi', '2005-01-04 10:53:59', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104105359', 'admin', '20050104105359');
INSERT INTO `care_news_article` VALUES (6, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '<font><font size="2" face="arial,verdana,helvetica,sans serif" color="#000033">We\r\nhave started to customize Care2x to East-African hospitals. The work\r\nwas started last year in Tanzania in ELCT (Evangelical Lutheran Church\r\nof Tanzania), which has 20 hospitals. Kijabe mission hospital from\r\nKenya joined to the project in November. <br />\r\n<br />\r\n<o:p>The first step was to install the original Care2x to Selian town\r\nclinic in June to see how well it would fit to our needs. The work was done by local IT-company Arusha Node Marie, which also trained the staff to use the program. In September Merotech IT-engineers from Germany made requirement analysis with us and the programming was started in December. When Kijabe joined to the project they brought\r\nthree more IT-engineers to our project.<br />\r\n<!--[endif]--><o:p><br />We are making major changes in pharmacy, laboratory and billing module and later this year build inventory/stock module. Also\r\nwe are waiting decision from PEPFAR for funding to make modules for ARV treatment according to their requirements. But we are making small modification to most of the for</o:p>ms in Care2x that we are going to use.<br />\r\n<br /> Our goal is to make one East-African version and keep the hospital specific modifications as simple as possible and we hope that\r\nmore hospitals from this area would join in. This is the way to create strong base and make the program sustainable.<br />\r\n<br />Mauri Niemi, MD<br />Infor</o:p>mation Officer<span ;="" roman="" new="" times="" style="font-size: 12pt;">, ELCT</span></font></font>\r\n', NULL, '', 1, '', '', '1165110445', 'Mauri Niemi', '2005-01-04 10:56:50', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104105650', 'admin', '20050104105650');
INSERT INTO `care_news_article` VALUES (7, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', 'We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical Lutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital from Kenya joined to the project in November.<br /><br />The first step was to install the original Care2x to Selian town clinic in June to see how well it would fit to our needs. The work was done by local IT-company Arusha Node Marie, which also trained the staff to use the program. In September Merotech IT-engineers from Germany made requirement analysis with us and the programming was started in December. When Kijabe joined to the project they brought three more IT-engineers to our project.<br /><br />We are making major changes in pharmacy, laboratory and billing module and later this year build inventory/stock module. Also we are waiting decision from PEPFAR for funding to make modules for ARV treatment according to their requirements. But we are making small modification to most of the forms in Care2x that we are going to use.<br /><br />Our goal is to make one East-African version and keep the hospital specific modifications as simple as possible and we hope that more hospitals from this area would join in. This is the way to create strong base and make the program sustainable.<br /><br />Mauri Niemi, MD<br />Information Officer, ELCT\r\n', NULL, '', 1, '', '', '2138317197', 'Mauri Niemi', '2005-01-04 11:01:52', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104110152', 'admin', '20050104110152');
INSERT INTO `care_news_article` VALUES (8, 'en', 1, '1', 'pending', 'Care2x in East-Africa', 'We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical Lutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital from Kenya joined to the project in November.\r\n', '<p>The first step was to install the original Care2x to Selian town clinic in June to see how well it would fit to our needs. The work was done by local IT-company Arusha Node Marie, which also trained the staff to use the program. In September Merotech IT-engineers from Germany made requirement analysis with us and the programming was started in December. When Kijabe joined to the project they brought three more IT-engineers to our project.</p><p><br />We are making major changes in pharmacy, laboratory and billing module and later this year build inventory/stock module. Also we are waiting decision from PEPFAR for funding to make modules for ARV treatment according to their requirements. But we are making small modification to most of the forms in Care2x that we are going to use.</p><p><br />Our goal is to make one East-African version and keep the hospital specific modifications as simple as possible and we hope that more hospitals from this area would join in. This is the way to create strong base and make the program sustainable.</p><p><br />Mauri Niemi, MD</p><p>Information Officer, ELCT</p>\r\n', NULL, '', 1, '', '', '250980175', 'Mauri Niemi', '2005-01-04 11:06:54', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104110654', 'admin', '20050104110654');
INSERT INTO `care_news_article` VALUES (9, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', 'We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical Lutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital from Kenya joined to the project in November.<br /><br />The first step was to install the original Care2x to Selian town clinic in June to see how well it would fit to our needs. The work was done by local IT-company Arusha Node Marie, which also trained the staff to use the program. In September Merotech IT-engineers from Germany made requirement analysis with us and the programming was started in December. When Kijabe joined to the project they brought three more IT-engineers to our project.<br /><br />We are making major changes in pharmacy, laboratory and billing module and later this year build inventory/stock module. Also we are waiting decision from PEPFAR for funding to make modules for ARV treatment according to their requirements. But we are making small modification to most of the forms in Care2x that we are going to use.<br /><br />Our goal is to make one East-African version and keep the hospital specific modifications as simple as possible and we hope that more hospitals from this area would join in. This is the way to create strong base and make the program sustainable.<br /><br />Mauri Niemi, MD<br />Information Officer, ELCT', NULL, '', 1, '', '', '1535686000', 'Mauri Niemi', '2005-01-04 11:09:10', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104110910', 'admin', '20050104110910');
INSERT INTO `care_news_article` VALUES (10, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '<h3>We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical Lutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital from Kenya joined to the project in November.</h3><br />The first step was to install the original Care2x to Selian town clinic in June to see how well it would fit to our needs. The work was done by local IT-company Arusha Node Marie, which also trained the staff to use the program. In September Merotech IT-engineers from Germany made requirement analysis with us and the programming was started in December. When Kijabe joined to the project they brought three more IT-engineers to our project.<br /><br />We are making major changes in pharmacy, laboratory and billing module and later this year build inventory/stock module. Also we are waiting decision from PEPFAR for funding to make modules for ARV treatment according to their requirements. But we are making small modification to most of the forms in Care2x that we are going to use.<br /><br />Our goal is to make one East-African version and keep the hospital specific modifications as simple as possible and we hope that more hospitals from this area would join in. This is the way to create strong base and make the program sustainable.<br /><br />Mauri Niemi, MD<br />Information Officer, ELCT\r\n', NULL, '', 1, '', '', '1453474157', 'Mauri Niemi', '2005-01-04 11:11:02', '0000-00-00 00:00:00', '2005-01-04', 'admin', '20050104111102', 'admin', '20050104111102');
INSERT INTO `care_news_article` VALUES (11, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', '<br />We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br />The following presentation are available <a href="http://health.elct.org/care2x/arusha%20meeting">online in this folder </a>where you can find also the minutes of the meeting, where all the participants are also listed:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “The MTRH experience in ICT Implementation”<br />Dr. Mark Bura from The Commonwealth Regional Health Community:“Cost Allocation at the Unit Level”.<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ Integrated Health Information for Education and Research”<br />Robert Meggle from Merotech: “How CVS works”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '1873792114', 'Mauri Niemi', '2005-01-07 12:02:01', '0000-00-00 00:00:00', '2005-01-07', 'admin', '20050107120201', 'admin', '20050107120201');
INSERT INTO `care_news_article` VALUES (12, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><a href="http://health.elct.org/care2x/arusha%20meeting/minutes20041210.doc">The minutes of the meeting</a> with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/The%20MTRH%20experience%20in%20ICT%20Implementation.ppt">The MTRH experience in ICT Implementation</a>”<br />Dr. Mark Bura from The Commonwealth Regional Health Community:“Cost Allocation at the Unit Level”.<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/Integrated%20Health%20Information%20for%20Education%20and%20Research.ppt">Integrated Health Information for Education and Research</a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/arusha%20meeting/How%20CVS%20works.ppt">How CVS works</a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '250430254', 'Mauri Niemi', '2005-01-07 12:25:37', '0000-00-00 00:00:00', '2005-01-07', 'admin', '20050107122537', 'admin', '20050107122537');
INSERT INTO `care_news_article` VALUES (13, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><a href="http://health.elct.org/care2x/arusha%20meeting/minutes.doc">The minutes of the meeting</a> with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/kirui.ppt">The MTRH experience in ICT Implementation</a>”<br />Dr. Mark Bura from The Commonwealth Regional Health Community:“Cost Allocation at the Unit Level”.<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/dahlman.ppt">Integrated Health Information for Education and Research</a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/arusha%20meeting/cvs.ppt">How CVS works</a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '553173484', 'Mauri Niemi', '2005-01-07 12:43:22', '0000-00-00 00:00:00', '2005-01-07', 'admin', '20050107124322', 'admin', '20050107124322');
INSERT INTO `care_news_article` VALUES (14, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '<h3>We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical Lutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital from Kenya joined to the project in November.</h3><br />The first step was to install the original Care2x to Selian town clinic in June to see how well it would fit to our needs. The work was done by local IT-company Arusha Node Marie, which also trained the staff to use the program. In September Merotech IT-engineers from Germany made requirement analysis with us and the programming was started in December. When Kijabe joined to the project they brought three more IT-engineers to our project.<br /><br /><p>We are making major changes in pharmacy, laboratory and billing module and later this year build inventory/stock module. Also we are waiting decision from PEPFAR for funding to make modules for ARV treatment according to their requirements. But we are making small modification to most of the forms in Care2x that we are going to use. <a href="http://health.elct.org/care2x/tasks/references.html"><span style="text-decoration: underline; font-style: italic;">See here the list of planned tasks,</span></a> includint our laboratory tests and drug and supplies list.</p><br />Our goal is to make one East-African version and keep the hospital specific modifications as simple as possible and we hope that more hospitals from this area would join in. This is the way to create strong base and make the program sustainable.<br /><br />Mauri Niemi, MD<br />Information Officer, ELCT\r\n', NULL, '', 1, '', '', '444798593', 'Mauri Niemi', '2005-01-10 08:15:42', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110081542', 'admin', '20050110081542');
INSERT INTO `care_news_article` VALUES (15, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><span style="font-style: italic; text-decoration: underline;"><a href="http://health.elct.org/care2x/arusha%20meeting/minutes.doc">The minutes of the meeting</a> </span>with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/kirui.ppt"><span style="font-style: italic; text-decoration: underline;">The MTRH experience in ICT Implementation</span></a>”<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/dahlman.ppt"><span style="font-style: italic; text-decoration: underline;">Integrated Health Information for Education and Research</span></a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/modules/news/http//health.elct.org/care2x/arusha%20meeting/cvs.ppt"><span style="font-style: italic; text-decoration: underline;">How CVS works</span></a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '1319843835', 'Mauri Niemi', '2005-01-10 08:24:45', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110082445', 'admin', '20050110082445');
INSERT INTO `care_news_article` VALUES (16, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><a href="http://health.elct.org/care2x/arusha%20meeting/minutes.doc"><span style="font-style: italic; text-decoration: underline;">The minutes of the meeting</span></a> with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/kirui.ppt"><span style="font-style: italic; text-decoration: underline;">The MTRH experience in ICT Implementation</span></a>”<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/dahlman.ppt"><span style="font-style: italic; text-decoration: underline;">Integrated Health Information for Education and Research</span></a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/arusha%20meeting/cvs.ppt"><span style="font-style: italic; text-decoration: underline;">How CVS works</span></a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 1, '', '', '693347227', 'Mauri Niemi', '2005-01-10 08:29:07', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110082907', 'admin', '20050110082907');
INSERT INTO `care_news_article` VALUES (17, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><a href="http://health.elct.org/care2x/arusha%20meeting/minutes.doc"><span style="font-style: italic; text-decoration: underline;">The minutes of the meeting</span></a> with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/kirui.ppt"><span style="font-style: italic; text-decoration: underline;">The MTRH experience in ICT Implementation</span></a>”<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/dahlman.ppt"><span style="font-style: italic; text-decoration: underline;">Integrated Health Information for Education and Research</span></a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/arusha%20meeting/cvs.ppt"><span style="font-style: italic; text-decoration: underline;">How CVS works</span></a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '1352646218', 'Mauri Niemi', '2005-01-10 08:32:29', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110083229', 'admin', '20050110083229');
INSERT INTO `care_news_article` VALUES (18, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '<h3>We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical Lutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital from Kenya joined to the project in November.</h3><br />The first step was to install the original Care2x to Selian town clinic in June to see how well it would fit to our needs. The work was done by local IT-company Arusha Node Marie, which also trained the staff to use the program. In September Merotech IT-engineers from Germany made requirement analysis with us and the programming was started in December. When Kijabe joined to the project they brought three more IT-engineers to our project.<br /><br />We are making major changes in pharmacy, laboratory and billing module and later this year build inventory/stock module. Also we are waiting decision from PEPFAR for funding to make modules for ARV treatment according to their requirements. But we are making small modification to most of the forms in Care2x that we are going to use. <a href="http://health.elct.org/care2x/tasks/references.html"><span style="font-style: italic; text-decoration: underline;">See here the list of planned tasks</span></a>, including our laboratory tests and drug and supplies list.<br /><br />Our goal is to make one East-African version and keep the hospital specific modifications as simple as possible and we hope that more hospitals from this area would join in. This is the way to create strong base and make the program sustainable.<br /><br />Mauri Niemi, MD<br />Information Officer, ELCT\r\n', NULL, '', 1, '', '', '2074014686', 'Mauri Niemi', '2005-01-10 08:35:55', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110083555', 'admin', '20050110083555');
INSERT INTO `care_news_article` VALUES (19, 'en', 1, '1', 'pending', 'Testing this East African version', '', '<h4>If you want to test use demo for username and password</h4>\r\n', NULL, '', 3, '', '', '206005667', 'Mauri Niemi', '2005-02-04 06:49:55', '0000-00-00 00:00:00', '2005-02-04', 'demo', '20050204064955', 'demo', '20050204064955');
INSERT INTO `care_news_article` VALUES (20, 'en', 1, '1', 'pending', 'For test use demo as username and password', '', '<br />\r\n', NULL, '', 3, '', '', '441646900', 'Mauri Niemi', '2005-02-04 06:51:22', '0000-00-00 00:00:00', '2005-02-04', 'demo', '20050204065122', 'demo', '20050204065122');
INSERT INTO `care_news_article` VALUES (21, 'en', 1, '1', 'pending', 'Care2x  presented in national ICT meeting', '', 'National meeting on ICT in health sector was held in Mwanza 1-4-2.2005. One central topic was management of information systems in health sector. Care 2x was demonstrated there. Partipanct aggreed that open source and free software is the future in Tanzania.<br /><br />Among participants were representatives from big hospitals like KCMC, Bugando, Kariuki and Muhimbili. Project team was formed to find a common way to go ahead.<br />\r\n', NULL, '', 3, '', '', '373530852', 'Mauri Niemi', '2005-02-04 16:09:02', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050204160902', 'admin', '20050204160902');
INSERT INTO `care_news_article` VALUES (22, 'en', 1, '1', 'pending', 'Care2x was demonstrated in a national ICT meeting', '', '<font size="2" face="arial,verdana,helvetica,sans serif" color="#000033">National\r\nmeeting on ICT in health sector was held in Mwanza 1-4-2.2005. One\r\ncentral topic was management of information systems in health sector.\r\nCare 2x was demonstrated there. Partipanct aggreed that open source and\r\nfree software is the future in Tanzania.<br /><br />Among participants were\r\nrepresentatives from big hospitals like KCMC, Bugando, Kariuki and\r\nMuhimbili. Project team was formed to join scarce forces to work on common goal..<br /></font>\r\n', NULL, '', 3, '', '', '1147889048', 'Mauri Niemi', '2005-02-05 08:10:52', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205081052', 'admin', '20050205081052');
INSERT INTO `care_news_article` VALUES (23, 'en', 1, '1', 'pending', 'Care2x was demonstrated in a national ICT meeting', '', '<font size="2" face="arial,verdana,helvetica,sans serif" color="#000033">National\r\nmeeting on ICT in health sector was held in Mwanza 1-4-2.2005. One\r\ncentral topic was management of information systems in health sector.\r\nCare 2x was demonstrated there. Partipanct aggreed that open source and\r\nfree software is the future in Tanzania.<br /><br />Among participants were\r\nrepresentatives from big hospitals like KCMC, Bugando, Kariuki and\r\nMuhimbili. Project team was formed to join forces to work on a common goal.<br /></font>\r\n', NULL, '', 3, '', '', '61208290', 'Mauri Niemi', '2005-02-05 08:12:24', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205081224', 'admin', '20050205081224');
INSERT INTO `care_news_article` VALUES (24, 'en', 1, '1', 'pending', 'Care2x was discussed in a national ICT meeting', '', 'National meeting on ICT in health sector was held in Mwanza 1-4-2.2005. One central topic was management of information systems in health sector. Care 2x was demonstrated there. Partipanct aggreed that open source and free software is the future in Tanzania.<br /><br />Among participants were representatives from big hospitals like KCMC, Bugando, Kariuki and Muhimbili. Project team was formed to join forces to work on a common goal.\r\n', NULL, '', 3, '', '', '621744209', 'Mauri Niemi', '2005-02-05 08:13:42', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205081342', 'admin', '20050205081342');
INSERT INTO `care_news_article` VALUES (25, 'en', 1, '1', 'pending', 'Care2x demonstrated in a national ICT meeting', '', 'National meeting on ICT in health sector was held in Mwanza 1-4-2.2005. One central topic was management of information systems in health sector. Care 2x was demonstrated there. Partipants aggreed that open source and free software is the future in Tanzania.<br /><br />Among participants were representatives from big hospitals like KCMC, Bugando, Kariuki and Muhimbili. Project team was formed to join forces to work on a common goal.\r\n', NULL, '', 3, '', '', '404709206', 'Mauri Niemi', '2005-02-05 08:15:26', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205081526', 'admin', '20050205081526');
INSERT INTO `care_news_article` VALUES (26, 'en', 1, '1', 'pending', 'Care2x discussed in a national ICT meeting', '', 'National meeting on ICT in health sector was held in Mwanza 1-4-2.2005. One central topic was management of information systems in health sector. Care 2x was demonstrated there. Partipants aggreed that open source and free software is the future in Tanzania.<br /><br />Among participants were representatives from big hospitals like KCMC, Bugando, Kairuki and Muhimbili. Project team was formed to join forces to work on a common goal. \r\n', NULL, '', 3, '', '', '318652455', 'Mauri Niemi', '2005-02-05 09:37:05', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205093705', 'admin', '20050205093705');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_op_med_doc`
-- 

CREATE TABLE `care_op_med_doc` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `op_date` varchar(12) NOT NULL default '',
  `operator` tinytext NOT NULL,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `diagnosis` text NOT NULL,
  `localize` text NOT NULL,
  `therapy` text NOT NULL,
  `special` text NOT NULL,
  `class_s` tinyint(4) NOT NULL default '0',
  `class_m` tinyint(4) NOT NULL default '0',
  `class_l` tinyint(4) NOT NULL default '0',
  `op_start` varchar(8) NOT NULL default '',
  `op_end` varchar(8) NOT NULL default '',
  `scrub_nurse` varchar(70) NOT NULL default '',
  `op_room` varchar(10) NOT NULL default '',
  `status` varchar(15) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_op_med_doc`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_ops301_de`
-- 

CREATE TABLE `care_ops301_de` (
  `code` varchar(12) NOT NULL default '',
  `description` text NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL default '',
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  KEY `code` (`code`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_ops301_de`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_ops301_es`
-- 

CREATE TABLE `care_ops301_es` (
  `code` varchar(12) NOT NULL default '',
  `description` text NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL default '',
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  KEY `code` (`code`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_ops301_es`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_person`
-- 

CREATE TABLE `care_person` (
  `pid` int(11) unsigned NOT NULL auto_increment,
  `date_reg` datetime NOT NULL default '0000-00-00 00:00:00',
  `name_first` varchar(60) NOT NULL default '',
  `name_2` varchar(60) default NULL,
  `name_3` varchar(60) default NULL,
  `name_middle` varchar(60) default NULL,
  `name_last` varchar(60) NOT NULL default '',
  `name_maiden` varchar(60) default NULL,
  `name_others` text NOT NULL,
  `date_birth` date NOT NULL default '0000-00-00',
  `blood_group` char(2) NOT NULL default '',
  `rh` varchar(10) NOT NULL default '',
  `addr_str` varchar(60) NOT NULL default '',
  `addr_str_nr` varchar(10) NOT NULL default '',
  `addr_zip` varchar(15) NOT NULL default '',
  `addr_citytown_nr` mediumint(8) unsigned NOT NULL default '0',
  `addr_is_valid` tinyint(1) NOT NULL default '0',
  `citizenship` varchar(35) default NULL,
  `phone_1_code` varchar(15) default '0',
  `phone_1_nr` varchar(35) default NULL,
  `phone_2_code` varchar(15) default '0',
  `phone_2_nr` varchar(35) default NULL,
  `cellphone_1_nr` varchar(35) default NULL,
  `cellphone_2_nr` varchar(35) default NULL,
  `fax` varchar(35) default NULL,
  `email` varchar(60) default NULL,
  `civil_status` varchar(35) NOT NULL default '',
  `sex` char(1) NOT NULL default '',
  `title` varchar(25) default NULL,
  `photo` blob,
  `photo_filename` varchar(60) NOT NULL default '',
  `ethnic_orig` mediumint(8) unsigned default NULL,
  `org_id` varchar(60) default NULL,
  `sss_nr` varchar(60) default NULL,
  `nat_id_nr` varchar(60) default NULL,
  `religion` varchar(125) default NULL,
  `mother_pid` int(11) unsigned NOT NULL default '0',
  `father_pid` int(11) unsigned NOT NULL default '0',
  `contact_person` varchar(255) default NULL,
  `contact_pid` int(11) unsigned NOT NULL default '0',
  `contact_relation` varchar(25) default '0',
  `death_date` date NOT NULL default '0000-00-00',
  `death_encounter_nr` int(10) unsigned NOT NULL default '0',
  `death_cause` varchar(255) default NULL,
  `death_cause_code` varchar(15) default NULL,
  `date_update` datetime default NULL,
  `status` varchar(20) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  `addr_citytown_name` varchar(35) NOT NULL default '',
  `insurance_silver` tinyint(4) NOT NULL default '0',
  `insurance_gold` tinyint(4) NOT NULL default '0',
  `insurance_friedkin` tinyint(4) NOT NULL default '0',
  `insurance_selian_stuff` tinyint(4) NOT NULL default '0',
  `insurance_premium_for_adults` int(11) NOT NULL default '0',
  `insurance_premium_for_childs` int(11) NOT NULL default '0',
  `insurance_premium_for_senior` int(11) NOT NULL default '0',
  `insurance_copayment_OPD` int(11) NOT NULL default '0',
  `insurance_copayment_IPD` int(11) NOT NULL default '0',
  `insurance_ceiling_by_individual` tinyint(4) NOT NULL default '0',
  `insurance_ceiling_by_family` tinyint(4) NOT NULL default '0',
  `insurance_ceiling_amount` int(11) NOT NULL default '0',
  `insurance_ceiling_for_families` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pid`),
  KEY `name_last` (`name_last`),
  KEY `name_first` (`name_first`),
  KEY `date_reg` (`date_reg`),
  KEY `date_birth` (`date_birth`)
) TYPE=MyISAM AUTO_INCREMENT=20000005 ;

-- 
-- Daten für Tabelle `care_person`
-- 

INSERT INTO `care_person` VALUES (10000000, '2005-02-10 13:49:10', 'sd', 'sd', 'sd', NULL, 'sd', NULL, '', '2004-07-01', '', '', '', '', '12', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-10 13:49:10 admin\n\nView 2005-02-21 16:25:11 = admin\nView 2005-02-21 16:29:24 = admin\nView 2005-02-24 16:59:57 = admin\nView 2005-02-28 13:10:56 = admin\nView 2005-02-28 17:18:00 = admin\nView 2005-02-28 17:20:03 = admin\nView 2005-03-02 15:25:45 = admin\nView 2005-03-02 15:26:00 = admin\nView 2005-03-02 15:33:12 = admin\nView 2005-03-02 15:33:18 = admin\nView 2005-03-02 15:33:27 = admin\nView 2005-03-02 16:45:50 = admin\nView 2005-03-02 16:47:56 = admin\nView 2005-05-24 15:45:37 = admin\nView 2005-05-24 15:45:38 = admin\nView 2005-05-24 15:46:11 = admin\nView 2005-05-24 15:46:12 = admin\nView 2005-05-24 15:47:22 = admin\nView 2005-05-24 15:47:22 = admin\nView 2005-05-24 15:48:04 = admin\nView 2005-05-24 15:48:04 = admin\nView 2005-05-24 15:48:08 = admin\nView 2005-05-24 15:48:09 = admin\nView 2005-05-24 17:51:24 = admin\nView 2005-05-24 17:51:25 = admin', '', '20050524175125', 'admin', '20050210134910', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000001, '2005-02-10 14:01:20', 'sds', 'sdss', 'sds', NULL, 'sds', NULL, '', '2004-07-01', '', '', '', '', '12', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'sds', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-10 14:01:20 admin\n\nView 2005-02-28 17:18:43 = admin\nView 2005-05-24 15:41:52 = admin\nView 2005-05-24 15:41:52 = admin\nView 2005-05-24 15:42:03 = admin\nView 2005-05-24 15:42:04 = admin', '', '20050524154204', 'admin', '20050210140120', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000002, '2005-02-10 14:01:38', 'sdd', 'ddd', 'dd', NULL, 'sdd', NULL, '', '2004-07-01', '', '', '', '', '12', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'sdd', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-10 14:01:38 admin\n\nView 2005-03-02 16:49:22 = admin\nView 2005-03-02 16:49:23 = admin', '', '20050302164923', 'admin', '20050210140138', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000003, '2005-02-10 14:05:55', 'dddd', 'dddddd', 'dddd', NULL, 'dddd', NULL, '', '2004-07-01', '', '', '', '', '12', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-10 14:05:55 admin\n', '', '20050210140555', 'admin', '20050210140555', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000004, '2005-02-10 14:09:14', 'asasa', 'sasas', 'asasa', '', 'aaasasa', 'MBULU', '', '2004-07-01', 'B', 'pos', '', '', '12', 0, 0, '', '0', '', '0', '', '', '', '', '', '', 'm', '', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-21 13:54:17', 'normal', 'Init.reg. 2005-02-10 14:09:14 admin\n\nView 2005-02-18 15:20:03 = admin\nView 2005-02-18 15:22:41 = admin\nView 2005-02-18 15:24:07 = admin\nView 2005-02-18 15:24:32 = admin\nView 2005-02-18 15:45:16 = admin\nView 2005-02-18 15:46:04 = admin\nView 2005-02-18 15:47:45 = admin\nView 2005-02-21 13:47:27 = adminUpdate 2005-02-21 13:47:49 admin \nUpdate 2005-02-21 13:48:05 admin \nUpdate 2005-02-21 13:54:17 admin \n\nView 2005-02-28 17:25:09 = admin\nView 2005-03-02 16:48:10 = admin\nView 2005-05-24 15:42:25 = admin\nView 2005-05-24 15:42:26 = admin\nView 2005-05-24 15:48:16 = admin\nView 2005-05-24 15:48:16 = admin', 'admin', '20050524154816', 'admin', '20050210140914', 'SONGEA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000005, '2005-02-17 16:47:13', 'sdvsdf', 'sdfsdf', 'adsvcsdf', 'asdvsdf', 'adsfsdf', 'AMERICAN', 'svsdv', '2003-07-01', '', '', '', '', '2333', 0, 0, '', '0', '', '0', '', '', '', '', '', '', 'm', 'ewfrwe', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-03-02 16:13:00', 'normal', 'Init.reg. 2005-02-17 16:47:13 admin\n\nView 2005-02-21 16:24:14 = admin\nView 2005-03-02 16:12:33 = adminUpdate 2005-03-02 16:13:00 admin \n\nView 2005-03-02 16:46:02 = admin', 'admin', '20050302164602', 'admin', '20050217164713', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000006, '2005-02-17 16:49:53', 'ömömö', 'ölmömöm', 'ömökmökmö', 'ökmökm', 'rhdöhfö', 'ökmökm', '', '2004-07-01', '', '', '', '', '3333', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'test', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-17 16:49:53 admin\n\nView 2005-05-24 15:42:47 = admin\nView 2005-05-24 15:42:48 = admin', '', '20050524154248', 'admin', '20050217164953', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000007, '2005-02-17 16:50:25', 'köfökdfgök', 'mökm', 'ökm', 'ökmökm', 'ödfdfgm', 'ökm', 'ökmökm', '2004-07-01', '', '', '', '', '3333', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'fgdfgdfg', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-17 16:50:25 admin\n', '', '20050217165025', 'admin', '20050217165025', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000008, '2005-02-17 16:53:15', 'kmlkdsfsmldkfmglk', 'lkwmdlfkgdlfkn', 'lknldkfknldkfnl', 'knlskdfnldksfkgn', 'lkdsmsfgdkfsmgl', 'AMERICAN', 'lkndlkffndlfkn', '2004-07-01', '', '', '', '', '2333', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'dfgdfg', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-17 16:53:15 admin\n', '', '20050217165315', 'admin', '20050217165315', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000009, '2005-02-17 17:04:52', 'kjbkjbkjb', 'kjbkjb', 'kjbkj', 'bkjb', 'jnkbkb', 'AMERICAN', 'kkbkjb', '2004-07-01', '', '', '', '', '3333', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'sdfsdfsdf', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-17 17:04:52 admin\n\nView 2005-02-18 14:39:28 = admin\nView 2005-02-18 14:41:06 = admin\nView 2005-02-24 17:00:25 = admin', '', '20050224170025', 'admin', '20050217170452', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000010, '2005-02-17 17:38:11', 'kjbkjb', 'kjb', 'kjb', 'kjb', 'jkjkkb', 'AMERICAN', '', '2003-07-01', '', '', '', '', '22222', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'sdfsdfsd', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-17 17:38:11 admin\n', '', '20050217173811', 'admin', '20050217173811', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000011, '2005-02-18 13:26:32', 'lkjlkjlkj', 'lkjlkj', 'lkjlkjlkj', 'lkjlkj', 'ljlkjlkj', 'AMERICAN', 'kkljlkj', '2003-07-01', '', '', '', '', '2222', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'dfgdfgkj', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-18 13:26:32 admin\n', '', '20050218132633', 'admin', '20050218132632', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000012, '2005-02-18 13:27:29', 'kjhkkj', 'kjhkjh', 'kjh', 'kjh', 'dfsdfsjkhKJK', 'AMERICAN', 'kjh', '2003-07-01', '', '', '', '', '2222', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-18 13:27:29 admin\n\nView 2005-02-18 13:35:10 = admin', '', '20050218133510', 'admin', '20050218132729', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000013, '2005-02-18 14:17:47', 'kjvkjvkjv', 'kjvkjv', 'kjvkjv', 'kjvkjv', 'kjkjjk', 'AMERICAN', 'kjvkjv', '2003-07-01', '', '', '', '', '22222', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'adsdfsdf', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-18 14:17:47 admin\n\nView 2005-05-24 15:48:27 = admin\nView 2005-05-24 15:48:28 = admin', '', '20050524154828', 'admin', '20050218141747', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000014, '2005-02-18 15:01:09', 'kjnkjnkjn', 'kjnkjnkjn', 'kjnknkjnkj', 'kjnkjnkj', 'jkjnkjn', 'AMERICAN', 'kjnkjnkjn', '2003-07-01', '', '', '', '', '2222', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'dfvdfgk', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-18 15:01:09 admin\n\nView 2005-02-18 15:16:01 = admin\nView 2005-05-24 17:52:54 = admin\nView 2005-05-24 17:52:55 = admin', '', '20050524175255', 'admin', '20050218150109', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000015, '2005-02-18 16:45:25', 'lkmlkmlk', 'mlkmlkm', 'lkmlkm', 'lkmlk', 'lkmlkmlkm', 'AMERICAN', 'klmlkmlkm', '2003-07-01', '', '', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'fgbvklmlkm', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-18 16:45:25 admin\n', '', '20050218164525', 'admin', '20050218164525', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000016, '2005-02-18 16:46:23', 'ölönön', 'öknökn', 'önkökn', 'öknökn', 'lö,ö,öl,', 'AMERICAN', 'öknökn', '0000-00-00', '', '', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'dfgdglö', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-18 16:46:23 admin\n', '', '20050218164623', 'admin', '20050218164623', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000017, '2005-02-18 17:01:59', 'adfsdfsdf', NULL, NULL, NULL, 'sdfsdf', NULL, '', '2003-07-01', '', '', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-18 17:01:59 admin\n', '', '20050218170159', 'admin', '20050218170159', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000018, '2005-02-21 11:34:24', 'lklknlk', 'nlknlk', 'nlknlkn', 'lknl', 'sfsdfjkn', 'AMERICAN', 'nl', '2003-07-01', 'O', 'neg', '', '', '', 0, 0, '', '0', '', '0', '', 'xx', '', '', '', '', 'm', '', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-21 11:58:01', 'normal', 'Init.reg. 2005-02-21 11:34:24 admin\nUpdate 2005-02-21 11:34:43 admin \nUpdate 2005-02-21 11:35:54 admin \nUpdate 2005-02-21 11:48:19 admin \nUpdate 2005-02-21 11:49:05 admin \nUpdate 2005-02-21 11:49:19 admin \nUpdate 2005-02-21 11:51:58 admin \nUpdate 2005-02-21 11:53:24 admin \nUpdate 2005-02-21 11:55:38 admin \nUpdate 2005-02-21 11:56:55 admin \nUpdate 2005-02-21 11:58:01 admin \n', 'admin', '20050221115801', 'admin', '20050221113424', 'arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000019, '2005-02-21 12:06:13', ' lk slksdlkflknlkn', 'lknlknlknl', 'knlkn', 'lknlknlknlknlkn', ' mlkm flds lk', 'AMERICAN', 'lknlknlkn', '2003-07-01', 'A', 'neg', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', 'single', 'm', 'sadasd', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-21 12:25:10', 'normal', 'Init.reg. 2005-02-21 12:06:13 admin\nUpdate 2005-02-21 12:06:31 admin \nUpdate 2005-02-21 12:08:42 admin \nUpdate 2005-02-21 12:08:50 admin \nUpdate 2005-02-21 12:09:04 admin \nUpdate 2005-02-21 12:10:10 admin \nUpdate 2005-02-21 12:10:20 admin \nUpdate 2005-02-21 12:10:43 admin \nUpdate 2005-02-21 12:11:15 admin \nUpdate 2005-02-21 12:11:29 admin \nUpdate 2005-02-21 12:13:15 admin \nUpdate 2005-02-21 12:20:08 admin \nUpdate 2005-02-21 12:24:59 admin \nUpdate 2005-02-21 12:25:10 admin \n', 'admin', '20050221122510', 'admin', '20050221120613', 'SONGEA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000020, '2005-02-21 17:19:30', 'aaaabc', 'fdlkdsmflkm', 'lkmlkmlk', 'blsdfldsn', 'aaaabc', 'AMERICAN', 'dsfsdf', '2003-07-01', '', '', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'aaaabc', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-21 17:19:30 admin\n', '', '20050221171930', 'admin', '20050221171930', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000021, '2005-02-21 17:20:36', 'aaaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaaaaa', 'kmsflfkmglkm', 'aaaaaaaaaaaa', 'AMERICAN', 'mlkmlkmlkm', '2002-07-01', '', '', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'f', 'aaaaaaaa', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-21 17:20:36 admin\n\nView 2005-05-24 14:58:38 = admin\nView 2005-05-24 14:58:39 = admin\nView 2005-05-24 15:01:15 = admin\nView 2005-05-24 15:01:16 = admin', '', '20050524150116', 'admin', '20050221172036', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000022, '2005-02-24 12:16:03', 'kmlkmlkmlk', 'lkmlkmlkm', 'lkmlkmlkm', 'lkmlkmlkmlk', 'sdmflsdkm', 'GERMAN', 'kmlkmlkm', '2020-07-20', 'A', 'pos', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', 'single', 'm', 'sdfsdf', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-24 12:41:02', 'normal', 'Init.reg. 2005-02-24 12:16:03 admin\nUpdate 2005-02-24 12:16:43 admin \nUpdate 2005-02-24 12:24:26 admin \nUpdate 2005-02-24 12:34:39 admin \nUpdate 2005-02-24 12:35:03 admin \nUpdate 2005-02-24 12:35:22 admin \nUpdate 2005-02-24 12:40:37 admin \nUpdate 2005-02-24 12:41:02 admin \n', 'admin', '20050224124102', 'admin', '20050224121603', 'Kilimanjaro', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000023, '2005-02-24 13:48:25', 'tester', 'tester', 'tester', 'tester', 'tester', '', 'tester', '2003-07-01', 'O', '', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', '', 'm', 'tester', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-24 13:51:54', 'normal', 'Init.reg. 2005-02-24 13:48:25 admin\nUpdate 2005-02-24 13:51:54 admin \n', 'admin', '20050224135154', 'admin', '20050224134825', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000024, '2005-02-24 14:34:56', 'xxxxx', 'xxxxx', 'xxxxx', 'xxxxx', 'xxxxx', NULL, 'xxxxx', '2002-07-01', 'A', '', '', '', 'dgg', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-24 14:34:56 admin\n', '', '20050224143456', 'admin', '20050224143456', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000025, '2005-02-24 14:36:31', 'aaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaaaaaa', NULL, 'aaaaaaaaaa', '2000-07-01', 'A', '', '', '', '222', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'aaaaaaaaaa', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-24 14:36:31 admin\n', '', '20050224143631', 'admin', '20050224143631', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000026, '2005-02-24 14:54:17', 'aasas', 'asasa', 'asasas', 'asassa', 'asass', '', 'asasas', '1913-07-01', 'A', 'pos', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', 'single', 'm', '', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-24 15:03:30', 'normal', 'Init.reg. 2005-02-24 14:54:17 admin\nUpdate 2005-02-24 15:03:30 admin \n', 'admin', '20050224150330', 'admin', '20050224145417', 'Songea', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000027, '2005-02-24 15:04:21', 'lksdfsdf', 'sdfsdf', 'sdfsdf', 'sdfsf', 'lksdfsdf', '', 'sdfsdf', '2002-07-01', 'A', '', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', 'single', 'm', 'sadfa', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-24 15:04:31', 'normal', 'Init.reg. 2005-02-24 15:04:21 admin\nUpdate 2005-02-24 15:04:31 admin \n', 'admin', '20050224150431', 'admin', '20050224150421', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000028, '2005-02-24 15:05:27', 'sdsdfsdf', 'sdfsdf', 'sdfsdfdf', 'sdsdfsdf', 'sdfsdf', 'AMERICAN', 'sdfsdf', '2001-07-20', 'A', 'pos', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', 'single', 'm', 'dfsdfsdfn', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-24 15:05:45', 'normal', 'Init.reg. 2005-02-24 15:05:27 admin\nUpdate 2005-02-24 15:05:45 admin \n', 'admin', '20050224150545', 'admin', '20050224150527', 'Songea', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000029, '2005-02-24 15:25:18', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'MBUGUWA', 'asdasd', '2002-07-01', 'A', '', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'f', 'asdasd', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-24 15:25:18 admin\n', '', '20050224152518', 'admin', '20050224152518', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000030, '2005-02-24 15:58:15', 'jnkj', 'nkjn', 'kjn', 'kjn', 'kjnk', 'MBULU', 'kjn', '2002-07-01', 'O', 'neg', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'sadasdnk', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-24 15:58:15 admin\n', '', '20050224155815', 'admin', '20050224155815', 'Singida', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000031, '2005-02-24 15:59:51', 'd', 'dd', 'd', 'd', 'dddd', 'MBULU', '', '2002-07-01', 'O', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'dddd', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-24 15:59:51 admin\n', '', '20050224155951', 'admin', '20050224155951', 'Tabora', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000032, '2005-02-24 16:00:17', 'test', 'test', 'test', 'test', 'test', 'MBULU', 'test', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'test', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-24 16:00:17 admin\n\nView 2005-05-24 17:51:43 = admin\nView 2005-05-24 17:51:44 = admin', '', '20050524175144', 'admin', '20050224160017', 'Shinyanga', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000033, '2005-02-24 16:00:51', 'kkkk', 'kkk', 'kkk', 'kk', 'kkkkk', '', 'kk', '2001-07-20', 'A', 'pos', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', 'single', 'm', 'kkkkk', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-24 16:01:03', 'normal', 'Init.reg. 2005-02-24 16:00:51 admin\nUpdate 2005-02-24 16:01:03 admin \n', 'admin', '20050224160103', 'admin', '20050224160051', 'Singida', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000034, '2005-02-25 13:36:32', 'sdfsdf', 'sdsdf', 'sdfsdf', 'sdfsdf', 'sdfds', 'AMERICAN', 'sdfsfd', '1982-07-01', 'AB', 'pos', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', 'married', 'm', 'sdfsdf', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-25 13:45:39', 'normal', 'Init.reg. 2005-02-25 13:36:32 admin\nUpdate 2005-02-25 13:36:51 admin \nUpdate 2005-02-25 13:37:35 admin \nUpdate 2005-02-25 13:45:39 admin \n', 'admin', '20050225134539', 'admin', '20050225133632', 'Musoma', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000035, '2005-02-25 13:46:36', 'test', 'test', 'test', 'test', 'test', 'MBENA', 'test', '1982-07-01', 'AB', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'test', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-25 13:46:36 admin\n\nView 2005-05-24 15:48:43 = admin\nView 2005-05-24 15:48:43 = admin', '', '20050524154843', 'admin', '20050225134636', 'Songea', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000036, '2005-02-25 14:58:51', 'eeeeee', 'eeeeee', 'eeeeee', 'eeeeee', 'eeeeee', 'AMERICAN', 'eeeeee', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'eeeeee', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-25 14:58:51 admin\n', '', '20050225145851', 'admin', '20050225145851', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000037, '2005-02-25 17:21:25', 'KLNLKN', 'lknlknlkn', 'lknlkn', 'lknlkn', 'LKNLKN', 'AMERICAN', 'lknlkn', '1982-07-01', 'AB', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'jnlknlknLNLKNlk', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-25 17:21:25 admin\n', '', '20050225172125', 'admin', '20050225172125', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000038, '2005-02-28 15:18:23', 'aaaa', 'aaaa', 'aaaa', 'aaaa', 'aaaa', 'AMERICAN', 'aaaa', '1985-07-01', 'B', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'aaaa', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 15:18:23 admin\n', '', '20050228151823', 'admin', '20050228151823', 'Arusha', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000039, '2005-02-28 15:19:42', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'AMERICAN', 'asdasd', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'asdasd', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 15:19:42 admin\n', '', '20050228151942', 'admin', '20050228151942', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000040, '2005-02-28 15:20:44', 'asdasdads', 'asdasdad', 'asdasda', 'asdasasd', 'asdasdas', 'AMERICAN', 'asdasdas', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'asdasdas', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 15:20:44 admin ', '', '20050228153714', 'admin', '20050228152044', 'Arusha', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000041, '2005-02-28 16:00:07', 'wbc', 'wbc', 'wbc', 'wbc', 'wbc', 'AMERICAN', 'wbc', '2002-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'wbc', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 16:00:07 admin\n', '', '20050228160007', 'admin', '20050228160007', 'Arusha', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000042, '2005-02-28 16:42:02', 'derarztderarzt', 'derarztderarzt', 'derarzt', 'derarzt', 'derarzt', NULL, 'derarzt', '2000-07-01', '', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'derarzt', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 16:42:02 admin\n', '', '20050228164202', 'admin', '20050228164202', 'Arusha', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000043, '2005-02-28 16:48:46', 'sadfsadf', 'sadfsadf', 'asdfasdf', 'sdfasdf', 'sadfsadfsdf', NULL, 'sdfasdf', '2002-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'sadfsadf', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 16:48:46 admin\n', '', '20050228164846', 'admin', '20050228164846', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000044, '2005-03-02 14:13:16', 'ghjghj', 'hgjghj', 'ghjgj', 'ghjghj', 'gjghghj', 'AMERICAN', 'hjghjghjhj', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'hghjghjgj', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-03-02 14:13:16 admin\n', '', '20050302141316', 'admin', '20050302141316', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (20000000, '2005-03-02 14:33:32', 'dfgdfg', 'dfgdfg', 'dfgdfg', 'dfgdfg', 'dfgdfg', 'AMERICAN', 'dfgdfg', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'gdfgdfdg', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-03-02 14:33:32 admin\n', '', '20050302143332', 'admin', '20050302143332', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (20000001, '2005-03-02 14:37:40', 'ooooo', 'ooooo', 'ooo', 'o', 'ooooo', 'AMERICAN', 'o', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'ooooo', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-03-02 14:37:40 admin\n', '', '20050302143740', 'admin', '20050302143740', 'Arusha', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (20000002, '2005-03-02 14:38:55', 'ppppppp', 'ppppppp', 'ppp', 'pp', 'ppppppppp', 'AMERICAN', 'ppp', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', 'single', 'm', 'oppppppppppp', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-03-02 14:44:20', 'normal', 'Init.reg. 2005-03-02 14:38:55 admin\nUpdate 2005-03-02 14:39:16 admin \nUpdate 2005-03-02 14:39:24 admin \nUpdate 2005-03-02 14:40:41 admin \nUpdate 2005-03-02 14:42:27 admin \nUpdate 2005-03-02 14:43:25 admin \nUpdate 2005-03-02 14:44:20 admin \n', 'admin', '20050302144420', 'admin', '20050302143855', 'Arusha', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (20000003, '2005-03-02 14:45:02', 'moimoi', 'moi', 'moimoi', 'iomoim', 'iomoimoi', 'AMERICAN', 'moim', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'sdjfsdfsdfmim', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-03-02 14:45:02 admin\n', '', '20050302144502', 'admin', '20050302144502', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (20000004, '2005-03-02 14:46:45', 'asdasd', 'asdasd', 'asdasdasd', 'asdads', 'asdasdas', 'AMERICAN', 'asdasd', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'asdadsasd', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-03-02 14:46:45 admin\n', '', '20050302144645', 'admin', '20050302144645', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (1, '2005-03-02 14:49:23', 'sdfsdfsdf', 'sdfsdf', 'sdfsf', 'sdfsdf', 'sdfsdfsdf', 'AMERICAN', '', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'sdfsdfsd', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-03-02 14:49:23 admin\n', '', '20050302144923', 'admin', '20050302144923', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (2, '2005-03-02 14:49:53', 'lk', 'lklklk', 'lk', 'lk', 'lklklk', 'AMERICAN', 'lk', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'öölöllööllö', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-03-02 14:49:53 admin\n', '', '20050302144953', 'admin', '20050302144953', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (3, '2005-03-02 15:35:40', 'aaaaaaaaaaaaa', 'aaaaaaaaaaa', 'aaaaaaaaaaaaaa', 'aaaaaaaaaa', 'asdasdasd', 'AMERICAN', 'aaaaaaaaaaaaa', '2000-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'aaaaaaaaaaa', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-03-02 15:35:40 admin\n\nView 2005-03-02 15:46:51 = admin\nView 2005-03-02 16:10:20 = admin', '', '20050302161020', 'admin', '20050302153540', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (4, '2005-04-20 12:01:53', 'Nanni', NULL, NULL, NULL, 'Hanni', 'MAASAI', '', '2005-04-20', '', '', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'male', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-04-20 12:01:53 admin\n\nView 2005-04-20 12:02:34 = admin\nView 2005-04-20 12:02:34 = admin\nView 2005-05-24 17:52:18 = admin\nView 2005-05-24 17:52:19 = admin', '', '20050524175219', 'admin', '20050420120153', 'ARUSHA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (5, '2005-05-30 14:38:11', 'Robert', 'Ludwig', NULL, 'Claudi', 'Meggle', 'GERMAN', 'no', '1970-07-27', 'A', '', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'no occupation', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-05-30 14:38:11 admin\n', '', '20050530143811', 'admin', '20050530143811', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (6, '2005-08-13 22:17:19', 'Claudia', 'Konrad Nick', '', '', 'Meggle', 'MKWAYA', '', '1975-07-01', 'A', '', '', '', '89079', 0, 0, '', '0', '', '0', '', '', '', '', '', 'married', 'f', 'med. Assistant', NULL, '6.jpg', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-08-13 22:18:01', 'normal', 'Init.reg. 2005-08-13 22:17:19 admin\nUpdate 2005-08-13 22:18:01 admin \n\nView 2005-08-15 14:42:25 = admin\nView 2005-08-15 14:42:27 = admin\nView 2005-08-17 15:46:13 = admin\nView 2005-08-17 15:46:13 = admin\nView 2005-08-26 16:00:51 = admin\nView 2005-08-26 16:00:52 = admin', 'admin', '20050826160052', 'admin', '20050813221719', 'Shinyanga', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_person_insurance`
-- 

CREATE TABLE `care_person_insurance` (
  `item_nr` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `type` varchar(60) NOT NULL default '',
  `insurance_nr` varchar(50) NOT NULL default '0',
  `firm_id` varchar(60) NOT NULL default '',
  `class_nr` tinyint(2) unsigned NOT NULL default '0',
  `is_void` tinyint(1) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`item_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_person_insurance`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_person_other_number`
-- 

CREATE TABLE `care_person_other_number` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `pid` int(11) unsigned NOT NULL default '0',
  `other_nr` varchar(30) NOT NULL default '',
  `org` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `pid` (`pid`),
  KEY `other_nr` (`other_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_person_other_number`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_personell`
-- 

CREATE TABLE `care_personell` (
  `nr` int(11) NOT NULL auto_increment,
  `short_id` varchar(10) default NULL,
  `pid` int(11) NOT NULL default '0',
  `job_type_nr` int(11) NOT NULL default '0',
  `job_function_title` varchar(60) default NULL,
  `date_join` date default NULL,
  `date_exit` date default NULL,
  `contract_class` varchar(35) NOT NULL default '0',
  `contract_start` date default NULL,
  `contract_end` date default NULL,
  `is_discharged` tinyint(1) NOT NULL default '0',
  `pay_class` varchar(25) NOT NULL default '',
  `pay_class_sub` varchar(25) NOT NULL default '',
  `local_premium_id` varchar(5) NOT NULL default '',
  `tax_account_nr` varchar(60) NOT NULL default '',
  `ir_code` varchar(25) NOT NULL default '',
  `nr_workday` tinyint(1) NOT NULL default '0',
  `nr_weekhour` float(10,2) NOT NULL default '0.00',
  `nr_vacation_day` tinyint(2) NOT NULL default '0',
  `multiple_employer` tinyint(1) NOT NULL default '0',
  `nr_dependent` tinyint(2) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`,`pid`,`job_type_nr`),
  KEY `pid` (`pid`)
) TYPE=MyISAM AUTO_INCREMENT=100004 ;

-- 
-- Daten für Tabelle `care_personell`
-- 

INSERT INTO `care_personell` VALUES (100000, '2', 10000023, 0, 'knkjnkj', '2003-07-01', NULL, 'klkn', '2003-07-01', NULL, 0, 'aksdkjnkjn', 'kjnkjnkjn', 'kjnkn', 'kjnkjnkjn', 'kjnkjnkj', 5, 37.00, 10, 0, 3, '', 'Create: 2005-02-24 13:52:56 = admin\n', '', '20050224135256', 'admin', '20050224135256');
INSERT INTO `care_personell` VALUES (100001, 'mlvkmslkm', 10000024, 0, 'lkmlkmlkmlk', '2002-07-01', NULL, 'lsm lvlk', '2002-07-01', NULL, 0, 'klmlkmlk', 'mlkm', 'lkm', 'lk', 'mlk', 0, 0.00, 0, 0, 0, '', 'Create: 2005-02-24 14:35:24 = admin\n', '', '20050224143524', 'admin', '20050224143524');
INSERT INTO `care_personell` VALUES (100002, 'xcv', 10000025, 0, 'sfdsfd', '2002-07-01', NULL, 'sdfsdf', NULL, NULL, 0, '', '', '', '', '', 0, 0.00, 0, 0, 0, '', 'Create: 2005-02-24 14:36:55 = admin\n', '', '20050224143655', 'admin', '20050224143655');
INSERT INTO `care_personell` VALUES (100003, 'as', 10000042, 0, 'as', '2000-07-01', NULL, 'addfa', '2000-07-01', NULL, 0, 'lkjmlkm', 'lklknnlk', 'lkn', 'lknl', 'knl', 0, 0.00, 0, 0, 0, '', 'Create: 2005-02-28 16:42:20 = admin\n', '', '20050228164220', 'admin', '20050228164220');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_personell_assignment`
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
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`,`personell_nr`,`role_nr`,`location_type_nr`,`location_nr`),
  KEY `personell_nr` (`personell_nr`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- Daten für Tabelle `care_personell_assignment`
-- 

INSERT INTO `care_personell_assignment` VALUES (1, 100000, 17, 1, 41, '2005-02-24', '0000-00-00', NULL, 0, '', 'Add: 2005-02-24 13:53:30 = admin\n', 'admin', '20050224135330', 'admin', '20050224135330');
INSERT INTO `care_personell_assignment` VALUES (2, 100001, 17, 1, 39, '2005-02-24', '0000-00-00', NULL, 0, '', 'Add: 2005-02-24 14:35:40 = admin\n', 'admin', '20050224143540', 'admin', '20050224143540');
INSERT INTO `care_personell_assignment` VALUES (3, 100003, 17, 1, 25, '2005-02-28', '2005-02-28', NULL, 0, 'deleted', 'Add: 2005-02-28 16:42:31 = admin\nDeleted: 2005-02-28 16:42:38 = admin\n', 'admin', '20050228164238', 'admin', '20050228164231');
INSERT INTO `care_personell_assignment` VALUES (4, 100003, 17, 1, 25, '2005-02-28', '0000-00-00', NULL, 0, '', 'Add: 2005-02-28 16:42:34 = admin\n', 'admin', '20050228164234', 'admin', '20050228164234');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_pharma_ordercatalog`
-- 

CREATE TABLE `care_pharma_ordercatalog` (
  `item_no` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `hit` int(11) NOT NULL default '0',
  `artikelname` tinytext NOT NULL,
  `bestellnum` varchar(20) NOT NULL default '',
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  KEY `item_no` (`item_no`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_pharma_ordercatalog`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_pharma_orderlist`
-- 

CREATE TABLE `care_pharma_orderlist` (
  `order_nr` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `order_date` date NOT NULL default '0000-00-00',
  `order_time` time NOT NULL default '00:00:00',
  `articles` text NOT NULL,
  `extra1` tinytext NOT NULL,
  `extra2` text NOT NULL,
  `validator` tinytext NOT NULL,
  `ip_addr` tinytext NOT NULL,
  `priority` tinytext NOT NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  `sent_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `process_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`order_nr`,`dept_nr`),
  KEY `dept` (`dept_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_pharma_orderlist`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_pharma_products_main`
-- 

CREATE TABLE `care_pharma_products_main` (
  `bestellnum` varchar(25) NOT NULL default '',
  `artikelnum` tinytext NOT NULL,
  `industrynum` tinytext NOT NULL,
  `artikelname` tinytext NOT NULL,
  `generic` tinytext NOT NULL,
  `description` text NOT NULL,
  `packing` tinytext NOT NULL,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  `picfile` tinytext NOT NULL,
  `encoder` tinytext NOT NULL,
  `enc_date` tinytext NOT NULL,
  `enc_time` tinytext NOT NULL,
  `lock_flag` tinyint(1) NOT NULL default '0',
  `medgroup` text NOT NULL,
  `cave` tinytext NOT NULL,
  `status` varchar(20) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`bestellnum`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_pharma_products_main`
-- 

INSERT INTO `care_pharma_products_main` VALUES ('0815', '', '', 'Paracetamol', 'ratiopharm 500', 'Tablets, for feaver and pain\r\n(Tablets N2)', '', 0, 0, '1', '', 'admin', '2005.03.21', '13.40', 0, 'pain killer', '', '', 'Created 2005-03-21 13:41:41 admin\n', '', '20050321134141', 'admin', '20050321134141');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_phone`
-- 

CREATE TABLE `care_phone` (
  `item_nr` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(25) default NULL,
  `name` varchar(45) NOT NULL default '',
  `vorname` varchar(45) NOT NULL default '',
  `pid` int(11) unsigned NOT NULL default '0',
  `personell_nr` int(10) unsigned NOT NULL default '0',
  `dept_nr` smallint(3) unsigned NOT NULL default '0',
  `beruf` varchar(25) default NULL,
  `bereich1` varchar(25) default NULL,
  `bereich2` varchar(25) default NULL,
  `inphone1` varchar(15) default NULL,
  `inphone2` varchar(15) default NULL,
  `inphone3` varchar(15) default NULL,
  `exphone1` varchar(25) default NULL,
  `exphone2` varchar(25) default NULL,
  `funk1` varchar(15) default NULL,
  `funk2` varchar(15) default NULL,
  `roomnr` varchar(10) default NULL,
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `status` varchar(15) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`item_nr`,`pid`,`personell_nr`,`dept_nr`),
  KEY `name` (`name`),
  KEY `vorname` (`vorname`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_phone`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_pregnancy`
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
  `child_encounter_nr` varchar(255) NOT NULL default '',
  `is_booked` tinyint(1) NOT NULL default '0',
  `vdrl` char(1) default NULL,
  `rh` tinyint(1) default NULL,
  `delivery_mode` tinyint(2) NOT NULL default '0',
  `delivery_by` varchar(60) default NULL,
  `bp_systolic_high` smallint(4) unsigned default NULL,
  `bp_diastolic_high` smallint(4) unsigned default NULL,
  `proteinuria` tinyint(1) default NULL,
  `labour_duration` smallint(3) unsigned default NULL,
  `induction_method` tinyint(2) NOT NULL default '0',
  `induction_indication` varchar(125) default NULL,
  `anaesth_type_nr` tinyint(2) NOT NULL default '0',
  `is_epidural` char(1) default NULL,
  `complications` varchar(255) default NULL,
  `perineum` tinyint(2) NOT NULL default '0',
  `blood_loss` float(8,2) unsigned default NULL,
  `blood_loss_unit` varchar(10) default NULL,
  `is_retained_placenta` char(1) NOT NULL default '',
  `post_labour_condition` varchar(35) default NULL,
  `outcome` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`,`encounter_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_pregnancy`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_registry`
-- 

CREATE TABLE `care_registry` (
  `registry_id` varchar(35) NOT NULL default '',
  `module_start_script` varchar(60) NOT NULL default '',
  `news_start_script` varchar(60) NOT NULL default '',
  `news_editor_script` varchar(255) NOT NULL default '',
  `news_reader_script` varchar(255) NOT NULL default '',
  `passcheck_script` varchar(255) NOT NULL default '',
  `composite` text NOT NULL,
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`registry_id`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_registry`
-- 

INSERT INTO `care_registry` VALUES ('amb', 'modules/ambulatory/ambulatory.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('dept', 'modules/news/departments.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('radiology', 'modules/radiology/radiolog.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('doctors', 'modules/doctors/doctors.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('nursing', 'modules/nursing/pflege.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('edp', 'modules/admin/edv.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('pharmacy', 'modules/pharmacy/apotheke.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('pr', 'modules/news/start_page.php', 'modules/news/start_page.php', 'modules/news/headline-edit.php', 'modules/news/headline-read.php', 'modules/news/editor-pass.php', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('cafe', 'modules/cafeteria/cafenews.php', 'modules/cafeteria/cafenews.php', 'modules/cafenews/cafenews-edit.php', 'modules/cafenews/cafenews-read.php', 'modules/cafenews/cafenews-edit-pass.php', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('main_start', 'modules/news/start_page.php', 'modules/news/start_page.php', 'modules/news/headline-edit-select-art.php', 'modules/news/headline-read.php', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('it', 'modules/system_admin/edv.php', 'modules/news/newscolumns.php', 'modules/news/editor-4plus1-select-art.php', 'modules/news/editor-4plus1-read.php', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_registry` VALUES ('admission_module', 'modules/admission/aufnahme_start.php', '', '', '', 'modules/admission/aufnahme_pass.php', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_role_person`
-- 

CREATE TABLE `care_role_person` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `role` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`,`group_nr`)
) TYPE=MyISAM AUTO_INCREMENT=18 ;

-- 
-- Daten für Tabelle `care_role_person`
-- 

INSERT INTO `care_role_person` VALUES (1, 3, 'contact', 'Contact person', 'LDContactPerson', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (2, 3, 'guarantor', 'Guarantor', 'LDGuarantor', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (3, 3, 'doctor_att', 'Attending doctor', 'LDAttDoctor', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (4, 3, 'supervisor', 'Supervisor', 'LDSupervisor', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (5, 3, 'doctor_admit', 'Admitting doctor', 'LDAdmittingDoctor', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (6, 3, 'doctor_consult', 'Consulting doctor', 'LDConsultingDoctor', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (7, 4, 'surgeon', 'Surgeon', 'LDSurgeon', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (8, 4, 'surgeon_asst', 'Assisting surgeon', 'LDAssistingSurgeon', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (9, 4, 'nurse_scrub', 'Scrub nurse', 'LDScrubNurse', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (10, 4, 'nurse_rotating', 'Rotating nurse', 'LDRotatingNurse', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (11, 4, 'nurse_anesthesia', 'Anesthesia nurse', 'LDAnesthesiaNurse', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (12, 4, 'anesthesiologist', 'Anesthesiologist', 'LDAnesthesiologist', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (13, 4, 'anesthesiologist_asst', 'Assisting anesthesiologist', 'LDAssistingAnesthesiologist', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (14, 0, 'nurse_on_call', 'Nurse On Call', 'LDNurseOnCall', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (15, 0, 'doctor_on_call', 'Doctor On Call', 'LDDoctorOnCall', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (16, 0, 'nurse', 'Nurse', 'LDNurse', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_role_person` VALUES (17, 0, 'doctor', 'Doctor', 'LDDoctor', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_room`
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
  `closed_beds` varchar(255) NOT NULL default '',
  `info` varchar(60) default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`,`type_nr`,`ward_nr`,`dept_nr`),
  KEY `room_nr` (`room_nr`),
  KEY `ward_nr` (`ward_nr`),
  KEY `dept_nr` (`dept_nr`)
) TYPE=MyISAM AUTO_INCREMENT=20 ;

-- 
-- Daten für Tabelle `care_room`
-- 

INSERT INTO `care_room` VALUES (1, 2, '2003-04-27', '0000-00-00', 0, 1, 0, 0, 1, '', NULL, '', '', '', '20030427185459', '', '20030427185459');
INSERT INTO `care_room` VALUES (2, 2, '2003-04-27', '0000-00-00', 0, 2, 0, 0, 1, '', NULL, '', '', '', '20030427185704', '', '20030427185631');
INSERT INTO `care_room` VALUES (3, 2, '2003-04-27', '0000-00-00', 0, 3, 0, 0, 1, '', NULL, '', '', '', '20030427185813', '', '20030427185727');
INSERT INTO `care_room` VALUES (4, 2, '2003-04-27', '0000-00-00', 0, 4, 0, 0, 1, '', NULL, '', '', '', '20030427190021', '', '20030427185846');
INSERT INTO `care_room` VALUES (5, 2, '2003-04-27', '0000-00-00', 0, 5, 0, 0, 1, '', NULL, '', '', '', '20030427190132', '', '20030427185927');
INSERT INTO `care_room` VALUES (6, 2, '2003-04-27', '0000-00-00', 0, 6, 0, 0, 1, '', NULL, '', '', '', '20030427190122', '', '20030427190105');
INSERT INTO `care_room` VALUES (7, 2, '2003-04-27', '0000-00-00', 0, 7, 0, 0, 1, '', NULL, '', '', '', '20030427190310', '', '20030427190310');
INSERT INTO `care_room` VALUES (8, 2, '2003-04-27', '0000-00-00', 0, 8, 0, 0, 1, '', NULL, '', '', '', '20030427190350', '', '20030427190350');
INSERT INTO `care_room` VALUES (9, 2, '2003-04-27', '0000-00-00', 0, 9, 0, 0, 1, '', NULL, '', '', '', '20030427190433', '', '20030427190433');
INSERT INTO `care_room` VALUES (10, 2, '2003-04-27', '0000-00-00', 0, 10, 0, 0, 1, '', NULL, '', '', '', '20030427190503', '', '20030427190503');
INSERT INTO `care_room` VALUES (11, 2, '2003-04-27', '0000-00-00', 0, 11, 0, 0, 1, '', NULL, '', '', '', '20030427190636', '', '20030427190636');
INSERT INTO `care_room` VALUES (12, 2, '2003-04-27', '0000-00-00', 0, 12, 0, 0, 1, '', NULL, '', '', '', '20030427190759', '', '20030427190759');
INSERT INTO `care_room` VALUES (13, 2, '2003-04-27', '0000-00-00', 0, 13, 0, 0, 1, '', NULL, '', '', '', '20030427190826', '', '20030427190826');
INSERT INTO `care_room` VALUES (14, 2, '2003-04-27', '0000-00-00', 0, 14, 0, 0, 1, '', NULL, '', '', '', '20030427190852', '', '20030427190852');
INSERT INTO `care_room` VALUES (15, 2, '2003-04-27', '0000-00-00', 0, 15, 0, 0, 1, '', NULL, '', '', '', '20030427190918', '', '20030427190918');
INSERT INTO `care_room` VALUES (16, 1, '2005-02-02', '0000-00-00', 0, 1, 1, 0, 2, '', 'left', '', 'Created: 2005-02-02 14:04:01 admin\n', '', '20050202140402', 'admin', '20050202140401');
INSERT INTO `care_room` VALUES (17, 1, '2005-02-02', '0000-00-00', 0, 2, 1, 0, 2, '', 'right', '', 'Created: 2005-02-02 14:04:01 admin\n', '', '20050202140402', 'admin', '20050202140401');
INSERT INTO `care_room` VALUES (18, 1, '2005-02-25', '0000-00-00', 0, 1, 2, 0, 2, '', 'none', '', 'Created: 2005-02-25 14:52:12 admin\n', '', '20050225145212', 'admin', '20050225145212');
INSERT INTO `care_room` VALUES (19, 1, '2005-02-25', '0000-00-00', 0, 2, 2, 0, 2, '', 'none', '', 'Created: 2005-02-25 14:52:12 admin\n', '', '20050225145212', 'admin', '20050225145212');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_sessions`
-- 

CREATE TABLE `care_sessions` (
  `SESSKEY` varchar(32) NOT NULL default '',
  `EXPIRY` int(11) unsigned NOT NULL default '0',
  `expireref` varchar(64) NOT NULL default '',
  `DATA` text NOT NULL,
  PRIMARY KEY  (`SESSKEY`),
  KEY `EXPIRY` (`EXPIRY`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_sessions`
-- 

INSERT INTO `care_sessions` VALUES ('cf570c82cc01373eacf63aa8e67d47e4', 1125916801, '', 'sess_user_name%7Cs%3A5%3A%22admin%22%3Bsess_user_origin%7Cs%3A10%3A%22main_start%22%3Bsess_file_forward%7CN%3Bsess_file_return%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_file_break%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_path_referer%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_dept_nr%7Cs%3A1%3A%221%22%3Bsess_title%7Cs%3A21%3A%22Headline%3A%3ASubmit%20News%22%3Bsess_lang%7Cs%3A2%3A%22en%22%3Bsess_user_id%7Cs%3A41%3A%22CFG427f8b23585930.36188800%201115654947.cfg%22%3Bsess_cur_page%7CN%3Bsess_searchkey%7Cs%3A1%3A%22%25%22%3Bsess_tos%7Cs%3A6%3A%22094000%22%3Bsess_news_nr%7CN%3Bsess_file_editor%7Cs%3A28%3A%22headline-edit-select-art.php%22%3Bsess_file_reader%7Cs%3A17%3A%22headline-read.php%22%3Bsess_login_userid%7Cs%3A4%3A%22care%22%3Bsess_login_username%7Cs%3A5%3A%22admin%22%3Bsess_login_pw%7Cs%3A17%3A%22S2kAAA%3D%3D%23jERNZA%3D%3D%22%3Bsess_en%7Cs%3A10%3A%222005500000%22%3Bsess_full_en%7Ci%3A2006000000%3B');
INSERT INTO `care_sessions` VALUES ('2ab8765102d4f32aca9da0e66eb17ea8', 1125942513, '', 'sess_user_name%7Cs%3A7%3A%22default%22%3Bsess_user_origin%7Cs%3A10%3A%22main_start%22%3Bsess_file_forward%7CN%3Bsess_file_return%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_file_break%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_path_referer%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_dept_nr%7Cs%3A1%3A%221%22%3Bsess_title%7Cs%3A21%3A%22Headline%3A%3ASubmit%20News%22%3Bsess_lang%7Cs%3A2%3A%22en%22%3Bsess_user_id%7Cs%3A41%3A%22CFG427f8b23585930.36188800%201115654947.cfg%22%3Bsess_cur_page%7CN%3Bsess_searchkey%7CN%3Bsess_tos%7Cs%3A6%3A%22164815%22%3Bsess_news_nr%7CN%3Bsess_file_editor%7Cs%3A28%3A%22headline-edit-select-art.php%22%3Bsess_file_reader%7Cs%3A17%3A%22headline-read.php%22%3Bsess_login_userid%7Cs%3A4%3A%22care%22%3Bsess_login_username%7Cs%3A5%3A%22admin%22%3Bsess_login_pw%7Cs%3A17%3A%22TAAAAA%3D%3D%23n25hVg%3D%3D%22%3B');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_standby_duty_report`
-- 

CREATE TABLE `care_standby_duty_report` (
  `report_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(15) NOT NULL default '',
  `date` date NOT NULL default '0000-00-00',
  `standby_name` varchar(35) NOT NULL default '',
  `standby_start` time NOT NULL default '00:00:00',
  `standby_end` time NOT NULL default '00:00:00',
  `oncall_name` varchar(35) NOT NULL default '',
  `oncall_start` time NOT NULL default '00:00:00',
  `oncall_end` time NOT NULL default '00:00:00',
  `op_room` char(2) NOT NULL default '',
  `diagnosis_therapy` text NOT NULL,
  `encoding` text NOT NULL,
  `status` varchar(20) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`report_nr`),
  KEY `report_nr` (`report_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_standby_duty_report`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_steri_products_main`
-- 

CREATE TABLE `care_steri_products_main` (
  `bestellnum` int(15) unsigned NOT NULL default '0',
  `containernum` varchar(15) NOT NULL default '',
  `industrynum` tinytext NOT NULL,
  `containername` varchar(40) NOT NULL default '',
  `description` text NOT NULL,
  `packing` tinytext NOT NULL,
  `minorder` int(4) unsigned NOT NULL default '0',
  `maxorder` int(4) unsigned NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  `picfile` tinytext NOT NULL,
  `encoder` tinytext NOT NULL,
  `enc_date` tinytext NOT NULL,
  `enc_time` tinytext NOT NULL,
  `lock_flag` tinyint(1) NOT NULL default '0',
  `medgroup` text NOT NULL,
  `cave` tinytext NOT NULL
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_steri_products_main`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tech_questions`
-- 

CREATE TABLE `care_tech_questions` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(60) NOT NULL default '',
  `query` text NOT NULL,
  `inquirer` varchar(25) NOT NULL default '',
  `tphone` varchar(30) NOT NULL default '',
  `tdate` date NOT NULL default '0000-00-00',
  `ttime` time NOT NULL default '00:00:00',
  `tid` timestamp(14) NOT NULL,
  `reply` text NOT NULL,
  `answered` tinyint(1) NOT NULL default '0',
  `ansby` varchar(25) NOT NULL default '',
  `astamp` varchar(16) NOT NULL default '',
  `archive` tinyint(1) NOT NULL default '0',
  `status` varchar(15) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL default '00000000000000',
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`),
  KEY `batch_nr` (`batch_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_tech_questions`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tech_repair_done`
-- 

CREATE TABLE `care_tech_repair_done` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(15) default NULL,
  `dept_nr` tinyint(3) unsigned NOT NULL default '0',
  `job_id` varchar(15) NOT NULL default '0',
  `job` text NOT NULL,
  `reporter` varchar(25) NOT NULL default '',
  `id` varchar(15) NOT NULL default '',
  `tdate` date NOT NULL default '0000-00-00',
  `ttime` time NOT NULL default '00:00:00',
  `tid` timestamp(14) NOT NULL,
  `seen` tinyint(1) NOT NULL default '0',
  `d_idx` varchar(8) NOT NULL default '',
  `status` varchar(15) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL default '00000000000000',
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`,`dept_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_tech_repair_done`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tech_repair_job`
-- 

CREATE TABLE `care_tech_repair_job` (
  `batch_nr` tinyint(4) NOT NULL auto_increment,
  `dept` varchar(15) NOT NULL default '',
  `job` text NOT NULL,
  `reporter` varchar(25) NOT NULL default '',
  `id` varchar(15) NOT NULL default '',
  `tphone` varchar(30) NOT NULL default '',
  `tdate` date NOT NULL default '0000-00-00',
  `ttime` time NOT NULL default '00:00:00',
  `tid` timestamp(14) NOT NULL,
  `done` tinyint(1) NOT NULL default '0',
  `seen` tinyint(1) NOT NULL default '0',
  `seenby` varchar(25) NOT NULL default '',
  `sstamp` varchar(16) NOT NULL default '',
  `doneby` varchar(25) NOT NULL default '',
  `dstamp` varchar(16) NOT NULL default '',
  `d_idx` varchar(8) NOT NULL default '',
  `archive` tinyint(1) NOT NULL default '0',
  `status` varchar(20) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL default '00000000000000',
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`),
  KEY `batch_nr` (`batch_nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_tech_repair_job`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_findings_baclabor`
-- 

CREATE TABLE `care_test_findings_baclabor` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` varchar(10) NOT NULL default '',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `notes` varchar(255) NOT NULL default '',
  `findings_init` tinyint(1) NOT NULL default '0',
  `findings_current` tinyint(1) NOT NULL default '0',
  `findings_final` tinyint(1) NOT NULL default '0',
  `entry_nr` varchar(10) NOT NULL default '',
  `rec_date` date NOT NULL default '0000-00-00',
  `type_general` text NOT NULL,
  `resist_anaerob` text NOT NULL,
  `resist_aerob` text NOT NULL,
  `findings` text NOT NULL,
  `doctor_id` varchar(35) NOT NULL default '',
  `findings_date` date NOT NULL default '0000-00-00',
  `findings_time` time NOT NULL default '00:00:00',
  `status` varchar(10) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
  KEY `findings_date` (`findings_date`),
  KEY `rec_date` (`rec_date`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_test_findings_baclabor`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_findings_chemlab`
-- 

CREATE TABLE `care_test_findings_chemlab` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `job_id` varchar(25) NOT NULL default '',
  `test_date` date NOT NULL default '0000-00-00',
  `test_time` time NOT NULL default '00:00:00',
  `group_id` varchar(30) NOT NULL default '',
  `serial_value` text NOT NULL,
  `add_value` text NOT NULL,
  `validator` varchar(15) NOT NULL default '',
  `validate_dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(20) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`job_id`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- Daten für Tabelle `care_test_findings_chemlab`
-- 

INSERT INTO `care_test_findings_chemlab` VALUES (1, 2005000001, '10000000', '2005-03-08', '15:26:26', '1', 'a:2:{i:9;s:4:"1234";i:13;s:3:"122";}', '', '', '0000-00-00 00:00:00', '', 'Create 2005-03-08 15:26:26 admin\n', 'admin', '20050308152641', 'admin', '20050308152626');
INSERT INTO `care_test_findings_chemlab` VALUES (2, 2005000001, '10000000', '2005-03-08', '15:26:51', '6', 'a:1:{i:44;s:4:"1334";}', '', '', '0000-00-00 00:00:00', '', 'Create 2005-03-08 15:26:51 admin\r\n', '', '20050308155026', 'admin', '20050308152651');
INSERT INTO `care_test_findings_chemlab` VALUES (3, 2005500001, '10000001', '2005-03-08', '16:17:48', '1', 'a:2:{i:9;s:2:"50";i:11;s:5:"12345";}', 'a:2:{i:9;N;i:11;N;}', '', '0000-00-00 00:00:00', '', 'Create 2005-03-08 16:17:48 admin\n', 'admin', '20050310162407', 'admin', '20050308161748');
INSERT INTO `care_test_findings_chemlab` VALUES (4, 2005500001, '10000001', '2005-03-08', '15:08:47', '6', 'a:2:{i:44;s:2:"56";i:49;s:2:"34";}', 'a:2:{i:44;N;i:49;s:9:"jhjgvjhvb";}', '', '0000-00-00 00:00:00', '', 'Create 2005-03-10 15:08:47 admin\n', 'admin', '20050310154927', 'admin', '20050310150847');
INSERT INTO `care_test_findings_chemlab` VALUES (5, 2005500001, '10000001', '2005-03-08', '15:09:14', '3', 'a:0:{}', 'N;', '', '0000-00-00 00:00:00', '', 'Create 2005-03-10 15:09:14 admin\n', 'admin', '20050310151015', 'admin', '20050310150914');
INSERT INTO `care_test_findings_chemlab` VALUES (6, 2005500001, '10000002', '2005-03-10', '17:08:51', '1', 'a:4:{i:10;s:2:"12";i:11;s:2:"12";i:12;s:2:"12";i:13;s:2:"12";}', 'a:4:{i:10;N;i:11;N;i:12;N;i:13;N;}', '', '0000-00-00 00:00:00', '', 'Create 2005-03-10 17:08:51 admin\n', 'admin', '20050415130841', 'admin', '20050310170851');
INSERT INTO `care_test_findings_chemlab` VALUES (7, 2005500001, '10000003', '2005-03-14', '12:09:26', '1', 'a:1:{i:9;s:2:"30";}', 'a:1:{i:9;N;}', '', '0000-00-00 00:00:00', '', 'Create 2005-03-14 12:09:26 admin\n', '', '20050314120926', 'admin', '20050314120926');
INSERT INTO `care_test_findings_chemlab` VALUES (8, 2005500001, '10000003', '2005-03-14', '12:09:38', '6', 'a:1:{i:44;s:3:"123";}', 'a:1:{i:44;s:5:"check";}', '', '0000-00-00 00:00:00', '', 'Create 2005-03-14 12:09:38 admin\n', '', '20050314120938', 'admin', '20050314120938');
INSERT INTO `care_test_findings_chemlab` VALUES (9, 2005500005, '10000005', '2005-06-03', '16:58:41', '4', 'a:1:{i:39;s:3:"115";}', 'a:1:{i:39;N;}', '', '0000-00-00 00:00:00', '', 'Create 2005-06-03 16:58:41 admin\n', 'admin', '20050603165908', 'admin', '20050603165841');
INSERT INTO `care_test_findings_chemlab` VALUES (10, 2005500005, '10000006', '2005-06-03', '17:00:19', '1', 'a:1:{i:9;s:2:"45";}', 'a:1:{i:9;N;}', '', '0000-00-00 00:00:00', '', 'Create 2005-06-03 17:00:19 admin\n', '', '20050603170019', 'admin', '20050603170019');
INSERT INTO `care_test_findings_chemlab` VALUES (11, 2005500004, '10000004', '2005-06-11', '22:17:24', '1', 'a:0:{}', 'N;', '', '0000-00-00 00:00:00', '', 'Create 2005-06-11 22:17:24 admin\n', '', '20050611221724', 'admin', '20050611221724');
INSERT INTO `care_test_findings_chemlab` VALUES (12, 2005500003, '10000009', '2005-06-11', '22:29:11', '3', 'a:1:{i:32;s:3:"500";}', 'a:1:{i:32;N;}', '', '0000-00-00 00:00:00', '', 'Create 2005-06-11 22:29:11 admin\n', '', '20050611222911', 'admin', '20050611222911');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_findings_patho`
-- 

CREATE TABLE `care_test_findings_patho` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` varchar(10) NOT NULL default '',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `material` text NOT NULL,
  `macro` text NOT NULL,
  `micro` text NOT NULL,
  `findings` text NOT NULL,
  `diagnosis` text NOT NULL,
  `doctor_id` varchar(35) NOT NULL default '',
  `findings_date` date NOT NULL default '0000-00-00',
  `findings_time` time NOT NULL default '00:00:00',
  `status` varchar(10) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
  KEY `send_date` (`findings_date`),
  KEY `findings_date` (`findings_date`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_test_findings_patho`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_findings_radio`
-- 

CREATE TABLE `care_test_findings_radio` (
  `batch_nr` int(11) unsigned NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` smallint(5) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `findings` text NOT NULL,
  `diagnosis` text NOT NULL,
  `doctor_id` varchar(35) NOT NULL default '',
  `findings_date` date NOT NULL default '0000-00-00',
  `findings_time` time NOT NULL default '00:00:00',
  `status` varchar(10) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`findings_date`),
  KEY `findings_date` (`findings_date`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_test_findings_radio`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_group`
-- 

CREATE TABLE `care_test_group` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `sort_nr` tinyint(4) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`,`group_id`),
  UNIQUE KEY `group_id` (`group_id`)
) TYPE=MyISAM AUTO_INCREMENT=24 ;

-- 
-- Daten für Tabelle `care_test_group`
-- 

INSERT INTO `care_test_group` VALUES (1, 'priority', 'Priority', 5, '', '', '20030711174456', '', '20030711174402');
INSERT INTO `care_test_group` VALUES (2, 'clinical_chem', 'Clinical chemistry', 10, '', '', '20030711174607', '', '20030711174549');
INSERT INTO `care_test_group` VALUES (3, 'liquor', 'Liquor', 15, '', '', '20030711174647', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (4, 'coagulation', 'Coagulationnn', 20, '', '', '20050301113107', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (5, 'hematology', 'Hematology', 25, '', '', '20030711174751', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (6, 'blood_sugar', 'Blood sugar', 30, '', '', '20030711174835', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (7, 'neonate', 'Neonate', 35, '', '', '20030711174928', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (8, 'proteins', 'Proteins', 40, '', '', '20030711174951', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (9, 'thyroid', 'Thyroid', 45, '', '', '20030711175013', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (10, 'hormones', 'Hormones', 50, '', '', '20030711175032', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (11, 'tumor_marker', 'Tumor marker', 55, '', '', '20030711175052', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (12, 'tissue_antibody', 'Tissue antibody', 60, '', '', '20030711175200', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (13, 'rheuma_factor', 'Rheuma factor', 65, '', '', '20030711175220', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (14, 'hepatitis', 'Hepatitis', 70, '', '', '20030711175259', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (15, 'biopsy', 'Biopsy', 75, '', '', '20030711175432', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (16, 'infection_serology', 'Infection serology', 80, '', '', '20030711175513', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (17, 'medicines', 'Medicines', 85, '', '', '20030711175535', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (18, 'prenatal', 'Prenatal', 90, '', '', '20030711175554', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (19, 'stool', 'Stool', 95, '', '', '20030711175646', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (20, 'rare', 'Rare', 100, '', '', '20030711175758', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (21, 'urine', 'Urine', 105, '', '', '20030711175817', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (22, 'total_urine', 'Total urine', 110, '', '', '20030711175848', '', '00000000000000');
INSERT INTO `care_test_group` VALUES (23, 'special_params', 'Special', 115, '', '', '20030711180005', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_param`
-- 

CREATE TABLE `care_test_param` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `id` varchar(10) NOT NULL default '',
  `msr_unit` varchar(15) NOT NULL default '',
  `median` varchar(20) default NULL,
  `hi_bound` varchar(20) default NULL,
  `lo_bound` varchar(20) default NULL,
  `hi_critical` varchar(20) default NULL,
  `lo_critical` varchar(20) default NULL,
  `hi_toxic` varchar(20) default NULL,
  `lo_toxic` varchar(20) default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`,`group_id`)
) TYPE=MyISAM AUTO_INCREMENT=313 ;

-- 
-- Daten für Tabelle `care_test_param`
-- 

INSERT INTO `care_test_param` VALUES (1, 'priority', 'Quick', '00q', 'mm/s', '', '', '15', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (2, 'priority', 'PTT', '00ptt', 'mm/s', '', '350', '', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (3, 'priority', 'Hb', '00hb', 'g/dl', '', '18', '12', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (4, 'priority', 'Hk', '00hc', '%', '48', '58', '36', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (5, 'priority', 'Platelets', '00pla', 'c/cmm', '', '500000', '200000', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (6, 'priority', 'RBC', '00rbc', 'mil/cmm', '', '5.5', '4.5', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (7, 'priority', 'WBC', '00wbc', 'c/ccm', '', '9000', '5000', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (8, 'priority', 'Calcium', '00ca', 'mEq/ml', '', '', '', '67', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (9, 'priority', 'Sodium', '00na', 'mEq/ml', '', '100', '20', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (10, 'priority', 'Potassium', '00k', 'mEq/ml', '', '100', '10', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (11, 'priority', 'Blood sugar', '00sug', 'mg/dL', '', '140', '', '260', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (12, 'clinical_chem', 'Alk. Ph.', '0aph', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (13, 'clinical_chem', 'Alpha GT', '0agt', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (14, 'clinical_chem', 'Ammonia', '0amm', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (15, 'clinical_chem', 'Amylase', '0amy', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (16, 'clinical_chem', 'Bili total', '0bit', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (17, 'clinical_chem', 'Bili direct', '0bid', '', '56', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (18, 'clinical_chem', 'Calcium', '0ca', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (19, 'clinical_chem', 'Chloride', '0chl', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (20, 'clinical_chem', 'Chol', '0cho', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (21, 'clinical_chem', 'Cholinesterase', '0chol', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (22, 'clinical_chem', 'CKMB', '0ccmb', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (23, 'clinical_chem', 'CPK', '0cpc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (24, 'clinical_chem', 'CRP', '0crp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (25, 'clinical_chem', 'Iron', '0fe', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (26, 'clinical_chem', 'RBC', '0rbc', 'c/ccm', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (27, 'clinical_chem', 'free HgB', '0fhb', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (28, 'clinical_chem', 'GLDH', '0gldh', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (29, 'clinical_chem', 'GOT', '0got', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (30, 'clinical_chem', 'GPT', '0gpt', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (31, 'clinical_chem', 'Uric acid', '0ucid', '', '', '', '', '', '', '', '', '', 'Update 2003-09-05 17:34:05 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030905183405', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (32, 'clinical_chem', 'Urea', '0urea', '', '', '', '', '', '', '', '', '', 'Update 2003-09-05 17:34:33 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030905183433', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (33, 'clinical_chem', 'HBDH', '0hbdh', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (34, 'clinical_chem', 'HDL Chol', '0hdlc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (35, 'clinical_chem', 'Potassium', '0pot', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (36, 'clinical_chem', 'Creatinine', '0cre', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (37, 'clinical_chem', 'Copper', '0co', '', '', '', '', '', '', '', '', '', 'Update 2003-09-05 17:22:10 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030905182210', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (38, 'clinical_chem', 'Lactate i.P.', '0lac', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (39, 'clinical_chem', 'LDH', '0ldh', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (40, 'clinical_chem', 'LDL Chol', '0ldlc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (41, 'clinical_chem', 'Lipase', '0lip', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (42, 'clinical_chem', 'Lipid Elpho', '0lpid', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (43, 'clinical_chem', 'Magnesium', '0mg', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (44, 'clinical_chem', 'Myoglobin', '0myo', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (45, 'clinical_chem', 'Sodium', '0na', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (46, 'clinical_chem', 'Osmolal.', '0osm', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (47, 'clinical_chem', 'Phosphor', '0pho', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (48, 'clinical_chem', 'Serum sugar', '0glo', 'mg/dL', '', '140', '', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (49, 'clinical_chem', 'Tri', '0tri', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (50, 'clinical_chem', 'Troponin T', '0tro', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (51, 'liquor', 'Liquor status', '1stat', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (52, 'liquor', 'Liquor elpho', '1elp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (53, 'liquor', 'Oligoclonales IgG', '1oli', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (54, 'liquor', 'Reiber Scheme', '1sch', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (55, 'liquor', 'A1', '1a1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (56, 'coagulation', 'Fibrinolysis', '2fiby', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (57, 'coagulation', 'Quick', '2q', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (58, 'coagulation', 'PTT', '2ptt', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (59, 'coagulation', 'PTZ', '2ptz', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (60, 'coagulation', 'Fibrinogen', '2fibg', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (61, 'coagulation', 'Sol.Fibr.mon.', '2fibs', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (62, 'coagulation', 'FSP dimer', '2fsp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (63, 'coagulation', 'Thr.Coag.', '2coag', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (64, 'coagulation', 'AT III', '2at3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (65, 'coagulation', 'Faktor VII', '2f8', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182153', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (66, 'coagulation', 'APC Resistance', '2apc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (67, 'coagulation', 'Protein C', '2prc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (68, 'coagulation', 'Protein S', '2prs', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (69, 'coagulation', 'Bleeding time', '2bt', 'ml/s', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (70, 'hematology', 'Retikulocytes', '3ret', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (71, 'hematology', 'Malaria', '3mal', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (72, 'hematology', 'Hb Elpho', '3hbe', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (73, 'hematology', 'HLA B 27', '3hla', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (74, 'hematology', 'Platelets AB', '3tab', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (75, 'hematology', 'WBC Phosp.', '3wbp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (76, 'blood_sugar', 'Blood sugar fasting', '4bsf', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (77, 'blood_sugar', 'Blood sugar 9:00', '4bs9', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (78, 'blood_sugar', 'Blood sugar p.prandial', '4bsp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (79, 'blood_sugar', 'Bl15:00', '4bs15', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (80, 'blood_sugar', 'Blood sugar 1', '4bs1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (81, 'blood_sugar', 'Blood sugar 2', '4bs2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (82, 'blood_sugar', 'Glucose stress.', '4glo', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (83, 'blood_sugar', 'Lactose stress', '4lac', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (84, 'blood_sugar', 'HBA 1c', '4hba', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (85, 'blood_sugar', 'Fructosamine', '4fru', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (86, 'neonate', 'Neonate bilirubin', '5bil', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (87, 'neonate', 'Cord bilirubin', '5bilc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (88, 'neonate', 'Bilirubin direct', '5bild', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (89, 'neonate', 'Neonate sugar 1', '5glo1', 'mg/dL', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (90, 'neonate', 'Neonate sugar 2', '5glo2', 'mg/DL', '', '', '30', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (91, 'neonate', 'Reticulocytes', '5ret', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (92, 'neonate', 'B1', '5b1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (93, 'proteins', 'Total proteins', '6tot', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (94, 'proteins', 'Albumin', '6alb', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (95, 'proteins', 'Elpho', '6elp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (96, 'proteins', 'Immune fixation', '6imm', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (97, 'proteins', 'Beta2 Microglobulin.i.S', '6b2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (98, 'proteins', 'Immune globulin quant.', '6img', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (99, 'proteins', 'IgE', '6ige', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (100, 'proteins', 'Haptoglobin', '6hap', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (101, 'proteins', 'Transferrin', '6tra', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (102, 'proteins', 'Ferritin', '6fer', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (103, 'proteins', 'Coeruloplasmin', '6coe', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (104, 'proteins', 'Alpha 1 Antitrypsin', '6alp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (105, 'proteins', 'AFP Grav.', '6afp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (106, 'proteins', 'SSW:', '6ssw', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (107, 'proteins', 'Alpha 1 Microglobulin', '6mic', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (108, 'thyroid', 'T3', '7t3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (109, 'thyroid', 'Thyroxin/T4', '7t4', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (110, 'thyroid', 'TSH basal', '7tshb', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (111, 'thyroid', 'TSH stim.', '7tshs', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (112, 'thyroid', 'TAB', '7tab', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (113, 'thyroid', 'MAB', '7mab', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (114, 'thyroid', 'TRAB', '7trab', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (115, 'thyroid', 'Thyreoglobulin', '7glob', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (116, 'thyroid', 'Thyroxinbind.Glob.', '7thx', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (117, 'thyroid', 'free T3', '7ft3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (118, 'thyroid', 'free T4', '7ft4', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (119, 'hormones', 'ACTH', '8acth', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (120, 'hormones', 'Aldosteron', '8ald', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (121, 'hormones', 'Calcitonin', '8cal', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (122, 'hormones', 'Cortisol', '8cor', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (123, 'hormones', 'Cortisol day', '8dcor', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (124, 'hormones', 'FSH', '8fsh', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (125, 'hormones', 'Gastrin', '8gas', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (126, 'hormones', 'HCG', '8hcg', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (127, 'hormones', 'Insulin', '8ins', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (128, 'hormones', 'Catecholam.i.P.', '8cat', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (129, 'hormones', 'LH', '8lh', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (130, 'hormones', 'Ostriol', '8osd', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (131, 'hormones', 'SSW:', '8ssw', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182154', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (132, 'hormones', 'Parat hormone', '8par', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (133, 'hormones', 'Progesteron', '8prg', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (134, 'hormones', 'Prolactin I', '8pr1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (135, 'hormones', 'Prolactin II', '8pr2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (136, 'hormones', 'Renin', '8ren', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (137, 'hormones', 'Serotonin', '8ser', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (138, 'hormones', 'Somatomedin C', '8som', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (139, 'hormones', 'Testosteron', '8tes', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (140, 'hormones', 'C1', '8c1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (141, 'tumor_marker', 'AFP', '9afp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (142, 'tumor_marker', 'CA. 15 3', '9c153', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (143, 'tumor_marker', 'CA. 19 9', '9c199', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (144, 'tumor_marker', 'CA. 125', '9c125', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (145, 'tumor_marker', 'CEA', '9cea', '', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (146, 'tumor_marker', 'Cyfra. 21 2', '9c212', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (147, 'tumor_marker', 'HCG', '9hcg', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (148, 'tumor_marker', 'NSE', '9nse', 'test', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', '20030806043227', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (149, 'tumor_marker', 'PSA', '9psa', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (150, 'tumor_marker', 'SCC', '9scc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (151, 'tumor_marker', 'TPA', '9tpa', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (152, 'tissue_antibody', 'ANA', '10ana', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (153, 'tissue_antibody', 'AMA', 'ama', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (154, 'tissue_antibody', 'DNS AB', '10dnsab', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (155, 'tissue_antibody', 'ASMA', '10asm', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (156, 'tissue_antibody', 'ENA', '10ena', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (157, 'tissue_antibody', 'ANCA', '10anc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (158, 'rheuma_factor', 'Anti Strepto Titer', '11ast', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (159, 'rheuma_factor', 'Lat. RF', '11lrf', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (160, 'rheuma_factor', 'Streptozym', '11stz', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (161, 'rheuma_factor', 'Waaler Rose', '11waa', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (162, 'hepatitis', 'Anti HAV', '12hav', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (163, 'hepatitis', 'Anti HAV IgM', '12hai', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (164, 'hepatitis', 'Hbs Antigen', '12hba', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (165, 'hepatitis', 'Anti HBs Titer', '12hbt', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (166, 'hepatitis', 'Anti HBe', '12hbe', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (167, 'hepatitis', 'Anti HBc', '12hbc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (168, 'hepatitis', 'Anti HBc.IgM', '12hci', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (169, 'hepatitis', 'Anti HCV', '12hcv', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (170, 'hepatitis', 'Hep.D Delta A.', '12hda', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (171, 'hepatitis', 'Anti HEV', '12hev', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (172, 'biopsy', 'Protein i.biopsy', '13pro', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (173, 'biopsy', 'LDH i.biopsy', '13ldh', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (174, 'biopsy', 'Chol.i.biopsy', '13cho', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (175, 'biopsy', 'CEA i.biopsy', '13cea', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (176, 'biopsy', 'AFP i.biopsy', '13afp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (177, 'biopsy', 'Uric acid.i.biopsy', '13ure', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (178, 'biopsy', 'Rheuma fact.i.biopsy', '13rhe', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (179, 'biopsy', 'D1', '13d1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (180, 'biopsy', 'D2', '13d2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (181, 'infection_serology', 'Antistaph.Titer', '14stap', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (182, 'infection_serology', 'Adenovirus AB', '14ade', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (183, 'infection_serology', 'Borrelia AB', '14bor', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (184, 'infection_serology', 'Borr.Immunoblot', '14bori', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (185, 'infection_serology', 'Brucellia AB', '14bru', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (186, 'infection_serology', 'Campylob. AB', '14cam', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (187, 'infection_serology', 'Candida AB', '14can', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (188, 'infection_serology', 'Cardiotr.Virus', '14car', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (189, 'infection_serology', 'Chlamydia AB', '14chl', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (190, 'infection_serology', 'C.psittaci AB', '14psi', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (191, 'infection_serology', 'Coxsack. AB', '14cox', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (192, 'infection_serology', 'Cox.burn. AB(Q fever)', '14qf', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (193, 'infection_serology', 'Cytomegaly AB', '14cyt', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (194, 'infection_serology', 'EBV AB', '14ebv', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (195, 'infection_serology', 'Echinococcus AB', '14ecc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (196, 'infection_serology', 'Echo Virus AB', '14ecv', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (197, 'infection_serology', 'FSME AB', '14fsme', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182155', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (198, 'infection_serology', 'Herpes simp. I AB', '14hs1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (199, 'infection_serology', 'Herpes simp. II AB', '14hs2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (200, 'infection_serology', 'HIV1/HIV2 AB', '14hiv', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (201, 'infection_serology', 'Influenza A AB', '14ina', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (202, 'infection_serology', 'Influenza B AB', '14inb', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (203, 'infection_serology', 'LCM AB', '14lcm', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (204, 'infection_serology', 'Leg.pneum AB', '14leg', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (205, 'infection_serology', 'Leptospiria AB', '14lep', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (206, 'infection_serology', 'Listeria AB', '14lis', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (207, 'infection_serology', 'Masern AB', '14mas', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (208, 'infection_serology', 'Mononucleose', '14mon', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (209, 'infection_serology', 'Mumps AB', '14mum', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (210, 'infection_serology', 'Mycoplas.pneum AB', '14myc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (211, 'infection_serology', 'Neutrop Virus AB', '14neu', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (212, 'infection_serology', 'Parainfluenza II AB', '14pi2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (213, 'infection_serology', 'Parainfluenza III AB', '14pi3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (214, 'infection_serology', 'Picorna Virus AB', '14pic', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (215, 'infection_serology', 'Rickettsia AB', '14vric', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (216, 'infection_serology', 'Röteln AB', '14rot', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (217, 'infection_serology', 'Röteln Immune status', '14roi', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (218, 'infection_serology', 'RS Virus AB', '14rsv', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (219, 'infection_serology', 'Shigella/Salm AB', '14shi', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (220, 'infection_serology', 'Toxoplasma AB', '14tox', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (221, 'infection_serology', 'TPHA', '14tpha', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (222, 'infection_serology', 'Varicella AB', '14vrc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (223, 'infection_serology', 'Yersinia AB', '14yer', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (224, 'infection_serology', 'E1', '14e1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (225, 'infection_serology', 'E2', '14e2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (226, 'infection_serology', 'E3', '14e3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (227, 'infection_serology', 'E4', '14e4', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (228, 'medicines', 'Amiodaron', '15ami', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (229, 'medicines', 'Barbiturate.i.S.', '15bar', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (230, 'medicines', 'Benzodiazep.i.S.', '15ben', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (231, 'medicines', 'Carbamazepin', '15car', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (232, 'medicines', 'Clonazepam', '15clo', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (233, 'medicines', 'Digitoxin', '15dig', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (234, 'medicines', 'Digoxin', '15dgo', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (235, 'medicines', 'Gentamycin', '15gen', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (236, 'medicines', 'Lithium', '15lit', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (237, 'medicines', 'Phenobarbital', '15phe', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (238, 'medicines', 'Phenytoin', '15pny', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (239, 'medicines', 'Primidon', '15pri', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (240, 'medicines', 'Salicylic acid', '15sal', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (241, 'medicines', 'Theophyllin', '15the', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (242, 'medicines', 'Tobramycin', '15tob', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (243, 'medicines', 'Valproin acid', '15val', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (244, 'medicines', 'Vancomycin', '15van', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (245, 'medicines', 'Amphetamine.i.u.', '15amp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (246, 'medicines', 'Antidepressant.i.u.', '15ant', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (247, 'medicines', 'Barbiturate.i.u.', '15bau', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (248, 'medicines', 'Benzodiazep.i.u.', '15beu', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (249, 'medicines', 'Cannabinol.i.u.', '15can', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (250, 'medicines', 'Cocain.i.u', '15coc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (251, 'medicines', 'Methadon.i.u.', '15met', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (252, 'medicines', 'Opiate.i.u.', '15opi', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (253, 'prenatal', 'Chlamyd.cult./SSW', '16chl', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (254, 'prenatal', 'SSW:', '16ssw', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (255, 'prenatal', 'Down Screening', '16dow', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (256, 'prenatal', 'Strep B quick test', '16stb', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (257, 'prenatal', 'TPHA', '16tpha', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (258, 'prenatal', 'HBs Ag', '16hbs', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (259, 'prenatal', 'HIV1/HIV2 AV', '16hiv', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (260, 'stool', 'Chymotrypsin', '17chy', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (261, 'stool', 'Occult blood 1', '17ob1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (262, 'stool', 'Occult blood 2', '17ob2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (263, 'stool', 'Occult blood 3', '17ob3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (264, 'rare', 'Rare H.', '18rh', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (265, 'rare', 'Rare E.', '18re', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182156', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (266, 'rare', 'Rare S.', '18rs', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (267, 'rare', 'Urine rare', '18uri', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (268, 'rare', 'F1', '18f1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (269, 'rare', 'F2', '18f2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (270, 'rare', 'F3', '18f3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (271, 'urine', 'Urine amylase', '19amy', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (272, 'urine', 'Urine sugar', '19sug', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (273, 'urine', 'Protein.i.u.', '19pro', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (274, 'urine', 'Albumin.i.u.', '19alb', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (275, 'urine', 'Osmol.i.u.', '19osm', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (276, 'urine', 'Pregnancy test.', '19pre', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (277, 'urine', 'Cytomeg.i.urine', '19cym', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (278, 'urine', 'Urine cytology', '19cyt', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (279, 'urine', 'Bence Jones', '19bj', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (280, 'urine', 'Urine elpho', '19elp', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (281, 'urine', 'Beta2 microglobulin.i.u.', '19bm2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (282, 'total_urine', 'Addis Count', '20adc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (283, 'total_urine', 'Sodium i.u.', '20na', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (284, 'total_urine', 'Potass. i.u.', '20k', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (285, 'total_urine', 'Calcium i.u.', '20ca', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (286, 'total_urine', 'Phospor i.u.', '20pho', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (287, 'total_urine', 'Uric acid i.u.', '20ura', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (288, 'total_urine', 'Creatinin i.u.', '20cre', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (289, 'total_urine', 'Porphyrine i.u.', '20por', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (290, 'total_urine', 'Cortisol i.u.', '20cor', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (291, 'total_urine', 'Hydroxyprolin i.u.', '20hyd', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (292, 'total_urine', 'Catecholamins i.u.', '20cat', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (293, 'total_urine', 'Pancreol.', '20pan', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (294, 'total_urine', 'Gamma Aminoläbulinsre.i.u.', '20gam', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (295, 'special_params', 'Blood alcohol', '21bal', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (296, 'special_params', 'CDT', '21cdt', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (297, 'special_params', 'Vitamin B12', '21vb12', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (298, 'special_params', 'Folic acid', '21fol', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (299, 'special_params', 'Insulin AB', '21inab', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (300, 'special_params', 'Intrinsic AB', '21iab', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (301, 'special_params', 'Stone analysis', '21sto', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (302, 'special_params', 'ACE', '21ace', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (303, 'special_params', 'G1', '21g1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (304, 'special_params', 'G2', '21g2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (305, 'special_params', 'G3', '21g3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (306, 'special_params', 'G4', '21g4', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (307, 'special_params', 'G5', '21g5', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (308, 'special_params', 'G6', '21g6', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (309, 'special_params', 'G7', '21g7', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (310, 'special_params', 'G8', '21g8', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (311, 'special_params', 'G9', '21g9', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');
INSERT INTO `care_test_param` VALUES (312, 'special_params', 'G10', '21g10', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '20030711182157', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_request_baclabor`
-- 

CREATE TABLE `care_test_request_baclabor` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `material` text NOT NULL,
  `test_type` text NOT NULL,
  `material_note` tinytext NOT NULL,
  `diagnosis_note` tinytext NOT NULL,
  `immune_supp` tinyint(4) NOT NULL default '0',
  `send_date` date NOT NULL default '0000-00-00',
  `sample_date` date NOT NULL default '0000-00-00',
  `status` varchar(10) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`),
  KEY `send_date` (`send_date`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_test_request_baclabor`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_request_blood`
-- 

CREATE TABLE `care_test_request_blood` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `blood_group` varchar(10) NOT NULL default '',
  `rh_factor` varchar(10) NOT NULL default '',
  `kell` varchar(10) NOT NULL default '',
  `date_protoc_nr` varchar(45) NOT NULL default '',
  `pure_blood` varchar(15) NOT NULL default '',
  `red_blood` varchar(15) NOT NULL default '',
  `leukoless_blood` varchar(15) NOT NULL default '',
  `washed_blood` varchar(15) NOT NULL default '',
  `prp_blood` varchar(15) NOT NULL default '',
  `thrombo_con` varchar(15) NOT NULL default '',
  `ffp_plasma` varchar(15) NOT NULL default '',
  `transfusion_dev` varchar(15) NOT NULL default '',
  `match_sample` tinyint(4) NOT NULL default '0',
  `transfusion_date` date NOT NULL default '0000-00-00',
  `diagnosis` tinytext NOT NULL,
  `notes` tinytext NOT NULL,
  `send_date` date NOT NULL default '0000-00-00',
  `doctor` varchar(35) NOT NULL default '',
  `phone_nr` varchar(40) NOT NULL default '',
  `status` varchar(10) NOT NULL default '',
  `blood_pb` tinytext NOT NULL,
  `blood_rb` tinytext NOT NULL,
  `blood_llrb` tinytext NOT NULL,
  `blood_wrb` tinytext NOT NULL,
  `blood_prp` tinyblob NOT NULL,
  `blood_tc` tinytext NOT NULL,
  `blood_ffp` tinytext NOT NULL,
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
  `x_test_1_name` varchar(35) NOT NULL default '',
  `x_test_1_count` mediumint(9) NOT NULL default '0',
  `x_test_1_price` float(10,2) NOT NULL default '0.00',
  `x_test_2_code` mediumint(9) NOT NULL default '0',
  `x_test_2_name` varchar(35) NOT NULL default '',
  `x_test_2_count` mediumint(9) NOT NULL default '0',
  `x_test_2_price` float(10,2) NOT NULL default '0.00',
  `x_test_3_code` mediumint(9) NOT NULL default '0',
  `x_test_3_name` varchar(35) NOT NULL default '',
  `x_test_3_count` mediumint(9) NOT NULL default '0',
  `x_test_3_price` float(10,2) NOT NULL default '0.00',
  `lab_stamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `release_via` varchar(20) NOT NULL default '',
  `receipt_ack` varchar(20) NOT NULL default '',
  `mainlog_nr` varchar(7) NOT NULL default '',
  `lab_nr` varchar(7) NOT NULL default '',
  `mainlog_date` date NOT NULL default '0000-00-00',
  `lab_date` date NOT NULL default '0000-00-00',
  `mainlog_sign` varchar(20) NOT NULL default '',
  `lab_sign` varchar(20) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`),
  KEY `send_date` (`send_date`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_test_request_blood`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_request_chemlabor`
-- 

CREATE TABLE `care_test_request_chemlabor` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` varchar(10) NOT NULL default '',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `parameters` text NOT NULL,
  `doctor_sign` varchar(35) NOT NULL default '',
  `highrisk` smallint(1) NOT NULL default '0',
  `notes` tinytext NOT NULL,
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `sample_time` time NOT NULL default '00:00:00',
  `sample_weekday` smallint(1) NOT NULL default '0',
  `status` varchar(15) NOT NULL default '',
  `history` text,
  `bill_number` bigint(20) default NULL,
  `bill_status` varchar(10) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=10000001 ;

-- 
-- Daten für Tabelle `care_test_request_chemlabor`
-- 

INSERT INTO `care_test_request_chemlabor` VALUES (10000000, 2005500000, '', 0, '_task28_=1', '', 0, '', '2005-09-05 09:39:53', '09:30:00', 1, 'pending', 'Create: 2005-09-05 09:39:53 = admin\n', 2, 'pending', 'admin', '20050905164744', 'admin', '20050905093953');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_request_generic`
-- 

CREATE TABLE `care_test_request_generic` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `testing_dept` varchar(35) NOT NULL default '',
  `visit` tinyint(1) NOT NULL default '0',
  `order_patient` tinyint(1) NOT NULL default '0',
  `diagnosis_quiry` text NOT NULL,
  `send_date` date NOT NULL default '0000-00-00',
  `send_doctor` varchar(35) NOT NULL default '',
  `result` text NOT NULL,
  `result_date` date NOT NULL default '0000-00-00',
  `result_doctor` varchar(35) NOT NULL default '',
  `status` varchar(10) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`),
  KEY `batch_nr` (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`send_date`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_test_request_generic`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_request_patho`
-- 

CREATE TABLE `care_test_request_patho` (
  `batch_nr` int(11) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `quick_cut` tinyint(4) NOT NULL default '0',
  `qc_phone` varchar(40) NOT NULL default '',
  `quick_diagnosis` tinyint(4) NOT NULL default '0',
  `qd_phone` varchar(40) NOT NULL default '',
  `material_type` varchar(25) NOT NULL default '',
  `material_desc` text NOT NULL,
  `localization` tinytext NOT NULL,
  `clinical_note` tinytext NOT NULL,
  `extra_note` tinytext NOT NULL,
  `repeat_note` tinytext NOT NULL,
  `gyn_last_period` varchar(25) NOT NULL default '',
  `gyn_period_type` varchar(25) NOT NULL default '',
  `gyn_gravida` varchar(25) NOT NULL default '',
  `gyn_menopause_since` varchar(25) NOT NULL default '0',
  `gyn_hysterectomy` varchar(25) NOT NULL default '0',
  `gyn_contraceptive` varchar(25) NOT NULL default '0',
  `gyn_iud` varchar(25) NOT NULL default '',
  `gyn_hormone_therapy` varchar(25) NOT NULL default '',
  `doctor_sign` varchar(35) NOT NULL default '',
  `op_date` date NOT NULL default '0000-00-00',
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(10) NOT NULL default '',
  `entry_date` date NOT NULL default '0000-00-00',
  `journal_nr` varchar(15) NOT NULL default '',
  `blocks_nr` int(11) NOT NULL default '0',
  `deep_cuts` int(11) NOT NULL default '0',
  `special_dye` varchar(35) NOT NULL default '',
  `immune_histochem` varchar(35) NOT NULL default '',
  `hormone_receptors` varchar(35) NOT NULL default '',
  `specials` varchar(35) NOT NULL default '',
  `history` text,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  `process_id` varchar(35) NOT NULL default '',
  `process_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `send_date` (`send_date`)
) TYPE=MyISAM AUTO_INCREMENT=20000001 ;

-- 
-- Daten für Tabelle `care_test_request_patho`
-- 

INSERT INTO `care_test_request_patho` VALUES (20000000, 2005000001, 0, 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '<y', '2005-05-09', '2005-05-09 12:59:03', 'pending', '0000-00-00', '', 0, 0, '', '', '', '', 'Create: 2005-05-09 12:59:03 = admin\n', '', '20050509125903', 'admin', '20050509125903', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_test_request_radio`
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
  `clinical_info` text NOT NULL,
  `test_request` text NOT NULL,
  `send_date` date NOT NULL default '0000-00-00',
  `send_doctor` varchar(35) NOT NULL default '0',
  `xray_nr` varchar(9) NOT NULL default '0',
  `r_cm_2` varchar(15) NOT NULL default '',
  `mtr` varchar(35) NOT NULL default '',
  `xray_date` date NOT NULL default '0000-00-00',
  `xray_time` time NOT NULL default '00:00:00',
  `results` text NOT NULL,
  `results_date` date NOT NULL default '0000-00-00',
  `results_doctor` varchar(35) NOT NULL default '',
  `status` varchar(10) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  `process_id` varchar(35) NOT NULL default '',
  `process_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`),
  UNIQUE KEY `batch_nr_2` (`batch_nr`),
  KEY `batch_nr` (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`xray_time`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_test_request_radio`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_anaesthesia`
-- 

CREATE TABLE `care_type_anaesthesia` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) default NULL,
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Daten für Tabelle `care_type_anaesthesia`
-- 

INSERT INTO `care_type_anaesthesia` VALUES (1, 'none', 'None', 'LDNone', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_anaesthesia` VALUES (2, 'unknown', 'Unknown', 'LDUnknown', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_anaesthesia` VALUES (3, 'general', 'General', 'LDGeneral', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_anaesthesia` VALUES (4, 'spinal', 'Spinal', 'LDSpinal', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_anaesthesia` VALUES (5, 'epidural', 'Epidural', 'LDEpidural', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_anaesthesia` VALUES (6, 'pudendal', 'Pudendal', 'LDPudendal', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_application`
-- 

CREATE TABLE `care_type_application` (
  `nr` int(11) NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) default NULL,
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=12 ;

-- 
-- Daten für Tabelle `care_type_application`
-- 

INSERT INTO `care_type_application` VALUES (1, 5, 'ita', 'ITA', 'LDITA', 'Intratracheal anesthesia', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_application` VALUES (2, 5, 'la', 'LA', 'LDLA', 'Locally applied anesthesia', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_application` VALUES (3, 5, 'as', 'AS', 'LDAS', 'Analgesic sedation', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_application` VALUES (4, 5, 'mask', 'Mask', 'LDMask', 'Gas anesthesia through breathing mask', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_application` VALUES (5, 6, 'oral', 'Oral', 'LDOral', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_application` VALUES (6, 6, 'iv', 'Intravenous', 'LDIntravenous', '', '', '', '00000000000000', 'preload', '00000000000000');
INSERT INTO `care_type_application` VALUES (7, 6, 'sc', 'Subcutaneous', 'LDSubcutaneous', '', '', '', '00000000000000', 'preload', '00000000000000');
INSERT INTO `care_type_application` VALUES (8, 6, 'im', 'Intramuscular', 'LDIntramuscular', '', '', '', '00000000000000', 'preload', '00000000000000');
INSERT INTO `care_type_application` VALUES (9, 6, 'sublingual', 'Sublingual', 'LDSublingual', 'Applied under the tounge', '', '', '00000000000000', 'preload', '00000000000000');
INSERT INTO `care_type_application` VALUES (10, 6, 'ia', 'Intraarterial', 'LDIntraArterial', '', '', '', '00000000000000', 'preload', '00000000000000');
INSERT INTO `care_type_application` VALUES (11, 6, 'pre_admit', 'Pre-admission', 'LDPreAdmission', '', '', '', '00000000000000', 'preload', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_assignment`
-- 

CREATE TABLE `care_type_assignment` (
  `type_nr` int(10) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(25) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`type`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_type_assignment`
-- 

INSERT INTO `care_type_assignment` VALUES (1, 'ward', 'Ward', 'LDWard', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_assignment` VALUES (2, 'dept', 'Department', 'LDDepartment', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_assignment` VALUES (3, 'firm', 'Firm', 'LDFirm', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_assignment` VALUES (4, 'clinic', 'Clinic', 'LDClinic', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_cause_opdelay`
-- 

CREATE TABLE `care_type_cause_opdelay` (
  `type_nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `cause` varchar(255) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Daten für Tabelle `care_type_cause_opdelay`
-- 

INSERT INTO `care_type_cause_opdelay` VALUES (1, 'patient', 'Patient was delayed', 'LDPatientDelayed', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_cause_opdelay` VALUES (2, 'nurse', 'Nurses were delayed', 'LDNursesDelayed', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_cause_opdelay` VALUES (3, 'surgeon', 'Surgeons were delayed', 'LDSurgeonsDelayed', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_cause_opdelay` VALUES (4, 'cleaning', 'Cleaning delayed', 'LDCleaningDelayed', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_cause_opdelay` VALUES (5, 'anesthesia', 'Anesthesiologist was delayed', 'LDAnesthesiologistDelayed', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_cause_opdelay` VALUES (6, 'other', 'Other causes', 'LDOtherCauses', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_color`
-- 

CREATE TABLE `care_type_color` (
  `color_id` varchar(25) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  PRIMARY KEY  (`color_id`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_type_color`
-- 

INSERT INTO `care_type_color` VALUES ('yellow', 'yellow', 'LDyellow', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('black', 'black', 'LDblack', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('blue_pale', 'pale blue', 'LDpaleblue', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('brown', 'brown', 'LDbrown', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('pink', 'pink', 'LDpink', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('yellow_pale', 'pale yellow', 'LDpaleyellow', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('red', 'red', 'LDred', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('green_pale', 'pale green', 'LDpalegreen', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('violet', 'violet', 'LDviolet', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('blue', 'blue', 'LDblue', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('biege', 'biege', 'LDbiege', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('orange', 'orange', 'LDorange', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('green', 'green', 'LDgreen', '', '', '00000000000000');
INSERT INTO `care_type_color` VALUES ('rose', 'rose', 'LDrose', '', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_department`
-- 

CREATE TABLE `care_type_department` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `type` (`type`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Daten für Tabelle `care_type_department`
-- 

INSERT INTO `care_type_department` VALUES (1, 'medical', 'Medical', 'LDMedical', 'Medical, Nursing, Diagnostics, Labs, OR', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_department` VALUES (2, 'support', 'Support (non-medical)', 'LDSupport', 'non-medical departments', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_department` VALUES (3, 'news', 'News', 'LDNews', 'News group or category', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_discharge`
-- 

CREATE TABLE `care_type_discharge` (
  `nr` smallint(3) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(100) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=9 ;

-- 
-- Daten für Tabelle `care_type_discharge`
-- 

INSERT INTO `care_type_discharge` VALUES (1, 'regular', 'Regular discharge', 'LDRegularRelease', '', '', '20030415020555', '', '20030413131226');
INSERT INTO `care_type_discharge` VALUES (2, 'own', 'Patient left hospital on his own will', 'LDSelfRelease', '', '', '20030415020606', '', '20030413131317');
INSERT INTO `care_type_discharge` VALUES (3, 'emergency', 'Emergency discharge', 'LDEmRelease', '', '', '20030415020617', '', '20030413131452');
INSERT INTO `care_type_discharge` VALUES (4, 'change_ward', 'Change of ward', 'LDChangeWard', '', '', '00000000000000', '', '20030413131526');
INSERT INTO `care_type_discharge` VALUES (6, 'change_bed', 'Change of bed', 'LDChangeBed', '', '', '20030415010942', '', '20030413131619');
INSERT INTO `care_type_discharge` VALUES (7, 'death', 'Death of patient', 'LDPatientDied', '', '', '20030415020642', '', '00000000000000');
INSERT INTO `care_type_discharge` VALUES (5, 'change_room', 'Change of room', 'LDChangeRoom', '', '', '20030415020659', '', '00000000000000');
INSERT INTO `care_type_discharge` VALUES (8, 'change_dept', 'Change of department', 'LDChangeDept', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_duty`
-- 

CREATE TABLE `care_type_duty` (
  `type_nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Daten für Tabelle `care_type_duty`
-- 

INSERT INTO `care_type_duty` VALUES (1, 'regular', 'Regular duty', 'LDRegularDuty', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_duty` VALUES (2, 'standby', 'Standby duty', 'LDStandbyDuty', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_duty` VALUES (3, 'morning', 'Morning duty', 'LDMorningDuty', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_duty` VALUES (4, 'afternoon', 'Afternoon duty', 'LDAfternoonDuty', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_duty` VALUES (5, 'night', 'Night duty', 'LDNightDuty', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_encounter`
-- 

CREATE TABLE `care_type_encounter` (
  `type_nr` int(10) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(25) NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `hide_from` tinyint(4) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`type_nr`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Daten für Tabelle `care_type_encounter`
-- 

INSERT INTO `care_type_encounter` VALUES (1, 'referral', 'Referral', 'LDEncounterReferral', 'Referral admission or visit', 0, '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_encounter` VALUES (2, 'emergency', 'Emergency', 'LDEmergency', 'Emergency admission or visit', 0, '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_encounter` VALUES (3, 'birth_delivery', 'Birth delivery', 'LDBirthDelivery', 'Admission or visit for birth delivery', 0, '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_encounter` VALUES (4, 'walk_in', 'Walk-in', 'LDWalkIn', 'Walk -in admission or visit (non-referred)', 0, '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_encounter` VALUES (5, 'accident', 'Accident', 'LDAccident', 'Emergency admission due to accident', 0, '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_ethnic_orig`
-- 

CREATE TABLE `care_type_ethnic_orig` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `class_nr` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `type` (`class_nr`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- Daten für Tabelle `care_type_ethnic_orig`
-- 

INSERT INTO `care_type_ethnic_orig` VALUES (1, 1, 'asian', 'LDAsian', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_ethnic_orig` VALUES (2, 1, 'black', 'LDBlack', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_ethnic_orig` VALUES (3, 1, 'caucasian', 'LDCaucasian', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_ethnic_orig` VALUES (4, 1, 'white', 'LDWhite', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_feeding`
-- 

CREATE TABLE `care_type_feeding` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) default NULL,
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Daten für Tabelle `care_type_feeding`
-- 

INSERT INTO `care_type_feeding` VALUES (1, 2, 'breast', 'Breast', 'LDBreast', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_feeding` VALUES (2, 2, 'formula', 'Formula', 'LDFormula', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_feeding` VALUES (3, 2, 'both', 'Both', 'LDBoth', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_feeding` VALUES (4, 2, 'parenteral', 'Parenteral', 'LDParenteral', '', '', '', '20030727231351', '', '00000000000000');
INSERT INTO `care_type_feeding` VALUES (5, 2, 'never_fed', 'Never fed', 'LDNeverFed', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_immunization`
-- 

CREATE TABLE `care_type_immunization` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(20) NOT NULL default '',
  `name` varchar(20) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `period` smallint(6) default '0',
  `tolerance` smallint(3) default '0',
  `dosage` text,
  `medicine` text NOT NULL,
  `titer` text,
  `note` text,
  `application` tinyint(3) default '0',
  `status` varchar(25) NOT NULL default 'normal',
  `history` text,
  `modify_id` varchar(35) default NULL,
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_type_immunization`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_insurance`
-- 

CREATE TABLE `care_type_insurance` (
  `type_nr` int(11) NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(60) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- Daten für Tabelle `care_type_insurance`
-- 

INSERT INTO `care_type_insurance` VALUES (1, 'medical_main', 'Medical insurance', 'LDMedInsurance', 'Main (default) medical insurance', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (2, 'medical_extra', 'Extra medical insurance', 'LDExtraMedInsurance', 'Extra medical insurance (evt. pays extra services)', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (3, 'dental', 'Dental insurance', 'LDDentalInsurance', 'Separate dental plan in case not included in medical plan or simply additional private plan', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (4, 'disability', 'Disability plan', 'LDDisabilityPlan', 'Disability insurance plan - general , both long term & short term', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (5, 'disability_short', 'Disability plan (short term)', 'LDDisabilityPlanShort', 'Short term disability plan', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (6, 'disability_long', 'Disability plan (long term)', 'LDDisabilityPlanLong', 'Long term disability plan', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (7, 'retirement_income', 'Retirement  income plan (general)', 'LDRetirementIncomePlan', 'Retirement income plan - either private or income/employer supported', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (8, 'edu_reimbursement', 'Educational Reimbursement Plan', 'LDEduReimbursementPlan', 'Reimbursement plan for education, either private or employer supported', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (9, 'retirement_medical', 'Retirement medical plan', 'LDRetirementMedPlan', 'Medical plan in retirement  - might include other care services', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (10, 'liability', 'Liability Insurance Plan', 'LDLiabilityPlan', 'General liability insurance - either private or employer supported', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (11, 'malpractice', 'Malpractice Insurance Plan', 'LDMalpracticeInsurancePlan', 'Insurance plan against possible malpractice', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_insurance` VALUES (12, 'unemployment', 'Unemployment Insurance Plan', 'LDUnemploymentPlan', 'Unemployment insurance , in case compulsory unemployment funds are guaranteed by the state, this plan is usually privately paid by the insured', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_localization`
-- 

CREATE TABLE `care_type_localization` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `category` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `short_code` char(1) NOT NULL default '',
  `LD_var_short_code` varchar(25) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `hide_from` varchar(255) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Daten für Tabelle `care_type_localization`
-- 

INSERT INTO `care_type_localization` VALUES (1, 'left', 'Left', 'LDLeft', 'L', 'LDLeft_s', '', '0', '', '', '', '20030525160414', '', '20030525160414');
INSERT INTO `care_type_localization` VALUES (2, 'right', 'Right', 'LDRight', 'R', 'LDRight_s', '', '0', '', '', '', '20030525160522', '', '20030525160500');
INSERT INTO `care_type_localization` VALUES (3, 'both_side', 'Both sides', 'LDBothSides', 'B', 'LDBothSides_s', '', '0', '', '', '', '20030525160618', '', '20030525160618');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_location`
-- 

CREATE TABLE `care_type_location` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Daten für Tabelle `care_type_location`
-- 

INSERT INTO `care_type_location` VALUES (1, 'dept', 'Department', 'LDDepartment', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_location` VALUES (2, 'ward', 'Ward', 'LDWard', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_location` VALUES (3, 'firm', 'Firm', 'LDFirm', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_location` VALUES (4, 'room', 'Room', 'LDRoom', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_location` VALUES (5, 'bed', 'Bed', 'LDBed', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_location` VALUES (6, 'clinic', 'Clinic', 'LDClinic', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_measurement`
-- 

CREATE TABLE `care_type_measurement` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=10 ;

-- 
-- Daten für Tabelle `care_type_measurement`
-- 

INSERT INTO `care_type_measurement` VALUES (1, 'bp_systolic', 'Systolic', 'LDSystolic', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_measurement` VALUES (2, 'bp_diastolic', 'Diastolic', 'LDDiastolic', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_measurement` VALUES (3, 'temp', 'Temperature', 'LDTemperature', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_measurement` VALUES (4, 'fluid_intake', 'Fluid intake', 'LDFluidIntake', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_measurement` VALUES (5, 'fluid_output', 'Fluid output', 'LDFluidOutput', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_measurement` VALUES (6, 'weight', 'Weight', 'LDWeight', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_measurement` VALUES (7, 'height', 'Height', 'LDHeight', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_measurement` VALUES (8, 'bp_composite', 'Sys/Dias', 'LDSysDias', '', '', '20030419153920', '', '20030419153920');
INSERT INTO `care_type_measurement` VALUES (9, 'head_circumference', 'Head circumference', 'LDHeadCircumference', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_notes`
-- 

CREATE TABLE `care_type_notes` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `sort_nr` smallint(6) NOT NULL default '0',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `type` (`type`)
) TYPE=MyISAM AUTO_INCREMENT=100 ;

-- 
-- Daten für Tabelle `care_type_notes`
-- 

INSERT INTO `care_type_notes` VALUES (1, 'histo_physical', 'Admission History and Physical', 'LDAdmitHistoPhysical', 5, '', '', '20030517192939', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (2, 'daily_doctor', 'Doctor''s daily notes', 'LDDoctorDailyNotes', 55, '', '', '20030517193835', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (3, 'discharge', 'Discharge summary', 'LDDischargeSummary', 50, '', '', '20030517193707', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (4, 'consult', 'Consultation notes', 'LDConsultNotes', 25, '', '', '20030517193151', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (5, 'op', 'Operation notes', 'LDOpNotes', 100, '', '', '20030517194314', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (6, 'daily_ward', 'Daily ward''s notes', 'LDDailyNurseNotes', 30, '', '', '20030517193212', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (7, 'daily_chart_notes', 'Chart notes', 'LDChartNotes', 20, '', '', '20030517193141', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (8, 'chart_notes_etc', 'PT,ATG,etc. daily notes', 'LDPTATGetc', 115, '', '', '20030517194356', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (9, 'daily_iv_notes', 'IV daily notes', 'LDIVDailyNotes', 75, '', '', '20030517194024', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (10, 'daily_anticoag', 'Anticoagulant daily notes', 'LDAnticoagDailyNotes', 15, '', '', '20030517193117', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (11, 'lot_charge_nr', 'Material LOT, Charge Nr.', 'LDMaterialLOTChargeNr', 80, '', '', '20030517194039', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (12, 'text_diagnosis', 'Diagnosis text', 'LDDiagnosis', 40, '', '', '20030517193530', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (13, 'text_therapy', 'Therapy text', 'LDTherapy', 120, '', '', '20030517194408', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (14, 'chart_extra', 'Extra notes on therapy & diagnosis', 'LDExtraNotes', 65, '', '', '20030517193912', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (15, 'nursing_report', 'Nursing care report', 'LDNursingReport', 85, '', '', '20030517194141', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (16, 'nursing_problem', 'Nursing problem report', 'LDNursingProblemReport', 95, '', '', '20030517194208', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (17, 'nursing_effectivity', 'Nursing effectivity report', 'LDNursingEffectivityReport', 90, '', '', '20030517194156', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (18, 'nursing_inquiry', 'Inquiry to doctor', 'LDInquiryToDoctor', 70, '', '', '20030517193951', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (19, 'doctor_directive', 'Doctor''s directive', 'LDDoctorDirective', 60, '', '', '20030517193859', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (20, 'problem', 'Problem', 'LDProblem', 110, '', '', '20030517194345', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (21, 'development', 'Development', 'LDDevelopment', 35, '', '', '20030517193228', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (22, 'allergy', 'Allergy', 'LDAllergy', 10, '', '', '20030517194439', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (23, 'daily_diet', 'Diet plan', 'LDDietPlan', 45, '', '', '20030517193545', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (99, 'other', 'Other', 'LDOther', 105, '', '', '20030517194331', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_outcome`
-- 

CREATE TABLE `care_type_outcome` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Daten für Tabelle `care_type_outcome`
-- 

INSERT INTO `care_type_outcome` VALUES (1, 2, 'alive', 'Alive', 'LDAlive', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_outcome` VALUES (2, 2, 'stillborn', 'Stillborn', 'LDStillborn', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_outcome` VALUES (3, 2, 'early_neonatal_death', 'Early neonatal death', 'LDEarlyNeonatalDeath', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_outcome` VALUES (4, 2, 'late_neonatal_death', 'Late neonatal death', 'LDLateNeonatalDeath', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_outcome` VALUES (5, 2, 'death_uncertain_timing', 'Death uncertain timing', 'LDDeathUncertainTiming', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_perineum`
-- 

CREATE TABLE `care_type_perineum` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Daten für Tabelle `care_type_perineum`
-- 

INSERT INTO `care_type_perineum` VALUES (1, 'intact', 'Intact', 'LDIntact', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_perineum` VALUES (2, '1_degree', '1st degree tear', 'LDFirstDegreeTear', '', '', '', '20030727222219', '', '00000000000000');
INSERT INTO `care_type_perineum` VALUES (3, '2_degree', '2nd degree tear', 'LDSecondDegreeTear', '', '', '', '20030727222231', '', '00000000000000');
INSERT INTO `care_type_perineum` VALUES (4, '3_degree', '3rd degree tear', 'LDThirdDegreeTear', '', '', '', '20030727222242', '', '00000000000000');
INSERT INTO `care_type_perineum` VALUES (5, 'episiotomy', 'Episiotomy', 'LDEpisiotomy', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_prescription`
-- 

CREATE TABLE `care_type_prescription` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- Daten für Tabelle `care_type_prescription`
-- 

INSERT INTO `care_type_prescription` VALUES (1, 'anticoag', 'Anticoagulant', 'LDAnticoagulant', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_prescription` VALUES (2, 'hemolytic', 'Hemolytic', 'LDHemolytic', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_prescription` VALUES (3, 'diuretic', 'Diuretic', 'LDDiuretic', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_prescription` VALUES (4, 'antibiotic', 'Antibiotic', 'LDAntibiotic', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_room`
-- 

CREATE TABLE `care_type_room` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Daten für Tabelle `care_type_room`
-- 

INSERT INTO `care_type_room` VALUES (1, 'ward', 'Ward room', 'LDWard', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_room` VALUES (2, 'op', 'Operating room', 'LDOperatingRoom', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_test`
-- 

CREATE TABLE `care_type_test` (
  `type_nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Daten für Tabelle `care_type_test`
-- 

INSERT INTO `care_type_test` VALUES (1, 'chemlabor', 'Chemical-Serology Lab', 'LDChemSerologyLab', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_test` VALUES (2, 'patho', 'Pathological Lab', 'LDPathoLab', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_test` VALUES (3, 'baclabor', 'Bacteriological Lab', 'LDBacteriologicalLab', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_test` VALUES (4, 'radio', 'Radiological Lab', 'LDRadiologicalLab', 'Lab for X-ray, Mammography, Computer Tomography, NMR', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_test` VALUES (5, 'blood', 'Blood test & product', 'LDBloodTestProduct', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_test` VALUES (6, 'generic', 'Generic test program', 'LDGenericTestProgram', '', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_time`
-- 

CREATE TABLE `care_type_time` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `type` (`type`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- 
-- Daten für Tabelle `care_type_time`
-- 

INSERT INTO `care_type_time` VALUES (1, 'patient_entry_exit', 'Patient entry/exit', 'LDPatientEntryExit', 'Times when patient entered and left the op room', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_time` VALUES (2, 'op_start_end', 'OP start/end', 'LDOPStartEnd', 'Times when op started (1st incision) and ended (last suture)', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_time` VALUES (3, 'delay', 'Delay time', 'LDDelayTime', 'Times when the op was delayed due to any reason', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_time` VALUES (4, 'plaster_cast', 'Plaster cast', 'LDPlasterCast', 'Times when the plaster cast was made', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_time` VALUES (5, 'reposition', 'Reposition', 'LDReposition', 'Times when a dislocated joint(s) was repositioned (non invasive op)', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_time` VALUES (6, 'coro', 'Coronary catheter', 'LDCoronaryCatheter', 'Times when a coronary catherer op was done (minimal invasive op)', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_time` VALUES (7, 'bandage', 'Bandage', 'LDBandage', 'Times when the bandage was made', '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_type_unit_measurement`
-- 

CREATE TABLE `care_type_unit_measurement` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `type` (`type`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Daten für Tabelle `care_type_unit_measurement`
-- 

INSERT INTO `care_type_unit_measurement` VALUES (1, 'volume', 'Volume', 'LDVolume', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_unit_measurement` VALUES (2, 'weight', 'Weight', 'LDWeight', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_unit_measurement` VALUES (3, 'length', 'Length', 'LDLength', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_unit_measurement` VALUES (4, 'pressure', 'Pressure', 'LDPressure', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_type_unit_measurement` VALUES (5, 'temperature', 'Temperature', 'LDTemperature', '', '', '', '20030419154724', '', '20030419154724');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_billing`
-- 

CREATE TABLE `care_tz_billing` (
  `nr` bigint(20) NOT NULL auto_increment,
  `encounter_nr` bigint(20) NOT NULL default '0',
  `first_date` bigint(20) NOT NULL default '0',
  `create_id` varchar(35) NOT NULL default '',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Daten für Tabelle `care_tz_billing`
-- 

INSERT INTO `care_tz_billing` VALUES (1, 2005500006, 1125064915, '');
INSERT INTO `care_tz_billing` VALUES (2, 2005500000, 1125931664, '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_billing_archive`
-- 

CREATE TABLE `care_tz_billing_archive` (
  `id` bigint(20) NOT NULL auto_increment,
  `nr` bigint(20) NOT NULL default '0',
  `encounter_nr` bigint(20) NOT NULL default '0',
  `first_date` bigint(20) NOT NULL default '0',
  `create_id` varchar(35) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `nr` (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_tz_billing_archive`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_billing_archive_elem`
-- 

CREATE TABLE `care_tz_billing_archive_elem` (
  `ID` bigint(20) NOT NULL auto_increment,
  `nr` bigint(20) NOT NULL default '0',
  `date_change` bigint(20) NOT NULL default '0',
  `is_labtest` tinyint(4) NOT NULL default '0',
  `is_medicine` tinyint(4) NOT NULL default '0',
  `is_comment` tinyint(4) NOT NULL default '0',
  `is_paid` tinyint(4) NOT NULL default '0',
  `amount` bigint(20) NOT NULL default '0',
  `price` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `item_number` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `nr` (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_tz_billing_archive_elem`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_billing_elem`
-- 

CREATE TABLE `care_tz_billing_elem` (
  `ID` bigint(20) NOT NULL auto_increment,
  `nr` bigint(20) NOT NULL default '0',
  `date_change` bigint(20) NOT NULL default '0',
  `is_labtest` tinyint(4) NOT NULL default '0',
  `is_medicine` tinyint(4) NOT NULL default '0',
  `is_comment` tinyint(4) NOT NULL default '0',
  `is_paid` tinyint(4) NOT NULL default '0',
  `amount` bigint(20) NOT NULL default '0',
  `price` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `item_number` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `nr` (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Daten für Tabelle `care_tz_billing_elem`
-- 

INSERT INTO `care_tz_billing_elem` VALUES (1, 1, 1125064915, 0, 1, 0, 0, 2, '500', 'Acetazolamide Tablet(Acetazolamide Tablet)', 0);
INSERT INTO `care_tz_billing_elem` VALUES (2, 2, 1125931664, 1, 0, 0, 0, 1, '', 'Platelet count', 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_drugsandservices`
-- 

CREATE TABLE `care_tz_drugsandservices` (
  `item_id` bigint(20) NOT NULL auto_increment,
  `item_number` varchar(50) NOT NULL default '',
  `is_pediatric` smallint(6) NOT NULL default '0',
  `is_adult` smallint(6) NOT NULL default '0',
  `is_other` smallint(6) NOT NULL default '0',
  `is_consumable` smallint(6) NOT NULL default '0',
  `item_code` varchar(255) NOT NULL default '',
  `item_description` varchar(255) NOT NULL default '',
  `pack_size` varchar(255) NOT NULL default '',
  `price_per_pack_size` double NOT NULL default '0',
  `sizes` varchar(50) NOT NULL default '',
  `item_description` varchar(255) NOT NULL default '',
  `item_full_description` varchar(255) NOT NULL default '',
  `dosage` varchar(50) NOT NULL default '',
  `unit_price` varchar(50) NOT NULL default '',
  `purchasing_class` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`item_id`)
) TYPE=MyISAM AUTO_INCREMENT=42 ;

-- 
-- Daten für Tabelle `care_tz_drugsandservices`
-- 

INSERT INTO `care_tz_drugsandservices` VALUES (1, '4711', 0, 0, 0, 0, '1', 'Acetic acid,  glacial, GPR grade, 100ml', '1', 1.344, '', 'Acetic acid', '', '', '500', 'drug_list');
INSERT INTO `care_tz_drugsandservices` VALUES (2, '4712', 0, 0, 0, 0, '1', 'Acid Phosphatase,Test Kit,', '1', 42, '', 'Acid Phosphatase,Test Kit,', '', '', '500', 'supplies');
INSERT INTO `care_tz_drugsandservices` VALUES (3, '4713', 0, 0, 0, 0, '1', 'Acetic acid,  glacial, GPR grade, 100ml', '', 1.344, '1', 'Acetic acid, glacial, GPR grade', '', '', '500', 'supplies_laboratory');
INSERT INTO `care_tz_drugsandservices` VALUES (4, '4714', 1, 1, 1, 1, '1', 'Acetazolamide Tablet 250mg', '', 6, '', 'Acetazolamide Tablet', '', '', '500', 'drug_list');
INSERT INTO `care_tz_drugsandservices` VALUES (5, '4899', 0, 1, 0, 0, '2', 'Acyclovir Tablet 200mg Tab', '50', 1000, '', 'Acyclovir Tablet', '', '', '500', 'drug_list');
INSERT INTO `care_tz_drugsandservices` VALUES (40, '9999', 1, 1, 0, 0, '', '', '', 0, '', 'as', '', '', '', 'drug_list');
INSERT INTO `care_tz_drugsandservices` VALUES (39, '007', 1, 0, 0, 0, '', '', '', 0, '', '200', '', '', '200', 'supplies');
INSERT INTO `care_tz_drugsandservices` VALUES (38, 't', 1, 1, 1, 1, '', '', '', 0, '', 't', 't', '', 't', 'drug_list');
INSERT INTO `care_tz_drugsandservices` VALUES (41, '12', 0, 1, 0, 0, '', '', '', 0, '', '12', '12', '', '12', 'supplies_laboratory');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_laboratory`
-- 

CREATE TABLE `care_tz_laboratory` (
  `id` bigint(20) NOT NULL auto_increment,
  `encounter_nr` bigint(20) NOT NULL default '0',
  `care_tz_laboratory_tests_id` bigint(20) NOT NULL default '0',
  `timestamp` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `care_tz_laboratory_tests_id` (`care_tz_laboratory_tests_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_tz_laboratory`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_laboratory_param`
-- 

CREATE TABLE `care_tz_laboratory_param` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `group_id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `id` varchar(10) NOT NULL default '',
  `msr_unit` varchar(15) NOT NULL default '',
  `median` varchar(20) default NULL,
  `hi_bound` varchar(20) default NULL,
  `lo_bound` varchar(20) default NULL,
  `hi_critical` varchar(20) default NULL,
  `lo_critical` varchar(20) default NULL,
  `hi_toxic` varchar(20) default NULL,
  `lo_toxic` varchar(20) default NULL,
  `add_type` varchar(255) NOT NULL default '',
  `add_label` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  `price` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=83 ;

-- 
-- Daten für Tabelle `care_tz_laboratory_param`
-- 

INSERT INTO `care_tz_laboratory_param` VALUES (1, '1', 'Amylase', '9', 'mm/s', '50', '55', '45', '60', '40', '65', '35', '', '', '', 'CONCAT(history,''Update 2005-05-16 14:34:56 admin\n'')', 'admin', '20050516143456', '', '00000000000000', '12,00');
INSERT INTO `care_tz_laboratory_param` VALUES (2, '1', 'Bilirubin, direct', '10', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:33:44 admin\n'')', 'admin', '20050518183344', '', '00000000000000', '24,00');
INSERT INTO `care_tz_laboratory_param` VALUES (3, '1', 'Bilirubin, total', '11', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:34:08 admin\n'')', 'admin', '20050518183408', '', '00000000000000', '72,00');
INSERT INTO `care_tz_laboratory_param` VALUES (4, '1', 'BUN', '12', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:34:14 admin\n'')', 'admin', '20050518183414', '', '00000000000000', '13,00');
INSERT INTO `care_tz_laboratory_param` VALUES (5, '1', 'Creatinine', '13', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:34:20 admin\n'')', 'admin', '20050518183420', '', '00000000000000', '55,00');
INSERT INTO `care_tz_laboratory_param` VALUES (6, '1', 'Glucose, fasting (FBG)', '14', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:41:24 admin\n'')', 'admin', '20050518184124', '', '00000000000000', '52,00');
INSERT INTO `care_tz_laboratory_param` VALUES (7, '1', 'Glucose, random (RBG)', '15', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:34:30 admin\n'')', 'admin', '20050518183430', '', '00000000000000', '93,00');
INSERT INTO `care_tz_laboratory_param` VALUES (8, '1', 'Potassium', '16', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:41:34 admin\n'')', 'admin', '20050518184134', '', '00000000000000', '14,15');
INSERT INTO `care_tz_laboratory_param` VALUES (9, '1', 'SGOT', '17', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:41:40 admin\n'')', 'admin', '20050518184140', '', '00000000000000', '15,17');
INSERT INTO `care_tz_laboratory_param` VALUES (10, '1', 'SGPT', '18', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:41:50 admin\n'')', 'admin', '20050518184150', '', '00000000000000', '133,20');
INSERT INTO `care_tz_laboratory_param` VALUES (11, '1', 'Sodium', '19', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-06-03 10:34:00 admin\n'')', 'admin', '20050603103400', '', '00000000000000', '15,00');
INSERT INTO `care_tz_laboratory_param` VALUES (12, '1', 'Uric acid', '20', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-06-03 10:34:42 admin\n'')', 'admin', '20050603103442', '', '00000000000000', '15,00');
INSERT INTO `care_tz_laboratory_param` VALUES (13, '2', 'Urinalysis', '21', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (14, '2', 'Urine pregnancy test', '22', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (15, '2', '24-hour protein excretion', '23', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (16, '3', 'Complete blood count (CBC)', '24', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (17, '3', 'Hemoglobin (Hb)', '25', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (18, '3', 'White blood count (WBC)', '26', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (19, '3', 'Differential WBC', '27', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (20, '3', 'Platelet count', '28', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (21, '3', 'Reticulocyte count', '29', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (22, '3', 'Sedimentation rate (ESR)', '30', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (23, '3', 'Sickle cell test', '31', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (24, '3', 'Malaria smear (B/S)', '32', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (25, '3', 'Blood morphology', '33', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (26, '3', 'WBC, body fluid', '34', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:05:49 admin\n', 'admin', '20050310150549', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (27, '3', 'Differential WBC, body fluid', '35', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:05:36 admin\n', 'admin', '20050310150536', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (28, '4', 'ASOT', '36', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (29, '4', 'Brucella test', '37', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (30, '4', 'Hepatitis B', '38', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (31, '4', 'HIV', '39', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (32, '4', 'Quick strep test', '40', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (33, '4', 'VDRL', '41', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (34, '5', 'Analysis (WBC, parasites)', '42', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (35, '5', 'Occult blood', '43', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (36, '6', 'AFB (tuberculosis) No. 1', '44', '', '', '', '', '', '', '', '', 'checkbox', 'follow up', '', 'CONCAT(history,''Update 2005-05-18 18:42:23 admin\n'')', 'admin', '20050518184223', '', '00000000000000', '21,00');
INSERT INTO `care_tz_laboratory_param` VALUES (37, '6', 'Cerebrospinal fluid analysis', '45', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:42:44 admin\n'')', 'admin', '20050518184244', '', '00000000000000', '6,50');
INSERT INTO `care_tz_laboratory_param` VALUES (38, '6', 'Culture, body fluid', '46', '', '', '', '', '', '', '', '', 'text', 'specify site', '', 'CONCAT(history,''Update 2005-05-18 18:42:56 admin\n'')', 'admin', '20050518184256', '', '00000000000000', '23,30');
INSERT INTO `care_tz_laboratory_param` VALUES (39, '6', 'Culture, blood', '47', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:42:49 admin\n'')', 'admin', '20050518184249', '', '00000000000000', '1,00');
INSERT INTO `care_tz_laboratory_param` VALUES (40, '6', 'Culture, urine', '48', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:43:01 admin\n'')', 'admin', '20050518184301', '', '00000000000000', '12,20');
INSERT INTO `care_tz_laboratory_param` VALUES (41, '6', 'Sensitivities, bacterial', '49', '', '', '', '', '', '', '', '', 'text', 'specify site', '', 'CONCAT(history,''Update 2005-05-18 18:43:05 admin\n'')', 'admin', '20050518184305', '', '00000000000000', '4,00');
INSERT INTO `care_tz_laboratory_param` VALUES (42, '7', 'Biopsy', '50', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:06:31 admin\n', 'admin', '20050310150631', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (43, '7', 'H. pylori', '51', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (44, '7', 'Pap smear', '52', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (45, '7', 'Surgical specimen', '53', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:06:19 admin\n', 'admin', '20050310150619', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (46, '8', 'Albumen', '54', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (47, '8', 'Alkaline phosphatase', '55', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (48, '8', 'Bleeding time', '56', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (49, '8', 'Calcium', '57', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (50, '8', 'Chloride', '58', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (51, '8', 'Cortisol, A.M..', '59', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (52, '8', 'Cortisol, P.M', '60', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (53, '8', 'Creatine phosphokinase (CPK)', '61', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (54, '8', 'Cholesterol', '62', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (55, '8', 'Triglycerides', '63', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (56, '8', 'Follicle-stimulating hormone (FSH )', '64', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (57, '8', 'LH', '65', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (58, '8', 'High-density lipoprotein (HDL)', '66', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (59, '8', 'Low-density lipoprotein (LDL)', '67', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (60, '8', 'H. pylori', '68', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (61, '8', 'Human chorionic gonadotropin (HCG)', '69', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (62, '8', 'Iron, serum', '70', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (63, '8', 'iron-binding capacity, serum (IBC)', '71', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (64, '8', 'Prothrombin time (PT)', '72', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (65, '8', 'Partial thromboplastin time (PTT)', '73', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (66, '8', 'Rheumatoid factor', '74', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (67, '8', 'T3', '75', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (68, '8', 'Thyroxin (T4)', '76', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (69, '8', 'Thyroid stimulating factor (TSH)', '77', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (70, '8', 'Proteins, total serum', '78', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000', '');
INSERT INTO `care_tz_laboratory_param` VALUES (71, '6', 'AFB (tuberculosis) No. 2', '80', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:42:30 admin\n'')', 'admin', '20050518184230', '', '00000000000000', '32,30');
INSERT INTO `care_tz_laboratory_param` VALUES (72, '6', 'AFB (tuberculosis) No. 3', '81', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-05-18 18:42:36 admin\n'')', 'admin', '20050518184236', '', '00000000000000', '534,30');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_laboratory_tests`
-- 

CREATE TABLE `care_tz_laboratory_tests` (
  `id` bigint(20) NOT NULL auto_increment,
  `parent` bigint(20) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `is_common` tinyint(4) NOT NULL default '0',
  `is_comment_required` tinyint(4) NOT NULL default '0',
  `comment` varchar(255) NOT NULL default '',
  `price` double NOT NULL default '0',
  `is_enabled` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM PACK_KEYS=0 AUTO_INCREMENT=92 ;

-- 
-- Daten für Tabelle `care_tz_laboratory_tests`
-- 

INSERT INTO `care_tz_laboratory_tests` VALUES (1, -1, 'Chemistries', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (2, -1, 'Urine', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (3, -1, 'Hematology', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (4, -1, 'Serology', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (5, -1, 'Stool', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (6, -1, 'Bacteriology', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (7, -1, 'Pathology', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (8, -1, 'Infrequently ordered tests', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (9, 1, 'Amylase', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (10, 1, 'Bilirubin, direct', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (11, 1, 'Bilirubin, total', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (12, 1, 'BUN', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (13, 1, 'Creatinine', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (14, 1, 'Glucose, fasting (FBG)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (15, 1, 'Glucose, random (RBG)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (16, 1, 'Potassium', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (17, 1, 'SGOT', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (18, 1, 'SGPT', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (19, 1, 'Sodium', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (20, 1, 'Uric acid', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (21, 2, 'Urinalysis', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (22, 2, 'Urine pregnancy test', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (23, 2, '24-hour protein excretion', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (24, 3, 'Complete blood count (CBC)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (25, 3, 'Hemoglobin (Hb)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (26, 3, 'White blood count (WBC)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (27, 3, 'Differential WBC', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (28, 3, 'Platelet count', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (29, 3, 'Reticulocyte count', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (30, 3, 'Sedimentation rate (ESR)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (31, 3, 'Sickle cell test', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (32, 3, 'Malaria smear (B/S)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (33, 3, 'Blood morphology', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (34, 3, 'WBC, body fluid', 0, 1, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (35, 3, 'Differential WBC, body fluid', 0, 1, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (36, 4, 'ASOT', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (37, 4, 'Brucella test', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (38, 4, 'Hepatitis B', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (39, 4, 'HIV', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (40, 4, 'Quick strep test', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (41, 4, 'VDRL', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (42, 5, 'Analysis (WBC, parasites)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (43, 5, 'Occult blood', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (44, 6, 'AFB (tuberculosis) No. 1', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (45, 6, 'Cerebrospinal fluid analysis', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (46, 6, 'Culture, body fluid', 0, 1, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (47, 6, 'Culture, blood', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (48, 6, 'Culture, urine', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (49, 6, 'Sensitivities, bacterial', 0, 1, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (50, 7, 'Biopsy', 0, 1, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (51, 7, 'H. pylori', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (52, 7, 'Pap smear', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (53, 7, 'Surgical specimen', 0, 1, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (54, 8, 'Albumen', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (55, 8, 'Alkaline phosphatase', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (56, 8, 'Bleeding time', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (57, 8, 'Calcium', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (58, 8, 'Chloride', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (59, 8, 'Cortisol, A.M..', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (60, 8, 'Cortisol, P.M', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (61, 8, 'Creatine phosphokinase (CPK)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (62, 8, 'Cholesterol', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (63, 8, 'Triglycerides', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (64, 8, 'Follicle-stimulating hormone (FSH )', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (65, 8, 'LH', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (66, 8, 'High-density lipoprotein (HDL)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (67, 8, 'Low-density lipoprotein (LDL)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (68, 8, 'H. pylori', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (69, 8, 'Human chorionic gonadotropin (HCG)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (70, 8, 'Iron, serum', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (71, 8, 'iron-binding capacity, serum (IBC)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (72, 8, 'Prothrombin time (PT)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (73, 8, 'Partial thromboplastin time (PTT)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (74, 8, 'Rheumatoid factor', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (75, 8, 'T3', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (76, 8, 'Thyroxin (T4)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (77, 8, 'Thyroid stimulating factor (TSH)', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (78, 8, 'Proteins, total serum', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (80, 6, 'AFB (tuberculosis) No. 2', 0, 0, '', 0, 1);
INSERT INTO `care_tz_laboratory_tests` VALUES (81, 6, 'AFB (tuberculosis) No. 3', 0, 0, '', 0, 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_regions`
-- 

CREATE TABLE `care_tz_regions` (
  `CODE` varchar(6) default NULL,
  `NAME` varchar(30) default NULL
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_tz_regions`
-- 

INSERT INTO `care_tz_regions` VALUES ('ARU', 'Arusha');
INSERT INTO `care_tz_regions` VALUES ('DSM', 'Dar-es-salaam');
INSERT INTO `care_tz_regions` VALUES ('DOD', 'Dodoma');
INSERT INTO `care_tz_regions` VALUES ('BKB', 'Bukoba');
INSERT INTO `care_tz_regions` VALUES ('KIL', 'Kilimanjaro');
INSERT INTO `care_tz_regions` VALUES ('MTW', 'Mtwara');
INSERT INTO `care_tz_regions` VALUES ('SON', 'Songea');
INSERT INTO `care_tz_regions` VALUES ('LIN', 'Lindi');
INSERT INTO `care_tz_regions` VALUES ('SIN', 'Singida');
INSERT INTO `care_tz_regions` VALUES ('TAB', 'Tabora');
INSERT INTO `care_tz_regions` VALUES ('SHI', 'Shinyanga');
INSERT INTO `care_tz_regions` VALUES ('MWA', 'Mwanza');
INSERT INTO `care_tz_regions` VALUES ('KIG', 'Kigoma');
INSERT INTO `care_tz_regions` VALUES ('MUS', 'Musoma');
INSERT INTO `care_tz_regions` VALUES ('TAN', 'Tanga');
INSERT INTO `care_tz_regions` VALUES ('MBE', 'Mbeya');
INSERT INTO `care_tz_regions` VALUES ('IRI', 'Iringa');
INSERT INTO `care_tz_regions` VALUES ('MOR', 'Morogoro');
INSERT INTO `care_tz_regions` VALUES ('MAF', 'Mafia');
INSERT INTO `care_tz_regions` VALUES ('PWA', 'Pwani');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_tz_tribes`
-- 

CREATE TABLE `care_tz_tribes` (
  `tribe_id` bigint(20) NOT NULL auto_increment,
  `tribe_code` varchar(10) NOT NULL default '',
  `tribe_name` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`tribe_id`),
  KEY `tribe_id` (`tribe_id`)
) TYPE=MyISAM AUTO_INCREMENT=131 ;

-- 
-- Daten für Tabelle `care_tz_tribes`
-- 

INSERT INTO `care_tz_tribes` VALUES (1, 'AME', 'AMERICAN');
INSERT INTO `care_tz_tribes` VALUES (2, 'ASI', 'ASIAN');
INSERT INTO `care_tz_tribes` VALUES (3, 'AUST', 'Australian');
INSERT INTO `care_tz_tribes` VALUES (4, 'BAR', 'BARIBARI');
INSERT INTO `care_tz_tribes` VALUES (5, 'BRIT', 'BRITISH');
INSERT INTO `care_tz_tribes` VALUES (6, 'CH', 'CHAGGA');
INSERT INTO `care_tz_tribes` VALUES (7, 'DUT', 'DUTCH');
INSERT INTO `care_tz_tribes` VALUES (8, 'ENGLI', 'ENGLISH');
INSERT INTO `care_tz_tribes` VALUES (9, 'ETH', 'ETHIOPIAN');
INSERT INTO `care_tz_tribes` VALUES (10, 'GER', 'GERMAN');
INSERT INTO `care_tz_tribes` VALUES (11, 'HIN', 'HINDU');
INSERT INTO `care_tz_tribes` VALUES (12, 'IR', 'IRAQ');
INSERT INTO `care_tz_tribes` VALUES (13, 'ITA', 'ITALIAN');
INSERT INTO `care_tz_tribes` VALUES (14, 'JAL', 'JALUO');
INSERT INTO `care_tz_tribes` VALUES (15, 'KAM', 'KAMBA');
INSERT INTO `care_tz_tribes` VALUES (16, 'KIK', 'KIKUYU');
INSERT INTO `care_tz_tribes` VALUES (17, 'KIU', 'KIUSHINI');
INSERT INTO `care_tz_tribes` VALUES (18, 'KYO', 'KYOGA');
INSERT INTO `care_tz_tribes` VALUES (19, 'LUM', 'MLUGULU');
INSERT INTO `care_tz_tribes` VALUES (20, 'LUY', 'LUYA');
INSERT INTO `care_tz_tribes` VALUES (21, 'M', 'MAASAI');
INSERT INTO `care_tz_tribes` VALUES (22, 'MAG', 'MANGATI');
INSERT INTO `care_tz_tribes` VALUES (23, 'MANG', 'MWANGAZA');
INSERT INTO `care_tz_tribes` VALUES (24, 'MASAI', 'MWARUSHA');
INSERT INTO `care_tz_tribes` VALUES (25, 'MB', 'MBENA');
INSERT INTO `care_tz_tribes` VALUES (26, 'MBA', 'MBARIBAI');
INSERT INTO `care_tz_tribes` VALUES (27, 'MBO', 'MBONDEI');
INSERT INTO `care_tz_tribes` VALUES (28, 'MBU', 'MBULU');
INSERT INTO `care_tz_tribes` VALUES (29, 'MBUG', 'MBUGUWA');
INSERT INTO `care_tz_tribes` VALUES (30, 'MBUGWE', 'MBUGWE');
INSERT INTO `care_tz_tribes` VALUES (31, 'MBUR', 'MBURUNGE');
INSERT INTO `care_tz_tribes` VALUES (32, 'MBURU', 'MBURUNGE');
INSERT INTO `care_tz_tribes` VALUES (33, 'MC', 'MCHAGGA');
INSERT INTO `care_tz_tribes` VALUES (34, 'MDIGO', 'MDIGO');
INSERT INTO `care_tz_tribes` VALUES (35, 'MF', 'MFIPYA');
INSERT INTO `care_tz_tribes` VALUES (36, 'MFYO', 'MFYOME');
INSERT INTO `care_tz_tribes` VALUES (37, 'MG', 'MGOGO');
INSERT INTO `care_tz_tribes` VALUES (38, 'MGA', 'MGANDA');
INSERT INTO `care_tz_tribes` VALUES (39, 'MGE', 'GREEK');
INSERT INTO `care_tz_tribes` VALUES (40, 'MGI', 'MGIRIAM');
INSERT INTO `care_tz_tribes` VALUES (41, 'MGO', 'MGOROA');
INSERT INTO `care_tz_tribes` VALUES (42, 'MGWE', 'MGWENO');
INSERT INTO `care_tz_tribes` VALUES (43, 'MH', 'MHAYA');
INSERT INTO `care_tz_tribes` VALUES (44, 'MHASI', 'MHASIJA');
INSERT INTO `care_tz_tribes` VALUES (45, 'MHE', 'MHEHE');
INSERT INTO `care_tz_tribes` VALUES (46, 'MJA', 'MJALUO');
INSERT INTO `care_tz_tribes` VALUES (47, 'MJI', 'MJITA');
INSERT INTO `care_tz_tribes` VALUES (48, 'MK', 'MMAKONDE');
INSERT INTO `care_tz_tribes` VALUES (49, 'MKA', 'MKAMBA');
INSERT INTO `care_tz_tribes` VALUES (50, 'MKAG', 'MKAGURU');
INSERT INTO `care_tz_tribes` VALUES (51, 'MKE', 'MKEREWE');
INSERT INTO `care_tz_tribes` VALUES (52, 'MKI', 'MKIKUYU');
INSERT INTO `care_tz_tribes` VALUES (53, 'MKING', 'MKINGA');
INSERT INTO `care_tz_tribes` VALUES (54, 'MKIR', 'MKIROBA');
INSERT INTO `care_tz_tribes` VALUES (55, 'MKU', 'MKURIA');
INSERT INTO `care_tz_tribes` VALUES (56, 'MKW', 'MKWERE');
INSERT INTO `care_tz_tribes` VALUES (57, 'MKWA', 'MKWAYA');
INSERT INTO `care_tz_tribes` VALUES (58, 'ML', 'MLULI');
INSERT INTO `care_tz_tribes` VALUES (59, 'MLU', 'MLUGURU');
INSERT INTO `care_tz_tribes` VALUES (60, 'MM', 'MMERU');
INSERT INTO `care_tz_tribes` VALUES (61, 'MMA', 'MMALAWI');
INSERT INTO `care_tz_tribes` VALUES (62, 'MMAN', 'MMANG´ATI');
INSERT INTO `care_tz_tribes` VALUES (63, 'MMANG', 'MMANGATI');
INSERT INTO `care_tz_tribes` VALUES (64, 'MMBU', 'MMBUGWE');
INSERT INTO `care_tz_tribes` VALUES (65, 'MMK', 'MMAKUA');
INSERT INTO `care_tz_tribes` VALUES (66, 'MN', 'MNYAKIUSA');
INSERT INTO `care_tz_tribes` VALUES (67, 'MND', 'MNDALI');
INSERT INTO `care_tz_tribes` VALUES (68, 'MNGO', 'MNGONI');
INSERT INTO `care_tz_tribes` VALUES (69, 'MNGONI', 'MNGONI');
INSERT INTO `care_tz_tribes` VALUES (70, 'MNY', 'MNYIRAMBA');
INSERT INTO `care_tz_tribes` VALUES (71, 'MNYA', 'MNYARWANDA');
INSERT INTO `care_tz_tribes` VALUES (72, 'MNYAKU', 'MNYAKUSYA');
INSERT INTO `care_tz_tribes` VALUES (73, 'MNYAMW', 'MNYAMWEZI');
INSERT INTO `care_tz_tribes` VALUES (74, 'MNYAS', 'MNYASA');
INSERT INTO `care_tz_tribes` VALUES (75, 'MNYATU', 'MNYATURU');
INSERT INTO `care_tz_tribes` VALUES (76, 'MNYI', 'MNYIRAMBA');
INSERT INTO `care_tz_tribes` VALUES (77, 'MNYIZ', 'MNYISANZU');
INSERT INTO `care_tz_tribes` VALUES (78, 'MNYIZU', 'MNYIZANZU');
INSERT INTO `care_tz_tribes` VALUES (79, 'MNYK', 'MNYAKYUSA');
INSERT INTO `care_tz_tribes` VALUES (80, 'MP', 'MPARE');
INSERT INTO `care_tz_tribes` VALUES (81, 'MPA', 'MPARE');
INSERT INTO `care_tz_tribes` VALUES (82, 'MPO', 'MPOGORO');
INSERT INTO `care_tz_tribes` VALUES (83, 'MR', 'MRANGI');
INSERT INTO `care_tz_tribes` VALUES (84, 'MRA', 'MRANGI');
INSERT INTO `care_tz_tribes` VALUES (85, 'MRU', 'MRUNDI');
INSERT INTO `care_tz_tribes` VALUES (86, 'MS', 'MAASAI');
INSERT INTO `care_tz_tribes` VALUES (87, 'MSA', 'MSAMBAA');
INSERT INTO `care_tz_tribes` VALUES (88, 'MSAF', 'MSAFA');
INSERT INTO `care_tz_tribes` VALUES (89, 'MSAN', 'MSANDAWE');
INSERT INTO `care_tz_tribes` VALUES (90, 'MSANG', 'MSANGU');
INSERT INTO `care_tz_tribes` VALUES (91, 'MSF', 'MSAFWA');
INSERT INTO `care_tz_tribes` VALUES (92, 'MSG', 'MSANGO');
INSERT INTO `care_tz_tribes` VALUES (93, 'MSH', 'MSHIRAZ');
INSERT INTO `care_tz_tribes` VALUES (94, 'MSHA', 'MSHASHI');
INSERT INTO `care_tz_tribes` VALUES (95, 'MSIMBI', 'NSIMBIZI');
INSERT INTO `care_tz_tribes` VALUES (96, 'MSO', 'MSONGO');
INSERT INTO `care_tz_tribes` VALUES (97, 'MSOM', 'MSOMALI');
INSERT INTO `care_tz_tribes` VALUES (98, 'MSON', 'MSONJO');
INSERT INTO `care_tz_tribes` VALUES (99, 'MSU', 'MSUKUMA');
INSERT INTO `care_tz_tribes` VALUES (100, 'MSUK', 'MSUKUMA');
INSERT INTO `care_tz_tribes` VALUES (101, 'MT', 'MTUSI');
INSERT INTO `care_tz_tribes` VALUES (102, 'MU', 'MUHA');
INSERT INTO `care_tz_tribes` VALUES (103, 'MUA', 'MUASI');
INSERT INTO `care_tz_tribes` VALUES (104, 'MW', 'MWARUSHA');
INSERT INTO `care_tz_tribes` VALUES (105, 'MWA', 'MWASI');
INSERT INTO `care_tz_tribes` VALUES (106, 'MWABE', 'MWABESHI');
INSERT INTO `care_tz_tribes` VALUES (107, 'MWANG', 'MWANGAZA');
INSERT INTO `care_tz_tribes` VALUES (108, 'MWAR', 'MWARABU');
INSERT INTO `care_tz_tribes` VALUES (109, 'MWE', 'MWEMBA');
INSERT INTO `care_tz_tribes` VALUES (110, 'MWEM', 'MWEMBA');
INSERT INTO `care_tz_tribes` VALUES (111, 'MWERI', 'MWERICANI');
INSERT INTO `care_tz_tribes` VALUES (112, 'MWI', 'MWIRAQ');
INSERT INTO `care_tz_tribes` VALUES (113, 'MWIK', 'MWIKOMA');
INSERT INTO `care_tz_tribes` VALUES (114, 'MWING', 'MWINGEREZA');
INSERT INTO `care_tz_tribes` VALUES (115, 'MWIRAQ', 'MWIRAQ');
INSERT INTO `care_tz_tribes` VALUES (116, 'MWISA', 'MWISAZU');
INSERT INTO `care_tz_tribes` VALUES (117, 'MY', 'MYAO');
INSERT INTO `care_tz_tribes` VALUES (118, 'MZ', 'Mzungu');
INSERT INTO `care_tz_tribes` VALUES (119, 'MZA', 'MZANAKI');
INSERT INTO `care_tz_tribes` VALUES (120, 'MZAR', 'MZARAMO');
INSERT INTO `care_tz_tribes` VALUES (121, 'MZI', 'MZIRAZI');
INSERT INTO `care_tz_tribes` VALUES (122, 'MZIG', 'MZIGUA');
INSERT INTO `care_tz_tribes` VALUES (123, 'MZIGUA', 'MZIGUA');
INSERT INTO `care_tz_tribes` VALUES (124, 'NYAMWE', 'MNYAMWEZI');
INSERT INTO `care_tz_tribes` VALUES (125, 'ORTU', 'ORTUMEI');
INSERT INTO `care_tz_tribes` VALUES (126, 'PE', 'PENDE');
INSERT INTO `care_tz_tribes` VALUES (127, 'SAD', 'SANDAWE');
INSERT INTO `care_tz_tribes` VALUES (128, 'SAM', 'SAMBAA');
INSERT INTO `care_tz_tribes` VALUES (129, 'SIKH', 'SIKH');
INSERT INTO `care_tz_tribes` VALUES (130, 'SOM', 'SOMALI');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_unit_measurement`
-- 

CREATE TABLE `care_unit_measurement` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `unit_type_nr` smallint(2) unsigned NOT NULL default '0',
  `id` varchar(15) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `sytem` varchar(35) NOT NULL default '',
  `use_frequency` bigint(20) default NULL,
  `status` varchar(25) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=19 ;

-- 
-- Daten für Tabelle `care_unit_measurement`
-- 

INSERT INTO `care_unit_measurement` VALUES (1, 1, 'ml', 'Milliliter', 'LDMilliliter', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (2, 2, 'mg', 'Milligram', 'LDMilligram', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (3, 3, 'mm', 'Millimeter', 'LDMillimeter', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (4, 1, 'ltr', 'liter', 'LDLiter', 'metric', NULL, '', '', '20030727141658', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (5, 2, 'gm', 'gram', 'LDGram', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (6, 2, 'kg', 'kilogram', 'LDKilogram', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (7, 3, 'cm', 'centimeter', 'LDCentimeter', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (8, 3, 'm', 'meter', 'LDMeter', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (9, 3, 'km', 'kilometer', 'LDKilometer', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (10, 3, 'in', 'inch', 'LDInch', 'english', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (11, 3, 'ft', 'foot', 'LDFoot', 'english', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (12, 3, 'yd', 'yard', 'LDYard', 'english', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (14, 4, 'mmHg', 'mmHg', 'LDmmHg', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (15, 5, 'celsius', 'Celsius', 'LDCelsius', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (16, 1, 'dl', 'deciliter', 'LDDeciliter', 'metric', NULL, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (17, 1, 'cl', 'centiliter', 'LDCentiliter', 'metric', 0, '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_unit_measurement` VALUES (18, 1, 'µl', 'microliter', 'LDMicroliter', 'metric', 0, '', '', '00000000000000', '', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_users`
-- 

CREATE TABLE `care_users` (
  `name` varchar(60) NOT NULL default '',
  `login_id` varchar(35) NOT NULL default '',
  `password` varchar(255) default NULL,
  `personell_nr` int(10) unsigned NOT NULL default '0',
  `lockflag` tinyint(3) unsigned default '0',
  `permission` text NOT NULL,
  `exc` tinyint(1) NOT NULL default '0',
  `s_date` date NOT NULL default '0000-00-00',
  `s_time` time NOT NULL default '00:00:00',
  `expire_date` date NOT NULL default '0000-00-00',
  `expire_time` time NOT NULL default '00:00:00',
  `status` varchar(15) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`login_id`),
  KEY `login_id` (`login_id`)
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_users`
-- 

INSERT INTO `care_users` VALUES ('admin', 'care', '88d923ba797e9cafdfa4176f02bc2537', 0, 0, 'System_Admin', 1, '2004-11-23', '09:32:40', '0000-00-00', '00:00:00', '', '', 'auto-installer', '00000000000000', 'auto-installer', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_version`
-- 

CREATE TABLE `care_version` (
  `name` varchar(20) NOT NULL default '',
  `type` varchar(20) NOT NULL default '',
  `number` varchar(10) NOT NULL default '',
  `build` varchar(5) NOT NULL default '',
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `releaser` varchar(30) NOT NULL default ''
) TYPE=MyISAM;

-- 
-- Daten für Tabelle `care_version`
-- 

INSERT INTO `care_version` VALUES ('CARE2X', 'beta', '2.0.0', '1.0', '2004-05-14', '00:00:00', 'Elpidio Latorilla');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `care_ward`
-- 

CREATE TABLE `care_ward` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `ward_id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `is_temp_closed` tinyint(1) NOT NULL default '0',
  `date_create` date NOT NULL default '0000-00-00',
  `date_close` date NOT NULL default '0000-00-00',
  `description` text,
  `info` tinytext,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `room_nr_start` smallint(6) NOT NULL default '0',
  `room_nr_end` smallint(6) NOT NULL default '0',
  `roomprefix` varchar(4) default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL default '0',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(25) NOT NULL default '0',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`),
  KEY `ward_id` (`ward_id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Daten für Tabelle `care_ward`
-- 

INSERT INTO `care_ward` VALUES (1, '1', 'theater', 0, '2005-02-02', '0000-00-00', 'This is the theather of emergency surgey', NULL, 4, 1, 2, 't', '', 'Create: 2005-02-02 14:03:53 admin\n', '0', '20050202140353', 'admin', '20050202140353');
INSERT INTO `care_ward` VALUES (2, '2', 'Panic Room', 0, '2005-02-25', '0000-00-00', 'This is the wellknown Panic Room', NULL, 41, 1, 2, 'p', '', 'Create: 2005-02-25 14:51:36 admin\n', '0', '20050225145136', 'admin', '20050225145136');
        