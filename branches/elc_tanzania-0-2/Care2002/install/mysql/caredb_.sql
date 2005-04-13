-- phpMyAdmin SQL Dump
-- version 2.6.1-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 18. März 2005 um 12:14
-- Server Version: 4.0.23
-- PHP-Version: 4.3.10-8
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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_billing_bill_item`
-- 


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
INSERT INTO `care_cache` VALUES ('chemlabs_result_2005500005_20050304165531', '\n		<tr bgcolor="#dd0000" >\n		<td class="va12_n"><font color="#ffffff"> &nbsp;<b>Parameter</b>\n		</td>\n		<td  class="j"><font color="#ffffff">&nbsp;<b>Normal range</b>&nbsp;</td>\n		<td  class="j"><font color="#ffffff">&nbsp;<b>Msr. Unit</b>&nbsp;</td>\n		\n		<td class="a12_b"><font color="#ffffff">&nbsp;<b>04/03/2005<br>10000002</b>&nbsp;</td>\n		<td>&nbsp;<a href="javascript:prep2submit()"><img src="../../gui/img/common/default/chart.gif" border=0 align="absmiddle" width="16" height="17" alt="Click to show the graphical display"></td></a></td></tr>\n		<tr bgcolor="#ffddee" >\n		<td class="va12_n"><font color="#ffffff"> &nbsp;\n		</td>\n		<td class="va12_n"><font color="#ffffff"> &nbsp;\n		</td>\n		<td  class="j"><font color="#ffffff">&nbsp;</td>\n		<td class="a12_b"><font color="#0000cc">&nbsp;<b>16:55</b> Hour&nbsp;</td>\n		<td>&nbsp;<a href="javascript:selectall()"><img src="../../gui/img/common/default/dwnarrowgrnlrg.gif" border=0 align="absmiddle" width="16" height="16" alt="Click to select or deselect all for graphical display"></a>\n		</tr><tr class="wardlistrow2">\n				<td class="va12_n"> &nbsp;<nobr><a href="#">Hb</a></nobr>\n				</td>\n				<td class="a10_b" >&nbsp;12 - 18</td>\n				<td class="a10_b" >&nbsp;g/dl</td>\n				<td class="j">&nbsp;233223&nbsp;</td><td>\n				<input type="checkbox" name="tk" value="2">\n				</td></tr><tr class="wardlistrow1">\n				<td class="va12_n"> &nbsp;<nobr><a href="#">Calcium</a></nobr>\n				</td>\n				<td class="a10_b" >&nbsp;</td>\n				<td class="a10_b" >&nbsp;mEq/ml</td>\n				<td class="j">&nbsp;3223&nbsp;</td><td>\n				<input type="checkbox" name="tk" value="7">\n				</td></tr><tr class="wardlistrow2">\n				<td class="va12_n"> &nbsp;<nobr><a href="#">Blood sugar</a></nobr>\n				</td>\n				<td class="a10_b" >&nbsp;</td>\n				<td class="a10_b" >&nbsp;mg/dL</td>\n				<td class="j">&nbsp;<img src="../../gui/img/common/default/arrow_red_up_sm.gif" border=0 width="15" height="15"> <font color="red">3323</font>&nbsp;</td><td>\n				<input type="checkbox" name="tk" value="10">\n				</td></tr><tr class="wardlistrow1">\n				<td class="va12_n"> &nbsp;<nobr><a href="#">AFP</a></nobr>\n				</td>\n				<td class="a10_b" >&nbsp;</td>\n				<td class="a10_b" >&nbsp;</td>\n				<td class="j">&nbsp;3223&nbsp;</td><td>\n				<input type="checkbox" name="tk" value="140">\n				</td></tr><tr class="wardlistrow2">\n				<td class="va12_n"> &nbsp;<nobr><a href="#">CA. 125</a></nobr>\n				</td>\n				<td class="a10_b" >&nbsp;</td>\n				<td class="a10_b" >&nbsp;</td>\n				<td class="j">&nbsp;22323&nbsp;</td><td>\n				<input type="checkbox" name="tk" value="143">\n				</td></tr>\n		<input type="hidden" name="colsize" value="1">\n		<input type="hidden" name="params" value="">\n		<input type="hidden" name="ptk" value="5">\n		', NULL, '20050304165532');

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

INSERT INTO `care_category_diagnosis` VALUES (1, 'most_responsible', 'Most responsible', 'LDMostResponsible', 'M', 'LDMostResp_s', 'Most responsible diagnosis, must be only one per admission or visit', '0', '', '', '', '20030525120956', '', '00000000000000');
INSERT INTO `care_category_diagnosis` VALUES (2, 'associated', 'Associated', 'LDAssociated', 'A', 'LDAssociated_s', 'Associated diagnosis, can be several per  admission or visit', '0', '', '', '', '20030525121005', '', '00000000000000');
INSERT INTO `care_category_diagnosis` VALUES (3, 'nosocomial', 'Hospital acquired', 'LDNosocomial', 'N', 'LDNosocomial_s', 'Hospital acquired problem, can be several per admission or visit', '0', '', '', '', '20030525121015', '', '00000000000000');
INSERT INTO `care_category_diagnosis` VALUES (4, 'iatrogenic', 'Iatrogenic', 'LDIatrogenic', 'I', 'LDIatrogenic_s', 'Problem resulting from a procedural/surgical complication or medication mistake', '0', '', '', '', '20030525121025', '', '00000000000000');
INSERT INTO `care_category_diagnosis` VALUES (5, 'other', 'Other', 'LDOther', 'O', 'LDOther_s', 'Other  diagnosis', '0', '', '', '', '20030525121033', '', '00000000000000');

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

INSERT INTO `care_category_procedure` VALUES (1, 'main', 'Main', 'LDMain', 'M', 'LDMain_s', 'Main procedure, must be only one per op or intervention visit', '0', '', '', '', '20030614013508', '', '00000000000000');
INSERT INTO `care_category_procedure` VALUES (2, 'supplemental', 'Supplemental', 'LDSupplemental', 'S', 'LDSupp_s', 'Supplemental procedure, can be several per  encounter op or intervention or visit', '0', '', '', '', '20030614015324', '', '00000000000000');

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

INSERT INTO `care_classif_neonatal` VALUES (1, 'jaundice', 'Neonatal jaundice', 'LDNeonatalJaundice', NULL, '', '', '20030807125731', '', '00000000000000');
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
INSERT INTO `care_classif_neonatal` VALUES (16, 'necrotising_enterocolitis', 'Necrotising enterocolitis', 'LDNecrotisingEnterocolitis', NULL, '', '', '20030807191727', '', '00000000000000');

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
INSERT INTO `care_config_global` VALUES ('main_info_email', 'mniemi@elct.or.tz', '', '', '', '', '20050204185342', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_id_nr_adder', '10000000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_outpatient_nr_adder', '500000', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('patient_inpatient_nr_adder', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_2_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_3_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_middle_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_maiden_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_ethnic_orig_hide', '1', '', '', '', '', '20050204063857', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_name_others_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_nat_id_nr_hide', '1', '', '', '', '', '20050204064603', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_religion_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_cellphone_2_nr_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_phone_2_nr_hide', '1', '', '', '', '', '20050204062530', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_citizenship_hide', '0', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_sss_nr_hide', '1', '', '', '', '', '20050204062530', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('language_default', 'en', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('language_single', '1', '', '', '', '', '20050204093209', '', '00000000000000');
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
INSERT INTO `care_config_global` VALUES ('person_fax_hide', '1', '', '', '', '', '20050204062530', '', '00000000000000');
INSERT INTO `care_config_global` VALUES ('person_email_hide', '1', '', '', '', '', '20050204063857', '', '00000000000000');
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
INSERT INTO `care_config_global` VALUES ('timeout_time', '001500', '', '', '', '', '00000000000000', '', '00000000000000');
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
INSERT INTO `care_config_user` VALUES ('CFG41f81cd4581c00.36090400 1106779348.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:13:"66.249.65.168";s:3:"cid";s:13:"41f81cd4581c0";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050126234228', '', '20050126234228');
INSERT INTO `care_config_user` VALUES ('CFG41fb66505fd6c0.39256500 1106994768.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41fb66505fd6c";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050129113248', '', '20050129113248');
INSERT INTO `care_config_user` VALUES ('CFG41fcd288e22230.92625200 1107088008.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"41fcd288e2223";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050130132648', '', '20050130132648');
INSERT INTO `care_config_user` VALUES ('CFG420376f9b8d740.75713600 1107523321.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"2.0";s:2:"ip";s:12:"65.214.44.52";s:3:"cid";s:13:"420376f9b8d74";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050204142201', '', '20050204142201');
INSERT INTO `care_config_user` VALUES ('CFG4205c1ee796110.49717700 1107673582.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"4205c1ee79611";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050206080622', '', '20050206080622');
INSERT INTO `care_config_user` VALUES ('CFG42073cff2c9900.18268200 1107770623.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"42073cff2c990";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050207110343', '', '20050207110343');
INSERT INTO `care_config_user` VALUES ('CFG42084b1fbb3de0.76696700 1107839775.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"42084b1fbb3de";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050208061615', '', '20050208061615');
INSERT INTO `care_config_user` VALUES ('CFG420a548ba21a10.66397700 1107973259.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"63.109.249.89";s:3:"cid";s:13:"420a548ba21a1";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050209192059', '', '20050209192059');
INSERT INTO `care_config_user` VALUES ('CFG420a9e8ace6300.84536900 1107992202.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"Unknown";s:8:"bversion";i:0;s:2:"ip";s:12:"207.46.98.31";s:3:"cid";s:13:"420a9e8ace630";s:5:"dhtml";s:1:"1";s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050210003642', '', '20050210003642');
INSERT INTO `care_config_user` VALUES ('CFG420b540a5b7250.37459700 1108038666.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:15:"212.165.155.162";s:3:"cid";s:13:"420b540a5b725";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050210133106', '', '20050210133106');
INSERT INTO `care_config_user` VALUES ('CFG420c8bcc618ac0.39954000 1108118476.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"82.212.58.128";s:3:"cid";s:13:"420c8bcc618ac";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050211114116', '', '20050211114116');
INSERT INTO `care_config_user` VALUES ('CFG420cc23c53bb70.34300300 1108132412.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"420cc23c53bb7";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050211153332', '', '20050211153332');
INSERT INTO `care_config_user` VALUES ('CFG420df4d974e680.47883200 1108210905.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"420df4d974e68";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050212132145', '', '20050212132145');
INSERT INTO `care_config_user` VALUES ('CFG420dfcfd557350.35003600 1108212989.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"212.37.41.132";s:3:"cid";s:13:"420dfcfd55735";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050212135629', '', '20050212135629');
INSERT INTO `care_config_user` VALUES ('CFG42103e31921870.59841500 1108360753.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:5:"opera";s:8:"bversion";s:4:"7.54";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"42103e3192187";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050214065913', '', '20050214065913');
INSERT INTO `care_config_user` VALUES ('CFG421071697616c0.48370200 1108373865.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"80.255.50.11";s:3:"cid";s:13:"421071697616c";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050214103745', '', '20050214103745');
INSERT INTO `care_config_user` VALUES ('CFG4211bdf7285e20.16535500 1108458999.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"4211bdf7285e2";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050215101639', '', '20050215101639');
INSERT INTO `care_config_user` VALUES ('CFG42147942d9aa00.89156000 1108638018.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"84.136.213.252";s:3:"cid";s:13:"42147942d9aa0";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050217120018', '', '20050217120018');
INSERT INTO `care_config_user` VALUES ('CFG421498152674f0.15752900 1108645909.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"84.136.225.127";s:3:"cid";s:13:"421498152674f";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050217141149', '', '20050217141149');
INSERT INTO `care_config_user` VALUES ('CFG4216070e51d760.33523200 1108739854.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"66.249.66.45";s:3:"cid";s:13:"4216070e51d76";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050218161734', '', '20050218161734');
INSERT INTO `care_config_user` VALUES ('CFG421611a99abe70.63383900 1108742569.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"84.136.197.43";s:3:"cid";s:13:"421611a99abe7";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050218170249', '', '20050218170249');
INSERT INTO `care_config_user` VALUES ('CFG4219aa95449500.28092800 1108978325.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:4:"5.01";s:2:"ip";s:14:"213.147.67.223";s:3:"cid";s:13:"4219aa9544950";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050221103205', '', '20050221103205');
INSERT INTO `care_config_user` VALUES ('CFG4219b56fd67db0.87856300 1108981103.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"203.101.56.95";s:3:"cid";s:13:"4219b56fd67db";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050221111823', '', '20050221111823');
INSERT INTO `care_config_user` VALUES ('CFG4219bbbd0a1ce0.04143300 1108982717.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"4219bbbd0a1ce";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050221114517', '', '20050221114517');
INSERT INTO `care_config_user` VALUES ('CFG4219d191cebf10.84684100 1108988305.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"84.128.79.15";s:3:"cid";s:13:"4219d191cebf1";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050221131825', '', '20050221131825');
INSERT INTO `care_config_user` VALUES ('CFG4219d39a3bb4b0.24456200 1108988826.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:8:"netscape";s:8:"bversion";s:3:"7.2";s:2:"ip";s:13:"193.220.190.1";s:3:"cid";s:13:"4219d39a3bb4b";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050221132706', '', '20050221132706');
INSERT INTO `care_config_user` VALUES ('CFG421a1626556660.34981300 1109005862.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:5:"opera";s:8:"bversion";s:4:"7.54";s:2:"ip";s:14:"195.23.147.227";s:3:"cid";s:13:"421a162655666";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050221181102', '', '20050221181102');
INSERT INTO `care_config_user` VALUES ('CFG421ac68e372850.22593300 1109051022.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"212.138.47.11";s:3:"cid";s:13:"421ac68e37285";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050222064342', '', '20050222064342');
INSERT INTO `care_config_user` VALUES ('CFG421b12c08f96a0.58814800 1109070528.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"194.32.41.22";s:3:"cid";s:13:"421b12c08f96a";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050222120848', '', '20050222120848');
INSERT INTO `care_config_user` VALUES ('CFG421c01a3e83d00.95128700 1109131683.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"67.160.163.146";s:3:"cid";s:13:"421c01a3e83d0";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050223050803', '', '20050223050803');
INSERT INTO `care_config_user` VALUES ('CFG421c2ceda174d0.66133700 1109142765.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:13:"217.30.18.138";s:3:"cid";s:13:"421c2ceda174d";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050223081245', '', '20050223081245');
INSERT INTO `care_config_user` VALUES ('CFG421c3ca1a1ec70.66324800 1109146785.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"217.24.203.130";s:3:"cid";s:13:"421c3ca1a1ec7";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050223091945', '', '20050223091945');
INSERT INTO `care_config_user` VALUES ('CFG421d0b8ede7e00.91133500 1109199758.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"Unknown";s:8:"bversion";i:0;s:2:"ip";s:12:"207.46.98.31";s:3:"cid";s:13:"421d0b8ede7e0";s:5:"dhtml";s:1:"1";s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050224000238', '', '20050224000238');
INSERT INTO `care_config_user` VALUES ('CFG421db4fd671b30.42233400 1109243133.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"421db4fd671b3";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050224120533', '', '20050224120533');
INSERT INTO `care_config_user` VALUES ('CFG421dd1e52b8310.17823500 1109250533.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"421dd1e52b831";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050224140853', '', '20050224140853');
INSERT INTO `care_config_user` VALUES ('CFG421ebbbdb7a930.75228300 1109310397.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"421ebbbdb7a93";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050225064637', '', '20050225064637');
INSERT INTO `care_config_user` VALUES ('CFG421ee65beba130.96515000 1109321307.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"421ee65beba13";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050225094827', '', '20050225094827');
INSERT INTO `care_config_user` VALUES ('CFG421eebf746a960.28946000 1109322743.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"421eebf746a96";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050225101223', '', '20050225101223');
INSERT INTO `care_config_user` VALUES ('CFG421f2a95040d60.01660900 1109338773.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.166.1.67";s:3:"cid";s:13:"421f2a95040d6";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050225143933', '', '20050225143933');
INSERT INTO `care_config_user` VALUES ('CFG4220313d0e9290.05969800 1109406013.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"4220313d0e929";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050226092013', '', '20050226092013');
INSERT INTO `care_config_user` VALUES ('CFG422041e06bb2b0.44114300 1109410272.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"422041e06bb2b";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050226103112', '', '20050226103112');
INSERT INTO `care_config_user` VALUES ('CFG4220ca80d66d50.87830100 1109445248.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"201.10.169.49";s:3:"cid";s:13:"4220ca80d66d5";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050226201408', '', '20050226201408');
INSERT INTO `care_config_user` VALUES ('CFG4220f29842d470.27374500 1109455512.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:15:"138.130.177.248";s:3:"cid";s:13:"4220f29842d47";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050226230512', '', '20050226230512');
INSERT INTO `care_config_user` VALUES ('CFG4223073b3d1b90.25030900 1109591867.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"84.136.209.207";s:3:"cid";s:13:"4223073b3d1b9";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050228125747', '', '20050228125747');
INSERT INTO `care_config_user` VALUES ('CFG42230bc61c2790.11533400 1109593030.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:14:"84.136.209.207";s:3:"cid";s:13:"42230bc61c279";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050228131710', '', '20050228131710');
INSERT INTO `care_config_user` VALUES ('CFG42230f9c88fc20.56110200 1109594012.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"42230f9c88fc2";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050228133332', '', '20050228133332');
INSERT INTO `care_config_user` VALUES ('CFG4225c6bd2fea60.19627300 1109771965.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"63.109.249.92";s:3:"cid";s:13:"4225c6bd2fea6";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050302145925', '', '20050302145925');
INSERT INTO `care_config_user` VALUES ('CFG4226c8b42b39c0.17707800 1109838004.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"145.253.2.24";s:3:"cid";s:13:"4226c8b42b39c";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050303092004', '', '20050303092004');
INSERT INTO `care_config_user` VALUES ('CFG422884d5dd4ec0.90648600 1109951701.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"84.136.195.103";s:3:"cid";s:13:"422884d5dd4ec";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050304165501', '', '20050304165501');
INSERT INTO `care_config_user` VALUES ('CFG422a2951bc64f0.77167100 1110059345.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"67.160.163.146";s:3:"cid";s:13:"422a2951bc64f";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050305224905', '', '20050305224905');
INSERT INTO `care_config_user` VALUES ('CFG422b0093a5d1a0.67922100 1110114451.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:11:"212.75.41.3";s:3:"cid";s:13:"422b0093a5d1a";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050306140731', '', '20050306140731');
INSERT INTO `care_config_user` VALUES ('CFG422e8bb9e5d820.94145200 1110346681.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"5.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"422e8bb9e5d82";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050309063801', '', '20050309063801');
INSERT INTO `care_config_user` VALUES ('CFG422f2389be5710.77964200 1110385545.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"130.206.50.47";s:3:"cid";s:13:"422f2389be571";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050309172545', '', '20050309172545');
INSERT INTO `care_config_user` VALUES ('CFG422f60f0c7d390.81849700 1110401264.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"5.0";s:2:"ip";s:13:"62.220.100.71";s:3:"cid";s:13:"422f60f0c7d39";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050309214744', '', '20050309214744');
INSERT INTO `care_config_user` VALUES ('CFG422f92f2c13720.79145000 1110414066.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"Unknown";s:8:"bversion";i:0;s:2:"ip";s:12:"207.46.98.31";s:3:"cid";s:13:"422f92f2c1372";s:5:"dhtml";s:1:"1";s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050310012106', '', '20050310012106');
INSERT INTO `care_config_user` VALUES ('CFG423185e100e190.00361900 1110541793.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:7:"mozilla";s:8:"bversion";s:3:"7.0";s:2:"ip";s:13:"62.158.187.45";s:3:"cid";s:13:"423185e100e19";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050311124953', '', '20050311124953');
INSERT INTO `care_config_user` VALUES ('CFG4231907e6960e0.43167300 1110544510.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"84.136.209.166";s:3:"cid";s:13:"4231907e6960e";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050311133510', '', '20050311133510');
INSERT INTO `care_config_user` VALUES ('CFG4231b1a567a120.42448400 1110552997.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"84.136.209.166";s:3:"cid";s:13:"4231b1a567a12";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050311155637', '', '20050311155637');
INSERT INTO `care_config_user` VALUES ('CFG4232a7c71985d0.10455200 1110616007.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:12:"193.220.91.5";s:3:"cid";s:13:"4232a7c71985d";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050312092647', '', '20050312092647');
INSERT INTO `care_config_user` VALUES ('CFG4232daadf25e80.99275300 1110629037.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"80.240.192.37";s:3:"cid";s:13:"4232daadf25e8";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050312130357', '', '20050312130357');
INSERT INTO `care_config_user` VALUES ('CFG42357489bf3710.78322600 1110799497.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"84.136.211.170";s:3:"cid";s:13:"42357489bf371";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050314122457', '', '20050314122457');
INSERT INTO `care_config_user` VALUES ('CFG42371defa399e0.67011900 1110908399.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"63.109.249.89";s:3:"cid";s:13:"42371defa399e";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050315183959', '', '20050315183959');
INSERT INTO `care_config_user` VALUES ('CFG4237302ccfb750.85081400 1110913068.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:14:"212.165.164.53";s:3:"cid";s:13:"4237302ccfb75";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050315195748', '', '20050315195748');
INSERT INTO `care_config_user` VALUES ('CFG423824f60fb480.06433800 1110975734.cfg', 'a:19:{s:4:"mask";b:0;s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:4:"msie";s:8:"bversion";s:3:"6.0";s:2:"ip";s:13:"63.109.249.89";s:3:"cid";s:13:"423824f60fb48";s:5:"dhtml";i:1;s:4:"lang";s:2:"en";}', NULL, '', NULL, '', '20050316132214', '', '20050316132214');

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

INSERT INTO `care_currency` VALUES (13, '€', 'Euro', 'European currency', 'main', 'Elpidio Latorilla', '20030802190637', '', '20021126200534');
INSERT INTO `care_currency` VALUES (3, 'L', 'Pound', 'GB British Pound (ISO = GBP)', '', '', '20030213173107', '', '20020816230349');
INSERT INTO `care_currency` VALUES (10, 'R', 'Rand', 'South African Rand (ISO = ZAR)', '', '', '20030802190637', 'Elpidio Latorilla', '20020817171805');
INSERT INTO `care_currency` VALUES (8, 'R', 'Rupees', 'Indian Rupees (ISO = INR)', '', '', '20030213173059', 'Elpidio Latorilla', '20020920234306');

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
INSERT INTO `care_department` VALUES (3, 'general_surgery', '1', 'General Surgery', 'General', 'General', 'LDGeneralSurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '8.30 - 21.00', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '20030828114327', '', '00000000000000');
INSERT INTO `care_department` VALUES (4, 'emergency_surgery', '1', 'Emergency Surgery', 'Emergency', '', 'LDEmergencySurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (5, 'plastic_surgery', '1', 'Plastic Surgery', 'Plastic', 'Aesthetic Surgery', 'LDPlasticSurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (6, 'ent', '1', 'Ear-Nose-Throath', 'ENT', 'HNO', 'LDEarNoseThroath', 'Ear-Nose-Throath, in german Hals-Nasen-Ohren. The department with  very old traditions that date back to the early beginnings of premodern medicine.', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', 'kope akjdielj asdlkasdf', '', '', 'Update: 2003-08-13 23:24:16 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:25:27 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:29:05 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:30:21 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:31:52 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:34:08 Elpidio Latorilla\r\n', 'Elpidio Latorilla', '20031019155346', '', '00000000000000');
INSERT INTO `care_department` VALUES (7, 'opthalmology', '1', 'Opthalmology', 'Opthalmology', 'Eye Department', 'LDOpthalmology', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (8, 'pathology', '1', 'Pathology', 'Pathology', 'Patho', 'LDPathology', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (9, 'ob_gyn', '1', 'Ob-Gynecology', 'Ob-Gyne', 'Gyn', 'LDObGynecology', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (10, 'physical_therapy', '1', 'Physical Therapy', 'Physical', 'PT', 'LDPhysicalTherapy', 'Physical therapy department with on-call therapists. Day care clinics, training, rehab.', 1, 0, 1, 1, 0, 1, 1, 16, '8:00 - 15:00', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '20030828114351', '', '00000000000000');
INSERT INTO `care_department` VALUES (11, 'internal_med', '1', 'Internal Medicine', 'Internal Med', 'InMed', 'LDInternalMedicine', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (12, 'imc', '1', 'Intermediate Care Unit', 'IMC', 'Intermediate', 'LDIntermediateCareUnit', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (13, 'icu', '1', 'Intensive Care Unit', 'ICU', 'Intensive', 'LDIntensiveCareUnit', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (14, 'emergency_ambulatory', '1', 'Emergency Ambulatory', 'Emergency', 'Emergency Amb', 'LDEmergencyAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 4, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', 'Update: 2003-09-23 00:06:27 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030923000627', '', '00000000000000');
INSERT INTO `care_department` VALUES (15, 'general_ambulatory', '1', 'General Ambulatory', 'Ambulatory', 'General Amb', 'LDGeneralAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 3, 'round the clock', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '20030828114254', '', '00000000000000');
INSERT INTO `care_department` VALUES (16, 'inmed_ambulatory', '1', 'Internal Medicine Ambulatory', 'InMed Ambulatory', 'InMed Amb', 'LDInternalMedicineAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (17, 'sonography', '1', 'Sonography', 'Sono', 'Ultrasound diagnostics', 'LDSonography', '', 0, 1, 1, 1, 0, 1, 1, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (18, 'nuclear_diagnostics', '1', 'Nuclear Diagnostics', 'Nuclear', 'Nuclear Testing', 'LDNuclearDiagnostics', '', 0, 1, 1, 1, 0, 1, 1, 19, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (19, 'radiology', '1', 'Radiology', 'Radiology', 'Xray', 'LDRadiology', '', 0, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (20, 'oncology', '1', 'Oncology', 'Oncology', 'Cancer Department', 'LDOncology', '', 1, 1, 1, 1, 1, 1, 0, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (21, 'neonatal', '1', 'Neonatal', 'Neonatal', 'Newborn Department', 'LDNeonatal', '', 1, 1, 1, 1, 1, 1, 1, 9, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '343', '', '', '', 'Update: 2003-08-13 22:32:07 Elpidio Latorilla\nUpdate: 2003-08-13 22:33:10 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:39 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:59 Elpidio Latorilla\nUpdate: 2003-08-13 22:44:19 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030813224419', '', '00000000000000');
INSERT INTO `care_department` VALUES (22, 'central_lab', '1', 'Central Laboratory', 'Central Lab', 'General Lab', 'LDCentralLaboratory', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', 'kdkdododospdfjdasljfda\r\nasdflasdjf\r\nasdfklasdjflasdjf', '', '', 'Update: 2003-08-13 23:12:30 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:14:59 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:15:28 Elpidio Latorilla\r\n', 'Elpidio Latorilla', '20030828114243', '', '00000000000000');
INSERT INTO `care_department` VALUES (23, 'serological_lab', '1', 'Serological Laboratory', 'Serological Lab', 'Serum Lab', 'LDSerologicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (24, 'chemical_lab', '1', 'Chemical Laboratory', 'Chemical Lab', 'Chem Lab', 'LDChemicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (25, 'bacteriological_lab', '1', 'Bacteriological Laboratory', 'Bacteriological Lab', 'Bacteria Lab', 'LDBacteriologicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (26, 'tech', '2', 'Technical Maintenance', 'Tech', 'Technical Support', 'LDTechnicalMaintenance', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', 'jpg', '', 'Update: 2003-08-10 23:42:30 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030810234230', '', '00000000000000');
INSERT INTO `care_department` VALUES (27, 'it', '2', 'IT Department', 'IT', 'EDP', 'LDITDepartment', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (28, 'management', '2', 'Management', 'Management', 'Busines Administration', 'LDManagement', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (29, 'exhibition', '3', 'Exhibitions', 'Exhibit', 'Showcases', 'LDExhibitions', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '00000000000000', '', '00000000000000');
INSERT INTO `care_department` VALUES (30, 'edu', '3', 'Education', 'Edu', 'Training', 'LDEducation', 'Education news bulletin of the hospital.', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', 'Update: 2003-08-13 22:44:45 Elpidio Latorilla\nUpdate: 2003-08-13 23:00:37 Elpidio Latorilla\n', 'Elpidio Latorilla', '20030813230037', '', '00000000000000');
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
) TYPE=MyISAM AUTO_INCREMENT=2005500008 ;

-- 
-- Daten für Tabelle `care_encounter`
-- 

INSERT INTO `care_encounter` VALUES (2005500000, 10000001, '2005-02-03 17:25:28', 2, '', 'disallow_cancel', 'test', 'test', 'test', '', '', 'test', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 39, 0, 0, 0, '', '', 1, '2005-02-19', '05:12:00', '0000-00-00', NULL, '', '', 'Create: 2005-02-03 17:25:28 = demo\nSet dept + in dept 2005-02- 17:25:35 demo\nView 2005-02-03 17:25:46 = demo\nView 2005-02-07 12:48:41 = admin\nView 2005-02-08 06:21:10 = admin\nView 2005-02-19 04:54:35 = admin\nView 2005-02-19 04:55:10 = admin\nView 2005-02-19 04:58:51 = admin', 'demo', '20050219051233', 'demo', '20050203172528');
INSERT INTO `care_encounter` VALUES (2005500001, 10000004, '2005-02-19 04:43:17', 2, '', 'disallow_cancel', '', '', '', '', '', ' ', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 39, 1, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-19 04:43:17 = admin\nView 2005-02-19 04:44:07 = admin\nView 2005-02-19 04:44:49 = admin\nView 2005-02-19 04:54:21 = admin\nView 2005-02-19 04:58:38 = admin\nView 2005-02-19 04:59:21 = admin\nSet dept + in dept 2005-02- 04:59:33 admin\nView 2005-02-19 04:59:45 = admin\nView 2005-02-28 17:21:57 = admin', 'admin', '20050228172157', 'admin', '20050219044317');
INSERT INTO `care_encounter` VALUES (2005500002, 10000003, '2005-02-19 05:10:57', 2, '', '', 'x', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 39, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-19 05:10:57 = admin\nView 2005-02-22 12:21:11 = demo\nView 2005-03-10 09:45:37 = admin', 'admin', '20050310094537', 'admin', '20050219051057');
INSERT INTO `care_encounter` VALUES (2005500003, 10000001, '2005-02-19 05:13:18', 2, '', '', '', NULL, 'x', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 39, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-19 05:13:18 = admin\nView 2005-02-28 13:05:25 = admin', 'admin', '20050228130525', 'admin', '20050219051318');
INSERT INTO `care_encounter` VALUES (2005500004, 10000005, '2005-02-22 13:48:27', 2, '', 'disallow_cancel', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 1, 0, 0, 39, 1, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-22 13:48:27 = admin\nView 2005-02-22 13:51:18 = admin\nView 2005-02-28 17:20:10 = admin\nSet dept + in dept 2005-02- 17:20:29 admin\nView 2005-02-28 17:20:38 = admin\nView 2005-03-10 09:45:44 = admin', 'admin', '20050310094544', 'admin', '20050222134827');
INSERT INTO `care_encounter` VALUES (2005500005, 10000006, '2005-02-25 06:53:14', 2, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 39, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-25 06:53:14 = admin', 'admin', '20050225065314', 'admin', '20050225065314');
INSERT INTO `care_encounter` VALUES (2005500006, 10000009, '2005-02-26 09:50:20', 2, '', 'cancelled', '', NULL, '', '', '', ' ', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 39, 0, 0, 0, '', '', 1, NULL, NULL, '0000-00-00', NULL, '', 'void', 'Create: 2005-02-26 09:50:20 = admin\nView 2005-02-26 09:51:10 = adminCancelled 2005-02- 09:51:29 by admin, logged-user admin\n', 'admin', '20050226095129', 'admin', '20050226095020');
INSERT INTO `care_encounter` VALUES (2005000000, 10000000, '2005-02-28 13:07:02', 1, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 1, 0, 0, 18, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-28 13:07:02 = admin\n Update: 2005-02-28 13:07:12 = admin\nView 2005-02-28 17:19:34 = admin', 'admin', '20050228171934', 'admin', '20050228130702');
INSERT INTO `care_encounter` VALUES (2005500007, 10000013, '2005-02-28 13:46:33', 2, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, '0', '0', 0, 0, '', 0, 0, 0, 39, 0, 0, 0, '', '', 0, NULL, NULL, '0000-00-00', NULL, '', '', 'Create: 2005-02-28 13:46:33 = admin', 'admin', '20050228134633', 'admin', '20050228134633');

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
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Daten für Tabelle `care_encounter_diagnostics_report`
-- 

INSERT INTO `care_encounter_diagnostics_report` VALUES (1, 10000001, 24, 'Chemical Laboratory', '2005-03-09', '06:43:57', 2005500004, 'labor_test_request_printpop.php?entry_date=&target=&subtarget=chemlabor&dept_nr=24&batch_nr=10000001&pn=2005500004', 'pending', 'Initial report: 2005-03-09 06:43:57 admin\n\r', '', '20050309064357', 'admin', '20050309064357');

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

INSERT INTO `care_encounter_event_signaller` VALUES (2005500000, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500004, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500005, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500001, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500007, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_encounter_event_signaller` VALUES (2005500003, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Daten für Tabelle `care_encounter_location`
-- 

INSERT INTO `care_encounter_location` VALUES (1, 2005500000, 1, 39, 39, '2005-02-03', '2005-02-19', '17:25:35', '05:12:00', 1, 'discharged', 'Create: 2005-02-03 17:25:35 demo\nUpdate (discharged): 2005-02-19 05:12:33 admin\n', 'admin', '20050219051233', 'demo', '20050203172535');
INSERT INTO `care_encounter_location` VALUES (2, 2005500001, 1, 39, 39, '2005-02-19', '0000-00-00', '04:59:33', NULL, 0, '', 'Create: 2005-02-19 04:59:33 admin\n', '', '20050219045933', 'admin', '20050219045933');
INSERT INTO `care_encounter_location` VALUES (3, 2005500004, 1, 39, 39, '2005-02-28', '0000-00-00', '17:20:29', NULL, 0, '', 'Create: 2005-02-28 17:20:29 admin\n', '', '20050228172029', 'admin', '20050228172029');

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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_encounter_notes`
-- 


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
  `drug_class` varchar(60) NOT NULL default '',
  `order_nr` int(11) NOT NULL default '0',
  `dosage` varchar(255) NOT NULL default '',
  `application_type_nr` smallint(5) unsigned NOT NULL default '0',
  `notes` text NOT NULL,
  `prescribe_date` date default NULL,
  `prescriber` varchar(60) NOT NULL default '',
  `color_marker` varchar(10) NOT NULL default '',
  `is_stopped` tinyint(1) unsigned NOT NULL default '0',
  `stop_date` date default NULL,
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
-- Daten für Tabelle `care_encounter_prescription`
-- 


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
) TYPE=MyISAM AUTO_INCREMENT=25 ;

-- 
-- Daten für Tabelle `care_menu_main`
-- 

INSERT INTO `care_menu_main` VALUES (1, 1, 'Home', 'LDHome', 'main/startframe.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (2, 5, 'Patient', 'LDPatient', 'modules/registration_admission/patient_register_pass.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (3, 10, 'Admission', 'LDAdmission', 'modules/registration_admission/aufnahme_pass.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (4, 15, 'Ambulatory', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', 1, '', '', '20050225152509', '00000000000000');
INSERT INTO `care_menu_main` VALUES (5, 20, 'Medocs', 'LDMedocs', 'modules/medocs/medocs_pass.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (6, 25, 'Doctors', 'LDDoctors', 'modules/doctors/doctors.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (7, 35, 'Nursing', 'LDNursing', 'modules/nursing/nursing.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (8, 40, 'OR', 'LDOR', 'main/op-doku.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (9, 45, 'Laboratories', 'LDLabs', 'modules/laboratory/labor.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (10, 50, 'Radiology', 'LDRadiology', 'modules/radiology/radiolog.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (11, 55, 'Pharmacy', 'LDPharmacy', 'modules/pharmacy/apotheke.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (12, 60, 'Medical Depot', 'LDMedDepot', 'modules/med_depot/medlager.php', 0, '', '', '20050202112256', '00000000000000');
INSERT INTO `care_menu_main` VALUES (13, 65, 'Directory', 'LDDirectory', 'modules/phone_directory/phone.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (14, 70, 'Tech Support', 'LDTechSupport', 'modules/tech/technik.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (15, 72, 'System Admin', 'LDEDP', 'modules/system_admin/edv.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (16, 75, 'Intranet Email', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (17, 80, 'Internet Email', 'LDInterEmail', 'modules/nocc/index.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (18, 85, 'Special Tools', 'LDSpecials', 'main/spediens.php', 1, '', '', '20030922232015', '00000000000000');
INSERT INTO `care_menu_main` VALUES (23, 91, 'Logout', 'LDLogout', 'main/logout_confirm.php', 1, '', '', '20050314150726', '00000000000000');
INSERT INTO `care_menu_main` VALUES (20, 7, 'Appointments', 'LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', 1, '', '', '20030922232015', '20030405000145');
INSERT INTO `care_menu_main` VALUES (21, 16, 'Inpatient', 'LDInpatient', 'modules/inpatient/inpatient.php', 1, NULL, '', '20050225143927', '00000000000000');
INSERT INTO `care_menu_main` VALUES (22, 46, 'Laboratories TZ', 'LDLabs', 'modules/laboratory_tz/labor.php', 0, '', '', '20050308130545', '00000000000000');
INSERT INTO `care_menu_main` VALUES (24, 90, 'Login', 'LDLogin', 'main/login.php', 1, '', '', '20050314150912', '00000000000000');

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

INSERT INTO `care_method_induction` VALUES (3, 1, 'prostaglandin', 'Prostaglandin', 'LDProstaglandin', '', '', '', '20030805191247', '', '00000000000000');
INSERT INTO `care_method_induction` VALUES (4, 1, 'oxytocin', 'Oxytocin', 'LDOxytocin', '', '', '', '20030805191254', '', '00000000000000');
INSERT INTO `care_method_induction` VALUES (5, 1, 'arom', 'AROM', 'LDAROM', '', '', '', '20030805191302', '', '00000000000000');
INSERT INTO `care_method_induction` VALUES (2, 1, 'unknown', 'Unknown', 'LDUnknown', '', '', '', '20030805191240', '', '00000000000000');
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
INSERT INTO `care_news_article` VALUES (11, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', '<br />We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br />The following presentation are available <a href="http://health.elct.org/care2x/arusha%20meeting">online in this folder </a>where you can find also the minutes of the meeting, where all the participants are also listed:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “The MTRH experience in ICT Implementation”<br />Dr. Mark Bura from The Commonwealth Regional Health Community:“Cost Allocation at the Unit Level”.<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ Integrated Health Information for Education and Research”<br />Robert Meggle from Merotech: “How CVS works”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '1873792114', 'Mauri Niemi', '2005-01-07 12:02:01', '0000-00-00 00:00:00', '2005-01-07', 'admin', '20050107120201', 'admin', '20050107120201');
INSERT INTO `care_news_article` VALUES (12, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><a href="http://health.elct.org/care2x/arusha%20meeting/minutes20041210.doc">The minutes of the meeting</a> with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/The%20MTRH%20experience%20in%20ICT%20Implementation.ppt">The MTRH experience in ICT Implementation</a>”<br />Dr. Mark Bura from The Commonwealth Regional Health Community:“Cost Allocation at the Unit Level”.<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/Integrated%20Health%20Information%20for%20Education%20and%20Research.ppt">Integrated Health Information for Education and Research</a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/arusha%20meeting/How%20CVS%20works.ppt">How CVS works</a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '250430254', 'Mauri Niemi', '2005-01-07 12:25:37', '0000-00-00 00:00:00', '2005-01-07', 'admin', '20050107122537', 'admin', '20050107122537');
INSERT INTO `care_news_article` VALUES (13, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><a href="http://health.elct.org/care2x/arusha%20meeting/minutes.doc">The minutes of the meeting</a> with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/kirui.ppt">The MTRH experience in ICT Implementation</a>”<br />Dr. Mark Bura from The Commonwealth Regional Health Community:“Cost Allocation at the Unit Level”.<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/dahlman.ppt">Integrated Health Information for Education and Research</a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/arusha%20meeting/cvs.ppt">How CVS works</a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '553173484', 'Mauri Niemi', '2005-01-07 12:43:22', '0000-00-00 00:00:00', '2005-01-07', 'admin', '20050107124322', 'admin', '20050107124322');
INSERT INTO `care_news_article` VALUES (14, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '<h3>We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical Lutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital from Kenya joined to the project in November.</h3><br />The first step was to install the original Care2x to Selian town clinic in June to see how well it would fit to our needs. The work was done by local IT-company Arusha Node Marie, which also trained the staff to use the program. In September Merotech IT-engineers from Germany made requirement analysis with us and the programming was started in December. When Kijabe joined to the project they brought three more IT-engineers to our project.<br /><br /><p>We are making major changes in pharmacy, laboratory and billing module and later this year build inventory/stock module. Also we are waiting decision from PEPFAR for funding to make modules for ARV treatment according to their requirements. But we are making small modification to most of the forms in Care2x that we are going to use. <a href="http://health.elct.org/care2x/tasks/references.html"><span style="text-decoration: underline; font-style: italic;">See here the list of planned tasks,</span></a> includint our laboratory tests and drug and supplies list.</p><br />Our goal is to make one East-African version and keep the hospital specific modifications as simple as possible and we hope that more hospitals from this area would join in. This is the way to create strong base and make the program sustainable.<br /><br />Mauri Niemi, MD<br />Information Officer, ELCT\r\n', NULL, '', 1, '', '', '444798593', 'Mauri Niemi', '2005-01-10 08:15:42', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110081542', 'admin', '20050110081542');
INSERT INTO `care_news_article` VALUES (15, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><span style="font-style: italic; text-decoration: underline;"><a href="http://health.elct.org/care2x/arusha%20meeting/minutes.doc">The minutes of the meeting</a> </span>with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/kirui.ppt"><span style="font-style: italic; text-decoration: underline;">The MTRH experience in ICT Implementation</span></a>”<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/dahlman.ppt"><span style="font-style: italic; text-decoration: underline;">Integrated Health Information for Education and Research</span></a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/modules/news/http//health.elct.org/care2x/arusha%20meeting/cvs.ppt"><span style="font-style: italic; text-decoration: underline;">How CVS works</span></a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '1319843835', 'Mauri Niemi', '2005-01-10 08:24:45', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110082445', 'admin', '20050110082445');
INSERT INTO `care_news_article` VALUES (16, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><a href="http://health.elct.org/care2x/arusha%20meeting/minutes.doc"><span style="font-style: italic; text-decoration: underline;">The minutes of the meeting</span></a> with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/kirui.ppt"><span style="font-style: italic; text-decoration: underline;">The MTRH experience in ICT Implementation</span></a>”<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/dahlman.ppt"><span style="font-style: italic; text-decoration: underline;">Integrated Health Information for Education and Research</span></a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/arusha%20meeting/cvs.ppt"><span style="font-style: italic; text-decoration: underline;">How CVS works</span></a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 1, '', '', '693347227', 'Mauri Niemi', '2005-01-10 08:29:07', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110082907', 'admin', '20050110082907');
INSERT INTO `care_news_article` VALUES (17, 'en', 1, '1', 'pending', 'Conference on Care2x in Arusha', '', 'We had a meeting on Hospital Information Systems (HIS) specially concentrating on Care2x on December 10th in Arusha. Representatives from 9 hospitals and 4 related organizations were attending from Kenya and Tanzania. The goal of the meeting was to find common ground for co-operation with East-African hospitals to HIS. <br /><br />General presentations on HIS were given and Care 2x was demonstrated to participants. <br /><a href="http://health.elct.org/care2x/arusha%20meeting/minutes.doc"><span style="font-style: italic; text-decoration: underline;">The minutes of the meeting</span></a> with participant list and the following presentation are available online:<br />Mr. David Kirui of Moi Teaching and Referral Hospital:  “<a href="http://health.elct.org/care2x/arusha%20meeting/kirui.ppt"><span style="font-style: italic; text-decoration: underline;">The MTRH experience in ICT Implementation</span></a>”<br />Dr. Bruce Dahlman, Medical Director, A.I.C. Kijabe Hospital:“ <a href="http://health.elct.org/care2x/arusha%20meeting/dahlman.ppt"><span style="font-style: italic; text-decoration: underline;">Integrated Health Information for Education and Research</span></a>”<br />Robert Meggle from Merotech: “<a href="http://health.elct.org/care2x/arusha%20meeting/cvs.ppt"><span style="font-style: italic; text-decoration: underline;">How CVS works</span></a>”<br /><br />Some hospitals had been using locally made software but needed improvements and others were looking for a fresh solution. Care2x was seen as a strong candidate, but many hospitals need time to evaluate it after this meeting.<br /><br />Mauri Niemi\r\n', NULL, '', 2, '', '', '1352646218', 'Mauri Niemi', '2005-01-10 08:32:29', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110083229', 'admin', '20050110083229');
INSERT INTO `care_news_article` VALUES (18, 'en', 1, '1', 'pending', 'Care2x in East-Africa', '', '<h3>We have started to customize Care2x to East-African hospitals. The work was started last year in Tanzania in ELCT (Evangelical Lutheran Church of Tanzania), which has 20 hospitals. Kijabe mission hospital from Kenya joined to the project in November.</h3><br />The first step was to install the original Care2x to Selian town clinic in June to see how well it would fit to our needs. The work was done by local IT-company Arusha Node Marie, which also trained the staff to use the program. In September Merotech IT-engineers from Germany made requirement analysis with us and the programming was started in December. When Kijabe joined to the project they brought three more IT-engineers to our project.<br /><br />We are making major changes in pharmacy, laboratory and billing module and later this year build inventory/stock module. Also we are waiting decision from PEPFAR for funding to make modules for ARV treatment according to their requirements. But we are making small modification to most of the forms in Care2x that we are going to use. <a href="http://health.elct.org/care2x/tasks/references.html"><span style="font-style: italic; text-decoration: underline;">See here the list of planned tasks</span></a>, including our laboratory tests and drug and supplies list.<br /><br />Our goal is to make one East-African version and keep the hospital specific modifications as simple as possible and we hope that more hospitals from this area would join in. This is the way to create strong base and make the program sustainable.<br /><br />Mauri Niemi, MD<br />Information Officer, ELCT\r\n', NULL, '', 1, '', '', '2074014686', 'Mauri Niemi', '2005-01-10 08:35:55', '0000-00-00 00:00:00', '2005-01-10', 'admin', '20050110083555', 'admin', '20050110083555');
INSERT INTO `care_news_article` VALUES (19, 'en', 1, '1', 'pending', 'Testing this East African version', '', '<h4>If you want to test use demo for username and password</h4>\r\n', NULL, '', 3, '', '', '206005667', 'Mauri Niemi', '2005-02-04 06:49:55', '0000-00-00 00:00:00', '2005-02-04', 'demo', '20050204064955', 'demo', '20050204064955');
INSERT INTO `care_news_article` VALUES (20, 'en', 1, '1', 'pending', 'For test use demo as username and password', '', '<br />\r\n', NULL, '', 3, '', '', '441646900', 'Mauri Niemi', '2005-02-04 06:51:22', '0000-00-00 00:00:00', '2005-02-04', 'demo', '20050204065122', 'demo', '20050204065122');
INSERT INTO `care_news_article` VALUES (21, 'en', 1, '1', 'pending', 'Care2x  presented in national ICT meeting', '', 'National meeting on ICT in health sector was held in Mwanza 1-4-2.2005. One central topic was management of information systems in health sector. Care 2x was demonstrated there. Partipanct aggreed that open source and free software is the future in Tanzania.<br /><br />Among participants were representatives from big hospitals like KCMC, Bugando, Kariuki and Muhimbili. Project team was formed to find a common way to go ahead.<br />\r\n', NULL, '', 3, '', '', '373530852', 'Mauri Niemi', '2005-02-04 16:09:02', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050204160902', 'admin', '20050204160902');
INSERT INTO `care_news_article` VALUES (22, 'en', 1, '1', 'pending', 'Care2x was demonstrated in a national ICT meeting', '', '<font size="2" face="arial,verdana,helvetica,sans serif" color="#000033">National\r\nmeeting on ICT in health sector was held in Mwanza 1-4-2.2005. One\r\ncentral topic was management of information systems in health sector.\r\nCare 2x was demonstrated there. Partipanct aggreed that open source and\r\nfree software is the future in Tanzania.<br /><br />Among participants were\r\nrepresentatives from big hospitals like KCMC, Bugando, Kariuki and\r\nMuhimbili. Project team was formed to join scarce forces to work on common goal..<br /></font>\r\n', NULL, '', 3, '', '', '1147889048', 'Mauri Niemi', '2005-02-05 08:10:52', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205081052', 'admin', '20050205081052');
INSERT INTO `care_news_article` VALUES (23, 'en', 1, '1', 'pending', 'Care2x was demonstrated in a national ICT meeting', '', '<font size="2" face="arial,verdana,helvetica,sans serif" color="#000033">National\r\nmeeting on ICT in health sector was held in Mwanza 1-4-2.2005. One\r\ncentral topic was management of information systems in health sector.\r\nCare 2x was demonstrated there. Partipanct aggreed that open source and\r\nfree software is the future in Tanzania.<br /><br />Among participants were\r\nrepresentatives from big hospitals like KCMC, Bugando, Kariuki and\r\nMuhimbili. Project team was formed to join forces to work on a common goal.<br /></font>\r\n', NULL, '', 3, '', '', '61208290', 'Mauri Niemi', '2005-02-05 08:12:24', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205081224', 'admin', '20050205081224');
INSERT INTO `care_news_article` VALUES (24, 'en', 1, '1', 'pending', 'Care2x was discussed in a national ICT meeting', '', 'National meeting on ICT in health sector was held in Mwanza 1-4-2.2005. One central topic was management of information systems in health sector. Care 2x was demonstrated there. Partipanct aggreed that open source and free software is the future in Tanzania.<br /><br />Among participants were representatives from big hospitals like KCMC, Bugando, Kariuki and Muhimbili. Project team was formed to join forces to work on a common goal.\r\n', NULL, '', 3, '', '', '621744209', 'Mauri Niemi', '2005-02-05 08:13:42', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205081342', 'admin', '20050205081342');
INSERT INTO `care_news_article` VALUES (25, 'en', 1, '1', 'pending', 'Care2x demonstrated in a national ICT meeting', '', 'National meeting on ICT in health sector was held in Mwanza 1-4-2.2005. One central topic was management of information systems in health sector. Care 2x was demonstrated there. Partipants aggreed that open source and free software is the future in Tanzania.<br /><br />Among participants were representatives from big hospitals like KCMC, Bugando, Kariuki and Muhimbili. Project team was formed to join forces to work on a common goal.\r\n', NULL, '', 3, '', '', '404709206', 'Mauri Niemi', '2005-02-05 08:15:26', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205081526', 'admin', '20050205081526');
INSERT INTO `care_news_article` VALUES (26, 'en', 1, '1', 'pending', 'Care2x discussed in a national ICT meeting', '', 'National meeting on ICT in health sector was held in Mwanza 1-4-2.2005. One central topic was management of information systems in health sector. Care 2x was demonstrated there. Partipants aggreed that open source and free software is the future in Tanzania.<br /><br />Among participants were representatives from big hospitals like KCMC, Bugando, Kairuki and Muhimbili. Project team was formed to join forces to work on a common goal. \r\n', NULL, '', 3, '', '', '318652455', 'Mauri Niemi', '2005-02-05 09:37:05', '0000-00-00 00:00:00', '2005-02-04', 'admin', '20050205093705', 'admin', '20050205093705');

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
) TYPE=MyISAM AUTO_INCREMENT=10000016 ;

-- 
-- Daten für Tabelle `care_person`
-- 

INSERT INTO `care_person` VALUES (10000000, '2004-12-15 10:29:01', 'Major', 'Major', '', '', 'Major', 'AMERICAN', '', '1900-01-01', 'A', '', '', '', '111', 0, 0, '', '0', '', '0', '', '', '', '', '', 'single', 'm', 'Major', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-28 13:06:11', 'normal', 'Init.reg. 2004-12-15 10:29:01 admin\n\nView 2005-01-07 08:31:05 = admin\nView 2005-01-11 11:54:45 = admin\nView 2005-02-14 11:27:44 = admin\nView 2005-02-21 11:19:27 = demo\nView 2005-02-26 20:15:54 = demo\nView 2005-02-28 13:05:44 = adminUpdate 2005-02-28 13:06:11 admin \n\nView 2005-02-28 13:15:52 = admin\nView 2005-02-28 17:19:30 = admin', 'admin', '20050228171930', 'admin', '20041215102901', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000001, '2005-02-03 17:25:03', 'test', 'test', 'test', '', 'test', 'AMERICAN', 'test', '2004-07-01', '', '', '', '', '2004', 0, 0, '', '0', '', '0', '', '', '', '', '', '', 'm', 'test', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-28 13:21:20', 'normal', 'Init.reg. 2005-02-03 17:25:03 demo\n\nView 2005-02-07 12:47:04 = admin\nView 2005-02-07 12:47:39 = admin\nView 2005-02-08 06:18:56 = admin\nView 2005-02-08 06:21:05 = admin\nView 2005-02-19 04:46:17 = admin\nView 2005-02-19 04:58:09 = admin\nView 2005-02-19 05:12:57 = admin\nView 2005-02-28 13:08:29 = admin\nView 2005-02-28 13:08:35 = admin\nView 2005-02-28 13:09:57 = admin\nView 2005-02-28 13:12:00 = admin\nView 2005-02-28 13:14:16 = admin\nView 2005-02-28 13:15:30 = admin\nView 2005-02-28 13:16:00 = admin\nView 2005-02-28 13:16:12 = admin\nView 2005-02-28 13:16:15 = admin\nView 2005-02-28 13:17:24 = adminUpdate 2005-02-28 13:20:20 admin \nUpdate 2005-02-28 13:20:36 admin \nUpdate 2005-02-28 13:20:42 admin \nUpdate 2005-02-28 13:20:46 admin \nUpdate 2005-02-28 13:21:20 admin \n\nView 2005-03-01 14:05:13 = admin', 'admin', '20050301140513', 'demo', '20050203172503', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000002, '2005-02-17 16:08:40', 'lnljnl', 'jnljnl', 'jnl', NULL, 'kmlmlnln', NULL, 'sdfsd', '2004-07-01', '', '', '', '', '3333', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'kjkj', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-17 16:08:40 admin\n\nView 2005-02-19 04:10:00 = admin\nView 2005-02-21 11:46:35 = admin', '', '20050221114635', 'admin', '20050217160840', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000003, '2005-02-18 17:03:16', 'bkh', 'hbkjb', 'kjb', NULL, 'dfgdfgbsdgbskjdbkj', NULL, 'kjb', '2003-07-01', '', '', '', '', '2222', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-18 17:03:16 admin\n\nView 2005-02-19 04:46:48 = admin\nView 2005-02-19 05:10:23 = admin\nView 2005-02-21 11:21:00 = demo\nView 2005-02-22 12:20:42 = demo', '', '20050222122042', 'admin', '20050218170316', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000004, '2005-02-19 04:24:57', 'Heikki', '', '', '', 'Kallio', 'BARIBARI', '', '1999-12-12', 'A', '', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', 'single', 'm', 'Teacher', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-19 04:31:01', 'normal', 'Init.reg. 2005-02-19 04:24:57 admin\nUpdate 2005-02-19 04:26:10 admin \nUpdate 2005-02-19 04:30:13 admin \nUpdate 2005-02-19 04:31:01 admin \n\nView 2005-02-19 04:32:33 = admin\nView 2005-02-19 04:32:36 = admin\nView 2005-02-19 04:41:58 = admin\nView 2005-02-19 04:42:31 = admin\nView 2005-02-19 04:43:55 = admin\nView 2005-02-19 04:44:30 = admin\nView 2005-02-19 04:45:43 = admin\nView 2005-02-19 04:48:04 = admin\nView 2005-02-19 04:54:16 = admin\nView 2005-02-19 04:58:32 = admin\nView 2005-02-19 04:59:16 = admin', 'admin', '20050219045916', 'admin', '20050219042457', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000005, '2005-02-22 13:41:54', 'Yako', '', '', '', 'Habari', 'MBULU', '', '1955-01-01', 'A', '', '', '', '1234', 0, 0, '', '0', '', '0', '', '', '', '', '', '', 'f', 'Nurse', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-22 13:47:30', 'normal', 'Init.reg. 2005-02-22 13:41:54 admin\nUpdate 2005-02-22 13:47:30 admin \n\nView 2005-02-22 13:47:55 = admin\nView 2005-02-22 13:47:59 = admin\nView 2005-02-22 13:51:02 = admin\nView 2005-02-22 13:52:02 = admin\nView 2005-02-22 13:55:54 = admin\nView 2005-02-28 17:20:03 = admin', 'admin', '20050228172003', 'admin', '20050222134154', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000006, '2005-02-25 06:51:35', 'Chui', NULL, NULL, NULL, 'Simba', 'MCHAGGA', '', '1960-12-12', 'A', '', '', '', '12345', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'Nurse', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-25 06:51:35 admin\n', '', '20050225065135', 'admin', '20050225065135', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000007, '2005-02-25 12:29:59', 'Michael', NULL, NULL, NULL, 'Mtoto', 'MCHAGGA', '', '1953-07-01', 'A', '', '', '', '1234', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'Fundi', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-25 12:29:59 admin\n\nView 2005-02-25 12:35:00 = admin', '', '20050225123500', 'admin', '20050225122959', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000008, '2005-02-26 09:23:56', 'Voitto', '', '', '', 'Makela', 'BARIBARI', '', '0000-00-00', 'A', 'neg', '', '', '1234', 0, 0, '', '0', '', '0', '', '', '', '', '', '', 'm', 'Fundi', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-26 09:29:24', 'normal', 'Init.reg. 2005-02-26 09:23:56 admin\nUpdate 2005-02-26 09:25:08 admin \nUpdate 2005-02-26 09:27:35 admin \nUpdate 2005-02-26 09:27:58 admin \nUpdate 2005-02-26 09:28:24 admin \nUpdate 2005-02-26 09:29:04 admin \nUpdate 2005-02-26 09:29:24 admin \n\nView 2005-02-28 13:15:51 = admin', 'admin', '20050228131551', 'admin', '20050226092356', 'Bukoba', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000009, '2005-02-26 09:34:01', 'Kalle', '', '', '', 'Kontula', 'BARIBARI', '', '0000-00-00', 'A', 'pos', '', '', '', 0, 0, '', '0', '1234567', '0', '', '0744223322', '', '', '', '', 'm', 'Laulaja', NULL, '', 0, NULL, '', '', 'lutheran', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-26 09:49:32', 'normal', 'Init.reg. 2005-02-26 09:34:01 admin\nUpdate 2005-02-26 09:34:33 admin \nUpdate 2005-02-26 09:40:28 admin \nUpdate 2005-02-26 09:41:20 admin \nUpdate 2005-02-26 09:44:07 admin \nUpdate 2005-02-26 09:44:40 admin \nUpdate 2005-02-26 09:47:20 admin \nUpdate 2005-02-26 09:47:52 admin \nUpdate 2005-02-26 09:49:32 admin \n', 'admin', '20050226094932', 'admin', '20050226093401', 'Tanga', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000010, '2005-02-28 12:59:23', 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdfdfs', 'kmlsfd', 'AMERICAN', 'sdfsdf', '1985-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'cvlkm', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 12:59:23 admin\n', '', '20050228125923', 'admin', '20050228125923', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000011, '2005-02-28 13:02:28', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'AMERICAN', 'asdasd', '1983-07-01', 'O', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'married', 'm', 'asdasd', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 13:02:28 admin\n', '', '20050228130228', 'admin', '20050228130228', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000012, '2005-02-28 13:03:37', 'tester', 'tester', 'tester', 'tester', 'tester', NULL, 'tester', '1983-07-01', 'A', 'pos', '', '', 'aaa', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, 'single', 'm', 'tester', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 13:03:37 admin\n', '', '20050228130337', 'admin', '20050228130337', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000013, '2005-02-28 13:40:48', 'Kunnollinen', '', '', '', 'Kalle', 'Mzungu', '', '1970-07-01', 'O', 'neg', '', '', '', 0, 0, '', '0', '', '0', '', '', '', '', '', '', 'm', 'Poliisi', NULL, '', 0, NULL, '', '', '', 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, '2005-02-28 13:46:03', 'normal', 'Init.reg. 2005-02-28 13:40:48 admin\nUpdate 2005-02-28 13:42:11 admin \nUpdate 2005-02-28 13:42:43 admin \nUpdate 2005-02-28 13:44:07 admin \nUpdate 2005-02-28 13:46:03 admin \n', 'admin', '20050228134603', 'admin', '20050228134048', 'Dodoma', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000014, '2005-02-28 13:49:10', 'Terve', NULL, NULL, NULL, 'Tiina', 'Mzungu', '', '1949-07-01', 'A', 'pos', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'f', 'Pyykkäri', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 13:49:10 admin\n', '', '20050228134910', 'admin', '20050228134910', 'Arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `care_person` VALUES (10000015, '2005-02-28 13:50:39', 'Menijä', NULL, NULL, NULL, 'vauhko', 'mzungu', '', '1983-07-01', 'B', '', '', '', '', 0, 0, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, '', 'm', 'kuski', NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, '0', '0000-00-00', 0, NULL, NULL, NULL, 'normal', 'Init.reg. 2005-02-28 13:50:39 admin\n', '', '20050228135039', 'admin', '20050228135039', 'arusha', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
) TYPE=MyISAM AUTO_INCREMENT=100001 ;

-- 
-- Daten für Tabelle `care_personell`
-- 

INSERT INTO `care_personell` VALUES (100000, '1', 10000012, 0, 'arzt', '2000-07-01', NULL, '...', '2001-07-01', NULL, 0, '3', '3', '2', '2', '2', 0, 0.00, 0, 0, 0, '', 'Create: 2005-02-28 13:04:24 = admin\n', '', '20050228130424', 'admin', '20050228130424');

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
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Daten für Tabelle `care_personell_assignment`
-- 

INSERT INTO `care_personell_assignment` VALUES (1, 100000, 17, 1, 39, '2005-02-28', '0000-00-00', NULL, 0, '', 'Add: 2005-02-28 13:04:41 = admin\n', 'admin', '20050228130441', 'admin', '20050228130441');

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
) TYPE=MyISAM AUTO_INCREMENT=47 ;

-- 
-- Daten für Tabelle `care_room`
-- 

INSERT INTO `care_room` VALUES (1, 2, '2003-04-27', '0000-00-00', 0, 1, 0, 0, 1, '', NULL, '', '', '', '20030427175459', '', '20030427175459');
INSERT INTO `care_room` VALUES (2, 2, '2003-04-27', '0000-00-00', 0, 2, 0, 0, 1, '', NULL, '', '', '', '20030427175704', '', '20030427175631');
INSERT INTO `care_room` VALUES (3, 2, '2003-04-27', '0000-00-00', 0, 3, 0, 0, 1, '', NULL, '', '', '', '20030427175813', '', '20030427175727');
INSERT INTO `care_room` VALUES (4, 2, '2003-04-27', '0000-00-00', 0, 4, 0, 0, 1, '', NULL, '', '', '', '20030427180021', '', '20030427175846');
INSERT INTO `care_room` VALUES (5, 2, '2003-04-27', '0000-00-00', 0, 5, 0, 0, 1, '', NULL, '', '', '', '20030427180132', '', '20030427175927');
INSERT INTO `care_room` VALUES (6, 2, '2003-04-27', '0000-00-00', 0, 6, 0, 0, 1, '', NULL, '', '', '', '20030427180122', '', '20030427180105');
INSERT INTO `care_room` VALUES (7, 2, '2003-04-27', '0000-00-00', 0, 7, 0, 0, 1, '', NULL, '', '', '', '20030427180310', '', '20030427180310');
INSERT INTO `care_room` VALUES (8, 2, '2003-04-27', '0000-00-00', 0, 8, 0, 0, 1, '', NULL, '', '', '', '20030427180350', '', '20030427180350');
INSERT INTO `care_room` VALUES (9, 2, '2003-04-27', '0000-00-00', 0, 9, 0, 0, 1, '', NULL, '', '', '', '20030427180433', '', '20030427180433');
INSERT INTO `care_room` VALUES (10, 2, '2003-04-27', '0000-00-00', 0, 10, 0, 0, 1, '', NULL, '', '', '', '20030427180503', '', '20030427180503');
INSERT INTO `care_room` VALUES (11, 2, '2003-04-27', '0000-00-00', 0, 11, 0, 0, 1, '', NULL, '', '', '', '20030427180636', '', '20030427180636');
INSERT INTO `care_room` VALUES (12, 2, '2003-04-27', '0000-00-00', 0, 12, 0, 0, 1, '', NULL, '', '', '', '20030427180759', '', '20030427180759');
INSERT INTO `care_room` VALUES (13, 2, '2003-04-27', '0000-00-00', 0, 13, 0, 0, 1, '', NULL, '', '', '', '20030427180826', '', '20030427180826');
INSERT INTO `care_room` VALUES (14, 2, '2003-04-27', '0000-00-00', 0, 14, 0, 0, 1, '', NULL, '', '', '', '20030427180852', '', '20030427180852');
INSERT INTO `care_room` VALUES (15, 2, '2003-04-27', '0000-00-00', 0, 15, 0, 0, 1, '', NULL, '', '', '', '20030427180918', '', '20030427180918');
INSERT INTO `care_room` VALUES (16, 1, '2005-02-22', '0000-00-00', 0, 1, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (17, 1, '2005-02-22', '0000-00-00', 0, 2, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (18, 1, '2005-02-22', '0000-00-00', 0, 3, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (19, 1, '2005-02-22', '0000-00-00', 0, 4, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (20, 1, '2005-02-22', '0000-00-00', 0, 5, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (21, 1, '2005-02-22', '0000-00-00', 0, 6, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (22, 1, '2005-02-22', '0000-00-00', 0, 7, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (23, 1, '2005-02-22', '0000-00-00', 0, 8, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (24, 1, '2005-02-22', '0000-00-00', 0, 9, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (25, 1, '2005-02-22', '0000-00-00', 0, 10, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (26, 1, '2005-02-22', '0000-00-00', 0, 11, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (27, 1, '2005-02-22', '0000-00-00', 0, 12, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (28, 1, '2005-02-22', '0000-00-00', 0, 13, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (29, 1, '2005-02-22', '0000-00-00', 0, 14, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (30, 1, '2005-02-22', '0000-00-00', 0, 15, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (31, 1, '2005-02-22', '0000-00-00', 0, 16, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (32, 1, '2005-02-22', '0000-00-00', 0, 17, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (33, 1, '2005-02-22', '0000-00-00', 0, 18, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (34, 1, '2005-02-22', '0000-00-00', 0, 19, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (35, 1, '2005-02-22', '0000-00-00', 0, 20, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (36, 1, '2005-02-22', '0000-00-00', 0, 21, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (37, 1, '2005-02-22', '0000-00-00', 0, 22, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (38, 1, '2005-02-22', '0000-00-00', 0, 23, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (39, 1, '2005-02-22', '0000-00-00', 0, 24, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (40, 1, '2005-02-22', '0000-00-00', 0, 25, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (41, 1, '2005-02-22', '0000-00-00', 0, 26, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (42, 1, '2005-02-22', '0000-00-00', 0, 27, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (43, 1, '2005-02-22', '0000-00-00', 0, 28, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (44, 1, '2005-02-22', '0000-00-00', 0, 29, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (45, 1, '2005-02-22', '0000-00-00', 0, 30, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');
INSERT INTO `care_room` VALUES (46, 1, '2005-02-22', '0000-00-00', 0, 31, 1, 0, 2, '', '', '', 'Created: 2005-02-22 12:24:43 demo\n', '', '20050222122443', 'demo', '20050222122443');

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

INSERT INTO `care_sessions` VALUES ('b9f7b69ad8fc9e7b15107e06d047726d', 1111077160, '', 'sess_user_name%7Cs%3A7%3A%22default%22%3Bsess_user_origin%7Cs%3A10%3A%22main_start%22%3Bsess_file_forward%7CN%3Bsess_file_return%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_file_break%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_path_referer%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_dept_nr%7Cs%3A1%3A%221%22%3Bsess_title%7Cs%3A21%3A%22Headline%3A%3ASubmit%20News%22%3Bsess_lang%7Cs%3A2%3A%22en%22%3Bsess_user_id%7Cs%3A41%3A%22CFG420cc23c53bb70.34300300%201108132412.cfg%22%3Bsess_cur_page%7CN%3Bsess_searchkey%7CN%3Bsess_tos%7Cs%3A6%3A%22143211%22%3Bsess_news_nr%7CN%3Bsess_file_editor%7Cs%3A28%3A%22headline-edit-select-art.php%22%3Bsess_file_reader%7Cs%3A17%3A%22headline-read.php%22%3B');
INSERT INTO `care_sessions` VALUES ('7bd62611d47d2e9c69145afdda8fc9f9', 1111078983, '', 'sess_user_name%7Cs%3A7%3A%22default%22%3Bsess_user_origin%7Cs%3A10%3A%22main_start%22%3Bsess_file_forward%7CN%3Bsess_file_return%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_file_break%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_path_referer%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_dept_nr%7Cs%3A1%3A%221%22%3Bsess_title%7Cs%3A21%3A%22Headline%3A%3ASubmit%20News%22%3Bsess_lang%7Cs%3A2%3A%22en%22%3Bsess_user_id%7Cs%3A41%3A%22CFG420cc23c53bb70.34300300%201108132412.cfg%22%3Bsess_cur_page%7CN%3Bsess_searchkey%7CN%3Bsess_tos%7Cs%3A6%3A%22150235%22%3Bsess_news_nr%7CN%3Bsess_file_editor%7Cs%3A28%3A%22headline-edit-select-art.php%22%3Bsess_file_reader%7Cs%3A17%3A%22headline-read.php%22%3B');
INSERT INTO `care_sessions` VALUES ('12ecdbefe10772c05a99c53c6e206ff0', 1111064544, '', 'sess_user_name%7Cs%3A4%3A%22demo%22%3Bsess_user_origin%7Cs%3A10%3A%22main_start%22%3Bsess_file_forward%7Cs%3A47%3A%22..%2F..%2Fmodules%2Fnews%2Feditor-4plus1-select-art.php%22%3Bsess_file_return%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_file_break%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_path_referer%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_dept_nr%7Cs%3A1%3A%221%22%3Bsess_title%7Cs%3A21%3A%22Headline%3A%3ASubmit%20News%22%3Bsess_lang%7Cs%3A2%3A%22en%22%3Bsess_user_id%7Cs%3A41%3A%22CFG42371defa399e0.67011900%201110908399.cfg%22%3Bsess_cur_page%7CN%3Bsess_searchkey%7CN%3Bsess_tos%7Cs%3A6%3A%22110110%22%3Bsess_news_nr%7CN%3Bsess_file_editor%7Cs%3A28%3A%22headline-edit-select-art.php%22%3Bsess_file_reader%7Cs%3A17%3A%22headline-read.php%22%3B');
INSERT INTO `care_sessions` VALUES ('86310cca734e24f4eb44eadca8c35bed', 1111138427, '', 'sess_user_name%7Cs%3A7%3A%22default%22%3Bsess_user_origin%7Cs%3A10%3A%22main_start%22%3Bsess_file_forward%7CN%3Bsess_file_return%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_file_break%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_path_referer%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_dept_nr%7Cs%3A1%3A%221%22%3Bsess_title%7Cs%3A21%3A%22Headline%3A%3ASubmit%20News%22%3Bsess_lang%7Cs%3A2%3A%22en%22%3Bsess_user_id%7Cs%3A41%3A%22CFG4205c1ee796110.49717700%201107673582.cfg%22%3Bsess_cur_page%7CN%3Bsess_searchkey%7CN%3Bsess_tos%7Cs%3A6%3A%22073307%22%3Bsess_news_nr%7CN%3Bsess_file_editor%7Cs%3A28%3A%22headline-edit-select-art.php%22%3Bsess_file_reader%7Cs%3A17%3A%22headline-read.php%22%3B');
INSERT INTO `care_sessions` VALUES ('4dc74cce086bd101f3e0f1ae0fdaae4a', 1111148805, '', 'sess_user_name%7Cs%3A7%3A%22default%22%3Bsess_user_origin%7Cs%3A10%3A%22main_start%22%3Bsess_file_forward%7CN%3Bsess_file_return%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_file_break%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_path_referer%7Cs%3A27%3A%22modules%2Fnews%2Fstart_page.php%22%3Bsess_dept_nr%7Cs%3A1%3A%221%22%3Bsess_title%7Cs%3A21%3A%22Headline%3A%3ASubmit%20News%22%3Bsess_lang%7Cs%3A2%3A%22en%22%3Bsess_user_id%7Cs%3A41%3A%22CFG4205c1ee796110.49717700%201107673582.cfg%22%3Bsess_cur_page%7CN%3Bsess_searchkey%7CN%3Bsess_tos%7Cs%3A6%3A%22102607%22%3Bsess_news_nr%7CN%3Bsess_file_editor%7Cs%3A28%3A%22headline-edit-select-art.php%22%3Bsess_file_reader%7Cs%3A17%3A%22headline-read.php%22%3B');

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
  `validator` varchar(15) NOT NULL default '',
  `validate_dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(20) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`job_id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- Daten für Tabelle `care_test_findings_chemlab`
-- 

INSERT INTO `care_test_findings_chemlab` VALUES (1, 2005500004, '10000000', '2005-03-08', '16:51:57', '1', 'a:1:{i:9;s:3:"100";}', '', '0000-00-00 00:00:00', '', 'Create 2005-03-08 16:51:57 admin\n', '', '20050308165157', 'admin', '20050308165157');
INSERT INTO `care_test_findings_chemlab` VALUES (2, 2005500004, '10000000', '2005-03-08', '16:55:15', '6', 'a:1:{i:44;s:2:"10";}', '', '0000-00-00 00:00:00', '', 'Create 2005-03-08 16:55:15 admin\n', '', '20050308165515', 'admin', '20050308165515');
INSERT INTO `care_test_findings_chemlab` VALUES (3, 2005500004, '10000001', '2005-03-09', '06:43:34', '3', 'a:3:{i:25;s:2:"12";i:32;s:8:"negative";i:30;s:2:"50";}', '', '0000-00-00 00:00:00', '', 'Create 2005-03-09 06:43:34 admin\n', '', '20050309064334', 'admin', '20050309064334');
INSERT INTO `care_test_findings_chemlab` VALUES (4, 2005500007, '10000003', '2005-03-09', '07:30:02', '2', 'a:1:{i:21;s:41:"wbc 5-10, rbc  <5, epithelial cells 10-20";}', '', '0000-00-00 00:00:00', '', 'Create 2005-03-09 07:30:02 admin\n', '', '20050309073002', 'admin', '20050309073002');

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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_test_group`
-- 


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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_test_param`
-- 


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
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) TYPE=MyISAM AUTO_INCREMENT=10000007 ;

-- 
-- Daten für Tabelle `care_test_request_chemlabor`
-- 

INSERT INTO `care_test_request_chemlabor` VALUES (10000000, 2005500004, '', 0, '_task9_=1', '', 0, '', '2005-03-08 16:51:46', '16:45:00', 2, 'pending', 'Create: 2005-03-08 16:51:46 = admin\n', 'admin', '20050308165146', 'admin', '20050308165146');
INSERT INTO `care_test_request_chemlabor` VALUES (10000001, 2005500004, '', 0, '_task32_=1&_task25_=1&_task30_=1', '', 0, '', '2005-03-09 06:40:41', '06:30:00', 3, 'done', 'Create: 2005-03-09 06:40:41 = admin\nDone: 2005-03-09 06:43:57 = admin\n', 'admin', '20050309064357', 'admin', '20050309064041');
INSERT INTO `care_test_request_chemlabor` VALUES (10000002, 2005500001, '', 0, '_task48_=1', '', 0, '', '2005-03-09 06:55:27', '06:45:00', 3, 'pending', 'Create: 2005-03-09 06:55:27 = admin\n', 'admin', '20050309065527', 'admin', '20050309065527');
INSERT INTO `care_test_request_chemlabor` VALUES (10000003, 2005500007, '', 0, '_task21_=1', '', 0, '', '2005-03-09 07:28:01', '07:15:00', 3, 'pending', 'Create: 2005-03-09 07:28:01 = admin\n', 'admin', '20050309072801', 'admin', '20050309072801');
INSERT INTO `care_test_request_chemlabor` VALUES (10000004, 2005500007, '', 0, '_task9_=1&_task21_=1', '', 0, '', '2005-03-11 13:37:27', '13:30:00', 5, 'pending', 'Create: 2005-03-11 13:37:27 = admin\n', 'admin', '20050311133727', 'admin', '20050311133727');
INSERT INTO `care_test_request_chemlabor` VALUES (10000005, 2005500004, '', 0, '_task39_=1', '', 0, '', '2005-03-11 16:02:50', '16:00:00', 5, 'pending', 'Create: 2005-03-11 16:02:50 = demo\n', 'demo', '20050311160250', 'demo', '20050311160250');
INSERT INTO `care_test_request_chemlabor` VALUES (10000006, 2005500003, '', 0, '_task44_=1&_task80_=1&_task81_=1', '', 0, '', '2005-03-15 20:01:46', '20:00:00', 2, 'pending', 'Create: 2005-03-15 20:01:46 = admin\n', 'admin', '20050315200146', 'admin', '20050315200146');

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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Daten für Tabelle `care_test_request_patho`
-- 


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

INSERT INTO `care_type_discharge` VALUES (1, 'regular', 'Regular discharge', 'LDRegularRelease', '', '', '20030415010555', '', '20030413121226');
INSERT INTO `care_type_discharge` VALUES (2, 'own', 'Patient left hospital on his own will', 'LDSelfRelease', '', '', '20030415010606', '', '20030413121317');
INSERT INTO `care_type_discharge` VALUES (3, 'emergency', 'Emergency discharge', 'LDEmRelease', '', '', '20030415010617', '', '20030413121452');
INSERT INTO `care_type_discharge` VALUES (4, 'change_ward', 'Change of ward', 'LDChangeWard', '', '', '00000000000000', '', '20030413121526');
INSERT INTO `care_type_discharge` VALUES (6, 'change_bed', 'Change of bed', 'LDChangeBed', '', '', '20030415000942', '', '20030413121619');
INSERT INTO `care_type_discharge` VALUES (7, 'death', 'Death of patient', 'LDPatientDied', '', '', '20030415010642', '', '00000000000000');
INSERT INTO `care_type_discharge` VALUES (5, 'change_room', 'Change of room', 'LDChangeRoom', '', '', '20030415010659', '', '00000000000000');
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
INSERT INTO `care_type_feeding` VALUES (4, 2, 'parenteral', 'Parenteral', 'LDParenteral', '', '', '', '20030727221351', '', '00000000000000');
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

INSERT INTO `care_type_localization` VALUES (1, 'left', 'Left', 'LDLeft', 'L', 'LDLeft_s', '', '0', '', '', '', '20030525150414', '', '20030525150414');
INSERT INTO `care_type_localization` VALUES (2, 'right', 'Right', 'LDRight', 'R', 'LDRight_s', '', '0', '', '', '', '20030525150522', '', '20030525150500');
INSERT INTO `care_type_localization` VALUES (3, 'both_side', 'Both sides', 'LDBothSides', 'B', 'LDBothSides_s', '', '0', '', '', '', '20030525150618', '', '20030525150618');

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
INSERT INTO `care_type_measurement` VALUES (8, 'bp_composite', 'Sys/Dias', 'LDSysDias', '', '', '20030419143920', '', '20030419143920');
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

INSERT INTO `care_type_notes` VALUES (1, 'histo_physical', 'Admission History and Physical', 'LDAdmitHistoPhysical', 5, '', '', '20030517182939', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (2, 'daily_doctor', 'Doctor''s daily notes', 'LDDoctorDailyNotes', 55, '', '', '20030517183835', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (3, 'discharge', 'Discharge summary', 'LDDischargeSummary', 50, '', '', '20030517183707', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (4, 'consult', 'Consultation notes', 'LDConsultNotes', 25, '', '', '20030517183151', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (5, 'op', 'Operation notes', 'LDOpNotes', 100, '', '', '20030517184314', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (6, 'daily_ward', 'Daily ward''s notes', 'LDDailyNurseNotes', 30, '', '', '20030517183212', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (7, 'daily_chart_notes', 'Chart notes', 'LDChartNotes', 20, '', '', '20030517183141', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (8, 'chart_notes_etc', 'PT,ATG,etc. daily notes', 'LDPTATGetc', 115, '', '', '20030517184356', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (9, 'daily_iv_notes', 'IV daily notes', 'LDIVDailyNotes', 75, '', '', '20030517184024', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (10, 'daily_anticoag', 'Anticoagulant daily notes', 'LDAnticoagDailyNotes', 15, '', '', '20030517183117', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (11, 'lot_charge_nr', 'Material LOT, Charge Nr.', 'LDMaterialLOTChargeNr', 80, '', '', '20030517184039', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (12, 'text_diagnosis', 'Diagnosis text', 'LDDiagnosis', 40, '', '', '20030517183530', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (13, 'text_therapy', 'Therapy text', 'LDTherapy', 120, '', '', '20030517184408', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (14, 'chart_extra', 'Extra notes on therapy & diagnosis', 'LDExtraNotes', 65, '', '', '20030517183912', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (15, 'nursing_report', 'Nursing care report', 'LDNursingReport', 85, '', '', '20030517184141', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (16, 'nursing_problem', 'Nursing problem report', 'LDNursingProblemReport', 95, '', '', '20030517184208', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (17, 'nursing_effectivity', 'Nursing effectivity report', 'LDNursingEffectivityReport', 90, '', '', '20030517184156', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (18, 'nursing_inquiry', 'Inquiry to doctor', 'LDInquiryToDoctor', 70, '', '', '20030517183951', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (19, 'doctor_directive', 'Doctor''s directive', 'LDDoctorDirective', 60, '', '', '20030517183859', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (20, 'problem', 'Problem', 'LDProblem', 110, '', '', '20030517184345', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (21, 'development', 'Development', 'LDDevelopment', 35, '', '', '20030517183228', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (22, 'allergy', 'Allergy', 'LDAllergy', 10, '', '', '20030517184439', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (23, 'daily_diet', 'Diet plan', 'LDDietPlan', 45, '', '', '20030517183545', '', '00000000000000');
INSERT INTO `care_type_notes` VALUES (99, 'other', 'Other', 'LDOther', 105, '', '', '20030517184331', '', '00000000000000');

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
INSERT INTO `care_type_perineum` VALUES (2, '1_degree', '1st degree tear', 'LDFirstDegreeTear', '', '', '', '20030727212219', '', '00000000000000');
INSERT INTO `care_type_perineum` VALUES (3, '2_degree', '2nd degree tear', 'LDSecondDegreeTear', '', '', '', '20030727212231', '', '00000000000000');
INSERT INTO `care_type_perineum` VALUES (4, '3_degree', '3rd degree tear', 'LDThirdDegreeTear', '', '', '', '20030727212242', '', '00000000000000');
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
INSERT INTO `care_type_unit_measurement` VALUES (5, 'temperature', 'Temperature', 'LDTemperature', '', '', '', '20030419144724', '', '20030419144724');

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
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM AUTO_INCREMENT=84 ;

-- 
-- Daten für Tabelle `care_tz_laboratory_param`
-- 

INSERT INTO `care_tz_laboratory_param` VALUES (1, '1', 'Amylase', '9', '', '50', '55', '45', '60', '40', '65', '35', '', '', '', 'CONCAT(history,''Update 2005-03-16 18:16:05 admin\n'')', 'admin', '20050316181605', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (2, '1', 'Bilirubin, direct', '10', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (3, '1', 'Bilirubin, total', '11', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (4, '1', 'BUN', '12', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (5, '1', 'Creatinine', '13', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (6, '1', 'Glucose, fasting (FBG)', '14', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (7, '1', 'Glucose, random (RBG)', '15', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (8, '1', 'Potassium', '16', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (9, '1', 'SGOT', '17', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (10, '1', 'SGPT', '18', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (11, '1', 'Sodium', '19', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (12, '1', 'Uric acid', '20', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (13, '2', 'Urinalysis', '21', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (14, '2', 'Urine pregnancy test', '22', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (15, '2', '24-hour protein excretion', '23', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (16, '3', 'Complete blood count (CBC)', '24', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (17, '3', 'Hemoglobin (Hb)', '25', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (18, '3', 'White blood count (WBC)', '26', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (19, '3', 'Differential WBC', '27', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (20, '3', 'Platelet count', '28', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (21, '3', 'Reticulocyte count', '29', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (22, '3', 'Sedimentation rate (ESR)', '30', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (23, '3', 'Sickle cell test', '31', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (24, '3', 'Malaria smear (B/S)', '32', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (25, '3', 'Blood morphology', '33', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (26, '3', 'WBC, body fluid', '34', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:05:49 admin\n', 'admin', '20050310150549', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (27, '3', 'Differential WBC, body fluid', '35', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:05:36 admin\n', 'admin', '20050310150536', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (28, '4', 'ASOT', '36', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (29, '4', 'Brucella test', '37', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (30, '4', 'Hepatitis B', '38', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (31, '4', 'HIV', '39', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (32, '4', 'Quick strep test', '40', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (33, '4', 'VDRL', '41', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (34, '5', 'Analysis (WBC, parasites)', '42', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (35, '5', 'Occult blood', '43', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (36, '6', 'AFB (tuberculosis) No. 1', '44', '', '', '', '', '', '', '', '', 'checkbox', 'follow up', '', 'CONCAT(history,''Update 2005-03-14 12:59:34 admin\n'')', 'admin', '20050314125934', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (37, '6', 'Cerebrospinal fluid analysis', '45', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (38, '6', 'Culture, body fluid', '46', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:04:32 admin\n', 'admin', '20050310150432', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (39, '6', 'Culture, blood', '47', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (40, '6', 'Culture, urine', '48', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (41, '6', 'Sensitivities, bacterial', '49', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:04:48 admin\n', 'admin', '20050310150448', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (42, '7', 'Biopsy', '50', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:06:31 admin\n', 'admin', '20050310150631', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (43, '7', 'H. pylori', '51', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (44, '7', 'Pap smear', '52', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (45, '7', 'Surgical specimen', '53', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', '', 'Update 2005-03-10 15:06:19 admin\n', 'admin', '20050310150619', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (46, '8', 'Albumen', '54', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-03-16 18:19:18 admin\n'')', 'admin', '20050316181918', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (47, '8', 'Alkaline phosphatase', '55', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (48, '8', 'Bleeding time', '56', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (49, '8', 'Calcium', '57', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (50, '8', 'Chloride', '58', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (51, '8', 'Cortisol, A.M..', '59', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (52, '8', 'Cortisol, P.M', '60', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (53, '8', 'Creatine phosphokinase (CPK)', '61', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (54, '8', 'Cholesterol', '62', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (55, '8', 'Triglycerides', '63', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (56, '8', 'Follicle-stimulating hormone (FSH )', '64', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (57, '8', 'LH', '65', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (58, '8', 'High-density lipoprotein (HDL)', '66', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (59, '8', 'Low-density lipoprotein (LDL)', '67', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (60, '8', 'H. pylori', '68', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (61, '8', 'Human chorionic gonadotropin (HCG)', '69', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (62, '8', 'Iron, serum', '70', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (63, '8', 'iron-binding capacity, serum (IBC)', '71', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (64, '8', 'Prothrombin time (PT)', '72', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (65, '8', 'Partial thromboplastin time (PTT)', '73', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (66, '8', 'Rheumatoid factor', '74', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (67, '8', 'T3', '75', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (68, '8', 'Thyroxin (T4)', '76', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (69, '8', 'Thyroid stimulating factor (TSH)', '77', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (70, '8', 'Proteins, total serum', '78', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '20050308131720', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (71, '6', 'AFB (tuberculosis) No. 2', '80', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-03-10 15:03:14 admin\n'')', 'admin', '20050310150314', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (72, '6', 'AFB (tuberculosis) No. 3', '81', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-03-10 15:03:36 admin\n'')', 'admin', '20050310150336', '', '00000000000000');
INSERT INTO `care_tz_laboratory_param` VALUES (83, '1', 'Albumin', '92', '', '', '', '', '', '', '', '', '', '', '', 'CONCAT(history,''Update 2005-03-16 18:17:21 admin\n'')', 'admin', '20050316181721', '', '00000000000000');

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
) TYPE=MyISAM PACK_KEYS=0 AUTO_INCREMENT=93 ;

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
INSERT INTO `care_tz_laboratory_tests` VALUES (54, 8, 'Albumen', 0, 0, '', 0, 0);
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
INSERT INTO `care_tz_laboratory_tests` VALUES (92, 1, 'Albumin', 0, 0, '', 0, 1);

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
INSERT INTO `care_unit_measurement` VALUES (4, 1, 'ltr', 'liter', 'LDLiter', 'metric', NULL, '', '', '20030727131658', '', '00000000000000');
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
INSERT INTO `care_users` VALUES ('demo', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 0, 0, '_a_1_admissionwrite _a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingstationallread _a_1_nursingdutyplanwrite _a_2_nursingdutyplanread _a_1_diagnosticsresultwrite _a_3_diagnosticsresultread _a_2_diagnosticsreceptionwrite _a_3_diagnosticsrequest _a_1_labresultswrite _a_2_labresultsread _a_1_opdoctorallwrite _a_2_opnurseallwrite _a_3_opnurseallread _a_1_opnursedutyplanwrite _a_2_opnursedutyplanread _a_1_radiowrite _a_2_radioread _a_1_medocswrite _a_2_medocsread _a_1_pharmadbadmin _a_2_pharmareception _a_3_pharmaorder _a_4_pharmaread _a_1_meddepotdbadmin _a_2_meddepotreception _a_3_meddepotorder _a_4_meddepotread _a_1_doctorsdutyplanwrite _a_2_doctorsdutyplanread _a_1_timestampallwrite _a_2_timestampallread _a_1_dutyplanallwrite _a_2_dutyplanallread ', 0, '2005-02-03', '17:24:16', '0000-00-00', '00:00:00', 'normal', '', 'admin', '20050204083109', 'admin', '20050203172416');

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
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Daten für Tabelle `care_ward`
-- 

INSERT INTO `care_ward` VALUES (1, 'jackid', 'jack', 0, '2005-02-22', '0000-00-00', 'dickehedn', NULL, 25, 1, 31, 'jhug', '', 'Create: 2005-02-22 12:24:36 demo\n', '0', '20050222122436', 'demo', '20050222122436');
