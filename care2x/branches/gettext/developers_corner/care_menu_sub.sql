-- developers SQL Dump
-- simple menu structure 
-- must be improved! 

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- based on development for care2x 3.0 (gettext)
--

-- --------------------------------------------------------


DROP TABLE IF EXISTS `care_menu_sub`;
CREATE TABLE IF NOT EXISTS `care_menu_sub` (
  `s_nr` int(11) NOT NULL DEFAULT '0',
  `s_sort_nr` int(11) NOT NULL DEFAULT '0',
  `s_main_nr` int(11) NOT NULL DEFAULT '0',
  `s_ebene` int(11) NOT NULL DEFAULT '0',
  `s_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_LD_var` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_url` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_url_ext` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_image` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_open_image` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_is_visible` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_hide_by` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_status` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_modify_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_modify_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='InnoDB free: 9216 kB';


-- --------------------------------------------------------


INSERT INTO `care_menu_sub` VALUES(3, 0, 2, 0, '', '', '', '', 'gui/img/common/default/new_group.gif', 'gui/img/common/default/new_group.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(70, 0, 7, 0, '', '', '', '', 'gui/img/common/default/nurse.gif', 'gui/img/common/default/nurse.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(20, 0, 1, 0, '', '', '', '', 'gui/img/common/default/articles.gif', 'gui/img/common/default/home.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(30, 0, 20, 0, '', '', '', '', 'gui/img/common/default/calendar.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(5, 2, 2, 1, 'Admission', 'LDAdmission', 'modules/registration_admission/admission_pass.php', '', 'gui/img/common/default/bn.gif', 'gui/img/common/default/bn.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(1, 1, 2, 1, 'Registration', '', 'modules/registration_admission/patient_register_pass.php', '&target=entry', 'gui/img/common/default/post_discussion.gif', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(130, 1, 2, 1, 'Search', 'LDSearch', 'modules/registration_admission/patient_register_pass.php', '&target=search', 'gui/img/common/default/findnew.gif', 'gui/img/common/default/findnew.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(135, 1, 2, 1, 'Archive', 'LDArchive', 'modules/registration_admission/patient_register_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(140, 5, 2, 2, 'Search', 'LDSearch', 'modules/registration_admission/admission_pass.php', '&target=search', 'gui/img/common/default/findnew.gif', 'gui/img/common/default/findnew.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(145, 6, 2, 2, 'Archive', 'LDArchive', 'modules/registration_admission/admission_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(71, 1, 7, 1, 'Wards', '', 'modules/nursing/nursing.php', '', 'gui/img/common/default/bul_arrowgrnsm.gif', 'gui/img/common/default/bul_arrowgrnsm.gif', '', '', '[station]', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(155, 1, 3, 1, 'Archive', 'LDArchive', 'modules/registration_admission/admission_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(40, 0, 3, 0, '', '', '', '', 'gui/img/common/default/bn.gif', 'gui/img/common/default/bn.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(165, 0, 13, 0, '', '', '', '', 'gui/img/common/default/violet_phone.gif', 'gui/img/common/default/violet_phone.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(7, 3, 7, 1, 'Search', '', 'modules/nursing/nursing-patient-search-start.php', '', 'gui/img/common/default/findnew.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(72, 2, 7, 1, 'Quick view', '', 'modules/nursing/nursing-quickview.php', '', 'gui/img/common/default/eye_s.gif', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(50, 0, 4, 0, '', '', '', '', 'gui/img/common/default/disc_unrd.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(120, 0, 6, 0, '', '', '', '', 'gui/img/common/default/forums.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(160, 0, 17, 0, '', '', '', '', 'gui/img/common/default/c-mail.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(190, 0, 16, 0, '', '', '', '', 'gui/img/common/default/bubble2.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(195, 0, 10, 0, '', '', '', '', 'gui/img/common/default/torso.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(200, 0, 18, 0, '', '', '', '', 'gui/img/common/default/settings_tree.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(205, 0, 11, 0, '', '', '', '', 'gui/img/common/default/add.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(160, 0, 19, 0, '', '', '', '', 'gui/img/common/default/padlock.gif', 'gui/img/common/default/bul_arrowgrnsm.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(215, 0, 15, 0, '', '', '', '', 'gui/img/common/default/sections.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(220, 0, 12, 0, '', '', '', '', 'gui/img/common/default/storage.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(225, 0, 8, 0, '', '', '', '', 'gui/img/common/default/people_search_online.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(230, 0, 9, 0, '', '', '', '', 'gui/img/common/default/chart.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO `care_menu_sub` VALUES(235, 0, 14, 0, '', '', '', '', 'gui/img/common/default/settings_tree.gif', '', '', '', '', '', '0001-01-01 00:00:00');
