-- developers SQL Dump
-- simple menu structure 
-- must be improved! 

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- based on development for care2x 3.0 (gettext)
--

-- --------------------------------------------------------



DROP TABLE IF EXISTS `care_menu_main`;
CREATE TABLE IF NOT EXISTS `care_menu_main` (
  `nr` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `sort_nr` tinyint(2) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;





INSERT INTO `care_menu_main` VALUES(1, 1, 'Home', '', '', 'LDHome', 'main/startframe.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(2, 5, 'Patient', '', '', 'LDPatient', 'modules/registration_admission/patient_register_pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(3, 10, 'Admission', 'admission', '', 'LDAdmission', 'modules/registration_admission/admission_pass.php', 0, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(4, 15, 'Ambulatory', '', '', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(5, 20, 'Medocs', 'medocs', '', 'LDMedocs', 'modules/medocs/medocs_pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(6, 25, 'Doctors', 'doctors', '', 'LDDoctors', 'modules/doctors/doctors.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(7, 35, 'Nursing', 'nursing', '', 'LDNursing', 'modules/nursing/nursing.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(8, 40, 'OR', 'op', 'LDOR', '', 'main/op-docu.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(9, 45, 'Laboratories', 'lab', '', 'LDLabs', 'modules/laboratory/labor.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(10, 50, 'Radiology', 'radio', '', 'LDRadiology', 'modules/radiology/radiolog.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(11, 55, 'Pharmacy', 'pharma', '', 'LDPharmacy', 'modules/pharmacy/pharmacy.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(12, 60, 'Medical Depot', 'meddepot', '', 'LDMedDepot', 'modules/medstock/medstock.php ', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(13, 65, 'Directory', 'teldir', '', 'LDDirectory', 'modules/phone_directory/phone.php', 0, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(14, 70, 'Tech Support', 'tech', '', 'LDTechSupport', 'modules/tech/tech.php', 0, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(15, 72, 'System Admin', 'System Admin', '', 'LDEDP', 'modules/system_admin/admin.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(16, 75, 'Intranet Email', '', '', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', 0, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(18, 85, 'Special Tools', '', '', 'LDSpecials', 'main/spediens.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(19, 90, 'Login', '', '', 'LDLogin', 'main/login.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES(20, 7, 'Appointments', '', '', 'LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', 0, '', '', '20030922232015', '2003-04-05 00:01:45');

