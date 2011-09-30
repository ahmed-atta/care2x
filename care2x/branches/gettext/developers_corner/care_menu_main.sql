-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2011 at 01:59 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `care2x_gettext`
--

-- --------------------------------------------------------

--
-- Table structure for table `care_menu_main`
--

CREATE TABLE IF NOT EXISTS `care_menu_main` (
  `nr` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `sort` tinyint(2) NOT NULL DEFAULT '0',
  `parent` int(2) NOT NULL DEFAULT '0',
  `name` varchar(35) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `LD_var` varchar(35) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `is_visible` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `hide_by` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `status` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `modify_id` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `care_menu_main`
--

INSERT INTO `care_menu_main` (`nr`, `sort`, `parent`, `name`, `permission`, `image`, `LD_var`, `url`, `is_visible`, `hide_by`, `status`, `modify_id`, `modify_time`) VALUES
(2, 5, 0, 'Patient', '', '', 'LDPatient', 'modules/registration_admission/patient_register_pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(3, 10, 0, 'Admission', 'admission', '', 'LDAdmission', 'modules/registration_admission/admission_pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(4, 15, 0, 'Ambulatory', '', '', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(5, 20, 7, 'Medocs', 'medocs', '', 'LDMedocs', 'modules/medocs/medocs_pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(6, 25, 29, 'Doctors', 'doctors', '', 'LDDoctors', 'modules/doctors/doctors.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(7, 35, 0, 'Nursing', 'nursing', '', 'LDNursing', 'modules/nursing/nursing.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(8, 40, 0, 'OR', 'op', 'LDOR', '', 'modules/or_logbook/op-docu.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(9, 45, 31, 'Laboratories', 'lab', '', 'LDLabs', 'modules/laboratory/labor.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(10, 50, 31, 'Radiology', 'radio', '', 'LDRadiology', 'modules/radiology/radiolog.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(11, 55, 30, 'Pharmacy', 'pharma', '', 'LDPharmacy', 'modules/pharmacy/pharmacy.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(12, 60, 30, 'Medical Depot', 'meddepot', '', 'LDMedDepot', 'modules/medstock/medstock.php ', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(13, 65, 29, 'Directory', 'teldir', '', 'LDDirectory', 'modules/phone_directory/phone.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(14, 70, 29, 'Tech Support', 'tech', '', 'LDTechSupport', 'modules/tech/tech.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(15, 72, 29, 'System Admin', 'System Admin', '', 'LDEDP', 'modules/system_admin/admin.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(16, 75, 29, 'Intranet Email', '', '', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(18, 85, 29, 'Modules', '', '', 'LDSpecials', 'main/plugins.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(19, 90, 0, 'Login', '', '', 'LDLogin', 'main/login.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(20, 7, 2, 'Appointments', '', '', 'LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', 1, '', '', '20030922232015', '2003-04-05 00:01:45'),
(21, 0, 2, 'Admission', '', NULL, 'LDAdmission', 'modules/registration_admission/patient_register_pass.php', 1, NULL, '', NULL, '2011-08-24 22:01:58'),
(22, 0, 2, 'Registration', '', 'gui/img/common/default/post_discussion.gif', '', 'modules/registration_admission/patient_register_pass.php', 1, NULL, '', NULL, '2011-08-24 22:04:17'),
(23, 0, 2, 'Search', '', 'gui/img/common/default/findnew.gif', 'LDSearch', 'modules/registration_admission/patient_register_pass.php?target=search', 1, NULL, '', NULL, '2011-08-24 22:04:59'),
(24, 0, 2, 'Archive', '', 'LDArchive', '', 'modules/registration_admission/patient_register_pass.php?target=archiv', 1, NULL, '', NULL, '2011-08-24 22:05:50'),
(25, 0, 7, 'Wards', '', 'gui/img/common/default/bul_arrowgrnsm.gif', '', 'modules/nursing/nursing.php', 1, NULL, '', NULL, '2011-08-24 22:07:09'),
(26, 0, 3, 'Archive', '', NULL, 'LDArchive', 'modules/registration_admission/admission_pass.php?target=archiv', 1, NULL, '', NULL, '2011-08-24 22:07:39'),
(27, 0, 7, 'Search', '', 'gui/img/common/default/findnew.gif', '', 'modules/nursing/nursing-patient-search-start.php', 1, NULL, '', NULL, '2011-08-24 22:08:06'),
(28, 0, 7, 'Quick view', '', 'gui/img/common/default/eye_s.gif', '', 'modules/nursing/nursing-quickview.php', 1, NULL, '', NULL, '2011-08-24 22:08:36'),
(29, 0, 0, 'Special Tools', '', NULL, '', '', 1, NULL, '', NULL, '2011-08-29 19:12:10'),
(30, 0, 0, 'Medicaments', '', NULL, '', '', 1, NULL, '', NULL, '2011-08-29 19:20:15'),
(31, 0, 0, 'Analysis', '', NULL, '', '', 1, NULL, '', NULL, '2011-08-29 19:23:08');

