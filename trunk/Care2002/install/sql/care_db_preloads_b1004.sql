# phpMyAdmin MySQL-Dump
# version 2.3.2
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: May 01, 2003 at 08:36 AM
# Server version: 3.22.34
# PHP Version: 4.0.4pl1
# Database : care2002b1004

#
# Dumping data for table care_category_diagnosis
#

INSERT INTO care_category_diagnosis VALUES ('most_responsible', 'Most responsible', 'LDMostResponsible', 'M', 'LDMostResp_s', 'Most responsible diagnosis, must be only one per admission or visit', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES ('associated', 'Associated', 'LDAssociated', 'A', 'LDAssociated_s', 'Associated diagnosis, can be several per  admission or visit', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES ('nosocomial', 'Hospital acquired', 'LDNosocomial', 'N', 'LDNosocomial_s', 'Hospital acquired problem, can be several per admission or visit', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES ('iatrogenic', 'Iatrogenic', 'LDIatrogenic', 'I', 'LDIatrogenic_s', 'Problem resulting from a procedural/surgical complication or medication mistake', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES ('other', 'Other', 'LDOther', 'O', 'LDOther_s', 'Other  diagnosis', '0', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_category_disease
#

INSERT INTO care_category_disease VALUES ('1', '2', 'asphyxia', 'Asphyxia', 'LDAsphyxia', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_disease VALUES ('2', '2', 'infection', 'Infection', 'LDInfection', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_disease VALUES ('3', '2', 'congenital_abnomality', 'Congenital abnormality', 'LDCongenitalAbnormality', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_disease VALUES ('4', '2', 'trauma', 'Trauma', 'LDTrauma', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_class_encounter
#

INSERT INTO care_class_encounter VALUES (1, 'inpatient', 'Inpatient', 'LDStationary', 'Inpatient admission - stays at least in a ward and assigned a bed', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_encounter VALUES (2, 'outpatient', 'Outpatient', 'LDAmbulant', 'Outpatient visit - does not stay in a ward nor assigned a bed', '0', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_class_ethnic_orig
#

INSERT INTO care_class_ethnic_orig VALUES (1, 'race', 'LDRace', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_ethnic_orig VALUES (2, 'country', 'LDCountry', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_class_financial
#

INSERT INTO care_class_financial VALUES (1, 'care_c', 'care', 'c', 'common', 'LDcommon', 'Common nursing care services. (Non-private)', 'Patient with common health fund insurance policy.', '', '', '', 20021229134050, '', 00000000000000);
INSERT INTO care_class_financial VALUES (2, 'care_pc', 'care', 'p/c', 'private + common', 'LDprivatecommon', 'Private services added to common services', 'Patient with common health fund insurance\r\npolicy with additional private insurance policy\r\nOR self paying components.', '', '', '', 20021229134451, '', 20021229134451);
INSERT INTO care_class_financial VALUES (3, 'care_p', 'care', 'p', 'private', 'LDprivate', 'Private nursing care services', 'Patient with private insurance policy\r\nOR self paying.', 'LDprivate', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (4, 'care_pp', 'care', 'pp', 'private plus', 'LDprivateplus', '"Very private" nursing care services', 'Patient with private health insurance policy\r\nAND self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (5, 'room_c', 'room', 'c', 'common', 'LDcommon', 'Common room services (non-private)', 'Patient with common health fund insurance policy. ', 'LDcommon', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (6, 'room_pc', 'room', 'p/c', 'private + common', '', 'Private services added to common services', 'Patient with common health fund insurance policy with additional private insurance policy OR self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (7, 'room_p', 'room', 'p', 'private', '', 'Private room services', 'Patient with private insurance policy OR self paying. ', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (8, 'room_pp', 'room', 'pp', 'private plus', '', '"Very private" room services', 'Patient with private health insurance policy AND self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (9, 'att_dr_c', 'att_dr', 'c', 'common', '', 'Common clinician services', 'Patient with common health fund insurance policy. ', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (10, 'att_dr_pc', 'att_dr', 'p/c', 'private + common', '', 'Private services added to common clinician services', 'Patient with common health fund insurance policy with additional private insurance policy OR self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (11, 'att_dr_p', 'att_dr', 'p', 'private', '', 'Private clinician services', 'Patient with private insurance policy OR self paying.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (12, 'att_dr_pp', 'att_dr', 'pp', 'private plus', '', '"Very private" clinician services', 'Patient with private health insurance policy AND self paying components.', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_class_insurance
#

INSERT INTO care_class_insurance VALUES (1, 'private', 'Private', 'LDPrivate', 'Private insurance plan (paid by insured alone)', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_insurance VALUES (2, 'common', 'Health Fund', 'LDInsurance', 'Public (common) health fund - usually paid both by the insured and his employer, eventually paid by the state', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_insurance VALUES (3, 'self_pay', 'Self pay', 'LDSelfPay', '', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_class_therapy
#

INSERT INTO care_class_therapy VALUES (1, '2', 'photo', 'Phototherapy', 'LDPhototherapy', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (2, '2', 'iv', 'IV Fluids', 'LDIVFluids', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (3, '2', 'oxygen', 'Oxygen therapy', 'LDOxygenTherapy', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (4, '2', 'cpap', 'CPAP', 'LDCPAP', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (5, '2', 'ippv', 'IPPV', 'LDIPPV', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (6, '2', 'nec', 'NEC', 'LDNEC', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (7, '2', 'tpn', 'TPN', 'LDTPN', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (8, '2', 'hie', 'HIE', 'LDHIE', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_config_global
#

INSERT INTO care_config_global VALUES ('date_format', 'dd.MM.yyyy',  NULL,  NULL, '', '', 20030425232322, '', 00000000000000);
INSERT INTO care_config_global VALUES ('time_format', 'HH.MM', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_reg_nr_adder', '10000000', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_police_nr', '11?', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_fire_dept_nr', '22?', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_emgcy_nr', '12?', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_phone', '(701??)  993???', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_fax', '(702??) 839393??', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_address', 'Virtualstr. 89<br>Cyberia 893003', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_email', 'contact@care2x.com', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_id_nr_adder', '10000000', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_outpatient_nr_adder', '20800000', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_inpatient_nr_adder', '22000000', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_2_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_3_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_middle_hide', '0',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_maiden_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_ethnic_orig_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_others_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_nat_id_nr_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_religion_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_cellphone_2_nr_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_phone_2_nr_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_citizenship_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_sss_nr_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('language_default', 'id',  NULL,  NULL, '', '', 20030329212253, '', 00000000000000);
INSERT INTO care_config_global VALUES ('language_single', '0',  NULL,  NULL, '', '', 20030329212253, '', 00000000000000);
INSERT INTO care_config_global VALUES ('mascot_hide', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('mascot_style', 'default', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_width', '150',  NULL,  NULL, '', '', 20030329212253, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_border', '1',  NULL,  NULL, '', '', 20030329212253, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_fotos_path', 'fotos/news/', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_size', '5', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_color', '#006600', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_size', '2', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_color', '#000033', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_body_font_size', '2', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_body_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_body_font_color', '#030303', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_normal_preview_maxlen', '600', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_bold', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_bold', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_normal_display_width', '500', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_fax_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_email_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_phone_1_nr_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_cellphone_1_nr_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_foto_path', 'fotos/registration/', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_service_care_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_service_room_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_service_att_dr_hide', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_financial_class_single_result', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_name_2_show', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_name_3_show', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_name_middle_show', '1',  NULL,  NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('theme_control_buttons', 'blue_aqua',  NULL,  NULL, '', '', 20030329210153, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_bdcolor', '#990000',  NULL,  NULL, '', '', 20030329212253, '', 00000000000000);
INSERT INTO care_config_global VALUES ('theme_control_theme_list', 'default,blue_aqua', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('medocs_text_preview_maxlen', '100', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('personell_nr_adder', '100000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('notes_preview_maxlen', '120',  NULL,  NULL, '', '', 20030413100412, '', 20030412201004);

#
# Dumping data for table care_config_user
#

INSERT INTO care_config_user VALUES ('default', 'a:19:{s:4:"mask";s:1:"1";s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:0:"";s:8:"bversion";s:0:"";s:2:"ip";s:0:"";s:3:"cid";s:0:"";s:5:"dhtml";s:1:"1";s:4:"lang";s:0:"";}',  NULL,  NULL,  NULL, '', 20030210161831, '', 00000000000000);

#
# Dumping data for table care_currency
#

INSERT INTO care_currency VALUES (13, '€', 'Euro', 'European currency', '', '', 20030213174719, '', 20021126200534);
INSERT INTO care_currency VALUES (20, 'KK', 'Kope', 'KOPD', '', '', 20030213200754, '', 20030213174251);
INSERT INTO care_currency VALUES (3, 'L', 'Pound', 'GB British Pound (ISO = GBP)', '', '', 20030213173107, '', 20020816230349);
INSERT INTO care_currency VALUES (22, 'dasd', 'fdaasdf', 'asdfsadfsda', '', '', 20030213174553, '', 20030213174553);
INSERT INTO care_currency VALUES (21, 'J', 'JOD', 'asfasdf', '', '', 20030213174357, '', 20030213174357);
INSERT INTO care_currency VALUES (10, 'R', 'Rand', 'South African Rand (ISO = ZAR)', 'main', '', 20030213200754, 'Elpidio Latorilla', 20020817171805);
INSERT INTO care_currency VALUES (8, 'R', 'Rupees', 'Indian Rupees (ISO = INR)', '', '', 20030213173059, 'Elpidio Latorilla', 20020920234306);
INSERT INTO care_currency VALUES (19, '&#836', 'Euro', 'bbbbbb', '', '', 20030213200750, '', 20030213174631);
INSERT INTO care_currency VALUES (23, '&#836', 'asfas', 'fsadf', '', '', 20030213174612, '', 20030213174612);

#
# Dumping data for table care_group
#

INSERT INTO care_group VALUES (1, 'pregnancy', 'Pregnancy', 'LDPregnancy', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (2, 'neonatal', 'Neonatal', 'LDNeonatal', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (3, 'encounter', 'Encounter', 'LDEncounter', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (4, 'op', 'OP', 'LDOP', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (5, 'anesthesia', 'Anesthesia', 'LDAnesthesia', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (6, 'prescription', 'Prescription', 'LDPrescription', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_menu_main
#

INSERT INTO care_menu_main VALUES ('1', '1', 'Home', 'LDHome', 'main/startframe.php', '1', '', '', 20030405003640, 00000000000000);
INSERT INTO care_menu_main VALUES ('2', '5', 'Patient', 'LDPatient', 'modules/registration_admission/patient.php', '1', '', '', 20030405003710, 00000000000000);
INSERT INTO care_menu_main VALUES ('3', '10', 'Admission', 'LDAdmission', 'modules/registration_admission/aufnahme_pass.php', '1', '', '', 20030405003723, 00000000000000);
INSERT INTO care_menu_main VALUES ('4', '15', 'Ambulatory', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', '1', '', '', 20030405003740, 00000000000000);
INSERT INTO care_menu_main VALUES ('5', '20', 'Medocs', 'LDMedocs', 'modules/medocs/medocs_pass.php', '1', '', '', 20030405003755, 00000000000000);
INSERT INTO care_menu_main VALUES ('6', '25', 'Doctors', 'LDDoctors', 'modules/doctors/doctors.php', '1', '', '', 20030405003814, 00000000000000);
INSERT INTO care_menu_main VALUES ('7', '35', 'Nursing', 'LDNursing', 'modules/nursing/nursing.php', '1', '', '', 20030405003828, 00000000000000);
INSERT INTO care_menu_main VALUES ('8', '40', 'OR', 'LDOR', 'main/op-doku.php', '1', '', '', 20030405003839, 00000000000000);
INSERT INTO care_menu_main VALUES ('9', '45', 'Laboratories', 'LDLabs', 'modules/laboratory/labor.php', '1', '', '', 20030405003853, 00000000000000);
INSERT INTO care_menu_main VALUES ('10', '50', 'Radiology', 'LDRadiology', 'modules/radiology/radiolog.php', '1', '', '', 20030405003906, 00000000000000);
INSERT INTO care_menu_main VALUES ('11', '55', 'Pharmacy', 'LDPharmacy', 'modules/pharmacy/apotheke.php', '1', '', '', 20030405003922, 00000000000000);
INSERT INTO care_menu_main VALUES ('12', '60', 'Medical Depot', 'LDMedDepot', 'modules/med_depot/medlager.php', '1', '', '', 20030405003937, 00000000000000);
INSERT INTO care_menu_main VALUES ('13', '65', 'Directory', 'LDDirectory', 'modules/phone_directory/phone.php', '1', '', '', 20030405003952, 00000000000000);
INSERT INTO care_menu_main VALUES ('14', '70', 'Tech Support', 'LDTechSupport', 'modules/tech/technik.php', '1', '', '', 20030405004050, 00000000000000);
INSERT INTO care_menu_main VALUES ('15', '72', 'EDP', 'LDEDP', 'modules/system_admin/edv.php', '1', '', '', 20030405004102, 00000000000000);
INSERT INTO care_menu_main VALUES ('16', '75', 'Intranet Email', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', '1', '', '', 20030405004116, 00000000000000);
INSERT INTO care_menu_main VALUES ('17', '80', 'Internet Email', 'LDInterEmail', 'modules/nocc/index.php', '1', '', '', 20030405004128, 00000000000000);
INSERT INTO care_menu_main VALUES ('18', '85', 'Special Tools', 'LDSpecials', 'main/spediens.php', '1', '', '', 20030405004142, 00000000000000);
INSERT INTO care_menu_main VALUES ('19', '90', 'Login', 'LDLogin', 'main/login.php', '1', '', '', 20030405004151, 00000000000000);
INSERT INTO care_menu_main VALUES ('20', '7', 'Appointments', 'LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', '1', '',  NULL, 20030407233801, 20030405000145);

#
# Dumping data for table care_method_induction
#

INSERT INTO care_method_induction VALUES (1, '1', 'prostaglandin', 'Prostaglandin', 'LDProstaglandin', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_method_induction VALUES (2, '1', 'oxytocin', 'Oxytocin', 'LDOxytocin', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_method_induction VALUES (3, '1', 'arom', 'AROM', 'LDAROM', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_mode_delivery
#

INSERT INTO care_mode_delivery VALUES (1, '2', 'normal', 'Normal', 'LDNormal', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (2, '2', 'breech', 'Breech', 'LDBreech', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (3, '2', 'caesarian', 'Caesarian', 'LDCaesarian', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (4, '2', 'forceps', 'Forceps', 'LDForceps', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (5, '2', 'vacuum', 'Vacuum', 'LDVacuum', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_role_person
#

INSERT INTO care_role_person VALUES (1, '3', 'contact', 'Contact person', 'LDContactPerson', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (2, '3', 'guarantor', 'Guarantor', 'LDGuarantor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (3, '3', 'doctor_att', 'Attending doctor', 'LDAttDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (4, '3', 'supervisor', 'Supervisor', 'LDSupervisor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (5, '3', 'doctor_admit', 'Admitting doctor', 'LDAdmittingDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (6, '3', 'doctor_consult', 'Consulting doctor', 'LDConsultingDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (7, '4', 'surgeon', 'Surgeon', 'LDSurgeon', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (8, '4', 'surgeon_asst', 'Assisting surgeon', 'LDAssistingSurgeon', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (9, '4', 'nurse_scrub', 'Scrub nurse', 'LDScrubNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (10, '4', 'nurse_rotating', 'Rotating nurse', 'LDRotatingNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (11, '4', 'nurse_anesthesia', 'Anesthesia nurse', 'LDAnesthesiaNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (12, '4', 'anesthesiologist', 'Anesthesiologist', 'LDAnesthesiologist', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (13, '4', 'anesthesiologist_asst', 'Assisting anesthesiologist', 'LDAssistingAnesthesiologist', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (14, '0', 'nurse_on_call', 'Nurse On Call', 'LDNurseOnCall', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (15, '0', 'doctor_on_call', 'Doctor On Call', 'LDDoctorOnCall', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (16, '0', 'nurse', 'Nurse', 'LDNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (17, '0', 'doctor', 'Doctor', 'LDDoctor', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_application
#

INSERT INTO care_type_application VALUES (1, '5', 'ita', 'ITA', 'LDITA', 'Intratracheal anesthesia', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (2, '5', 'la', 'LA', 'LDLA', 'Locally applied anesthesia', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (3, '5', 'as', 'AS', 'LDAS', 'Analgesic sedation', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (4, '5', 'mask', 'Mask', 'LDMask', 'Gas anesthesia through breathing mask', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (5, '6', 'oral', 'Oral', 'LDOral', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (6, '6', 'iv', 'Intravenous', 'LDIntravenous', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (7, '6', 'sc', 'Subcutaneous', 'LDSubcutaneous', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (8, '6', 'im', 'Intramuscular', 'LDIntramuscular', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (9, '6', 'sublingual', 'Sublingual', 'LDSublingual', 'Applied under the tounge', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (10, '6', 'ia', 'Intraarterial', 'LDIntraArterial', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (11, '6', 'pre_admit', 'Pre-admission', 'LDPreAdmission', '', '', '', 00000000000000, 'preload', 00000000000000);

#
# Dumping data for table care_type_assignment
#

INSERT INTO care_type_assignment VALUES (1, 'ward', 'Ward', 'LDWard', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_assignment VALUES (2, 'dept', 'Department', 'LDDepartment', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_assignment VALUES (3, 'firm', 'Firm', 'LDFirm', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_assignment VALUES (4, 'clinic', 'Clinic', 'LDClinic', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_cause_opdelay
#

INSERT INTO care_type_cause_opdelay VALUES (1, 'patient', 'Patient was delayed', 'LDPatientDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (2, 'nurse', 'Nurses were delayed', 'LDNursesDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (3, 'surgeon', 'Surgeons were delayed', 'LDSurgeonsDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (4, 'cleaning', 'Cleaning delayed', 'LDCleaningDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (5, 'anesthesia', 'Anesthesiologist was delayed', 'LDAnesthesiologistDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (0, 'other', 'Other causes', 'LDOtherCauses', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_color
#

INSERT INTO care_type_color VALUES ('yellow', 'yellow', 'LDyellow', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('black', 'black', 'LDblack', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('blue_pale', 'pale blue', 'LDpaleblue', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('brown', 'brown', 'LDbrown', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('pink', 'pink', 'LDpink', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('yellow_pale', 'pale yellow', 'LDpaleyellow', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('red', 'red', 'LDred', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('green_pale', 'pale green', 'LDpalegreen', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('violet', 'violet', 'LDviolet', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('blue', 'blue', 'LDblue', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('biege', 'biege', 'LDbiege', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('orange', 'orange', 'LDorange', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('green', 'green', 'LDgreen', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('rose', 'rose', 'LDrose', '', '', 00000000000000);

#
# Dumping data for table care_type_department
#

INSERT INTO care_type_department VALUES (1, 'medical', 'Medical', 'LDMedical', 'Medical, Nursing, Diagnostics, Labs, OR', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_department VALUES (2, 'support', 'Support (non-medical)', 'LDSupport', 'non-medical departments', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_department VALUES (3, 'news', 'News', 'LDNews', 'News group or category', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_discharge
#

INSERT INTO care_type_discharge VALUES (1, 'regular', 'Regular discharge', 'LDRegularRelease',  NULL, '', 20030415010555, '', 20030413121226);
INSERT INTO care_type_discharge VALUES (2, 'own', 'Patient left hospital on his own will', 'LDSelfRelease',  NULL, '', 20030415010606, '', 20030413121317);
INSERT INTO care_type_discharge VALUES (3, 'emergency', 'Emergency discharge', 'LDEmRelease',  NULL, '', 20030415010617, '', 20030413121452);
INSERT INTO care_type_discharge VALUES (4, 'change_ward', 'Change of ward', 'LDChangeWard',  NULL, '', 00000000000000, '', 20030413121526);
INSERT INTO care_type_discharge VALUES (6, 'change_bed', 'Change of bed', 'LDChangeBed',  NULL, '', 20030415000942, '', 20030413121619);
INSERT INTO care_type_discharge VALUES (7, 'death', 'Death of patient', 'LDPatientDied',  NULL, '', 20030415010642, '', 00000000000000);
INSERT INTO care_type_discharge VALUES (5, 'change_room', 'Change of room', 'LDChangeRoom',  NULL, '', 20030415010659, '', 00000000000000);

#
# Dumping data for table care_type_duty
#

INSERT INTO care_type_duty VALUES (1, 'regular', 'Regular duty', 'LDRegularDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (2, 'standby', 'Standby duty', 'LDStandbyDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (3, 'morning', 'Morning duty', 'LDMorningDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (4, 'afternoon', 'Afternoon duty', 'LDAfternoonDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (5, 'night', 'Night duty', 'LDNightDuty', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_encounter
#

INSERT INTO care_type_encounter VALUES (1, 'referral', 'Referral', 'LDEncounterReferral', 'Referral admission or visit', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (2, 'emergency', 'Emergency', 'LDEmergency', 'Emergency admission or visit', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (3, 'birth_delivery', 'Birth delivery', 'LDBirthDelivery', 'Admission or visit for birth delivery', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (4, 'walk_in', 'Walk-in', 'LDWalkIn', 'Walk -in admission or visit (non-referred)', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (5, 'accident', 'Accident', 'LDAccident', 'Emergency admission due to accident', '0', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_ethnic_orig
#

INSERT INTO care_type_ethnic_orig VALUES (1, '1', 'asian', 'LDAsian', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_ethnic_orig VALUES (2, '1', 'black', 'LDBlack', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_ethnic_orig VALUES (3, '1', 'caucasian', 'LDCaucasian', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_ethnic_orig VALUES (4, '1', 'white', 'LDWhite', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_event
#

INSERT INTO care_type_event VALUES (1, 'request_test_patho', 'Pathological test request', 'LDPathoTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (2, 'request_test_serology', 'Serology test request', 'LDSerologyTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (3, 'request_test_radio', 'Radiological test  request', 'LDRadioTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (4, 'request_test_ecg', 'ECG test request', 'LDEcgTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (5, 'request_test_eeg', 'EEG test request', 'LDEegTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (6, 'request_test_bact', 'Bacteriological test request', 'LDBactTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (7, 'request_test_echo', 'Echocardiography test request', 'LDEchoTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (8, 'request_test_blood', 'Blood test request', 'LDBloodTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (9, 'request_draw_blood', 'Blood draw request', 'LDBloodDrawRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (10, 'result_test_patho', 'Pathological test result', 'LDPathoTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (11, 'result_test_serology', 'Serological test result', 'LDSerologicalTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (12, 'result_test_radio', 'Radiological test result', 'LDRadioTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (13, 'result_test_ecg', 'ECG test result', 'LDEcgTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (14, 'result_test_eeg', 'EEG test result', 'LDEegTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (15, 'result_test_bact', 'Bacteriological test result', 'LDBactTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (16, 'result_test_echo', 'Echocardiography test result', 'LDEchoTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (17, 'result_test_blood', 'Blood test result', 'LDBloodTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (18, 'is_blood_drawn', 'Blood is drawn', 'LDBloodIsDrawn', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (19, 'nursing_report', 'New nursing report', 'LDNewNursingReport', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (20, 'effect_report', 'New effectivity report', 'LDNewEffectReport', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (21, 'directive', 'New doctor\'s directive', 'LDNewDoctorDirective', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (22, 'inquiry_doctor', 'New inquiry to doctor', 'LDNewInquiryDoctor', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (23, 'nursing_problem', 'New nursing problem', 'LDNewNursingProblem', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (24, 'anticoag_program', 'Anticoagulant program in progress', 'LDAnticoagProgramProgress', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (25, 'iv_tube', 'Intravenous tube in place', 'LDIVTubePlace', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (26, 'ia_tube', 'Intra-arterial tube in place', 'LDIATubePlace', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (27, 'cave', 'Cave', 'LDCave', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (28, 'monitor_fluids', 'Monitor fluid intake & discharge', 'LDMonitorFluids', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (29, 'intensive_care', 'Intensive care program', 'LDIntensiveCare', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (30, 'monitor_bpt_intensive', 'Intensive monitoring of bp & temp', 'LDIntensiveBPT', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (31, 'monitor_weight', 'Monitor weight', 'LDMonitorWeight', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (32, 'antibiotics_program', 'Antibiotics program', 'LDAntibioticsProgram', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (33, 'monitor_bpt', 'Monitor blood pressure & temp', 'LDMonitorBPT', '', '', 00000000000000);

#
# Dumping data for table care_type_feeding
#

INSERT INTO care_type_feeding VALUES (1, '2', 'breast', 'Breast', 'LDBreast', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (2, '2', 'formula', 'Formula', 'LDFormula', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (3, '2', 'both', 'Both', 'LDBoth', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (4, '2', 'parenteral', 'Parenteral', 'LDPerenteral', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (5, '2', 'never_fed', 'Never fed', 'LDNeverFed', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_insurance
#

INSERT INTO care_type_insurance VALUES (1, 'medical_main', 'Medical insurance', 'LDMedInsurance', 'Main (default) medical insurance', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (2, 'medical_extra', 'Extra medical insurance', 'LDExtraMedInsurance', 'Extra medical insurance (evt. pays extra services)', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (3, 'dental', 'Dental insurance', 'LDDentalInsurance', 'Separate dental plan in case not included in medical plan or simply additional private plan', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (4, 'disability', 'Disability plan', 'LDDisabilityPlan', 'Disability insurance plan - general , both long term & short term', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (5, 'disability_short', 'Disability plan (short term)', 'LDDisabilityPlanShort', 'Short term disability plan', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (6, 'disability_long', 'Disability plan (long term)', 'LDDisabilityPlanLong', 'Long term disability plan', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (7, 'retirement_income', 'Retirement  income plan (general)', 'LDRetirementIncomePlan', 'Retirement income plan - either private or income/employer supported', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (8, 'edu_reimbursement', 'Educational Reimbursement Plan', 'LDEduReimbursementPlan', 'Reimbursement plan for education, either private or employer supported', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (9, 'retirement_medical', 'Retirement medical plan', 'LDRetirementMedPlan', 'Medical plan in retirement  - might include other care services', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (10, 'liability', 'Liability Insurance Plan', 'LDLiabilityPlan', 'General liability insurance - either private or employer supported', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (11, 'malpractice', 'Malpractice Insurance Plan', 'LDMalpracticeInsurancePlan', 'Insurance plan against possible malpractice', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (12, 'unemployment', 'Unemployment Insurance Plan', 'LDUnemploymentPlan', 'Unemployment insurance , in case compulsory unemployment funds are guaranteed by the state, this plan is usually privately paid by the insured', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_location
#

INSERT INTO care_type_location VALUES (1, 'dept', 'Department', 'LDDepartment', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (2, 'ward', 'Ward', 'LDWard', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (3, 'firm', 'Firm', 'LDFirm', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (4, 'room', 'Room', 'LDRoom', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (5, 'bed', 'Bed', 'LDBed', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (6, 'clinic', 'Clinic', 'LDClinic', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_measurement
#

INSERT INTO care_type_measurement VALUES (1, 'bp_systolic', 'Systolic', 'LDSystolic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (2, 'bp_diastolic', 'Diastolic', 'LDDiastolic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (3, 'temp', 'Temperature', 'LDTemperature', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (4, 'fluid_intake', 'Fluid intake', 'LDFluidIntake', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (5, 'fluid_output', 'Fluid output', 'LDFluidOutput', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (6, 'weight', 'Weight', 'LDWeight', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (7, 'height', 'Height', 'LDHeight', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (8, 'bp_composite', 'Sys/Dias', 'LDSysDias',  NULL, '', 20030419143920, '', 20030419143920);

#
# Dumping data for table care_type_notes
#

INSERT INTO care_type_notes VALUES (1, 'histo_physical', 'Admission History and Physical', 'LDAdmitHistoPhysical', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (2, 'daily_doctor', 'Doctor\'s daily notes', 'LDDoctorDailyNotes', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (3, 'discharge', 'Discharge summary', 'LDDischargeSummary', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (4, 'consult', 'Consultation notes', 'LDConsultNotes', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (5, 'op', 'Operation notes', 'LDOpNotes', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (6, 'daily_ward', 'Daily ward\'s notes', 'LDDailyNurseNotes', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (99, 'other', 'Other', 'LDOther', '', '', 20030420000747, '', 00000000000000);
INSERT INTO care_type_notes VALUES (7, 'daily_chart_notes', 'Chart notes', 'LDChartNotes', '', '', 20030419114423, '', 00000000000000);
INSERT INTO care_type_notes VALUES (8, 'chart_notes_etc', 'PT,ATG,etc. daily notes', 'LDPTATGetc', '', '', 20030419114204, '', 00000000000000);
INSERT INTO care_type_notes VALUES (9, 'daily_iv_notes', 'IV daily notes', 'LDIVDailyNotes', '', '', 20030419114619, '', 00000000000000);
INSERT INTO care_type_notes VALUES (10, 'daily_anticoag', 'Anticoagulant daily notes', 'LDAnticoagDailyNotes', '', '', 20030419111909, '', 00000000000000);
INSERT INTO care_type_notes VALUES (11, 'lot_charge_nr', 'Material LOT, Charge Nr.', 'LDMaterialLOTChargeNr', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (12, 'text_diagnosis', 'Diagnosis text', 'LDDiagnosis', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (13, 'text_therapy', 'Therapy text', 'LDTherapy', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (14, 'chart_extra', 'Extra notes on therapy & diagnosis', 'LDExtraNotes', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (15, 'nursing_report', 'Nursing care report', 'LDNursingReport', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (16, 'nursing_problem', 'Nursing problem report', 'LDNursingProblemReport', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (17, 'nursing_effectivity', 'Nursing effectivity report', 'LDNursingEffectivityReport', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (18, 'nursing_inquiry', 'Inquiry to doctor', 'LDInquiryToDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (19, 'doctor_directive', 'Doctor\'s directive', 'LDDoctorDirective', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (20, 'problem', 'Problem', 'LDProblem', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (21, 'development', 'Development', 'LDDevelopment', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (22, 'allergy', 'Allergy', 'LDAllergy',  NULL, '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_notes VALUES (23, 'daily_diet', 'Diet plan', 'LDDietPlan', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_outcome
#

INSERT INTO care_type_outcome VALUES (1, '2', 'alive', 'Alive', 'LDAlive', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (2, '2', 'stillborn', 'Stillborn', 'LDStillborn', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (3, '2', 'early_neonatal_death', 'Early neonatal death', 'LDEarlyNeonatalDeath', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (4, '2', 'late_neonatal_death', 'Late neonatal death', 'LDLateNeonatalDeath', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (5, '2', 'death_uncertain_timing', 'Death uncertain timing', 'LDDeathUncertainTiming', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_perineum
#

INSERT INTO care_type_perineum VALUES (1, 'intact', 'Intact', 'LDIntact', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (2, '1_degree', 'First degree tear', 'LDFirstDegreeTear', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (3, '2_degree', 'Second degree tear', 'LDSecondDegreeTear', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (4, '3_degree', 'Third degree tear', 'LDThirdDegreeTear', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_prescription
#

INSERT INTO care_type_prescription VALUES (1, 'anticoag', 'Anticoagulant', 'LDAnticoagulant', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_prescription VALUES (2, 'hemolytic', 'Hemolytic', 'LDHemolytic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_prescription VALUES (3, 'diuretic', 'Diuretic', 'LDDiuretic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_prescription VALUES (4, 'antibiotic', 'Antibiotic', 'LDAntibiotic', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_room
#

INSERT INTO care_type_room VALUES (1, 'ward', 'Ward room', 'LDWard', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_room VALUES (2, 'op', 'Operating room', 'LDOperatingRoom', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_test
#

INSERT INTO care_type_test VALUES (1, 'chemlabor', 'Chemical-Serology Lab', 'LDChemSerologyLab', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (2, 'patho', 'Pathological Lab', 'LDPathoLab', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (3, 'baclabor', 'Bacteriological Lab', 'LDBacteriologicalLab', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (4, 'radio', 'Radiological Lab', 'LDRadiologicalLab', 'Lab for X-ray, Mammography, Computer Tomography, NMR', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (5, 'blood', 'Blood test & product', 'LDBloodTestProduct', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (6, 'generic', 'Generic test program', 'LDGenericTestProgram', '', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_time
#

INSERT INTO care_type_time VALUES (1, 'patient_entry_exit', 'Patient entry/exit', 'LDPatientEntryExit', 'Times when patient entered and left the op room', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (2, 'op_start_end', 'OP start/end', 'LDOPStartEnd', 'Times when op started (1st incision) and ended (last suture)', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (3, 'delay', 'Delay time', 'LDDelayTime', 'Times when the op was delayed due to any reason', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (4, 'plaster_cast', 'Plaster cast', 'LDPlasterCast', 'Times when the plaster cast was made', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (5, 'reposition', 'Reposition', 'LDReposition', 'Times when a dislocated joint(s) was repositioned (non invasive op)', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (6, 'coro', 'Coronary catheter', 'LDCoronaryCatheter', 'Times when a coronary catherer op was done (minimal invasive op)', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (7, 'bandage', 'Bandage', 'LDBandage', 'Times when the bandage was made', '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_type_unit_measurement
#

INSERT INTO care_type_unit_measurement VALUES (1, 'volume', 'Volume', 'LDVolume', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (2, 'weight', 'Weight', 'LDWeight', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (3, 'length', 'Length', 'LDLength', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (4, 'pressure', 'Pressure', 'LDPressure', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (5, 'temperature', 'Temperature', 'LDTemperature', '', '', '', 20030419144724, '', 20030419144724);

#
# Dumping data for table care_unit_measurement
#

INSERT INTO care_unit_measurement VALUES (1, 1, 'ml', 'Milliliter', 'LDMilliliter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (2, 2, 'mg', 'Milligram', 'LDMilligram', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (3, 3, 'mm', 'Millimeter', 'LDMillimeter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (4, 1, 'liter', 'liter', 'LDLiter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (5, 2, 'gm', 'gram', 'LDGram', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (6, 2, 'kg', 'kilogram', 'LDKilogram', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (7, 3, 'cm', 'centimeter', 'LDCentimeter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (8, 3, 'm', 'meter', 'LDMeter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (9, 3, 'km', 'kilometer', 'LDKilometer', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (10, 3, 'in', 'inch', 'LDInch', 'english',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (11, 3, 'ft', 'foot', 'LDFoot', 'english',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (12, 3, 'yd', 'yard', 'LDYard', 'english',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (14, 4, 'mmHg', 'mmHg', 'LDmmHg', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (15, 5, 'celsius', 'Celsius', 'LDCelsius', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);

#
# Dumping data for table care_users
#

INSERT INTO care_users VALUES ('admin', 'admin', 'admin', '0', 'System_Admin', '1', '0000-00-00', '00:00:00', '2003-07-27', '00:00:00', '', '', '', 20030427205316, '', 00000000000000);

    
